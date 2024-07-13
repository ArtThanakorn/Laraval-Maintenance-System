<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalInformationTechnicianController extends Controller
{
    public function index(){
        return view('technician.personal-information');
    }
}
