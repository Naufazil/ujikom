<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DaftarEskulController;
use App\Http\Controllers\Api\EskulController;
use App\Http\Controllers\API\JadwalController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // ==================== ROUTE YANG KITA BUTUHKAN ====================
    Route::post('/daftar-eskul', [DaftarEskulController::class, 'store']);
    
    // Riwayat Pendaftaran Siswa (INI YANG BARU)
    Route::get('/daftar-eskul/saya', [DaftarEskulController::class, 'indexSaya']);

    // ==================== NONAKTIFKAN SEMENTARA ====================
    Route::get('/eskul', [EskulController::class, 'index']);
    Route::apiResource('jadwal', JadwalController::class);
});