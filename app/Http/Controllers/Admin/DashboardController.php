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
use Illuminate\Support\Facades\DB;

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

        $ChartWorkcompleted = 0;
        $ChartWorknotcompleted = 0;
        // dd($select_param);
        if ($select_param == "ดำเนินการเสร็จสิ้น") {
            $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')->where('status_repair', $select_param)->orderBy('repairs.updated_at', 'desc')->get();
            //jChart
            $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                ->where('status_repair', $select_param)
                ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                ->groupBy('repairs.type', 'departments.department_name')
                ->orderBy('repairs.updated_at', 'desc')
                ->get();
            //countWork
            $ChartWorkcompleted = Repair::where('status_repair', "ดำเนินการเสร็จสิ้น")->count();

            if ($select_param == "ดำเนินการเสร็จสิ้น" && $inupfilter) {
                $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')->where('status_repair', $select_param)
                    ->where(function ($query) use ($inupfilter) {
                        $query
                            ->orWhere('status', 'like', "%$inupfilter%")
                            ->orWhere('site', 'like', "%$inupfilter%")
                            ->orWhere('tag_repair', 'like', "%$inupfilter%")
                            ->orWhere('department_name', 'like', "%$inupfilter%")
                            ->orWhere('status_repair', 'like', "%$inupfilter%");
                    })->orderBy('repairs.updated_at', 'desc')->get();
                //jChart
                $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                    ->where('status_repair', $select_param)
                    ->where(function ($query) use ($inupfilter) {
                        $query
                            ->orWhere('status', 'like', "%$inupfilter%")
                            ->orWhere('site', 'like', "%$inupfilter%")
                            ->orWhere('tag_repair', 'like', "%$inupfilter%")
                            ->orWhere('department_name', 'like', "%$inupfilter%")
                            ->orWhere('status_repair', 'like', "%$inupfilter%");
                    })
                    ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                    ->groupBy('repairs.type', 'departments.department_name')
                    ->get();
                //Number of jobs (จำนวนงาน)
                $ChartWorkcompleted = $liRepair->filter(function ($item) {
                    return $item->status_repair === 'ดำเนินการเสร็จสิ้น';
                })->count();
                $ChartWorknotcompleted = $liRepair->filter(function ($item) {
                    return $item->status_repair === 'รอดำเนินการ';
                })->count();
            }
        } elseif ($select_param == "รอดำเนินการ") {
            $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')->where('status_repair', $select_param)->orderBy('repairs.updated_at', 'desc')->get();
            //jChart
            $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                ->where('status_repair', $select_param)
                ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                ->groupBy('repairs.type', 'departments.department_name')
                ->get();
            //countWork

            $ChartWorknotcompleted = Repair::where('status_repair', "รอดำเนินการ")->count();
            if ($select_param == "รอดำเนินการ" && $inupfilter) {
                $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')->where('status_repair', $select_param)
                    ->where(function ($query) use ($inupfilter) {
                        $query
                            ->orWhere('status', 'like', "%$inupfilter%")
                            ->orWhere('site', 'like', "%$inupfilter%")
                            ->orWhere('tag_repair', 'like', "%$inupfilter%")
                            ->orWhere('department_name', 'like', "%$inupfilter%")
                            ->orWhere('status_repair', 'like', "%$inupfilter%");
                    })->orderBy('repairs.updated_at', 'desc')->get();
                //jChart
                $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                    ->where('status_repair', $select_param)
                    ->where(function ($query) use ($inupfilter) {
                        $query
                            ->orWhere('status', 'like', "%$inupfilter%")
                            ->orWhere('site', 'like', "%$inupfilter%")
                            ->orWhere('tag_repair', 'like', "%$inupfilter%")
                            ->orWhere('department_name', 'like', "%$inupfilter%")
                            ->orWhere('status_repair', 'like', "%$inupfilter%");
                    })
                    ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                    ->groupBy('repairs.type', 'departments.department_name')
                    ->get();
                //Number of jobs (จำนวนงาน)
                $ChartWorkcompleted = $liRepair->filter(function ($item) {
                    return $item->status_repair === 'ดำเนินการเสร็จสิ้น';
                })->count();
                $ChartWorknotcompleted = $liRepair->filter(function ($item) {
                    return $item->status_repair === 'รอดำเนินการ';
                })->count();
            }
        } elseif ($select_param == "ทั้งหมด" && $inupfilter) {
            $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                ->where(function ($query) use ($inupfilter) {
                    $query
                        ->orWhere('status', 'like', "%$inupfilter%")
                        ->orWhere('site', 'like', "%$inupfilter%")
                        ->orWhere('tag_repair', 'like', "%$inupfilter%")
                        ->orWhere('department_name', 'like', "%$inupfilter%")
                        ->orWhere('status_repair', 'like', "%$inupfilter%");
                })->orderBy('repairs.updated_at', 'desc')->get();
            //jChart
            $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                ->where(function ($query) use ($inupfilter) {
                    $query
                        ->orWhere('status', 'like', "%$inupfilter%")
                        ->orWhere('site', 'like', "%$inupfilter%")
                        ->orWhere('tag_repair', 'like', "%$inupfilter%")
                        ->orWhere('department_name', 'like', "%$inupfilter%")
                        ->orWhere('status_repair', 'like', "%$inupfilter%");
                })
                ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                ->groupBy('repairs.type', 'departments.department_name')
                ->get();

            //Number of jobs (จำนวนงาน)
            $ChartWorkcompleted = $liRepair->filter(function ($item) {
                return $item->status_repair === 'ดำเนินการเสร็จสิ้น';
            })->count();

            $ChartWorknotcompleted = $liRepair->filter(function ($item) {
                return $item->status_repair === 'รอดำเนินการ';
            })->count();
        } else {
            // $liRepair = Repair::with('department')->select('departments.department_name','name')->orderBy('updated_at', 'desc')->get();
            $liRepair = DB::table('repairs')->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
            ->orderBy('repairs.updated_at', 'desc')
            ->get();

            $departments = Repair::leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
                ->select('repairs.type', 'departments.department_name', DB::raw('count(*) as work'))
                ->groupBy('repairs.type', 'departments.department_name')
                ->get();

            $ChartWorkcompleted = Repair::where('status_repair', "ดำเนินการเสร็จสิ้น")->count();
            $ChartWorknotcompleted = Repair::where('status_repair', "รอดำเนินการ")->count();
        }
        // dd($ChartWorkcompleted, $ChartWorknotcompleted);


        $liRepairthaiDate = $liRepair->map(function ($item) {
            $thaiDate = Carbon::parse($item->created_at)->thaidate('j M y');
            $updatedItem = (array) $item; //->toArray() Convert the item to an array
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
        // dd($data);

        // dd( $ChartWorkcompleted,$ChartWorknotcompleted);
        return view('admin.list-repair', ['jChart' => $data], compact('repairs', 'inupfilter', 'perPage', 'ChartWorkcompleted', 'ChartWorknotcompleted'));
    }
}
