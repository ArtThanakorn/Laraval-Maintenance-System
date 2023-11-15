<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Faker\Provider\ar_EG\Company;

class EmployeeCRUDController extends Controller
{
    // Create index
    public function index(){
        $data['employees'] = Employee::orderBy('id','asc')->paginate(5);
        return view('employee.index', $data);
    }

    // Create resource
    public function create(){
        return view('employee.create');
    }

    // Create
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();
        return redirect()->route('employee.index')->with('success',"สร้างเรียบร้อย");
    }

    // Edit
    public function edit(Employee $employee){
        return view('employee.edit', compact('employee'));
    }

    // Update
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->save();
        return redirect()->route('employee.index')->with('success', "อัพเดตเรียบร้อย");
    }

    // Delete
    public function destroy(Employee $employee){
        $employee->delete();
        return redirect()->route('employee.index')->with('success', "ลบเรียบร้อย");
    }
}
