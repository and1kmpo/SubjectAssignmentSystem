<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StudentSubjectProfessorController extends Controller
{
    public function assignSubjectsToStudent(Request $request, $studentId)
    {
        try {
            // Verificar la existencia del estudiante
            $student = Student::find($studentId);

            if (!$student) {
                return response()->json(['error' => "Student with ID $studentId not found."], 404);
            }

            // Obtén los IDs de las asignaturas seleccionadas desde la solicitud
            $subjectIds = $request->input('subjects', []);

            // Filtra las asignaturas que el estudiante ya tiene asignadas
            $existingSubjects = $student->subjects()->whereIn('subject_id', $subjectIds)->pluck('subject_id')->toArray();

            // Filtra las asignaturas que aún no están asignadas al estudiante
            $newSubjects = array_diff($subjectIds, $existingSubjects);

            // Inicializa un array para almacenar mensajes de error
            $errors = [];

            // Itera sobre las asignaturas seleccionadas que aún no están asignadas al estudiante
            foreach ($newSubjects as $subjectId) {
                // Obtén el profesor asociado a la asignatura desde la tabla pivot
                $professor = Subject::find($subjectId)->professors()->first();

                // Valida si la asignatura tiene un profesor asociado
                if ($professor) {
                    $professorId = $professor->id;

                    // Asigna la materia al estudiante con el profesor obtenido
                    try {
                        $student->subjects()->attach($subjectId, ['professor_id' => $professorId]);
                    } catch (QueryException $e) {
                        // Captura excepciones de duplicados y agrega un mensaje de error
                        $errors[] = "Subject with ID $subjectId is already assigned to the student.";
                    }
                } else {
                    // Agrega un mensaje de error para la asignatura sin profesor
                    $errors[] = "Subject with ID $subjectId has no associated professor.";
                }
            }

            if (empty($errors)) {
                return response()->json(['message' => 'Assignment subjects to student successfully']);
            } else {
                // Si hay errores, retorna una respuesta con los mensajes de error
                return response()->json(['errors' => $errors], 400);
            }
        } catch (\Exception $e) {
            // Manejo de excepciones, puedes personalizar esto según tus necesidades
            // dd($e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function unassignSubjectsFromStudent(Request $request, $studentId)
    {
        try {
            // Verificar la existencia del estudiante
            $student = Student::find($studentId);

            if (!$student) {
                return response()->json(['error' => "Student with ID $studentId not found."], 404);
            }

            // Obtén los IDs de las asignaturas seleccionadas desde la solicitud
            $subjectIds = $request->input('subjects', []);

            // Inicializa un array para almacenar mensajes de error
            $errors = [];

            // Itera sobre las asignaturas seleccionadas
            foreach ($subjectIds as $subjectId) {
                // Desvincula la asignatura del estudiante
                $student->subjects()->detach($subjectId);
            }

            return response()->json(['message' => 'Unassignment of subjects from student successful']);
        } catch (\Exception $e) {
            // Manejo de excepciones, puedes personalizar esto según tus necesidades
            // dd($e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }
}
