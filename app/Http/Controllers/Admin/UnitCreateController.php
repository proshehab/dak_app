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
}
