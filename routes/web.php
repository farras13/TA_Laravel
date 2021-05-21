<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersilanganController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proslog']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('persilangan', [PersilanganController::class, 'index'])->name('persilangan');
    Route::get('persilangan/form', [PersilanganController::class, 'formT']);
    Route::get('persilangan/form-edit/{id}', [PersilanganController::class, 'formE']);
    Route::post('persilangan/add', [PersilanganController::class, 'tambah']);
    Route::post('persilangan/edit/{id}', [PersilanganController::class, 'rubah']);
    Route::get('persilangan/hapus/{id}', [PersilanganController::class, 'hapus']);

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
