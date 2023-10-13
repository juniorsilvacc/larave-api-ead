<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'sucess' => true,
    ]);
});

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);

Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
Route::get('/lessons/{id}', [LessonController::class, 'show']);
