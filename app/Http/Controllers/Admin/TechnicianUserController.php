<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TechnicianUserController extends Controller
{
    public function index()
    {
        $DataTu = new User();
        $liTechnicianUser = User::with('departments')->where('role', 2)->get();
        $Department = Department::where('status_display', 0)->get();
        // dd();
        return view('admin.manage-technicianuser', compact('DataTu', 'liTechnicianUser', 'Department'));
    }

    public function technician_user_store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department' => ['required'],
            'level' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $uT =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'department' => $request->department,
                'level' => $request->level,
                'password' => Hash::make($request->password),
                'role' => 2,
            ]);

            if ($uT) {
                return response()->json([
                    'status' => '200',
                    'message' => 'การลงทะเบียนเสร็จสมบูรณ์'
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => "Something Went Wrong"
                ], 500);
            }
        }
    }

    public function technician_user_edit($tu_id)
    {
        // dd($tu_id);
        $DataTu = User::find($tu_id);
        $Department = Department::select('department_id', 'department_name')->where('status_display', 0)->get();
        // dd($DataTu);
        return response()->json([
            'message' => 'ok',
            'status' => true,
            'Technician' => $DataTu,
            'Department' => $Department,
        ], 200);
    }

    public function technician_edituser_store(Request $request, $tu_id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'department' => ['required', 'integer'],
            'level' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $Technician = User::where('id', $tu_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'department' => $request->department,
                'level' => $request->level
            ]);

            if ($Technician) {
                return response()->json([
                    'status' => '200',
                    'message' => 'แก้ไขผู้ใช้งานช่างสำเร็จ'
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => "บางอย่างผิดพลาด"
                ], 500);
            }
        }
    }

    public function technician_reset_password(Request $request, $tu_id)
    {
        $TechnicianReset = User::where('id', $tu_id)->update([
            'password' => Hash::make($request->password),
        ]);
        if ($TechnicianReset) {
            return response()->json([
                'status' => '200',
                'message' => 'รีเซ็ตรหัสผ่านสำเร็จ'
            ], 200);
        } else {
            return response()->json([
                'status' => '500',
                'message' => "บางอย่างผิดพลาด"
            ], 500);
        }
    }

    public function technician_destroyuser($tu_id)
    {
        // dd($tu_id);
        User::destroy($tu_id);
    }
}
