<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomDetails;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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

    public function RoomStoreEquipment(Request $request)
    {
        // dd($request->equipment);
        foreach ($request->equipment as $equipments) {
            if ($equipments != null) {
                RoomDetails::create([
                    'room_id' => $request->id_room,
                    'name_equipment' => $equipments,
                ]);
            }
        }
        return response()->json([
            'status' => '200',
            'message' => 'เพิ่มอุปกรณ์'
        ], 200);
    }

    public function EquipmentUpdata(Request $request)
    {
        // dd($request->id_room_remove);
        RoomDetails::whereIn('id', $request->id_room_remove)->delete();

        return response()->json([
            'status' => '200',
            'message' => 'ลบสำเร็จ'
        ], 200);
    }

    public function EditNameRoom(Request $request)
    {
        // dd($request->all());

        Room::where('id', $request->eRoomId)
            ->update(['name_room' => $request->EroomName]);

        return response()->json([
            'status' => '200',
            'message' => 'แก้ไขข้อมูลห้องแล้ว'
        ], 200);
    }

    public function qrcode($id)
    {
        $rooms = Room::where('id',$id)->first();
        
        $qrCodes = QrCode::size(200)->generate(route('index.repair', ['id' => $id]));

        return view('admin.qrcode',compact('qrCodes','rooms'));
    }

    public function DeleteRoom($id)
    {

        // dd($id);
        Room::where('id', $id)->delete();
        RoomDetails::where('room_id', $id)->delete();
    }
}
