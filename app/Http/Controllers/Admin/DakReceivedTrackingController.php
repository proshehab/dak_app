<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DakAddress;
use App\Models\UnitPeople;
use Illuminate\Support\Facades\Log;

class DakReceivedTrackingController extends Controller
{
    public function index(Request $request)
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
        try {
            $request->validate([
                'barcode' => ['required', 'string', 'exists:dak_addresses,barcode'],
                'location' => ['required', 'string'],
            ]);

            $barcode = $request->input('barcode');
            $address = DakAddress::where('barcode', $barcode)->first();

            if (!$address) {
                return response('QR Code not found.', 422);
            }

            // $unit_person = UnitPeople::where('user_id', $address->user_id)->first();
            // if (!$unit_person) {
            //     return response('No Unit People record found for this user.', 422);
            // }

            $scannedBarcodes = $request->session()->get('scanned_barcodes', []);
            if (!in_array($barcode, $scannedBarcodes)) {
                $scannedBarcodes[] = $barcode;
                $request->session()->put('scanned_barcodes', $scannedBarcodes);
            }

            $shipments = DakAddress::with('unitUser')
                ->where(function ($query) use ($scannedBarcodes) {
                    $query->where('status', 'pending')
                        ->orWhereIn('barcode', $scannedBarcodes);
                })
                ->orderByRaw("FIELD(barcode, '" . implode("','", $scannedBarcodes) . "') DESC")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $tableBody = view('admin.dakTracking.partials.shipments_table_body', compact('shipments'))->render();

            return response()->json([
                'success' => true,
                'message' => 'QR Code scanned successfully.',
                'table_body' => $tableBody
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response($e->validator->errors()->first(), 422);
        } catch (\Exception $e) {
            Log::error('Scan error: ' . $e->getMessage(), ['barcode' => $request->input('barcode')]);
            return response('An error occurred while scanning the QR Code.', 500);
        }
    }




    public function cancel(Request $request, $barcode)
    {
        try {
            $scannedBarcodes = $request->session()->get('scanned_barcodes', []);
            Log::info('Before cancel - Scanned barcodes: ', $scannedBarcodes);

            if (($key = array_search($barcode, $scannedBarcodes)) !== false) {
                unset($scannedBarcodes[$key]);
                $scannedBarcodes = array_values($scannedBarcodes);
                $request->session()->put('scanned_barcodes', $scannedBarcodes);
                Log::info('After cancel - Scanned barcodes: ', $scannedBarcodes);
            } else {
                Log::warning('Barcode not found in scanned list: ' . $barcode);
                return response()->json([
                    'success' => false,
                    'errors' => ['barcode' => 'QR Code not found in scanned list.']
                ], 422);
            }

            $shipments = DakAddress::with('user')
                ->where(function ($query) use ($scannedBarcodes) {
                    $query->where('status', 'pending')
                        ->orWhereIn('barcode', $scannedBarcodes);
                })
                ->orderByRaw("FIELD(barcode, '" . implode("','", $scannedBarcodes) . "') DESC")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $tableBody = view('admin.tracking.partials.shipments_table_body', compact('shipments'))->render();

            return response()->json([
                'success' => true,
                'message' => 'QR Code canceled successfully.',
                'table_body' => $tableBody
            ]);
        } catch (\Exception $e) {
            Log::error('Cancel error: ' . $e->getMessage(), ['barcode' => $barcode]);
            return response()->json([
                'success' => false,
                'errors' => ['barcode' => 'An error occurred while canceling the QR Code.']
            ], 500);
        }
    }
}