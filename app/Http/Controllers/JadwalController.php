<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Eskul;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jadwal::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('hari', 'like', '%' . $request->search . '%');
            $query->orWhereHas('eskul', function ($q) use ($request) {
                $q->where('nama_eskul', 'like', '%' . $request->search . '%');
            });
        }

        $jadwal = Jadwal::all();
        $jadwal = $query->get();

        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eskul = Eskul::all();
        $jadwal = Jadwal::all();
        return view('jadwal.create', compact('eskul','jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'eskul_id' => 'required|exists:eskuls,id',
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $eskul = Eskul::all();
        
        return view('jadwal.edit', compact('jadwal', 'eskul'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('update', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('delete', 'Jadwal berhasil dihapus!');
    }
}
