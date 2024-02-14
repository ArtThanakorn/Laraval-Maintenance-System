<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TechnicianUserController extends Controller
{
    public function index(){
        $DataTu = new User();
        $liTechnicianUser = User::where('role', 2)->get();
        return view('admin.manage-technicianuser',compact('DataTu','liTechnicianUser'));
    }

    public function technician_user_store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'department' =>['required'],
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
        $liTechnicianUser = User::where('role', 2)->get();
        // dd($DataTu);
        return view('admin.manage-technicianuser', compact('DataTu', 'liTechnicianUser'));
    }

    public function technician_edituser_store(Request $request, $tu_id)
    {
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],
            'password' => [ 'string', 'min:8'],
        ]);

        User::where('id', $tu_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => 1,
            'message' => 'การแก้ไขเสร็จสมบูรณ์'
          ]);

        // return redirect()->route('technician.index');
    }

    public function technician_destroyuser($tu_id){
        // dd($tu_id);
        User::destroy($tu_id);
    }
}
