<?php

use App\Http\Controllers\Admin\RoomController;
use App\Models\Rooms;
use App\Models\TaiSanChungRieng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// routes/web.php
Route::get('/get-used-room-codes/{nha_tro_id}', [RoomController::class, 'getUsedRoomCodes']);

// routes/web.php
// routes/api.php
Route::get('/ajax/rooms-by-nhatro/{nhaTroId}', function ($nhaTroId) {
    $rooms = Rooms::where('nha_tro_id', $nhaTroId)
        ->with(['taiSanChungRiengs']) // giả sử có quan hệ này
        ->get();

    return response()->json($rooms->map(function ($room) {
        return [
            'id' => $room->id,
            'ma_phong' => $room->ma_phong,
             'da_ton_tai' => $room->taiSanChungRiengs->isNotEmpty(),
        ];
    }));
});

