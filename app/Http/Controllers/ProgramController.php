<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return response()->json($programs);
    }

    public function show($id)
    {
        $program = Program::find($id);

        if ($program) {
            return response()->json([
                'data' => $program,
                'message' => 'Program found successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Program not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $program = Program::create($inputs);

        return response()->json([
            'data' => $program,
            'message' => 'Program created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $program = Program::find($id);

        if ($program) {
            $program->update($request->all());

            return response()->json([
                'data' => $program,
                'message' => 'Program updated successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Not found program'
            ]);
        }
    }

    public function destroy($id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }

        $program->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program deleted successfully'
        ]);
    }
}
