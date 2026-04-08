<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarEskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarEskulController extends Controller
{
    // Method untuk siswa melihat riwayat pendaftaran mereka
    public function indexSaya()
    {
        $riwayat = DaftarEskul::with('eskul')  // eager load relasi eskul
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat pendaftaran berhasil diambil',
            'data'    => $riwayat
        ]);
    }

    // Method store yang sudah ada (biarkan tetap)
    public function store(Request $request)
    {
        $request->validate([
            'eskul_id'      => 'required|exists:eskuls,id',
            'kelas'         => 'required|string|max:50',
            'tahun_ajaran'  => 'required|string|max:20',
            'no_telp'       => 'required|string|max:15',
            'alasan'        => 'required|string',
        ]);

        // Cek duplikat pendaftaran
        $existing = DaftarEskul::where('user_id', Auth::id())
            ->where('eskul_id', $request->eskul_id)
            ->whereIn('status', ['menunggu', 'diterima'])
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Anda sudah pernah mendaftar eskul ini dan masih dalam proses atau sudah diterima.'
            ], 400);
        }

        $daftar = DaftarEskul::create([
            'user_id'       => Auth::id(),
            'eskul_id'      => $request->eskul_id,
            'kelas'         => $request->kelas,
            'tahun_ajaran'  => $request->tahun_ajaran,
            'no_telp'       => $request->no_telp,
            'alasan'        => $request->alasan,
            'status'        => 'menunggu',
        ]);

        return response()->json([
            'message' => 'Pendaftaran eskul berhasil dikirim. Menunggu verifikasi admin.',
            'data'    => $daftar
        ], 201);
    }
}