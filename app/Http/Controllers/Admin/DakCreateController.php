<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DakCreateController extends Controller
{
    public function index()
    {
        return view('admin.dak.create');
    }
    
}
