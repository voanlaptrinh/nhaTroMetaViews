<?php

use App\Http\Controllers\Admin\DichVuController;
use App\Http\Controllers\Admin\DienNuocController;
use App\Http\Controllers\Admin\NhaTroController;
use App\Http\Controllers\Admin\RoomController;
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


Route::get('nha-tro', [NhaTroController::class, 'index'])->name('nha_tro.index');
Route::get('nha-tro/create', [NhaTroController::class, 'create'])->name('nha_tro.create');
Route::post('nha-tro/store', [NhaTroController::class, 'store'])->name('nha_tro.store');
Route::get('nha-tro/edit/{id}', [NhaTroController::class, 'edit'])->name('nha_tro.edit');
Route::put('nha-tro/update/{id}', [NhaTroController::class, 'update'])->name('nha_tro.update');
Route::delete('nha-tro/delete/{id}', [NhaTroController::class, 'destroy'])->name('nha_tro.destroy');



Route::prefix('phong-tro')->name('rooms.')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('index');
    Route::get('/create', [RoomController::class, 'create'])->name('create');
    Route::post('/', [RoomController::class, 'store'])->name('store');
    Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('edit');
    Route::put('/{room}', [RoomController::class, 'update'])->name('update');
    Route::delete('/{room}', [RoomController::class, 'destroy'])->name('destroy');
});
Route::prefix('dien-nuoc')->group(function () {
    Route::get('/', [DienNuocController::class, 'index'])->name('diennuoc.index');
    Route::post('/tao-du-lieu', [DienNuocController::class, 'store'])->name('diennuoc.store');
    Route::put('/{id}', [DienNuocController::class, 'update'])->name('diennuoc.update');
});
