<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitDakReceivedStatusController extends Controller
{
    public function receivedConfirmation()
    {
        return view('unit.receivedStatus.index');
    }
}
