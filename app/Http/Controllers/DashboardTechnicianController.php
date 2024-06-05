<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;
use App\Models\Department;
use App\Models\ImageRepair;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DashboardTechnicianController extends Controller
{
    public function index(Request $request, $p)
    {
        // $workData = Repair::where('type', Auth::user()->department)->paginate($p);//
        $workData_query = Repair::query();

        $search_param = $request->query('q');
        $inupfilter = $request->query('status');
        // dd($search_param);
        if ($inupfilter == "ดำเนินการเสร็จสิ้น") {
            $workData_query->where('type', Auth::user()->department)->where('status_repair', $inupfilter);
            if ($inupfilter == "ดำเนินการเสร็จสิ้น" && $search_param) {
                $workData_query->where('type', Auth::user()->department)->where('status_repair', $inupfilter);
                $workData_query->where(function ($query) use ($search_param) {
                    $query
                        ->orWhere('status', 'like', "%$search_param%")
                        ->orWhere('site', 'like', "%$search_param%")
                        ->orWhere('status_repair', 'like', "%$search_param%");
                });
            }
        } elseif ($inupfilter == "รอดำเนินการ") {
            $workData_query->where('type', Auth::user()->department)->where('status_repair', $inupfilter);
            if ($inupfilter == "รอดำเนินการ" && $search_param) {
                $workData_query->where('type', Auth::user()->department)->where('status_repair', $inupfilter);
                $workData_query->where(function ($query) use ($search_param) {
                    $query
                        ->orWhere('status', 'like', "%$search_param%")
                        ->orWhere('site', 'like', "%$search_param%")
                        ->orWhere('status_repair', 'like', "%$search_param%");
                });
            }
        }elseif($inupfilter == "ทั้งหมด" && $search_param){
            $workData_query->where('type', Auth::user()->department);
                $workData_query->where(function ($query) use ($search_param) {
                    $query
                        ->orWhere('status', 'like', "%$search_param%")
                        ->orWhere('site', 'like', "%$search_param%")
                        ->orWhere('status_repair', 'like', "%$search_param%");
                });
        }else{
            $workData_query->where('type', Auth::user()->department);
        }

        $workData = $workData_query->with('imageRepair')->where('type', Auth::user()->department)->orderBy('updated_at', 'desc')->paginate($p);

        $department = Department::where('status_display', 0)->get();

        $imgrepairs = ImageRepair::all();

        // dd($workData);
        return view('technician.dashboard', compact('workData', 'p', 'search_param', 'department', 'imgrepairs'));
    }

    public function work_moves(Request $request)
    {
        $usedepar = Auth::user()->department;
        $department = Department::find($usedepar);
        $newdepar = Department::find($request->newdepartment);
        $url = url('/') . "/technician/dashboard/10";
        $message = "{$department->department_name} มีการส่งงานไปยัง {$newdepar->department_name}\n";
        $message2 =  "[คลิกที่นี่เพื่อดูข้อมูลเพิ่มเติม]({$url})";
        $repairs = Repair::where('id_repair', $request->id)->update(['type' => $request->newdepartment]);
        if ($repairs) {
            Line::send($message . $message2);
        };
        // return
    }

    public function work_updata(Request $request, $id)
    {

        $files = $request->file('imfupdate');

        $Urepai = Repair::find($id);
        Repair::where('id_repair', $id)->update(['status_repair' => $request->updateWork_select]);

        foreach ($files as $images) {
            $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension(); // ชื่อรูป
            $images->move(public_path('uploads/repair/'), $imageName); // path ที่ต้องการเก็บรูป
            ImageRepair::create([
                'id_repair' =>  $Urepai->id_repair,
                'nameImage' => $imageName
            ]);
        }


        return response()->json([
            'success' => 1,
            'message' => 'การอัพเดทงานเสร็จสมบูรณ์'
        ]);
    }
}
