<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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




Route::get('/',[LoginController::class,'loginView'])->name('loginView');
Route::post('login',[LoginController::class,'login'])->name('login');

Route::group(['middleware' => 'AdminAuthCheck'],function(){

    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    
    Route::get('booksView',[AdminController::class,'booksView'])->name('booksView');
    Route::get('addBookView',[AdminController::class,'addBookView'])->name('addBookView');

    Route::post('saveCategory',[AdminController::class,'saveCategory'])->name('saveCategory');
    
});
