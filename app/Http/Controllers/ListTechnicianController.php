<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListTechnicianController extends Controller
{
    public function index(){
        return view('technician.list-repair');
    }//
}
