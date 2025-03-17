<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\ValidationController;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1/auth')->group(function() {
    Route::post('/login' , action: [AuthController::class , 'login']);
    Route::post('/logout' , action: [AuthController::class , 'logout']);
});

Route::prefix('/v1')->group(function() {
    Route::post('/validations' , action: [ValidationController::class , 'sent']);
    Route::get('/validations' , action: [ValidationController::class , 'index']);
    Route::get('/job_vacancies' , action: [JobCategoryController::class , 'index']);
});