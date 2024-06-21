<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\ImageRepair;
use App\Models\Repair;
use App\Models\Room;
use App\Models\RoomDetails;
use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



class RepairController extends Controller
{
    public function index($id)
    {
        // $rooms = RoomDetails::where('room_id',$id)->orderBy('updated_at', 'desc')->get();
        $rooms = Room::with('detail')->where('id',$id)->orderBy('updated_at', 'desc')->first();
        // dd($rooms);
        $Department = Department::where('status_display', 0)->get();

        return view('admin.repair', compact('Department','rooms'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'statusRadio'=> 'required|string',
            'chackname' => 'required|string',
            'toolcheck' => 'required',
            'detail' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|string',
            'number' => 'required|nullable|numeric|digits_between:10,10',
            'image' => 'required|array|max:5',
            'image.*' => 'mimes:jpeg,png,jpg,gif',

        ], [
            'checkstatus.required' => 'กรุณาระบุสถาณะผู้เเจ่งซ่อม',
            'chackname.required' => 'กรุณาระบุชื่อ-นามสกุลผู้เเจ่งซ่อม',
            'detail.required' => 'กรุณาระบุรายละเอียดปัญหา',
            // 'location.required' => 'กรุณาระบุสถาณที่เเจ่งซ่อม',
            'email.required' => 'กรุณาระบุอีเมลผู้เเจ่งซ่อม',
            'number.required' => 'กรุณาระบุเบอร์โทร',
            'number.numeric' => 'กรุณาระบุตัวเลขเฉพาะในช่องเบอร์โทร',
            'number.digits_between' => 'ระบุเบอร์โทรถูกต้อง',

            'image.array' => 'รูปภาพต้องเป็นอาร์เรย์',
            'image.max' => 'รูปภาพต้องไม่เกิน 5 รูปภาพ',
            'image.required' => 'กรุณาเลือกรูปภาพ',
            'image.*.mimes' => 'รูปภาพต้องเป็นไฟล์รูปภาพที่มีนามสกุล .jpeg, .png, .jpg, หรือ .gif',
        ]);

        $repairs = Repair::create([
            'status' => $request->statusRadio,
            'name' => $request->chackname,
            'equipment' => $request->toolcheck,
            'details' => $request->detail,
            'site' => $request->location,
            'email' => $request->email,
            'number' => $request->number,
            // Gets a prefix unique
            'tag_repair' => substr(uniqid(), -5)
        ]);

        $saveRepair = DB::table('repairs')
            ->latest('id_repair')
            ->first();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $images) {
                $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension(); // =ชื่อรูป
                $images->move(public_path('uploads/repair/'), $imageName); // path ที่ต้องการเก็บรูป
                ImageRepair::create([
                    'id_repair' => $saveRepair->id_repair,
                    'nameImage' => $imageName
                ]);
            }
        }


        return redirect()->route('user.confirmRepair', ['id' => $saveRepair->id_repair]);
    }
    public function confirm_repair($id)
    {
        $dataconfirm = Repair::with('imageRepair')->where('id_repair', $id)->first();
        // dd($dataconfirm);
        return view('admin.confirmRepair', compact('dataconfirm'));
    }

    public function handle_repaair()
    {
        return view('admin.handle-repair');
    }

    public function followUp()
    {
        $repairsData = Repair::with('department')
        ->get();
        return view('user.follow-up-repair', compact('repairsData'));
    }
}
