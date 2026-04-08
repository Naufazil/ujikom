<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // GET semua jadwal
    public function index()
    {
        return Jadwal::with('eskul')->get();
    }

    // POST tambah jadwal
    public function store(Request $request)
    {
        $request->validate([
            'eskul_id' => 'required|exists:eskuls,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $jadwal = Jadwal::create($request->all());

        return response()->json($jadwal, 201);
    }

    // GET detail jadwal
    public function show($id)
    {
        return Jadwal::with('eskul')->findOrFail($id);
    }

    // UPDATE jadwal
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'eskul_id' => 'required|exists:eskuls,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $jadwal->update($request->all());

        return response()->json($jadwal);
    }

    // DELETE jadwal
    public function destroy($id)
    {
        Jadwal::destroy($id);
        return response()->json(['message' => 'Jadwal berhasil dihapus']);
    }
}
