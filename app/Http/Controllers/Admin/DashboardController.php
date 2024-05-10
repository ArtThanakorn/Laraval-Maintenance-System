<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Phattarachai\Thaidate\Thaidate;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $countRepair = Repair::where('status_repair', 'รอดำเนินการ')->count();
        $countAdmin = User::where('role', 1)->count();
        $countTechnician = User::where('role', 2)->count();
        $department = Department::all()->count();
        return view('admin.dashboard', compact('countRepair', 'countAdmin', 'countTechnician', 'department'));
    }



    public function repair_show(Request $request, $p)
    {
        // จำนวนรายการที่ต้องการแสดงในแต่ละหน้า
        $perPage = $p;
        
        $select_param = $request->query('status');

        $inupfilter = $request->query('q');
        

        if ($select_param == "เนินการเสร็จสิ้น"||$inupfilter) {
            $liRepair = Repair::with('department')->where('status_repair',$select_param)
            ->where(function ($query) use ($inupfilter) {
                $query
                    ->orWhere('status', 'like', "%$inupfilter%")
                    ->orWhere('site', 'like', "%$inupfilter%")
                    ->orWhere('status_repair', 'like', "%$inupfilter%");
            })
            ->orderBy('updated_at', 'desc')->get();
            
        }elseif($select_param == "รอดำเนินการ"||$inupfilter){
            $liRepair = Repair::with('department')->where('status_repair',$select_param)
            ->where(function ($query) use ($inupfilter) {
                $query
                    ->orWhere('status', 'like', "%$inupfilter%")
                    ->orWhere('site', 'like', "%$inupfilter%")
                    ->orWhere('status_repair', 'like', "%$inupfilter%");
            })->orderBy('updated_at', 'desc')->get();
          
        }else{
            $liRepair = Repair::with('department')->orderBy('updated_at', 'desc')->get();
        }

        $liRepairthaiDate = $liRepair->map(function ($item) {
            $thaiDate = Carbon::parse($item->created_at)->thaidate('j M y');
            $updatedItem = $item->toArray(); // Convert the item to an array
            $updatedItem['created_at'] = $thaiDate; // Replace the 'created_at' value
            return $updatedItem; // Return the modified item array
        });

     
        // หาหน้าที่ถูกเรียก
        $page = Paginator::resolveCurrentPage('page');
        // $page = request()->get('page', 1);

        // ข้ามและจำกัดการคำนวณตามหน้าปัจจุบันและรายการต่อหน้า
        $skip = ($page - 1) * $perPage;
        $take = $perPage;

        // แบ่งส่วนคอลเลกชันเพื่อดึงข้อมูลรายการของหน้าปัจจุบัน
        $repairconut =  $liRepairthaiDate->count();

        //การแบ่งส่วน Collection
        $currentPageItems =  $liRepairthaiDate->slice($skip, $take);
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

        $departments = Department::select('department_id', 'department_name')->where('status_display', '=', 0)->get();
        $departmentsArray = $departments->toArray();

        $departmentIds = $departments->pluck('department_id');
        $types = $liRepair->pluck('type');
        $matchedIds = $departmentIds->diff($types);
        $counts = $types->countBy();

        //  dd($matchedIds); // [0, 13, 1]   $counts[2]
        foreach ($matchedIds as $matchedId) {
            if (!isset($counts[$matchedId])) {
                $counts->push(0);
            }
        }
        $datachart = $counts->toArray();

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

        $data =  collect([
            'labels' => $departmentsArray,
            'datasets' => [
                'data' => $datachart,
                'backgroundColor' => $bgcolor
            ]
        ]);
        // dd($data);
        $ChartWorkcompleted = Repair::where('status_repair',"เนินการเสร็จสิ้น")->count();
        $ChartWorknotcompleted = Repair::where('status_repair',"รอดำเนินการ")->count();
        // dd( $ChartWorkcompleted,$ChartWorknotcompleted);
        return view('admin.list-repair',['jChart' => $data], compact('repairs', 'perPage', 'ChartWorkcompleted', 'ChartWorknotcompleted'));
    }
}
