<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Eskul;

class EskulController extends Controller
{
    public function index()
    {
        $eskul = Eskul::all();
        return view('eskul.index', compact('eskul'));
    }

    public function show($id)
    {
        $eskul = Eskul::with(['pembina', 'jadwals'])->findOrFail($id);
        return view('eskul.detail', compact('eskul'));
    }
}