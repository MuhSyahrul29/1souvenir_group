<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganConrtroller;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('/register-proses',[LoginController::class,'register_proses'])->name('register-proses');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
// });

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::prefix('admin')->name('admin.')->group(function () {
//         Route::get('/user', [UserController::class, 'index'])->name('user.index');
//         Route::get('/create', [UserController::class, 'create'])->name('create');
//         Route::post('/store', [UserController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
//         Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
//         Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
//     });
// });

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    // Manajemen Karyawan
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/', [AdminController::class, 'indexKaryawan'])->name('index');
        Route::get('/create', [AdminController::class, 'createKaryawan'])->name('create');
        Route::post('/store', [AdminController::class, 'storeKaryawan'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'editKaryawan'])->name('edit');
        Route::put('/update/{id}', [AdminController::class, 'updateKaryawan'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'deleteKaryawan'])->name('delete');
    });

    // Manajemen Pelanggan
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [AdminController::class, 'indexPelanggan'])->name('index');
        Route::get('/create', [AdminController::class, 'createPelanggan'])->name('create');
        Route::post('/store', [AdminController::class, 'storePelanggan'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'editPelanggan'])->name('edit');
        Route::put('/update/{id}', [AdminController::class, 'updatePelanggan'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'deletePelanggan'])->name('delete');
    });
});


Route::middleware(['auth', 'role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [KaryawanController::class, 'dashboard'])->name('dashboard');
    Route::get('/penawaran', [KaryawanController::class, 'index'])->name('penawaran.index');
    Route::get('/penawaran/create', [KaryawanController::class, 'create'])->name('penawaran.create');
    Route::post('/penawaran/store', [KaryawanController::class, 'store'])->name('penawaran.store');
});


Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganConrtroller::class, 'dashboard'])->name('dashboard');
});
