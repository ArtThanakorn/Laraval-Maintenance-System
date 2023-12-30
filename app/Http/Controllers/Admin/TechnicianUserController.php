<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TechnicianUserController extends Controller
{
    public function index(){
        $DataTu = new User();
        $liTechnicianUser = User::where('role', 2)->get();
        return view('admin.manage-technicianuser',compact('DataTu','liTechnicianUser'));
    }
}
