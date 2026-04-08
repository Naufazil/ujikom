<?php

namespace App\Http\Controllers;

use App\Models\DaftarEskul;
use App\Models\Penerimaan;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = DaftarEskul::whereHas('eskul', function ($q) {
            $q->where('pembina_id', Auth::id());
        })
        ->with(['user', 'eskul'])
        ->latest()
        ->get();

        return view('pembina.pendaftar', compact('pendaftarans'));
    }

    public function accept($id)
{
    $daftar = DaftarEskul::with('eskul')->findOrFail($id);

    if ($daftar->eskul->pembina_id !== Auth::id()) {
        abort(403);
    }

   $daftar->update([
    'status' => 'diterima'
]);


    // INSERT / UPDATE ke tabel penerimaans
    Penerimaan::updateOrCreate(
        ['daftar_id' => $daftar->id],
        ['catatan' => 'Diterima']
    );

    return back()->with('success', 'Pendaftaran diterima');
}

public function reject($id)
{
    $daftar = DaftarEskul::with('eskul')->findOrFail($id);

    if ($daftar->eskul->pembina_id !== Auth::id()) {
        abort(403);
    }

   $daftar->update([
    'status' => 'ditolak'
]);


    Penerimaan::updateOrCreate(
        ['daftar_id' => $daftar->id],
        ['catatan' => 'Ditolak']
    );

    return back()->with('success', 'Pendaftaran ditolak');
}

}
