<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Repair;
use App\Models\User;
use App\DataTables\RepairDataTable;

class DashboardController extends Controller
{
    public function index()
    {
        $countRepair = Repair::where('status_repair', 'รอดำเนินการ')->count();
        $countAdmin = User::where('role', 1)->count();
        $countTechnician = User::where('role', 2)->count();
        $department = Department::all()->count();
        return view('admin.dashboard', compact('countRepair', 'countAdmin', 'countTechnician', 'department'));
    }



    public function repair_show(RepairDataTable $dataTable)
    {
        $liRepair = Repair::with('department')->get();

        $departments = Department::select('department_id', 'department_name')->where('status_display', '=', 0)->get();
        $departmentsArray = $departments->toArray();

        $departmentIds = $departments->pluck('department_id');
        $types = $liRepair->pluck('type');
        $matchedIds = $departmentIds->diff($types);
        $counts = $types->countBy();

        //  dd($matchedIds); // [0, 13, 1]   $counts[2]
        foreach ($matchedIds as $matchedId) {
            if (!isset($counts[$matchedId])) {
                $counts->push(0);
            }
        }
        $datachart = $counts->toArray();

        function random_color()
        {
            return '#' . str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT) .
                str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        }

        $bgcolor = [];

        foreach ($departmentsArray as $department) {
            $bgcolor[] = random_color();
        }
        //dd($bgcolor);  // Example output: #f2a543

        $data =  collect([
            'labels' => $departmentsArray,
            'datasets' => [
                'data' => $datachart,
                'backgroundColor' => $bgcolor
            ]
        ]);
        return $dataTable->render('admin.list-repair', compact('liRepair', 'data', 'counts'));
    }
}
