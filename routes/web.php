<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\UserController;


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

//home dan index
Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//akses admin
Route::group(['middleware' => 'admin'], function () {
    //route guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::get('/guru/detail/{id_guru}', [GuruController::class, 'detail']);
    Route::get('/guru/add', [GuruController::class, 'add']);
    Route::post('/guru/insert', [GuruController::class, 'insert']);
    Route::get('/guru/edit/{id_guru}', [GuruController::class, 'edit']);
    Route::post('/guru/update/{id_guru}', [GuruController::class, 'update']);
    Route::get('/guru/delete/{id_guru}', [GuruController::class, 'delete']);
    
    //route siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
});

//akses user
Route::group(['middleware' => 'user'], function () {
    //route user
    Route::get('/user', [UserController::class, 'index'])->name('user');
});

//akses koperasi
Route::group(['middleware' => 'koperasi'], function () {
    //route koperasi
    Route::get('/koperasi/print', [KoperasiController::class, 'print']);
    Route::get('/koperasi/printpdf', [KoperasiController::class, 'printpdf']);
    Route::get('/koperasi', [KoperasiController::class, 'index'])->name('koperasi');
});
