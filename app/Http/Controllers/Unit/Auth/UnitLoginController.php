<?php

namespace App\Http\Controllers\Unit\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use App\Models\UnitUser;

class UnitLoginController extends Controller
{
    public function showUnitLoginForm()
    {
        return view('unit.auth.login');
    }

    public function unitlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'exists:unit_users,email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('unit')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/unit/dashboard');
        }

        return redirect()->route('unit.dashboard')->with('success', 'Unit Login successful.');
    }

    public function showRegisterForm()
    {
        $units = Unit::all();
        return view('unit.auth.register', compact('units'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'email' => 'required|string|email|max:255|unique:unit_users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = UnitUser::create([
            'unit_id' => $request->unit_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // auth()->guard('unit')->login($user); // If you want auto-login

        return redirect()->route('unit.Unitlogin')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::guard('unit')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/unit/login');
    }
}