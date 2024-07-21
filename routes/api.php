<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/getModule', [DashboardController::class, 'getModule'])->name('dashboard.getModule');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/getAuthCookie', [AuthController::class, 'getAuthCookie'])->name('auth.getAuthCookie');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
