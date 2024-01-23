<?php

namespace App\Http\Controllers\Admin;

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
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => 2,
        // ]);

        // return redirect()->back()->with('success', 'Registration completed');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        return response()->json([
            'success' => 1,
            'message' => 'การลงทะเบียนเสร็จสมบูรณ์'
          ]);

    }

    public function technician_user_edit($tu_id)
    {
        $DataTu = User::find($tu_id);
        $liTechnicianUser = User::where('role', 2)->get();
        // dd($litechnicianUser);
        return view('admin.manage-technicianuser', compact('DataTu', 'liTechnicianUser'));
    }

    public function technician_edituser_store(Request $request, $tu_id)
    {
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'password' => [ 'string', 'min:8', 'confirmed'],
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
