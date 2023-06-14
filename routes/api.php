<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/unauthorized',[AuthController::class,'unauthorized'])->name('login');

Route::post('/auth/login',[AuthController::class, 'login']);
Route::post('/auth/logout',[AuthController::class,'logout']);

Route::post('/user', [AuthController::class, 'create']);
Route::put('/user', [UserController::class,'update']);
Route::post('/user/delete/{id?}',[UserController::class,'delete']);

Route::post('/device',[DeviceController::class,'create']);
Route::put('/device/{id?}',[DeviceController::class,'update']);
Route::post('/device/delete/{id?}',[DeviceController::class,'delete']);
Route::get('/device',[DeviceController::class,'list']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
