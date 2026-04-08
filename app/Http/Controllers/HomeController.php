<?php

namespace App\Http\Controllers;

use App\Models\DaftarEskul;
use App\Models\Eskul;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahEskul = Eskul::count();
        $jumlahSiswa = DaftarEskul::count();
        $jumlahDitolak = DaftarEskul::where('status', 'Ditolak')->count();
        $keterima = DaftarEskul::where('status', 'Diterima')->count();
        return view('home', compact('jumlahEskul', 'jumlahSiswa', 'jumlahDitolak', 'keterima'));
    }

}
