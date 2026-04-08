<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showAdminLoginForm()
    {
        return view('layouts.admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ⛔ Batasi hanya email admin tertentu
        if ($request->email !== 'admin@example.com') {
            return back()->with('error', 'Hanya akun admin yang bisa login di sini.');
        }

        // Coba login
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }

        // Gagal login
        return back()->with('error', 'Email atau password salah.');
    }
}
