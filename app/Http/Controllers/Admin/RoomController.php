<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function IndexRoom()
    {

        $rooms = Room::with('detail')->orderBy('updated_at', 'desc')->get();


        return view('admin.room', compact('rooms'));
    }

    public function Roomstore(Request $request)
    {

        // dd($request);

        $validator = Validator::make($request->all(), [
            'nameRoom' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $rooms = Room::create([
                'name_room' => $request->nameRoom,
            ]);

            if ($rooms) {
                return response()->json([
                    'status' => '200',
                    'message' => 'เพิ่มห้องสำเร็จ'
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => "บางอย่างผิดพลาด"
                ], 500);
            }
        }
    }
}
