<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

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
        // dd($AuId);
        return response()->json([
            'message' => 'ok',
            'status' => true,
            'Technician' => $DataAu,
        ], 200);
    }

    public function admin_edituser_store(Request $request, $au_id)
    {
        // dd($request->all(), $au_id);
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
        ]);

        User::where('id', $au_id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => 1,
            'message' => 'การแก้ไขเสร็จสมบูรณ์'
        ]);
    }

    public function admin_user_reset_password(Request $request, $au_id)
    {

        $validator = Validator::make($request->all(), [
            'password_reset' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
        try {
            User::where('id', $au_id)->update([
                'password' => Hash::make($request->password_reset),
            ]);

            return response()->json([
                'status' => '200',
                'message' => 'รีเซ็ตรหัสผ่านสำเร็จ'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'server error',
                'errorsMessage' => $e->getMessage()
            ], 500);
        }
    }

    public function admin_destroyuser($au_id)
    {
        
        User::destroy($au_id);
    }
}
