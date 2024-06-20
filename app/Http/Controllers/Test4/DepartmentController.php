<?php

namespace App\Http\Controllers\Test4;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department.index', [
            'departments' => $departments
        ]);
    }


    public function create()
    {
        return view('department.create');
    }

    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->all());

        return response()->json([
                'message' => 'Department created successfully', 
                'data' => $department
        ], 201);
    }

    public function edit($id)
    {
        $department = Department::where('id_dept', $id)->first();
        if (empty($department)) {
            return response()->json([
                'message' => 'Sorry, department not found.',
            ], 404);
        }
        return view('department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, $id)
    {

        $department = Department::where('id_dept', $id)->first();
        if (empty($department)) {
            return response()->json([
                'message' => 'Sorry, depart$department not found.',
            ], 404);
        }

        $department->nama_dept = $request->nama_dept;
        $department->save();

        return response()->json([
            'message' => 'Departments updated successfully', 
            'data' => $department
        ], 201);
    }

    public function destroy($id)
    {

        $department = Department::where('id_dept', $id)->first();
        if (empty($department)) {
            return response()->json([
                'message' => 'Sorry, department not found.',
            ], 404);
        }
    

        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully'
        ]);
    }
}
