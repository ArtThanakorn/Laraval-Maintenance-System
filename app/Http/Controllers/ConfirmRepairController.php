<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmRepairController extends Controller
{
    public function index(){
        return view('admin.confirmRepair');
    }
}
