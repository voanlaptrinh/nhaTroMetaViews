<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DichVuController;
use App\Http\Controllers\Admin\DienNuocController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\NhaTroController;
use App\Http\Controllers\Admin\PhuongTienController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RolesControler;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TaiSanChungRiengController;
use App\Http\Controllers\Admin\TaiSanController;
use App\Http\Controllers\Admin\TintucController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\UploadController;
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

Route::prefix('admin')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });


    Route::prefix('dich-vus')->group(function () {
        Route::get('/', [DichVuController::class, 'index'])->name('dichvu.index');
        Route::get('/create', [DichVuController::class, 'create'])->name('dichvus.create');
        Route::post('', [DichVuController::class, 'store'])->name('dichvus.store');
        Route::get('/{id}/edit', [DichVuController::class, 'edit'])->name('dichvus.edit');
        Route::put('/{id}', [DichVuController::class, 'update'])->name('dichvus.update');
        Route::delete('/{id}', [DichVuController::class, 'destroy'])->name('dichvus.destroy');
    });

    Route::prefix('nha-tro')->group(function () {
        Route::get('/', [NhaTroController::class, 'index'])->name('nha_tro.index');
        Route::get('/create', [NhaTroController::class, 'create'])->name('nha_tro.create');
        Route::post('/store', [NhaTroController::class, 'store'])->name('nha_tro.store');
        Route::get('/edit/{id}', [NhaTroController::class, 'edit'])->name('nha_tro.edit');
        Route::put('/update/{id}', [NhaTroController::class, 'update'])->name('nha_tro.update');
        Route::delete('/delete/{id}', [NhaTroController::class, 'destroy'])->name('nha_tro.destroy');
    });


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

    Route::prefix('tai-sans')->group(function () {
        Route::get('/', [TaiSanController::class, 'index'])->name('tai-sans.index');           // Danh sách
        Route::get('/create', [TaiSanController::class, 'create'])->name('tai-sans.create');   // Form thêm
        Route::post('/store', [TaiSanController::class, 'store'])->name('tai-sans.store');           // Xử lý thêm
        Route::get('/{id}/edit', [TaiSanController::class, 'edit'])->name('tai-sans.edit');    // Form sửa
        Route::put('/{id}', [TaiSanController::class, 'update'])->name('tai-sans.update');     // Xử lý sửa
        Route::delete('/{id}', [TaiSanController::class, 'destroy'])->name('tai-sans.destroy'); // Xử lý xóa
    });
    Route::prefix('tin_tuc')->group(function () {
        Route::get('/', [TintucController::class, 'index'])->name('tin_tuc.index'); // Danh sách tin
        Route::get('/create', [TinTucController::class, 'create'])->name('tin_tuc.create'); // Form thêm
        Route::post('/store', [TinTucController::class, 'store'])->name('tin_tuc.store'); // Lưu tin mới
        Route::get('/{tinTuc}/edit', [TinTucController::class, 'edit'])->name('tin_tuc.edit'); // Form sửa
        Route::put('/{tinTuc}', [TinTucController::class, 'update'])->name('tin_tuc.update'); // Cập nhật tin
        Route::delete('/{tinTuc}/delete', [TinTucController::class, 'destroy'])->name('tin_tuc.destroy'); // Xóa tin

    });
    Route::prefix('tai-san-chung-rieng')->group(function () {
        Route::get('/', [TaiSanChungRiengController::class, 'index'])->name('tai_san_chung_riengs.index');
        Route::get('/create', [TaiSanChungRiengController::class, 'create'])->name('tai_san_chung_riengs.create');
        Route::post('/store', [TaiSanChungRiengController::class, 'store'])->name('tai_san_chung_riengs.store');
        Route::get('/{id}/edit', [TaiSanChungRiengController::class, 'edit'])->name('tai_san_chung_riengs.edit');
        Route::put('/{id}', [TaiSanChungRiengController::class, 'update'])->name('tai_san_chung_riengs.update');
        Route::delete('/{id}', [TaiSanChungRiengController::class, 'destroy'])->name('tai_san_chung_riengs.destroy');
    });
    Route::prefix('chinh-sach')->group(function () {
        Route::get('/', [PolicyController::class, 'index'])->name('policies.index');
        Route::get('/create', [PolicyController::class, 'create'])->name('policies.create');
        Route::post('/store', [PolicyController::class, 'store'])->name('policies.store');
        Route::get('/{policy}/edit', [PolicyController::class, 'edit'])->name('policies.edit');
        Route::put('/{policy}', [PolicyController::class, 'update'])->name('policies.update');
        Route::delete('/{policy}', [PolicyController::class, 'destroy'])->name('policies.destroy');
    });
    Route::prefix('sliders')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
    });
    Route::prefix('feedbacks')->name('feedbacks.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');           // Danh sách
        Route::get('/create', [FeedbackController::class, 'create'])->name('create');   // Form thêm
        Route::post('/store', [FeedbackController::class, 'store'])->name('store');     // Lưu mới
        Route::get('/edit/{feedback}', [FeedbackController::class, 'edit'])->name('edit'); // Form sửa
        Route::put('/update/{feedback}', [FeedbackController::class, 'update'])->name('update'); // Cập nhật
        Route::post('/delete/{feedback}', [FeedbackController::class, 'destroy'])->name('destroy'); // Xóa
    });
    Route::prefix('web-config')->name('web-config.')->group(function () {
        Route::get('/', [WebConfigController::class, 'edit'])->name('edit');
        Route::put('/', [WebConfigController::class, 'update'])->name('update');
    });
    Route::prefix('web-config')->name('web-config.')->group(function () {
        Route::get('/', [WebConfigController::class, 'edit'])->name('edit');
        Route::put('/', [WebConfigController::class, 'update'])->name('update');
    });
    Route::prefix('about_us')->name('about_us.')->group(function () {
        Route::get('/', [AboutUsController::class, 'edit'])->name('edit');
        Route::put('/', [AboutUsController::class, 'update'])->name('update');
    });
    Route::prefix('khach-hang')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('quan-ly')->name('admin.quanly.')->group(function () {
        Route::get('/', [AdministratorController::class, 'index'])->name('index');
        Route::get('/create', [AdministratorController::class, 'create'])->name('create');
        Route::post('/store', [AdministratorController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [AdministratorController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdministratorController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdministratorController::class, 'destroy'])->name('destroy');
    });


    Route::get('/lien-he', [ContactController::class, 'index'])->name('lien_he.index.admin');


    Route::prefix('vai-tro')->name('roles.')->group(function () {
        Route::get('/', [RolesControler::class, 'index'])->name('index');
        Route::get('/create', [RolesControler::class, 'create'])->name('create');
        Route::post('/', [RolesControler::class, 'store'])->name('store');
        Route::get('/{role}/edit', [RolesControler::class, 'edit'])->name('edit');
        Route::put('/{role}', [RolesControler::class, 'update'])->name('update');
        Route::delete('/{role}', [RolesControler::class, 'destroy'])->name('destroy');
    });

// Routes chính cho quản lý phương tiện
Route::prefix('phuong-tiens')->name('admin.phuong_tiens.')->group(function () {
    Route::get('/', [PhuongTienController::class, 'index'])->name('index');
    Route::get('/create', [PhuongTienController::class, 'create'])->name('create');
    Route::post('/', [PhuongTienController::class, 'store'])->name('store');
    Route::get('/{phuong_tien}/edit', [PhuongTienController::class, 'edit'])->name('edit');
    Route::put('/{phuong_tien}', [PhuongTienController::class, 'update'])->name('update');
    Route::delete('/{phuong_tien}', [PhuongTienController::class, 'destroy'])->name('destroy');
});




});
Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload-image');
Route::post('/delete-image', [UploadController::class, 'deleteImage'])->name('delete-image');
