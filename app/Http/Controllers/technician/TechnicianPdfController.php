<?php

namespace App\Http\Controllers\technician;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianPdfController extends Controller
{
    public function generatePdf()
    {
        $users = 'ปาร์ค';
        $table_head = ['TH1'=> 'ลำดับ','TH2'=>'ผู้แจ้งซ่อม','TH3'=>'รายละเอียด','TH4'=>'สถานะ','TH5'=>'รหัสแจ้งซ่อม','TH6'=>'สถานที่'];
        $pdfData = Repair::where('type', Auth::user()->department)->orderBy('updated_at', 'desc')->get();

        $pdfDataPending = Repair::where('type', Auth::user()->department)->where('status_repair','รอดำเนินการ')->orderBy('updated_at', 'desc')->count();

        $pdfDataCompleted = Repair::where('type', Auth::user()->department)->where('status_repair','ดำเนินการเสร็จสิ้น')->orderBy('updated_at', 'desc')->count();
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users,
            'tableHead' => $table_head,
            'pdfData' => $pdfData,
            'Pending' => $pdfDataPending,
            'Completed' => $pdfDataCompleted
        ];
        // dd($data);
        $pdf = Pdf::loadView('technician.work-schedule',$data);
        return $pdf->stream();
    }
}
