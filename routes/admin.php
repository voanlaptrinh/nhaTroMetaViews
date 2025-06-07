<?php

use App\Http\Controllers\Admin\DichVuController;
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

Route::get('/dich-vus', [DichVuController::class, 'index'])->name('dichvu.index');
Route::get('/dich-vus/create', [DichVuController::class, 'create'])->name('dichvus.create');
Route::post('/dich-vus', [DichVuController::class, 'store'])->name('dichvus.store');

Route::get('/dich-vus/{id}/edit', [DichVuController::class, 'edit'])->name('dichvus.edit');
Route::put('/dich-vus/{id}', [DichVuController::class, 'update'])->name('dichvus.update');

Route::delete('/dich-vus/{id}', [DichVuController::class, 'destroy'])->name('dichvus.destroy');