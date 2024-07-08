<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Repair;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Phattarachai\Thaidate\Thaidate;
use Phattarachai\LineNotify\Facade\Line;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $countRepair = Repair::where('status_repair', 'รอดำเนินการ')->count();
        $countAdmin = User::where('role', 1)->count();
        $countTechnician = User::where('role', 2)->count();
        $department = Department::all()->count();
        $rooms = Room::all()->count();
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
        $repairsQuery = Repair::query();
        $repairsQuery->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
            ->select('repairs.*', 'departments.department_id', 'departments.department_name', 'departments.status_display')
            ->orderBy('repairs.updated_at', 'desc')
            ->with('imageRepair');

        if ($inupfilter) {
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
        // dd($liRepair->all());
        $departments = $repairsQuery
            ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
            ->groupBy('repairs.type', 'departments.department_name')
            ->get();

        $ChartWorkcompleted = $liRepair->filter(function ($item) {
            return $item->status_repair === 'ดำเนินการเสร็จสิ้น';
        })->count();

        $ChartWorknotcompleted = $liRepair->filter(function ($item) {
            return $item->status_repair === 'รอดำเนินการ';
        })->count();

        // dd( $liRepair);

        // $liRepairthaiDate = $liRepair->map(function ($item) {
        //     $thaiDate = Carbon::parse($item->created_at)->thaidate('j M y');
        //     $updatedItem = (array) $item; //->toArray() Convert the item to an array
        //     $updatedItem['created_at'] = $thaiDate; // Replace the 'created_at' value
        //     return $updatedItem; // Return the modified item array
        // });
        // dd($liRepairthaiDate);

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
        return view('admin.list-repair', ['jChart' => $data], compact('branch_department', 'repairs', 'inupfilter', 'perPage', 'ChartWorkcompleted', 'ChartWorknotcompleted'));
    }

    public function setdepart(Request $request)
    {
        $repairs = Repair::where('id_repair', $request->id_repair)->update(['type' => $request->depart_id]);

        // $url = url('/') . "/technician/dashboard/10";
        $url = route('technician.dashboard', ['p' => 10]);
        $department = Department::find($request->depart_id);
        $message = " มีการส่งงานไปยัง {$department->department_name}\n";
        $message2 =  "[คลิกที่นี่เพื่อดูข้อมูลเพิ่มเติม]({$url})";
        if ($repairs) {
            Line::send($message . $message2);
        };

        return response()->json([
            'status' => '200',
            'message' => 'มอบหมายงานเส็ดสื้น'
        ], 200);
    }
}
