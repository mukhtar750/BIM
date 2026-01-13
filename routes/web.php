<?php

use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/polling-unit/{id}', [ElectionController::class, 'pollingUnitResults'])->name('polling.unit.results');
Route::get('/lga-results', [ElectionController::class, 'lgaResults'])->name('lga.results');
Route::get('/add-results', [ElectionController::class, 'createResults'])->name('results.create');
Route::post('/add-results', [ElectionController::class, 'storeResults'])->name('results.store');
