<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FollowRepairs;
use App\Models\Department;
use App\Models\Repair;
use App\Models\RepairFollow;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function logout(Request $request)
    {
        // Get the current user's information
        $user = Auth::user();

        // Log the user out
        Auth::logout();

        // Optionally, you can perform a redirect after logging out
        return redirect('/')->with('status', 'You have been successfully logged out.');
    }

    public function index()
    {
        $countRepair = Repair::where('status_repair', 'แจ้งซ่อม')->count();
        $countAdmin = User::where('role', 1)->count();
        $countTechnician = User::where('role', 2)->count();
        $department = Department::all()->count();
        $rooms = Room::all()->count();
        // dd( $countRepair);
        return view('admin.dashboard', compact('rooms', 'countRepair', 'countAdmin', 'countTechnician', 'department'));
    }

    public function repair_show(Request $request, $p)
    {
        // จำนวนรายการที่ต้องการแสดงในแต่ละหน้า
        $perPage = $p;

        $select_param = $request->query('status');

        $inupfilter = $request->query('q');

        $ChartWorkcompleted = 0;
        $ChartWorknotcompleted = 0;
        // dd($select_param);
        $status = $select_param;

        // $repairsQuery = Repair::query();
        $repairsQuery = DB::table('repairs');

        $repairsQuery->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
            ->select('repairs.*', 'departments.department_id', 'departments.department_name', 'departments.status_display');


        if ($inupfilter) {
            // dd($inupfilter);
            $repairsQuery->where(function ($query) use ($inupfilter) {
                $query->orWhere('status', 'like', "%$inupfilter%")
                    ->orWhere('site', 'like', "%$inupfilter%")
                    ->orWhere('tag_repair', 'like', "%$inupfilter%")
                    ->orWhere('department_name', 'like', "%$inupfilter%")
                    ->orWhere('status_repair', 'like', "%$inupfilter%");
            });
        }

        if ($status === "ทั้งหมด") {
            $liRepair = $repairsQuery->get();
        } else {
            $liRepair = $repairsQuery->where('status_repair', $status)->get();
        }
        // dd($liRepair,$status);
        $worlALL = Repair::count();

        $departments = $repairsQuery
            ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'));


        $departments = Repair::select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
            ->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
            ->groupBy('repairs.type', 'departments.department_name')
            ->get();

        // dd( $departments);
        $ChartWorkcompleted = $liRepair->filter(function ($item) {
            return $item->status_repair === 'ดำเนินการเสร็จสิ้น';
        })->count();

        $ChartWorknotcompleted = $liRepair->filter(function ($item) {
            return $item->status_repair <> 'ดำเนินการเสร็จสิ้น';
        })->count();

        $worlALL = Repair::count();
        foreach ($liRepair as $repair) {
            $startDate = Carbon::parse($repair->created_at);
            $endDate = Carbon::parse($repair->updated_at);
            $repair->daysDiff = $startDate->diffInDays($endDate);
            $repair->created_at_thai = Carbon::parse($repair->created_at)->thaidate('D j M y');
            $repair->updated_at_thai = Carbon::parse($repair->updated_at)->thaidate('D j M y');
        }
        // dd($worlALL);

        // หาหน้าที่ถูกเรียก
        $page = Paginator::resolveCurrentPage('page');
        // $page = request()->get('page', 1);

        // ข้ามและจำกัดการคำนวณตามหน้าปัจจุบันและรายการต่อหน้า
        $skip = ($page - 1) * $perPage;
        $take = $perPage;

        // แบ่งส่วนคอลเลกชันเพื่อดึงข้อมูลรายการของหน้าปัจจุบัน
        $repairconut =  $liRepair->count();

        //การแบ่งส่วน Collection
        $currentPageItems =  $liRepair->slice($skip, $take);
        // dd($currentPageItems);
        // สร้างรายการข้อมูลที่แบ่งหน้า
        $repairs = new LengthAwarePaginator(
            $currentPageItems, // collection ที่แบ่งตาม $perPage แล้ว
            $repairconut, // จำนวนสิ่งของข้อมูลทั้งหมด (ได้มาจากคอลเลกชันดั้งเดิม)
            $perPage, // รายการต่อหน้า
            $page, // หมายเลขหน้าปัจจุบัน
            [
                'path' => URL::current(), // Optional: Base URL for pagination links (adjust if needed)
                'query' => request()->query(), // Optional: Query parameters to carry over when paging
            ]
        );
        $repairs->withQueryString();
        // dd($repairs);

        // $departments = Department::select('department_id', 'department_name')->where('status_display', '=', 0)->get();


        $departmentsArray = $departments->toArray();

        // dd( $departmentsArray);

        function random_color()
        {
            return '#' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        }

        $bgcolor = [];
        foreach ($departmentsArray as $department) {
            $bgcolor[] = random_color();
        }

        // dd($departmentsArray);
        $data =  collect([
            'datasets1' => [
                'data' => $departmentsArray,
                'backgroundColor' => $bgcolor
            ],
            'datasets2' => [
                'data' => [$ChartWorkcompleted, $ChartWorknotcompleted],
                'backgroundColor' => ["#dc3545", "#198754"]
            ]
        ]);
        // dd($currentPageItems);
        $branch_department = Department::where('status_display', 0)->get();
        // dd( $ChartWorkcompleted,$ChartWorknotcompleted);
        return view('admin.list-repair', ['jChart' => $data], compact('worlALL', 'branch_department', 'repairs', 'inupfilter', 'perPage', 'ChartWorkcompleted', 'ChartWorknotcompleted'));
    }

    public function setdepart(Request $request)
    {
        try {
            DB::beginTransaction();
            $conditions  = RepairFollow::where('repair_id', $request->id_repair)->where('status_repair', 'รอดำเนินการ')->first();
            if (isset($conditions)) {
                $repair = Repair::where('id_repair', $request->id_repair)
                    ->update(['type' => $request->depart_id]);
            } else {
                $repairsStatus = RepairFollow::create(['repair_id' => $request->id_repair, 'status_repair' => 'รอดำเนินการ']);
                $repair = Repair::where('id_repair', $request->id_repair)
                    ->update(['type' => $request->depart_id, 'status_repair' => 'รอดำเนินการ', 'status_follow' => $repairsStatus->id]);
            }

            // $url = url('/') . "/technician/dashboard/10";
            $url = route('technician.dashboard', ['p' => 10]);
            $department = Department::find($request->depart_id);
            $message = " มีการส่งงานไปยัง {$department->department_name}\n";
            $message2 =  "[คลิกที่นี่เพื่อดูข้อมูลเพิ่มเติม]({$url})";
            if ($repair) {
                Line::send($message . $message2);
            };
            $repaors = Repair::where('id_repair', $request->id_repair)->first();
            Mail::to($repaors->email)->send(new FollowRepairs($repaors));
            DB::commit();
            return response()->json([
                'status' => '200',
                'message' => 'มอบหมายงานเสร็จสิ้น'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            // Return error message
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }

    // private function
    private function differentday($query)
    {
        $resultData = [];
        $createdDate = $query->pluck('created');
        $updated = $query->pluck('updated');
        $dataAll = [
            'data1' => $createdDate,
            'data2' => $updated
        ];
        // $startDate = Carbon::parse($repairsQuery->created_at);
        // $endDate = Carbon::parse($repairsQuery->updated_at);
        // $daysDiff = $endDate->diffInDays($startDate);
        if (isset($query)) {
            foreach ($query as $val) {
                $startdata = Carbon::parse($val->created_at);
                $enddata = Carbon::parse($val->updated_at);
                $val->period = $enddata->diffInDays($startdata);
                $resultData[] = $val;
            }
        }

        return $resultData;
    }
}
