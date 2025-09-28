<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DakAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\UnitUser;
use App\Models\Unit;

class DakCreateController extends Controller
{

     public function index(Request $request)
    {
        $addresses = DakAddress::orderBy('created_at', 'desc')->get();

        return view('admin.dak.index', compact('addresses'));
    }

    public function create()
    {
        $unit_user = UnitUser::all();
        $units = Unit::all();
        return view('admin.dak.create', compact('unit_user', 'units'));
    }


    public function store(Request $request)
    {
        $request->validate([
            //'from_name' => ['required', 'string'],
            'from_address' => ['required', 'string'],
            'security_type' => ['required', 'string'],
            'letter_no' => ['required', 'string'],
            'to_name' => ['required', 'string'],
            'to_address' => ['required', 'string'],
            'date' => ['required', 'date'],
        ]);

        DakAddress::create([
            'unit_user_id' => $request->unit_user_id,
            'unit_id' => $request->unit_id,
            //'unit_person_id' => null,
            //'from_name' => $request->from_name,
            'from_address' => $request->from_address,
            'security_type' => $request->security_type,
            'letter_no' => $request->letter_no,
            'to_name' => $request->to_name,
            'to_address' => $request->to_address,
            'date' => $request->date,
            'status' => 'pending',
            'barcode' => Str::random(12),
        ]);

        return redirect()->route('admin.dakCreate.index')->with('success', 'Address created successfully');
    }
    
}
