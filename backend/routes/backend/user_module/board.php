<?php

use App\Http\Controllers\Backend\UserModule\Board\BoardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'all-board'], function(){

     //index
     Route::get("",[BoardController::class,"index"])->name("board.all");

     Route::get("export-board",[BoardController::class,"export_board"])->name("board.export");

});

?>