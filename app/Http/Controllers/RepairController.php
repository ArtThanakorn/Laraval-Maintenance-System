<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    public function index(){
        return view('admin.repair');
    }

    public function store(Request $request){
         //dd($request);
        $request->validate([
            'checkstatus'=>'required|string',

            'chackname'=>'required|string',
            'detail'=>'required|string',
            'location'=>'required|string',
            'email'=>'required|string',
            'number'=>'required|nullable|numeric|digits_between:10,10',
            'image' => 'required|array|max:5',

            'image.*' => 'required|mimes:jpeg,png,jpg,gif',

        ], [
            'checkstatus.required'=>'กรุณาระบุสถาณะผู้เเจ่งซ่อม',

            'chackname.required'=>'กรุณาระบุชื่อ-นามสกุลผู้เเจ่งซ่อม',
            'detail.required'=>'กรุณาระบุรายละเอียดปัญหา',
            'location.required'=>'กรุณาระบุสถาณที่เเจ่งซ่อม',
            'email.required'=>'กรุณาระบุอีเมลผู้เเจ่งซ่อม',
            'number.required'=>'กรุณาระบุเบอร์โทร',
            'number.numeric'=>'กรุณาระบุตัวเลขเฉพาะในช่องเบอร์โทร',
            'number.digits_between'=>'ระบุเบอร์โทรถูกต้อง',

            'image.array' => 'รูปภาพต้องเป็นอาร์เรย์',
            'image.max' => 'รูปภาพต้องไม่เกิน 5 รูปภาพ',

            'image.*.required' => 'กรุณาเลือกรูปภาพ',
            'image.*.mimes' => 'รูปภาพต้องเป็นไฟล์รูปภาพที่มีนามสกุล .jpeg, .png, .jpg, หรือ .gif',

        ]);

            if($request->chacktype == 'อื่นๆ'){
                $chacktypedb = $request->otherType;
            }else{
                $chacktypedb = $request->chacktype;
            }

            DB::table('repair')->insert([
                'stutus' => $request->checkstatus,
                'nameRepair' => $request->chackname,
                'typeRepair' => $chacktypedb,
                'details' => $request->detail,
                'location' => $request->location,
                'email' => $request->email,
                'number' => $request->number
            ]);

            $saveRepair = DB::table('repair')
                    ->latest('id')
                    ->first();

                    if ($request->hasFile('image')) {
                        foreach ($request->file('image') as $images) {
                            $imageName = 'image-' . time() . rand(1, 1000) . '.' . $images->extension(); // =ชื่อรูป
                            $images->move(public_path('uploads/repair/'), $imageName); // path ที่ต้องการเก็บรูป
                            DB::table('repair_image')->insert([
                'idRepair' => $saveRepair->id,
                'nameImage' => $imageName
            ]);
                        }
                    }
                    return redirect(route('index.repair'))->with('success', 'บันทึกข้อมูลเเจ่งซ่อมเรียบร้อย');
    }
}
