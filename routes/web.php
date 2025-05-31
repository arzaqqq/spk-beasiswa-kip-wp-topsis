<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AlternatifController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
        return view('dashboard');
});

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

