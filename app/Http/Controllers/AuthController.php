<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Support both username and email login
        $user = User::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['username' => 'Username atau password salah.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/admin')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'admin';

        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/admin')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    public function demoLogin(Request $request, ?string $role = 'admin')
    {
        $roleName = ($role === 'superadmin') ? 'superadmin' : 'admin';
        $user = User::where('role', $roleName)->first() ?? User::first();

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/admin')->with('success', 'Mode Demo Aktif: Masuk sebagai ' . $user->name . ' (' . ucfirst($user->role) . '). Silakan jelajahi fitur!');
        }

        return redirect()->route('login')->with('error', 'Akun demo tidak ditemukan.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}

