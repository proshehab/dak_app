<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DakReceivedTrackingController extends Controller
{
    public function index()
    {
        return view('admin.dakTracking.index');
    }
}
