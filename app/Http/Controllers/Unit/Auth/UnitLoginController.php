<?php

namespace App\Http\Controllers\Unit\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitLoginController extends Controller
{
    public function showUnitLoginForm(){
        return view('unit.auth.login');
    }

    public function showRegisterForm(){
         $units = Unit::all();
        return view('unit.auth.register', compact('units'));
    }

    public function register(Request $request){
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user (you may need to adjust this based on your User model)
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        // auth()->login($user);

        // Redirect to a desired location after registration
        return redirect()->route('unit.dashboard'); // Adjust the route as needed
    }


}
