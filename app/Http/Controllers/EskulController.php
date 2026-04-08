<?php

namespace App\Http\Controllers;

use App\Models\Eskul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    public function index(Request $request)
    {
        $eskul = Eskul::with('pembina')
            ->when($request->search, function ($q) use ($request) {
                $q->where('nama_eskul', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('eskul.index', compact('eskul'));
    }

    public function create()
    {
        $pembinas = User::where('role', 'pembina')->get();
        return view('eskul.create', compact('pembinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'pembina_id' => 'required|exists:users,id',
            'no_hp'      => 'nullable|string|max:15',
            'alamat'     => 'nullable|string|max:255',
            'foto'       => 'nullable|image|max:2048',
            'deskripsi'  => 'nullable|string',
        ]);

        $fotoPath = $request->hasFile('foto')
            ? $request->file('foto')->store('foto_eskul', 'public')
            : null;

        Eskul::create([
            'nama_eskul' => $request->nama_eskul,
            'pembina_id' => $request->pembina_id,
            'no_hp'      => $request->no_hp,
            'alamat'     => $request->alamat,
            'deskripsi'  => $request->deskripsi,
            'foto'       => $fotoPath,
        ]);

        return redirect()->route('eskul.index')->with('success', 'Data eskul berhasil ditambahkan.');
    }

    public function show($id)
    {
        $eskul = Eskul::with(['pembina', 'jadwals'])->findOrFail($id);
        return view('eskul.detail', compact('eskul'));
    }

    public function edit(Eskul $eskul)
    {
        $pembinas = User::where('role', 'pembina')->get();
        return view('eskul.edit', compact('eskul', 'pembinas'));
    }

    public function update(Request $request, Eskul $eskul)
    {
        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'pembina_id' => 'required|exists:users,id',
            'no_hp'      => 'nullable|string|max:15',
            'alamat'     => 'nullable|string|max:255',
            'foto'       => 'nullable|image|max:2048',
            'deskripsi'  => 'nullable|string',
        ]);

        $fotoPath = $eskul->foto;

        if ($request->hasFile('foto')) {
            if ($eskul->foto) {
                Storage::disk('public')->delete($eskul->foto);
            }
            $fotoPath = $request->file('foto')->store('foto_eskul', 'public');
        }

        $eskul->update([
            'nama_eskul' => $request->nama_eskul,
            'pembina_id' => $request->pembina_id,
            'no_hp'      => $request->no_hp,
            'alamat'     => $request->alamat,
            'deskripsi'  => $request->deskripsi,
            'foto'       => $fotoPath,
        ]);

        return redirect()->route('eskul.index')->with('update', 'Data eskul berhasil diperbarui.');
    }

    public function destroy(Eskul $eskul)
    {
        if ($eskul->foto) {
            Storage::disk('public')->delete($eskul->foto);
        }

        $eskul->delete();
        return redirect()->route('eskul.index')->with('delete', 'Data eskul berhasil dihapus.');
    }
}