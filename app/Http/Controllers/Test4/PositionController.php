<?php

namespace App\Http\Controllers\Test4;

use App\Models\Level;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with('level')->get();
        return view('position.index', [
            'positions' => $positions
        ]);
    }

    public function create()
    {
        return view('position.create', [
            'levels' => Level::all()
        ]);
    }

    public function store(PositionRequest $request)
    {
        $level = Level::where('id_level', $request->id_level)->first();
        if (empty($level)) {
            return response()->json([
                'message' => 'Sorry, level not found.',
            ], 404);
        }
        $position = Position::create([
            'nama_jabatan' =>  $request->nama_jabatan,
            'id_level' => $level->id_level
        ]);

        return response()->json([
                'message' => 'position created successfully', 
                'data' => $position
            ], 201);
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $levels = Level::all();

        return view('position.edit', compact('position', 'levels'));
    }

    public function update(PositionRequest $request, $id)
    {

        $level = Level::where('id_level', $request->id_level)->first();
        if (empty($level)) {
            return response()->json([
                'message' => 'Sorry, level not found.',
            ], 404);
        }

        $position = Position::findOrFail($id);
        $position->nama_jabatan = $request->nama_jabatan;
        $position->id_level = $request->id_level;
        $position->save();

        return response()->json([
            'message' => 'Position updated successfully.',
            'data' => $position,
        ]);
    }

    public function destroy($id)
    {

        $position = Position::where('id_jabatan', $id)->first();
        if (empty($position)) {
            return response()->json([
                'message' => 'Sorry, jabatan not found.',
            ], 404);
        }
    
        $position->delete();
        return response()->json([
            'message' => 'Jabatan deleted successfully'
        ]);
    }
}
