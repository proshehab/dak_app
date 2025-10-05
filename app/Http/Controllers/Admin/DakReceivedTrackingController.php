<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DakAddress;

class DakReceivedTrackingController extends Controller
{
    public function index( Request $request)
    {
        $scannedBarcodes = $request->session()->get('scanned_barcodes', []);
        $shipments = DakAddress::with('unitUser')
            ->where(function ($query) use ($scannedBarcodes) {
                $query->where('status', 'pending')
                      ->orWhereIn('barcode', $scannedBarcodes);
            })
            ->orderByRaw("FIELD(barcode, '" . implode("','", $scannedBarcodes) . "') DESC")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.dakTracking.index', compact('shipments'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string|exists:dak_addresses,barcode',
        ]);

        $barcode = $request->input('barcode');
        $scannedBarcodes = $request->session()->get('scanned_barcodes', []);

        if (!in_array($barcode, $scannedBarcodes)) {
            $scannedBarcodes[] = $barcode;
            $request->session()->put('scanned_barcodes', $scannedBarcodes);
        }

        return response()->json(['message' => 'Barcode scanned successfully.', 'scanned_barcodes' => $scannedBarcodes]);
    }
}
