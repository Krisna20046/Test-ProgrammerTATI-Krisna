<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/provinsi/sync', [ProvinsiController::class, 'sync']);
Route::get('/provinsi', [ProvinsiController::class, 'getData']);
Route::get('/provinsi/{id}', [ProvinsiController::class, 'getDataDetail']);
Route::post('/provinsi', [ProvinsiController::class, 'store']);
Route::put('/provinsi/{id}', [ProvinsiController::class, 'update']);
Route::delete('/provinsi/{id}', [ProvinsiController::class, 'destroy']);