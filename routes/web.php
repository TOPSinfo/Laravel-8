<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => false, 'register' => false]);


Route::get('/', function () {
    return redirect()->route('admin');
});


//Route::view('/404','errors.404')->name('404');

Route::view('/admin','auth.login')->name('admin');
//Route::resource('user', App\Http\Controllers\Admin\UserController::class);


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::any('user/delete-multiple-user', [App\Http\Controllers\Admin\UserController::class,'multipleDelete'])->name('delete-multiple-user');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);


    Route::any('cms/delete-multiple-cms', [App\Http\Controllers\Admin\CmsPageController::class,'multipleDelete'])->name('delete-multiple-cms');
    Route::resource('cms', App\Http\Controllers\Admin\CmsPageController::class);

    Route::resource('module', App\Http\Controllers\Admin\ModuleController::class);
    Route::resource('role', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('profile', App\Http\Controllers\Admin\ProfileController::class);

    //Route::get('/jcryption', [App\Http\Controllers\Admin\UserController::class, 'jcryption'])->name('jcryption');

    Route::resource('permission', App\Http\Controllers\Admin\PermissionController::class);



    Route::get('/change-password', [App\Http\Controllers\Admin\ChangePasswordController::class, 'index'])->name('change.password');
    Route::match(['put', 'post'],'/update-password', [App\Http\Controllers\Admin\ChangePasswordController::class, 'store'])->name('update.password');
});


