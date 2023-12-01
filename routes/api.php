<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProfessorSubjectController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para las operaciones básicas de asignaturas
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subjects/{id}', [SubjectController::class, 'show']);
Route::post('/subjects', [SubjectController::class, 'store']);
Route::put('/subjects/{id}', [SubjectController::class, 'update']);
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

// Rutas para la asignación de asignaturas a profesores y estudiantes
Route::post('/professors/{professorId}/assign-subjects', [ProfessorSubjectController::class, 'assignSubjectsToProfessor']);
Route::post('/students/{studentId}/assign-subjects', [StudentSubjectController::class, 'assignSubjectsToStudent']);

// Rutas para las otras entidades
Route::apiResource('students', StudentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('professors', ProfessorController::class);
Route::apiResource('programs', ProgramController::class);
