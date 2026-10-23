<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/helo', function () {
    return response()->json([
        'message' => 'Hello World',
    ]);
});

Route::get('/info', function () {
    return response()->json([
        'app' => 'Task API',
        'ver' => '0.1',
        'author' => "BTNG",
    ]);
});

Route::get("/hello", function () {
    return response()->json([
        'message' => 'halo cuy',
    ]); 
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{id}',[TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::patch('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

