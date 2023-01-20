<?php

use App\Http\Controllers\Backend\UserModule\Visitor\Visitorcontroller;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'visitor'],function(){

     //index route 
     Route::get("/",[Visitorcontroller::class,"index"])->name("visitor.all");

     //data route 
     Route::get("/data",[Visitorcontroller::class,"data"])->name("visitor.data");

     //edit route 
     Route::get("/edit/{id}",[Visitorcontroller::class,"edit_modal"])->name("visitor.edit.modal");
     Route::post("/edit/{id}",[Visitorcontroller::class,"edit"])->name("visitor.edit");

     //reset password route 
     Route::get("/reset-password-modal/{id}",[Visitorcontroller::class,"reset_password_modal"])->name("visitor.reset.password.modal");
     Route::post("/reset-password/{id}",[Visitorcontroller::class,"reset_password"])->name("visitor.reset.password");

     //view route 
     Route::get("/view/{id}",[Visitorcontroller::class,"view"])->name("visitor.view");

     //delete route 
     Route::get("delete-visitor",[Visitorcontroller::class,"delete_visitor"])->name("delete.visitor");

});

?>