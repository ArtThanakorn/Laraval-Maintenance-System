<?php

namespace App\Http\Controllers\technician;

use App\Http\Controllers\Controller;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandlemembersController extends Controller
{
    public function index(){
      $id = Auth::user()->id;
      $date = Repair::file($id);

        return view('',compact('date'));
    }

    public function updatamembers(Request $request, $id){
        Repair::where('id',$id)->update([
            'name'=>$request,
            'email'=>$request,
        ]);
    }
}
