<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

use App\Http\Controllers\MejaController;
use App\Http\Controllers\KapasitasController;
use App\Http\Controllers\DetailMejaController;
use App\Http\Controllers\ReservasiWalkinController;
use App\Http\Controllers\ReservasiController;

Route::resource('meja', MejaController::class);
Route::resource('kapasitas', KapasitasController::class);
Route::resource('detail-meja', DetailMejaController::class);
Route::resource('reservasi-walkin', ReservasiWalkinController::class);
Route::resource('reservasi', ReservasiController::class);
