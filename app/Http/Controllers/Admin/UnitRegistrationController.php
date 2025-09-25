<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitUser;
use Illuminate\Support\Facades\Hash;

class UnitRegistrationController extends Controller
{
    public function index()
    {
        $units = UnitUser::paginate(10);
        return view('admin.unitReg.index', compact('units'));
    }

    public function create()
    {
        return view('admin.unitReg.create');
    }

      public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:unit_users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:unit_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           
        ]);

        UnitUser::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            
        ]);

        return redirect()->route('admin.unitRegistration.index')->with('success', 'UnitRegistration Created Successfully');
    }
}
