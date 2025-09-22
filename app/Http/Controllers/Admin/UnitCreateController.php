<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitCreateController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::query();

    if ($request->has('name') && $request->name !== '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    $units = $query->paginate(10)->appends(['name' => $request->name]);

    return view('admin.unit.index', compact('units'));
      
    }

    public function create(){
        return view('admin.unit.create');
    }

    public function store(Request $request){
    $request->validate([
        'name' => ['required', 'string'],
        'address' => ['required', 'string'],
    ]);

    Unit::create([
        'name' => $request->name,
        'address' => $request->address,
    ]);

    return redirect()->route('admin.unit.index')
        ->with('success', 'Unit created successfully!');
}
}
