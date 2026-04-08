<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Eskul;
use App\Models\DaftarEskul;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil eskul yang dibina oleh pembina login
        $eskul = Eskul::where('pembina_id', $userId)->first();

        // Kalau pembina belum punya eskul
        if (!$eskul) {
            return view('pembina.dashboard', [
                'keterima' => 0,
                'jumlahDitolak' => 0,
                'jumlahSiswa' => 0,
                'jumlahEskul' => 0,
            ]);
        }

        // Hitung data berdasarkan eskul tersebut
        $keterima = DaftarEskul::where('eskul_id', $eskul->id)
            ->where('status', 'diterima')
            ->count();

        $jumlahDitolak = DaftarEskul::where('eskul_id', $eskul->id)
            ->where('status', 'ditolak')
            ->count();

        $jumlahSiswa = DaftarEskul::where('eskul_id', $eskul->id)->count();

        $jumlahEskul = 1; // pembina hanya 1 eskul

        return view('pembina.dashboard', compact(
            'keterima',
            'jumlahDitolak',
            'jumlahSiswa',
            'jumlahEskul'
        ));
    }
}