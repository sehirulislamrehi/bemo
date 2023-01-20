<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//visitor registration start
Route::post("/visitor/registration",[RegistrationController::class,'registration']);
Route::post("/visitor/signin",[LoginController::class,'login']);
Route::get("/visitor/verification/{token}",[LoginController::class,'verification']);
//visitor registration end