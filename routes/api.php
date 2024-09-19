<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::post('/tasks',[TaskController::class, 'store']);
Route::put('/tasks/{id}',[TaskController::class, 'update']);
Route::patch('/tasks/{id}',[TaskController::class, 'markAsComplete']);
Route::delete('/tasks/{id}',[TaskController::class, 'delete']);
