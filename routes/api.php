<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('students', StudentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('professors', ProfessorController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('programs', ProgramController::class);