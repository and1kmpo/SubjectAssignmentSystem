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

    public function assignSubjectsToStudent(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);
        $subjectIds = $request->input('subjects', []);

        // Obtén las asignaturas ya asignadas al estudiante
        $assignedSubjectIds = $student->subjects->pluck('id')->toArray();

        // Filtra las asignaturas que aún no han sido asignadas al estudiante
        $newSubjectIds = array_diff($subjectIds, $assignedSubjectIds);

        // Asigna solo las nuevas asignaturas al estudiante
        foreach ($newSubjectIds as $subjectId) {
            // Obtén el profesor asociado a la asignatura
            $subject = Subject::findOrFail($subjectId);
            $professor = $subject->professors->first();

            // Verifica si la asignatura tiene un profesor asignado
            if ($professor) {
                // Obtén el professor_id
                $professorId = $professor->id;

                // Ahora, inserta en la tabla intermedia
                $student->subjects()->attach($subjectId, ['professor_id' => $professorId]);
            } else {
                // Manejar el caso en que la asignatura no tiene un profesor asignado
                return response()->json(['error' => 'The subject does not have an assigned teacher.'], 400);
            }
        }

        return response()->json(['message' => 'Subjects assigned to the student successfully.']);
    }
}
