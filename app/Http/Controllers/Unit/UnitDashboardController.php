<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitDashboardController extends Controller
{
    public function index()
    {
        return view('unit.dashboard.index');
    }
}
