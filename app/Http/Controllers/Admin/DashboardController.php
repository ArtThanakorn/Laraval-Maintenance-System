<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Repair;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $countRepair = Repair::where('status_repair', 'รอดำเนินการ')->count();
        $countAdmin = User::where('role', 1)->count();
        $countTechnician = User::where('role', 2)->count();
        $department = Department::all()->count();
        return view('admin.dashboard', compact('countRepair', 'countAdmin','countTechnician','department'));
    }



    public function repair_show()
    {
        $liRepair = Repair::all();
        //    dd($liRepair);
        return view('admin.list-repair', compact('liRepair'));
    }
}
