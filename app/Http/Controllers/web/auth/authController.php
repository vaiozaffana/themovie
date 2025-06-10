<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($request->email === 'adminmovies@example.com') {
            return back()->withErrors([
                'email' => 'Admin user cannot be registered.'
            ])->withInput();
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user'
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Register successful. Welcome!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'adminmovies@example.com') {
            if ($request->password !== 'adminmovies') {
                return back()->withErrors([
                    'email' => 'Invalid admin credentials.'
                ])->withInput();
            }

            $admin = User::where('email', 'adminmovies@example.com')->first();
            if (!$admin) {
                $admin = User::create([
                    'name'     => 'Admin Movies',
                    'email'    => 'adminmovies@example.com',
                    'password' => Hash::make('adminmovies'),
                    'role'     => 'admin'
                ]);
            }

            Auth::login($admin);
            return redirect()->route('admin.dashboard-data')->with('success', 'Welcome, Admin!');

            session(['admin_logged_in' => true]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
