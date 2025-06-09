<?php

use App\Http\Controllers\Admin\DichVuController;
use App\Http\Controllers\Admin\DienNuocController;
use App\Http\Controllers\Admin\NhaTroController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TaiSanChungRiengController;
use App\Http\Controllers\Admin\TaiSanController;
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


Route::get('/tai-sans', [TaiSanController::class, 'index'])->name('tai-sans.index');           // Danh sách
Route::get('/tai-sans/create', [TaiSanController::class, 'create'])->name('tai-sans.create');   // Form thêm
Route::post('/tai-sans', [TaiSanController::class, 'store'])->name('tai-sans.store');           // Xử lý thêm
Route::get('/tai-sans/{id}/edit', [TaiSanController::class, 'edit'])->name('tai-sans.edit');    // Form sửa
Route::put('/tai-sans/{id}', [TaiSanController::class, 'update'])->name('tai-sans.update');     // Xử lý sửa
Route::delete('/tai-sans/{id}', [TaiSanController::class, 'destroy'])->name('tai-sans.destroy'); // Xử lý xóa



Route::get('tai-san-chung-rieng', [TaiSanChungRiengController::class, 'index'])->name('tai_san_chung_riengs.index');
Route::get('tai-san-chung-rieng/create', [TaiSanChungRiengController::class, 'create'])->name('tai_san_chung_riengs.create');
Route::post('tai-san-chung-rieng', [TaiSanChungRiengController::class, 'store'])->name('tai_san_chung_riengs.store');
Route::get('tai-san-chung-rieng/{id}/edit', [TaiSanChungRiengController::class, 'edit'])->name('tai_san_chung_riengs.edit');
Route::put('tai-san-chung-rieng/{id}', [TaiSanChungRiengController::class, 'update'])->name('tai_san_chung_riengs.update');
Route::delete('tai-san-chung-rieng/{id}', [TaiSanChungRiengController::class, 'destroy'])->name('tai_san_chung_riengs.destroy');