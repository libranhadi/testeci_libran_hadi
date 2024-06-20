<?php

namespace App\Http\Controllers\Test4;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('level.index', [
            'levels' => $levels
        ]);
    }


    public function create()
    {
        return view('level.create');
    }

    public function store(LevelRequest $request)
    {
        $level = Level::create($request->all());

        return response()->json([
                'message' => 'Level created successfully', 
                'data' => $level
            ], 201);
    }

    public function edit($id)
    {
        $level = Level::where('id_level', $id)->first();
        if (empty($level)) {
            return response()->json([
                'message' => 'Sorry, level not found.',
            ], 404);
        }
        return view('level.edit', compact('level'));
    }

    public function update(LevelRequest $request, $id)
    {

        $level = Level::where('id_level', $id)->first();
        if (empty($level)) {
            return response()->json([
                'message' => 'Sorry, level not found.',
            ], 404);
        }

        $level->nama_level = $request->nama_level;
        $level->save();

        return response()->json([
            'message' => 'Level updated successfully', 
            'data' => $level
        ], 201);
    }

    public function destroy($id)
    {

        $level = Level::where('id_level', $id)->first();
        if (empty($level)) {
            return response()->json([
                'message' => 'Sorry, level not found.',
            ], 404);
        }
    

        $level->delete();

        return response()->json([
            'message' => 'Level deleted successfully'
        ]);
    }
}