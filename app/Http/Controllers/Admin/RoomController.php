<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function IndexRoom()
    {
        return view('admin.room');
    }

    public function Roomstore(Request $request)
    {
        
    }
}
