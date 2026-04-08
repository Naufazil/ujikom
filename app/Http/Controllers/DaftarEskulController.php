<?php

namespace App\Http\Controllers;

use App\Models\DaftarEskul;
use App\Models\Eskul;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarEskulController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */
    public function index(Request $request)
    {
        $query = DaftarEskul::query();

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('eskul', function ($q) use ($request) {
                $q->where('nama_eskul', 'like', '%' . $request->search . '%')
                    ->orWhere('kelas', 'like', '%' . $request->search . '%')
                    ->orWhere('tahun_ajaran', 'like', '%' . $request->search . '%');
            });
        }

        $daftar = DaftarEskul::all();
        $eskul = Eskul::all();
        $user = User::all();
        $daftar = $query->get();

        return view('daftar eskul.index', compact('daftar', 'eskul', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $daftar = DaftarEskul::all();
        $eskul = Eskul::all();
        $user = User::all();
        $eskulId = $request->eskul_id;
        return view('daftar eskul.create', compact('eskul', 'user','daftar', 'eskulId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DaftarEskul::create([
            'user_id' => Auth::id(),
            'eskul_id' => $request->eskul_id,
            'kelas' => $request->kelas,
            'tahun_ajaran' => $request->tahun_ajaran,
            'no_telp' => $request->no_telp,
            'alasan' => $request->alasan,
            'status' => 'menunggu',
        ]);

        return redirect('/')->with('status', 
            'Pendaftaran kamu sedang diproses. Silakan tunggu konfirmasi! 
            Jika ada pertanyaan lebih lanjut, 
            <a href="https://wa.me/6281234567890" target="_blank" style="color:#004d40; font-weight:bold;">
                <i class="fab fa-whatsapp"></i> Hubungi admin via WhatsApp
            </a>.'
        );

    }


    /**
     * Display the specified resource.
     */
    public function show(DaftarEskul $daftar)
    {
        $daftar = DaftarEskul::all();
        $eskul = Eskul::all();
        $user = User::all();
        return view('daftar eskul.create', compact('daftar', 'eskul', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarEskul $daftar)
    {
        return view('daftar eskul.edit', compact('daftar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarEskul $daftar)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'kelas' => 'required|string|max:50',
            'eskul_id' => 'required|exists:eskuls,id',
            'no_telp' => 'nullable|string|max:15',
            'alasan' => 'nullable|string|max:255',
        ]);

        $daftar->update($request->all());
        return redirect()->route('daftar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarEskul $daftar)
    {
        $daftar->delete();
        return redirect()->route('daftar.index')->with('delete', 'Data pendaftaran eskul berhasil dihapus.');
    }

//     public function setuju($id)
//     {
//         $data = DaftarEskul::findOrFail($id);
//         $data->status = 'Diterima';
//         $data->save();

//         return redirect('/')->with('success', '🎉 Selamat! Kamu diterima di ekstrakurikuler pilihanmu.');
//     }


//    public function tolak($id)
//     {
//         $data = DaftarEskul::findOrFail($id);
//         $data->status = 'Ditolak';
//         $data->save();

//         return redirect('/')->with('warning', '⚠️ Maaf, kamu belum diterima. Coba lagi dengan eskul lainnya ya.');
//     }

}
