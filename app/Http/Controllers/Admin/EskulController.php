<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    public function index()
    {
        $eskul = Eskul::with('pembina')->get();
        return view('admin.eskul.index', compact('eskul'));
    }

    public function create()
    {
        $pembinas = User::where('role', 'pembina')->get();
        return view('admin.eskul.create', compact('pembinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required',
            'pembina_id' => 'required',
        ]);

        Eskul::create($request->all());

        return redirect()->route('admin.eskul.index');
    }

    public function edit(Eskul $eskul)
    {
        $pembinas = User::where('role', 'pembina')->get();
        return view('admin.eskul.edit', compact('eskul', 'pembinas'));
    }

    public function update(Request $request, Eskul $eskul)
    {
        $eskul->update($request->all());
        return redirect()->route('admin.eskul.index');
    }

    public function destroy(Eskul $eskul)
    {
        $eskul->delete();
        return redirect()->route('admin.eskul.index');
    }
}