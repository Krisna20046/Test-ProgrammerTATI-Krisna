<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use App\Models\Provinsi;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/getData', [RoleController::class, 'getData'])->name('role.getData');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::post('/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::post('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('log-harian')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('log-harian.index');
        Route::post('/', [LogController::class, 'store'])->name('log-harian.store');
        Route::post('/{id}', [LogController::class, 'update'])->name('log-harian.update');
        Route::delete('/{id}', [LogController::class, 'destroy'])->name('log-harian.destroy');
    });

    Route::prefix('verifikasi')->group(function () {
        Route::get('/', [LogController::class, 'index_verifikasi'])->name('verifikasi.index');
        Route::post('/{id}', [LogController::class, 'verifikasi'])->name('verifikasi.update');
    });

    Route::get('/provinsi', function () {
        return view('provinsi.index');
    })->name('provinsi.index');

    Route::get('/predikat', function () {
        return view('predikat.index');
    })->name('predikat.index');

    Route::get('/deret-bilangan', function () {
        return view('deret_bilangan.index');
    })->name('deret_bilangan.index');
});
