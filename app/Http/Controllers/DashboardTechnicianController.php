<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;
use Illuminate\Support\Str;

class DashboardTechnicianController extends Controller
{
    public function index(Request $request,$p)
    {
        // $workData = Repair::where('type', Auth::user()->department)->paginate($p);//
        $workData_query = Repair::query();

        $search_param = $request->query('q') ?? $request->query('status');

        if ($search_param) {
            $workData_query->where('type', Auth::user()->department);
            $workData_query->where(function ($query) use ($search_param) {
                $query
                    ->orWhere('tag_repair', 'like', "%$search_param%")
                    ->orWhere('status_repair', 'like', "%$search_param%");
            });
        }
        $workData = $workData_query->where('type', Auth::user()->department)->orderBy('updated_at', 'desc')->paginate($p);

        $department = Department::where('status_display',0)->get();
        // dd($workData);
        return view('technician.dashboard',compact('workData','p','search_param','department'));
    }

    public function work_moves(Request $request)
    {
            $usedepar = Auth::user()->department;
            $department = Department::find($usedepar);
            $newdepar = Department::find($request->newdepartment);
            $url = url('/')."/technician/dashboard/10";
            $message ="{$department->department_name} มีการส่งงานไปยัง {$newdepar->department_name}\n";
            $message2 =  "[คลิกที่นี่เพื่อดูข้อมูลเพิ่มเติม]({$url})";
            $repairs = Repair::where('id_repair',$request->id)->update(['type' => $request->newdepartment]);
            if ($repairs) {
                Line::send($message.$message2);
            };
            // return 
    }
}
