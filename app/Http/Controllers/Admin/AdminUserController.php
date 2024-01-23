<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function add_adminuser()
    {
        $DataAu = new User();
        $liAdminUser = User::where('role', 1)->get();
        return view('admin.add-admin-user', compact('liAdminUser', 'DataAu'));
    }

    public function admin_user_store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ], [
        //     'name.required' => "กรุณาป้อน ชื่อ"
        // ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1,
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 422,
        //         'errors' => $validator->messages()
        //     ], 422);
        // } else {
        //     return response()->json([
        //         'success' => 1,
        //         'message' => 'การลงทะเบียนเสร็จสมบูรณ์'
        //       ]);
        // }

        return response()->json([
            'success' => 1,
            'message' => 'การลงทะเบียนเสร็จสมบูรณ์'
          ]);
    }

    public function admin_user_edit($au_id)
    {
        $DataAu = User::find($au_id);
        $liAdminUser = User::where('role', 1)->get();
        // dd($AuId);
        return view('admin.add-admin-user', compact('DataAu', 'liAdminUser'));
    }

    public function admin_edituser_store(Request $request, $au_id)
    {
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],
            'password' => [ 'string', 'min:8'],
        ]);

        User::where('id', $au_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => 1,
            'message' => 'การแก้ไขเสร็จสมบูรณ์'
          ]);
        // return redirect()->route('pages.addadmin');
    }

    public function admin_destroyuser($au_id){
        User::destroy($au_id);
    }
}
