<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\TemporaryAlternatifController;



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


Route::middleware('auth')->group(function () {

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function(){
            return view('dashboard');
    })->name('dashboard');

    // ROUTE KRITERIA
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    Route::resource('alternatif',AlternatifController::class);
    Route::delete('alternatif', [AlternatifController::class, 'destroyall'])->name('alternatif.destroyall');

    //ROUTE PENILAIAN
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('penilaian/{alternatif}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('penilaian/{alternatif}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('penilaian/{alternatif}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');


    Route::get('/perhitungan/wp', [PerhitunganController::class, 'wp'])->name('perhitungan.wp');
    Route::get('/perhitungan/topsis', [PerhitunganController::class, 'topsis'])->name('perhitungan.topsis');

    Route::get('/rekomendasi', [App\Http\Controllers\PerhitunganController::class, 'rekomendasi'])->name('rekomendasi');


    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



    Route::get('/temporary', [TemporaryAlternatifController::class, 'index'])->name('temporary.index');
Route::post('/temporary/import', [TemporaryAlternatifController::class, 'import'])->name('temporary.import');
Route::get('/temporary/preview', [TemporaryAlternatifController::class, 'preview'])->name('temporary.preview');
Route::post('/temporary/store-selected', [TemporaryAlternatifController::class, 'storeSelected'])->name('temporary.storeSelected');
});
