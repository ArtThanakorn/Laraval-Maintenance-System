<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = Department::all();
        $dataEdit = new Department();
        return view('admin.manageDepartment',compact('data','dataEdit'));
    }

    public function createDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'departmentName' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $department =  Department::create([
                'department_name' => $request->departmentName,
            ]);

            if ($department) {
                return response()->json([
                    'status' => '200',
                    'message' => 'เพิ่มรายชื่อแผนกสำเร็จ'
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => "บางอย่างผิดพลาด"
                ], 500);
            }
        }
    }

    public function departmentEdit($id)
    {
        $dataEdit = Department::find($id);
        return response()->json($dataEdit, 200);
    }

    public function updateDepartment(Request $request, $id)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'departmentNameEdit' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $department =  Department::where('department_id', $id)->update([
                'department_name' => $request->departmentNameEdit,
                'status_display'=> $request->switchEdit
            ]);

            if ($department) {
                return response()->json([
                    'status' => '200',
                    'message' => 'แก้ไขชื่อแผนกสำเร็จ'
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => "บางอย่างผิดพลาด"
                ], 500);
            }
        }
    }

    public function destroy_department($id){
        Department::destroy($id);
    }
}
