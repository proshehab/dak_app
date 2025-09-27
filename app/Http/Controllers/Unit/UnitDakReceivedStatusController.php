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
        $query = DakAddress::where('unit_user_id', Auth::id())
            ->whereIn('status', ['pending', 'rejected']);

        if ($request->has('barcode') && $request->barcode) {
            $query->where('barcode', 'like', '%' . $request->barcode . '%');
        }
    
        if ($request->has('date') && $request->date) {
            $query->whereDate('date', $request->date);
        }
    
        //$addresses = $query->with('scans')->paginate(10);
        return view('unit.receivedStatus.index', ['addresses' => $query->get()] )   ;
    }
}
