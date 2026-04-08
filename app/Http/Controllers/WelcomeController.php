<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eskul;

class WelcomeController extends Controller
{
    public function index()
    {
        $eskul = Eskul::all();
        return view('welcome', compact('eskul'));
    }
}
