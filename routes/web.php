<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'],function (){

    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/check',[AdminLoginController::class,'check'])->name('admin.check');
    });
    Route::group(['middleware'=>'admin.check'],function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard.index');
    });
});
