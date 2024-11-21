<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;
use App\Models\Department;
use App\Models\ImageRepair;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\EmailTechnician;
use App\Mail\FollowRepairs;
use App\Models\RepairFollow;
use Exception;
use Illuminate\Support\Facades\Mail;

class DashboardTechnicianController extends Controller
{
    public function index(Request $request)
    {
        return view('technician.dashboard');
    }

    public function all_work(Request $request, $p)
    {
        // $workData = Repair::where('type', Auth::user()->department)->paginate($p);//
        $workData_query = Repair::query();
        $workData_query->leftJoin('users', 'repairs.user_responsible', '=', 'users.id');
        $search_param = $request->query('q');
        $inupfilter = $request->query('status');
        $use_department = Auth::user()->department;
        $userLevel = Auth::user()->level;
        $userId = Auth::user()->id;

        $workData_query->where('type', $use_department);

        if ($userLevel == 2) {
            $workData_query->where('user_responsible', $userId);
        }

        if (in_array($inupfilter, ["ดำเนินการเสร็จสิ้น", "รอดำเนินการ"])) {
            $workData_query->where('status_repair', $inupfilter);
        }

        if ($search_param) {
            $workData_query->where(function ($query) use ($search_param) {
                $query
                    ->orWhere('status', 'like', "%$search_param%")
                    ->orWhere('site', 'like', "%$search_param%")
                    ->orWhere('status_repair', 'like', "%$search_param%");
            });
        }

        $workData = $workData_query->orderBy('repairs.updated_at', 'desc')->paginate($p);

        $department = Department::where('status_display', 0)->get();

        $imgrepairs = ImageRepair::all();

        $work_recipient = User::where('department', $use_department)->where('level', 2)->get();

        $PDFdate = $workData_query->orderBy('repairs.updated_at', 'desc')->get();

        return view('technician.list-work', compact('work_recipient', 'workData', 'p', 'search_param', 'department', 'imgrepairs', 'PDFdate'));
    }

    public function work_moves(Request $request)
    {
        $usedepar = Auth::user()->department;
        $department = Department::find($usedepar);
        $newdepar = Department::find($request->newdepartment);
        $url = url('/') . "/technician/dashboard/10";
        $message = "{$department->department_name} มีการส่งงานไปยัง {$newdepar->department_name}\n";
        $message2 =  "[คลิกที่นี่เพื่อดูข้อมูลเพิ่มเติม]({$url})";
        $repairs = Repair::where('id_repair', $request->id)->update(['type' => $request->newdepartment, 'user_responsible' => null]);
        if ($repairs) {
            Line::send($message . $message2);
        };
        // return
    }

    public function work_updata(Request $request, $id)
    {
        // dd($request);
        $files = $request->file('imfupdate');

        $Urepai = Repair::find($id);
        // dd($repaors);
        try {
            DB::beginTransaction();
            // $conditions  = ['repair_id' => $id, 'status_repair' => $request->updateWork_select];
            $conditions  = RepairFollow::where('repair_id', $id)->where('status_repair', $request->updateWork_select)->first();

            if (isset($conditions)) {
                Repair::where('id_repair', $id)->update(['status_repair' => $request->updateWork_select]);
            } else {
                $repairsStatus = RepairFollow::create(['repair_id' =>  $id, 'status_repair' => $request->updateWork_select]);
                Repair::where('id_repair', $id)->update(['status_follow' => $repairsStatus->id, 'status_repair' => $request->updateWork_select]);
            };

            if (isset($files['imfupdate'])) {
                foreach ($files as $images) {
                    $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension(); // ชื่อรูป
                    $images->move(public_path('uploads/repair/'), $imageName); // path ที่ต้องการเก็บรูป
                    ImageRepair::create([
                        'id_repair' =>  $Urepai->id_repair,
                        'nameImage' => $imageName
                    ]);
                }
            }
            // dd($request->updateWork_select);
            $repaors = Repair::select('repairs.*', 'users.name as nameT')
                ->leftJoin('users', 'repairs.user_responsible', '=', 'users.id')->where('id_repair', $Urepai->id_repair)->first();
            if ($request->updateWork_select === "ดำเนินการเสร็จสิ้น") {
                // dd($repaors);
                Mail::to($repaors->email)->send(new EmailTechnician($repaors));
            } else {
                // dd($repaors);
                Mail::to($repaors->email)->send(new FollowRepairs($repaors));
            }

            DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'การอัพเดทงานเสร็จสมบูรณ์'
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'status' => false,
                'message' => 'server error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    // public function sendEmail($Urepai)
    // {
    //     $responsible = User::where('id', $Urepai->user_responsible)->first();
    //     try {
    //         Mail::to($Urepai->email)->send(new EmailTechnician($Urepai, $responsible));
    //         return "success";
    //     } catch (Exception $e) {
    //         // Return error message
    //         return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function workRecipient(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $conditions  = RepairFollow::where('repair_id', $request->repair_id)->where('status_repair', 'กำลังดำเนินการ')->first();
            if (isset($conditions)) {
                Repair::where('id_repair', $request->repair_id)
                    ->update([
                        'user_responsible' => $request->recipient,
                        'status_repair' => 'กำลังดำเนินการ'
                    ]);
            } else {
                $repairsStatus = RepairFollow::create(['repair_id' => $request->repair_id, 'status_repair' => 'กำลังดำเนินการ']);

                Repair:: where('id_repair', $request->repair_id)
                    ->update([
                        'user_responsible' => $request->recipient,
                        'status_repair' => 'กำลังดำเนินการ',
                        'status_follow' => $repairsStatus->id,
                    ]);
            }
            
            $repaors = Repair::select('repairs.*', 'users.name as nameT ')
                ->leftJoin('users', 'repairs.user_responsible', '=', 'users.id')->where('id_repair', $request->repair_id)->first();
            // dd($repaors);
            Mail::to($repaors->email)->send(new FollowRepairs($repaors));
            DB::commit();

            return response()->json([
                'success' => 1,
                'message' => 'การมอบหมายงานเสร็จสมบูรณ์'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'status' => false,
                'message' => 'server error',
                'description' => 'Something went wrong.',
                'errorsMessage' => $e->getMessage()
            ], 501);
        }
    }

    public function Indexinformation()
    {
        $Utechnician = User::find(Auth::user()->id);
        $Uinfo = DB::table('users')->join('departments', 'users.department', '=', 'departments.department_id')
            ->where('id', $Utechnician->id)
            ->first();
        // dd($Uinfo);

        return view('technician.personal-information', compact('Uinfo'));
    }

    public function edit_personal_info(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'username' => 'required'
        ], [
            'email.required' => 'อีเมลต้องไม่เป็นค่าว่าง',
            'password.required' => 'รหัสผ่านต้องไม่เป็นค่าว่าง',
            'username.required' => 'ชื่อ - นามสกุลต้องไม่เป็นค่าว่าง',
        ]);
        // dd($request);
        $user = User::find($request->iduser);

        $user->name = $request->username;

        $user->email = $request->email;
        if ($user->password != $request->password) {
            // dd('123');
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->back()->with('successeditactivity', 'แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function IndexTechnicianStaff()
    {
        $Utechnician = User::find(Auth::user()->id);
        $Departmentstaff = User::where('department', $Utechnician->department)->where('level', 2)->get();
        // dd($Departmentstaff);
        return view('technician.technician-staff', compact('Departmentstaff'));
    }
}
