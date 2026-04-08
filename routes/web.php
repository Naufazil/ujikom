<?php

use App\Http\Controllers\DaftarEskulController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Models\DaftarEskul;
use App\Models\Eskul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('login.admin.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');



Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', function () {
    $jumlahEskul = Eskul::count(); // hitung total eskul
    $jumlahSiswa = DaftarEskul::count(); // hitung total Siswa
    $jumlahDitolak = DaftarEskul::where('status', 'Ditolak')->count();
    $keterima = DaftarEskul::where('status', 'Diterima')->count();
    return view('home', compact('jumlahEskul', 'jumlahSiswa', 'jumlahDitolak', 'keterima'));
});

Route::middleware([IsAdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/daftar-eskul', [DaftarEskulController::class, 'store'])->name('daftar-eskul.store');
});



Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', IsAdminMiddleware::class]
], function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('eskul', EskulController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('daftar', DaftarEskulController::class);
    Route::resource('penerimaan', PenerimaanController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Eskul
Route::resource('eskul', EskulController::class);
Route::get('/eskul/{id}', [App\Http\Controllers\EskulController::class, 'show'])->name('eskul.show');


// Jadwal
Route::resource('jadwal', JadwalController::class);

// Daftar Eskul
Route::resource('daftar', DaftarEskulController::class);
Route::get('/daftar-eskul', [DaftarEskulController::class, 'create'])->name('daftar-eskul');
Route::post('/daftar-eskul', [DaftarEskulController::class, 'store'])->name('daftar-eskul.store');
Route::get('/daftar-eskul/{id}/edit', [DaftarEskulController::class, 'edit'])->name('daftar-eskul.edit');
Route::put('/daftar-eskul/{id}', [DaftarEskulController::class, 'update'])->name('daftar-eskul.update');
Route::delete('/daftar-eskul/{id}', [DaftarEskulController::class, 'destroy'])->name('daftar-eskul.destroy');


// Penerimaan
Route::resource('penerimaan', PenerimaanController::class);
Route::post('/penerimaan/store', [App\Http\Controllers\PenerimaanController::class, 'store'])->name('penerimaan.store');
Route::prefix('pembina')
    ->as('pembina.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

       
    });
Route::middleware('auth')->group(function () {
    Route::get('/pembina/dashboard', [PembinaController::class, 'dashboard'])
        ->name('pembina.dashboard');
    Route::get('/pembina', [PembinaController::class, 'index'])->name('pembina.index');
    Route::post('/pembina/accept/{id}', [PembinaController::class, 'accept'])->name('pembina.accept');
    Route::post('/pembina/reject/{id}', [PembinaController::class, 'reject'])->name('pembina.reject');
});

use App\Http\Controllers\PendaftaranController;

Route::prefix('pembina')->middleware('auth')->group(function () {
    Route::get('/pendaftar', [PendaftaranController::class, 'index'])
        ->name('pembina.pendaftar');

    Route::put('/pendaftar/{id}/accept', [PendaftaranController::class, 'accept'])
        ->name('pembina.pendaftar.accept');

    Route::put('/pendaftar/{id}/reject', [PendaftaranController::class, 'reject'])
        ->name('pembina.pendaftar.reject');
});




