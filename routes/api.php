<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('users')->group(function () {
	Route::post('/create',[UserController::class, 'createUser']);
	Route::post('/login',[UserController::class,'login']);
	Route::post('/password',[UserController::class,'changePassword']);
	Route::post('/update',[UserController::class,'update']);
});