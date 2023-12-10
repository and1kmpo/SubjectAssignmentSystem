<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectProfessorController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para las operaciones básicas de asignaturas
/* Crear una asignatura */
Route::post('/subjects', [SubjectController::class, 'store']);
/* Obtener SOLO asignaturas que tenga profesor asignado  */
Route::get('/subjects-with-professors', [SubjectController::class, 'subjectsWithProfessors']);
/* Obtener detalle de 1 asignatura */
Route::get('/subjects/{id}', [SubjectController::class, 'show']);
/* Obtener lista de asignaturas */
Route::get('/subjects', [SubjectController::class, 'index']);
/* Actualizar asignatura */
Route::put('/subjects/{id}', [SubjectController::class, 'update']);
/* Borrar asignatura */
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

// Rutas para la asignación de asignaturas a profesores y estudiantes
Route::post('/professors/{professorId}/assign-subjects', [SubjectController::class, 'assignSubjectsToProfessor']);
// Asignar asignaturas a estudiantes
Route::post('/students/{studentId}/assign-subjects', [StudentSubjectProfessorController::class, 'assignSubjectsToStudent']);
/* Desasignar asignatura a estudiante */
Route::post('/students/{studentId}/unassign-subjects', [StudentSubjectProfessorController::class, 'unassignSubjectsFromStudent']);
/* Desasignar asignatura a profesor */
Route::delete('/professors/{professor_id}/subjects/{subject_id}/unassign', [SubjectController::class, 'unassignSubjectToProfessor']);


/* Obtener asignaturas de un profesor */
Route::get('/professors/{professorId}/assigned-subjects', [ProfessorController::class, 'getAssignedSubjects']);
/* Obtener asignaturas de un estudiante */
Route::get('/students/{studentId}/assigned-subjects', [SubjectController::class, 'getAssignedSubjects']);


// Rutas para las otras entidades
Route::apiResource('students', StudentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('professors', ProfessorController::class);
Route::apiResource('programs', ProgramController::class);
