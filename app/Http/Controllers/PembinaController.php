<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eskul;
use App\Models\DaftarEskul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PembinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // =====================================================
    // DASHBOARD PEMBINA
    // =====================================================
    public function dashboard()
    {
        if (Gate::denies('isPembina')) {
            abort(403, 'Unauthorized');
        }

        $user = Auth::user();

        $eskuls = Eskul::where('pembina_id', $user->id)->get();

        $daftars = DaftarEskul::whereIn('eskul_id', $eskuls->pluck('id'));

        // ✅ FIX STATUS (lowercase semua)
        $keterima = (clone $daftars)->where('status', 'diterima')->count();
        $jumlahDitolak = (clone $daftars)->where('status', 'ditolak')->count();
        $jumlahSiswa = (clone $daftars)->count();
        $jumlahEskul = $eskuls->count();

        return view('pembina.dashboard', compact(
            'keterima',
            'jumlahDitolak',
            'jumlahSiswa',
            'jumlahEskul'
        ));
    }

    // =====================================================
    // LIST PENDAFTAR
    // =====================================================
    public function index()
    {
        if (Gate::denies('isPembina')) {
            abort(403, 'Unauthorized');
        }

        $user = Auth::user();

        $eskuls = Eskul::where('pembina_id', $user->id)->get();

        $daftars = DaftarEskul::whereIn('eskul_id', $eskuls->pluck('id'))
            ->with(['user', 'eskul'])
            ->latest()
            ->get();

        // ✅ FIX nama variable (biar sama dengan blade)
        return view('pembina.index', [
            'pendaftarans' => $daftars
        ]);
    }

    // =====================================================
    // TERIMA
    // =====================================================
    public function accept($id)
    {
        if (Gate::denies('isPembina')) {
            abort(403, 'Unauthorized');
        }

        $daftar = DaftarEskul::with('eskul')->findOrFail($id);

        if (Gate::denies('manageEskul', $daftar->eskul)) {
            abort(403, 'Unauthorized');
        }

        // ✅ FIX lowercase
        $daftar->update([
            'status' => 'diterima'
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil diterima.');
    }

    // =====================================================
    // TOLAK
    // =====================================================
    public function reject($id)
    {
        if (Gate::denies('isPembina')) {
            abort(403, 'Unauthorized');
        }

        $daftar = DaftarEskul::with('eskul')->findOrFail($id);

        if (Gate::denies('manageEskul', $daftar->eskul)) {
            abort(403, 'Unauthorized');
        }

        // ✅ FIX lowercase
        $daftar->update([
            'status' => 'ditolak'
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak.');
    }
}