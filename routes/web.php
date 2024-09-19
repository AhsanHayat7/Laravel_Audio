<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('audios', AudioController::class);
Route::get('audios/{id}/download', [AudioController::class, 'download'])->name('audios.download');

Route::get('/home/dashboard', [AudioController::class,  'dashboard'])->name('home');
