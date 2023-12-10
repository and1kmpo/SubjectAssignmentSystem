<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessorController extends Controller
{
    public function index()
    {
        $professors = Professor::all();
        return response()->json($professors);
    }

    public function show($id)
    {
        $professor = Professor::find($id);

        if ($professor) {
            return response()->json([
                'data' => $professor,
                'message' => 'Professor found successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Professor not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $professor = Professor::create($inputs);

        return response()->json([
            'data' => $professor,
            'message' => 'Professor created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);

        if ($professor) {
            $professor->update($request->all());

            return response()->json([
                'data' => $professor,
                'message' => 'Professor updated successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Not found professor'
            ]);
        }
    }

    public function destroy($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['error' => 'Professor not found'], 404);
        }

        $professor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Professor deleted successfully'
        ]);
    }

    public function getAssignedSubjects($professorId)
    {
        $professor = Professor::findOrFail($professorId);

        // Obtener las materias asignadas al profesor
        $assignedSubjects = $professor->subjects;

        return response()->json($assignedSubjects);
    }
}
