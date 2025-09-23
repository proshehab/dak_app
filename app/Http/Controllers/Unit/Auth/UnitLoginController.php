<?php

namespace App\Http\Controllers\Unit\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class UnitLoginController extends Controller
{
    public function showUnitLoginForm(){
        return view('unit.auth.login');
    }

     public function unitlogin(Request $request)
    {
    $credentials = $request->validate([
        'email' => ['required', 'exists:unit_users,email'],
        'password' => ['required'],
    ]);

    if (Auth::guard('unit')->attempt($credentials + ['role' => 'unit'])) {
        $request->session()->regenerate();
        // ✅ Correct place to flash success message
        return redirect()->route('unit.dashboard')->with('success', 'Unit Login successful.');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }

    public function showRegisterForm(){
         $units = Unit::all();
        return view('unit.auth.register', compact('units'));
    }

    public function register(Request $request)
{
    $request->validate([
        'unit_id' => 'required|exists:units,id',
        'email' => 'required|string|email|max:255|unique:unit_users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\UnitUser::create([
        'unit_id' => $request->unit_id,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // auth()->guard('unit')->login($user); // If you want auto-login

    return redirect()->route('unit.Unitlogin')->with('success', 'Registration successful!');
}



}
