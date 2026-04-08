<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Blok admin login lewat form siswa (opsional)
        if ($request->email === 'admin@example.com') {
            return redirect()->route('login')
                ->with('error', '❌ Anda tidak diperbolehkan login di halaman siswa.');
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->redirectBasedOnUser(Auth::user());
        }

        return redirect()->route('login')
            ->with('error', '❌ Email atau password salah!')
            ->withInput($request->only('email'));
    }

    /**
     * REDIRECT BERDASARKAN ROLE (FIX UTAMA)
     */
    protected function redirectBasedOnUser($user)
    {
        // ADMIN
        if ($user->role === 'admin' || $user->is_admin) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, Admin!');
        }

        // PEMBINA
        if ($user->role === 'pembina') {
            return redirect('/pembina/pendaftar')
                ->with('success', 'Selamat datang, Pembina!');
        }

        // SISWA
        return redirect('/')
            ->with('success', 'Selamat datang, Siswa!');
    }

    protected function authenticated(Request $request, $user)
    {
        return $this->redirectBasedOnUser($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
