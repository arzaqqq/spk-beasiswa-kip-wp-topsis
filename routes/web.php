<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;

Route::get('/', function () {
    return view('layouts.app');
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

;
