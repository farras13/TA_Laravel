<?php

use App\Http\Controllers\GenController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
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

    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Pegawai
    Route::get('/Pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/FormPegawai', [PegawaiController::class, 'form'])->name('formpegawai');

    // Persilangan
    Route::get('persilangan', [PersilanganController::class, 'index'])->name('persilangan');
    Route::get('persilangan/form', [PersilanganController::class, 'formT']);
    Route::get('persilangan/form-edit/{id}', [PersilanganController::class, 'formE']);
    Route::post('persilangan/add', [PersilanganController::class, 'tambah']);
    Route::post('persilangan/edit/{id}', [PersilanganController::class, 'rubah']);
    Route::get('persilangan/hapus/{id}', [PersilanganController::class, 'hapus']);

    // Gen
    Route::get('gen', [GenController::class, 'index'])->name('gen');
    Route::get('gen/tambah', [GenController::class, 'create']);
    Route::post('gen/add', [GenController::class, 'add']);
    Route::get('gen/edit/{id}', [GenController::class, 'edit']);
    Route::post('gen/update/{id}', [GenController::class, 'update']);
    Route::get('gen/destroy/{id}', [GenController::class, 'destroy']);

    // proses kebun
    Route::get('kebun/proses', [KebunController::class, 'index'])->name('proses');
    Route::get('kebun/proses/tambah', [KebunController::class, 'create']);
    Route::post('kebun/proses/add', [KebunController::class, 'add']);
    Route::get('kebun/proses/edit/{id}', [KebunController::class, 'edit']);
    Route::post('kebun/proses/update/{id}', [KebunController::class, 'update']);
    Route::get('kebun/proses/destroy/{id}', [KebunController::class, 'destroy']);

    // panen kebun
    Route::get('kebun/panen', [KebunController::class, 'panen'])->name('panen');
    Route::get('kebun/panen/tambah', [KebunController::class, 'createP']);
    Route::post('kebun/panen/add', [KebunController::class, 'addP']);
    Route::get('kebun/panen/edit/{id}', [KebunController::class, 'editP']);
    Route::post('kebun/panen/update/{id}', [KebunController::class, 'updateP']);
    Route::get('kebun/panen/destroy/{id}', [KebunController::class, 'destroyP']);

    // trans 1
    Route::get('trans', [LabController::class, 'index'])->name('trans');
    Route::get('trans/tambah', [LabController::class, 'create']);
    Route::post('trans/add', [LabController::class, 'add']);
    Route::get('trans/edit/{id}', [LabController::class, 'edit']);
    Route::post('trans/update/{id}', [LabController::class, 'update']);
    Route::get('trans/destroy/{id}', [LabController::class, 'destroy']);

    // trans 2
    Route::get('trans2', [LabController::class, 'trans2'])->name('trans2');
    Route::get('trans2/tambah', [LabController::class, 'create2']);
    Route::get('trans3/getData/{id}', [LabController::class, 'getData']);
    Route::post('trans2/add', [LabController::class, 'add2']);
    Route::get('trans2/edit/{id}', [LabController::class, 'edit2']);
    Route::post('trans2/update/{id}', [LabController::class, 'update2']);
    Route::get('trans2/destroy/{id}', [LabController::class, 'destroy2']);

    // trans 3
    Route::get('trans3', [LabController::class, 'trans3'])->name('trans3');
    Route::get('trans3/tambah', [LabController::class, 'create3']);
    Route::get('trans3/getData/{id}', [LabController::class, 'getData']);
    Route::post('trans3/add', [LabController::class, 'add3']);
    Route::get('trans3/edit/{id}', [LabController::class, 'edit3']);
    Route::post('trans3/update/{id}', [LabController::class, 'update3']);
    Route::get('trans3/destroy/{id}', [LabController::class, 'destroy3']);

    // Gudang
    Route::get('gudang', [GudangController::class, 'index'])->name('gudang');
    Route::get('gudang/tambah', [GudangController::class, 'create']);
    Route::post('gudang/add', [GudangController::class, 'add']);
    Route::get('gudang/edit/{id}', [GudangController::class, 'edit']);
    Route::get('gudang/detail/{id}', [GudangController::class, 'detail']);
    Route::post('gudang/update/{id}', [GudangController::class, 'update']);
    Route::get('gudang/destroy/{id}', [GudangController::class, 'destroy']);

    // Data Masuk
    Route::get('eksternal/in', [GudangController::class, 'eksin'])->name('eksin');
    Route::get('eksternal/in/tambah', [GudangController::class, 'create2']);
    Route::post('eksternal/in/add', [GudangController::class, 'add2']);
    Route::get('eksternal/in/edit/{id}', [GudangController::class, 'edit2']);
    Route::post('eksternal/in/update/{id}', [GudangController::class, 'update2']);
    Route::get('eksternal/in/destroy/{id}', [GudangController::class, 'destroy2']);

    // Data Keluar
    Route::get('eksternal/out', [GudangController::class, 'eksout'])->name('eksout');
    Route::get('eksternal/out/tambah', [GudangController::class, 'create3']);
    Route::post('eksternal/out/add', [GudangController::class, 'add3']);
    Route::get('eksternal/out/edit/{id}', [GudangController::class, 'edit3']);
    Route::get('eksternal/out/getData/{id}', [GudangController::class, 'getData']);
    Route::post('eksternal/out/update/{id}', [GudangController::class, 'update3']);
    Route::get('eksternal/out/destroy/{id}', [GudangController::class, 'destroy3']);


    // logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
