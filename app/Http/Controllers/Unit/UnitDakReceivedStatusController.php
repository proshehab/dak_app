<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DakAddress;
use Illuminate\Support\Facades\Auth;

class UnitDakReceivedStatusController extends Controller
{
   public function receivedConfirmation(Request $request)
{
    $query = DakAddress::query();

    // Always filter by authenticated user's unit_user_id and pending status
    $query->where('unit_user_id', auth()->id())
          ->where('status', 'pending')
          ->orderBy('date', 'desc');

    // Filter by barcode if provided
    if ($request->filled('barcode')) {
        $query->where('barcode', 'like', '%' . $request->barcode . '%');
    }

    // Filter by letter number if provided
    if ($request->filled('letter_no')) {
        $query->where('letter_no', 'like', '%' . $request->letter_no . '%');
    }

    // Filter by date if provided
    if ($request->filled('date')) {
        $query->whereDate('date', $request->date);
    }

    // Return the view with filtered results
    return view('unit.receivedStatus.index', ['addresses' => $query->get()]);
}

}
