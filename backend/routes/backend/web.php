<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductModule\ProductController;
use Illuminate\Support\Facades\Route;


//login route start
Route::get('/', [LoginController::class, 'login_show'])->name('login.show');
Route::post('/do-login', [LoginController::class, 'do_login'])->name('do.login');
//login route end


//forget password route start
Route::get('/forget-password', [ForgetPasswordController::class, 'getEmail'])->name('get.email');
Route::post('/forget-password', [ForgetPasswordController::class, 'postEmail'])->name('post.email');
Route::get('reset-password/{token}/{email}', [ForgetPasswordController::class, 'getPassword'])->name('get.password');
Route::post('reset-password/{email}', [ForgetPasswordController::class, 'reset_password'])->name('password.reset');
//forget password route end


//logout route start
Route::post('/do-logout', [LogoutController::class, 'do_logout'])->name('do.logout');
//logout route end


//backend route group start
Route::group(['prefix' => 'admindashboard', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    //visitor registration chart
    Route::get('/visitor-register', [DashboardController::class, 'visitor_register'])->name('visitor.register');

    //visitor package chart
    Route::get('/visitor-package', [DashboardController::class, 'visitor_package'])->name('visitor.package');

    //product history chart
    Route::get('/product-history-chart', [DashboardController::class, 'product_history'])->name('product.history');

    //blog history chart
    Route::get('/blog-history-chart', [DashboardController::class, 'blog_history'])->name('blog.history');


    //profile module routes start
    Route::group(['prefix' => 'profile-module'], function () {
        require_once 'profile_module/profile.php';
    });
    //profile module routes end

    //user module routes start
    Route::group(['prefix' => 'user-module'], function(){
        require_once 'user_module/user.php';
        require_once 'user_module/role.php';
        require_once 'user_module/visitor.php';
        require_once 'user_module/board.php';
    });
    //user module routes end

    //settings module routes start
    Route::group(['prefix' => 'settings-module'], function () {
        require_once 'settings_module/app_info.php';
    });
    //settings module routes end
    
});
//backend route group end


?>