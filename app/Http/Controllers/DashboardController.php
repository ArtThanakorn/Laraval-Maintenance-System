<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $countRepair = Repair::where('status_repair', 'รอซ่อม')->count();
        return view('admin.dashboard',compact('countRepair'));
    }

    public function repair_show(){
       $liRepair = Repair::all();
    //    dd($liRepair);
        return view('admin.list-repair',compact('liRepair'));
    }
}
