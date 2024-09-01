<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('edit-profile', [AuthController::class, 'editProfile']);
    Route::get('user', [AuthController::class, 'getUserInfo']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user/tukar/{id}', [UserController::class, 'tukarPoin']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('donasi/add', [DonasiController::class, 'add']);
    Route::get('donasi/getlist', [DonasiController::class, 'getlist']);
    Route::get('donasi/detail/{id}', [DonasiController::class, 'detail']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('sampah/add', [SampahController::class, 'add']);
    Route::get('sampah/getlist', [SampahController::class, 'getlist']);
    Route::get('sampah/detail/{id}', [SampahController::class, 'detail']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('edukasi/getlist', [EducationController::class, 'getlist']);
    Route::get('edukasi/detail/{id}', [EducationController::class, 'detail']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('riwayat/donasi/getlist', [RiwayatController::class, 'getListDonasi']);
    Route::get('riwayat/donasi/detail/{id}', [RiwayatController::class, 'getDetailDonasi']);
    Route::get('riwayat/sampah/detail/{id}', [RiwayatController::class, 'getDetailSampah']);
    Route::get('riwayat/sampah/getlist', [RiwayatController::class, 'getListSampah']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('proses/donasi/add', [ProsesController::class, 'addDonasi']);
    Route::get('proses/donasi/getlist', [ProsesController::class, 'getListDonasi']);
    Route::get('proses/donasi/detail/{id}', [ProsesController::class, 'getDetailDonasi']);
    Route::post('proses/sampah/add', [ProsesController::class, 'addSampah']);
    Route::get('proses/sampah/detail/{id}', [ProsesController::class, 'getDetailSampah']);
    Route::get('proses/sampah/getlist', [ProsesController::class, 'getListSampah']);
});
