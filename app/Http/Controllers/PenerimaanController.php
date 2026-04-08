<?php

namespace App\Http\Controllers;
use App\Models\DaftarEskul;
use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Penerimaan::with('daftar.user', 'daftar.eskul');

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->whereHas('daftar.user', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%' . $request->search . '%');
                })->orWhereHas('daftar.eskul', function ($q2) use ($request) {
                    $q2->where('nama_eskul', 'like', '%' . $request->search . '%');
                })->orWhereHas('daftar', function ($q2) use ($request) {
                    $q2->where('status', 'like', '%' . $request->search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $request->search . '%');
                });
            });
        }

        $penerimaan = $query->get();

        return view('penerimaan.index', compact('penerimaan'));
    }

    public function setuju($id)
    {
        $daftar = DaftarEskul::findOrFail($id);

        // Cegah duplikasi
        if (!Penerimaan::where('daftar_id', $id)->exists()) {
            Penerimaan::create([
                'daftar_id' => $id,
                'catatan' => 'Disetujui oleh admin',
            ]);
        }

        return redirect()->back()->with('success', 'Pendaftaran disetujui.');
    }

    public function tolak($id)
    {
        $daftar = DaftarEskul::findOrFail($id);

        if (!Penerimaan::where('daftar_id', $id)->exists()) {
            Penerimaan::create([
                'daftar_id' => $id,
                'catatan' => 'Ditolak oleh admin',
            ]);
        }

        return redirect()->back()->with('success', 'Pendaftaran ditolak.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerimaan = Penerimaan::all();
        $daftar_eskul = DaftarEskul::all();
        return view("penerimaan.create", compact("daftar_eskul"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'daftar_id' => 'required|exists:daftar__eskuls,id',
            'catatan' => 'required|string',
        ]);

        // INSERT kalau belum ada, UPDATE kalau sudah ada
        \App\Models\Penerimaan::updateOrCreate(
            ['daftar_id' => $request->daftar_id],
            ['catatan' => $request->catatan]
        );

        // Update status di daftar_eskuls
        $daftar = \App\Models\DaftarEskul::findOrFail($request->daftar_id);
        $daftar->status = $request->catatan;
        $daftar->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Penerimaan $penerimaan)
    {
        $penerimaan = Penerimaan::find($penerimaan->id);
        return view("penerimaan.show", compact("penerimaan"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerimaan $penerimaan)
    {
        $penerimaan = Penerimaan::findOrFail($penerimaan->id);
        $daftarEskul = DaftarEskul::all();
        return view("penerimaan.edit", compact("penerimaan", "daftarEskul"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        $request->validate([
            "daftar_id" => "required|exists:daftar__eskuls,id",
            "catatan" => "required|string|max:255",
        ]);

        $penerimaan->update([
            'daftar_id' => $request->daftar_id,
            'catatan' => $request->catatan,
        ]);

        // Update status juga di daftar_eskuls
        $daftar = DaftarEskul::findOrFail($request->daftar_id);
        $daftar->status = $request->catatan;
        $daftar->save();

        return redirect()->route("penerimaan.index")->with("success", "Data berhasil diperbarui");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerimaan $penerimaan)
    {
        $daftar = $penerimaan->daftar;
        $penerimaan->delete();

        // Reset status pendaftar jadi "Menunggu"
        if ($daftar) {
            $daftar->status = 'Menunggu';
            $daftar->save();
        }

        return redirect()->route("penerimaan.index")->with("delete", "Data berhasil dihapus");
    }
    
}
