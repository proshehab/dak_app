<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DakAddress;

class DakReceivedQRcodeController extends Controller
{
    public function generate($id)
    {
        $dakAddress = DakAddress::findOrFail($id);
        return view('admin.dakreceivedQRcode.qrcode', compact('dakAddress'));
    }

}
