<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }

    public function show($id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            return response()->json([
                'data' => $subject,
                'message' => 'Subject found successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Subject not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->input();
        $subject = Subject::create($inputs);

        return response()->json([
            'data' => $subject,
            'message' => 'Subject created successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            $subject->update($request->all());

            return response()->json([
                'data' => $subject,
                'message' => 'Subject updated successfully'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Not found subject'
            ]);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        $subject->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subject deleted successfully'
        ]);
    }
    public function assignSubjectsToProfessor(Request $request, $professorId)
    {
        $professor = Professor::findOrFail($professorId);
        $subjectIds = $request->input('subjects', []);

        // Obtén las asignaturas ya asignadas al profesor
        $assignedSubjectIds = $professor->subjects->pluck('id')->toArray();

        // Filtra las asignaturas que aún no han sido asignadas al profesor
        $newSubjectIds = array_diff($subjectIds, $assignedSubjectIds);

        // Asigna solo las nuevas asignaturas al profesor
        $professor->subjects()->attach($newSubjectIds);

        return response()->json(['message' => 'Assignment subjects to professor successfully']);
    }

    public function unassignSubjectToProfessor($professorId, $subjectId)
    {
        // Encuentra al profesor
        $professor = Professor::find($professorId);

        if (!$professor) {
            return response()->json(['message' => 'Professor not found'], 404);
        }

        // Desasigna la materia del profesor
        $professor->subjects()->detach($subjectId);

        return response()->json(['message' => 'Subject unassigned successfully'], 200);
    }

    public function getAssignedSubjects($studentId)
    {
        $student = Student::findOrFail($studentId);
        $assignedSubjects = $student->subjects;

        return response()->json($assignedSubjects);
    }

    public function subjectsWithProfessors()
    {
        $subjects = Subject::whereHas('professors')->get();
        return response()->json($subjects);
    }
}
