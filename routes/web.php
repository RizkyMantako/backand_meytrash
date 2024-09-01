<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SampahController;
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

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/users', function () {
    return view('pages.users.index');
});

Route::get('/sampah', function () {
    return view('pages.sampah.sampah');
});

Route::get('/donasi', function () {
    return view('pages.donasis.donasi');
});

Route::get('/proses_donasi', function () {
    return view('pages.proses.proses_donasi');
});



Route::get('/riwayat_donasi', function () {
    return view('pages.riwayat.riwayat_donasi');
});

Route::get('/riwayat_sampah', function () {
    return view('pages.riwayat.riwayat_sampah');
});

Route::get('/edukasi', function () {
    return view('pages.edukasis.edukasi');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::resource('users', UserController::class);
});


// hapus data user
Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');


// verifikasi sampah ke proses sampah
Route::get('/proses_sampah', [SampahController::class, 'proses']);
Route::put('/proses_sampah/{id}', [SampahController::class, 'verifikasi'])->name('verifikasi_sampah');
Route::get('/riwayat_sampah', [SampahController::class, 'tolak'])->name('tolak_sampah');
Route::put('/selesaikan_sampah/{id}', [SampahController::class, 'selesaiProses'])->name('selesai_sampah');


Route::put('/proses_donasi/{id}', [DonasiController::class, 'verifikasi'])->name('verifikasi_donasi');
Route::get('/riwayat_donasi', [DonasiController::class, 'tolak'])->name('riwayat.riwayat_donasi');
Route::get('/proses_donasi', [DonasiController::class, 'proses'])->name('proses.proses_donasi');
Route::put('/selesaikan_donasi/{id}', [DonasiController::class, 'selesaiProses'])->name('selesai_donasi');


Route::get('/edukasi', [EducationController::class, 'index'])->name('edukasis.edukasi');
Route::post('/edukasi/save', [EducationController::class, 'store'])->name('edukasis.store');
Route::get('/edukasi/{id}/edit', [EducationController::class, 'edit'])->name('edukasis.edit');
Route::put('/edukasi/{id}/update', [EducationController::class, 'update'])->name('edukasis.update');
Route::delete('/edukasi/{id}/delete', [EducationController::class, 'destroy'])->name('edukasis.destroy');
Route::get('/sampah', [SampahController::class, 'index'])->name('sampah.sampah');
Route::get('/sampah/{id}/edit', [SampahController::class, 'edit'])->name('sampah.edit');
Route::put('/sampah/{id}/update', [SampahController::class, 'update'])->name('sampah.update');
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasis.donasi');
Route::get('/donasi/{id}/edit', [DonasiController::class, 'edit'])->name('donasis.edit');
Route::put('/donasi/{id}/update', [DonasiController::class, 'update'])->name('donasis.update');


