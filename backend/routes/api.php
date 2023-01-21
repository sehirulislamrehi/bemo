<?php

use App\Http\Controllers\Api\BoardController;
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

//create board
Route::get("/get-board/{token}",[BoardController::class,'get_board']);
Route::post("/create-board",[BoardController::class,'create_board']);
Route::get("/delete-board/{id}",[BoardController::class,'delete_board']);

//board sort
Route::post("/board-sorting/{token}",[BoardController::class,'board_sorting']);

//card sort
Route::post("/card-sorting/{token}",[BoardController::class,'card_sorting']);

//add card
Route::post("/add-card/{id}",[BoardController::class,'add_card']);

//delete card
Route::get("/delete-card/{id}",[BoardController::class,'delete_card']);


//edit board
Route::post("/edit-board",[BoardController::class,'edit_board']);
