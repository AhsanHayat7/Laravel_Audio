<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WebController;

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






Route::group(['middleware'=> 'auth'], function (){
Route::resource('medias', MediaController::class);
Route::get('logout', [AuthController::class,  'logout'])->name('logout');
// Route::get('media/download/{id}/{type}', [MediaController::class, 'download'])->name('medias.download');
});
Route::get('/',[WebController::class,  'index'])->name('home');


//auth
Route::group(['middleware'=> 'guest'], function (){
Route::get('/login', [AuthController::class, 'logged'])->name('logged');
Route::post('/login',[AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'reg'])->name('regist');
Route::post('/register',[AuthController::class, 'register'])->name('register');
});

