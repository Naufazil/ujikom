<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    public function index()
    {
        $eskul = Eskul::with('pembina')->get();

        return response()->json([
            'success' => true,
            'data' => $eskul
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required',
            'pembina_id' => 'required|exists:users,id',
            'foto' => 'nullable|image'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_eskul', 'public');
        }

        $eskul = Eskul::create([
            'nama_eskul' => $request->nama_eskul,
            'pembina_id' => $request->pembina_id,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $foto
        ]);

        return response()->json([
            'success' => true,
            'data' => $eskul
        ]);
    }

    public function show($id)
    {
        $eskul = Eskul::with('pembina')->findOrFail($id);
        return response()->json($eskul);
    }

    public function update(Request $request, $id)
    {
        $eskul = Eskul::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($eskul->foto) {
                Storage::disk('public')->delete($eskul->foto);
            }
            $foto = $request->file('foto')->store('foto_eskul', 'public');
        } else {
            $foto = $eskul->foto;
        }

        $eskul->update([
            'nama_eskul' => $request->nama_eskul,
            'pembina_id' => $request->pembina_id,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $foto
        ]);

        return response()->json([
            'success' => true,
            'data' => $eskul
        ]);
    }

    public function destroy($id)
    {
        $eskul = Eskul::findOrFail($id);

        if ($eskul->foto) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $eskul->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
