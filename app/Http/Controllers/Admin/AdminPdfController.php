<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPdfController extends Controller
{
    public function repairAll()
    {

        // dd($data);
        $pdf = Pdf::loadView('admin.pdf-repair-all');
        return $pdf->stream();
    }
}
