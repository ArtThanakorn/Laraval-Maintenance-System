<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPdfController extends Controller
{
    public function repair_all_pdf()
    {
        // dd('123');
        $users = 'ปาร์ค';
        $repair = Repair::select('*','departments.department_name',DB::raw('DATE_FORMAT(repairs.created_at,"%d/%m/%Y") AS created_date'))
        ->leftJoin('departments', 'repairs.type', '=', 'departments.department_id')
        ->orderBy('repairs.updated_at', 'desc')->get();

        $repairAll = Repair::count();
        $repairFinished = Repair::where('status_repair',"=",'ดำเนินการเสร็จสิ้น')->count();
        $repairNotFinished = Repair::where('status_repair','<>','ดำเนินการเสร็จสิ้น')->count();
// dd($repair);
        $data = [
            'users' => $users,
            'repair' => $repair,
            'all' => $repairAll,
            'finished' => $repairFinished,
            'NotFinished' => $repairNotFinished
        ];
        $pdf = Pdf::loadView('admin.pdf-repair-all',$data);
        return $pdf->stream();
    }
}
