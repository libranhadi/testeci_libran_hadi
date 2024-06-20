<?php

namespace App\Http\Controllers\Test4;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('position', 'department')->get();

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::all();
        $departments = Department::all();

        return view('employee.create', compact('positions', 'departments'));
    }


    public function store(EmployeeRequest $request)
    {
        $validatedData = $request->validated();

        $employee = Employee::create([
            'nik' => $validatedData['nik'],
            'nama' => $validatedData['nama'],
            'ttl' => $validatedData['ttl'],
            'alamat' => $validatedData['alamat'],
            'id_jabatan' => $validatedData['id_jabatan'],
            'id_dept' => $validatedData['id_dept'],
        ]);

        return response()->json([
            'message' => 'Karyawan berhasil ditambahkan.',
            'employee' => $employee
        ]);
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        $positions = Position::all();
        $departments = Department::all();

        return view('employee.edit', compact('employee', 'positions', 'departments'));
    }


    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validated();

        $employee->nik = $validatedData['nik'];
        $employee->nama = $validatedData['nama'];
        $employee->ttl = $validatedData['ttl'];
        $employee->alamat = $validatedData['alamat'];
        $employee->id_jabatan = $validatedData['id_jabatan'];
        $employee->id_dept = $validatedData['id_dept'];
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee successfully updated.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'Karyawan deleted successfully'
        ]);
    }

}
