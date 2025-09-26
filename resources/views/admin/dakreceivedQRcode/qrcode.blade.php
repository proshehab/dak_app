@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"> <strong>Unit letter details with QR code</strong></div>
        <div class="card-body">
            {{-- Top Restricted Heading (Centered) --}}
            <p class="text-center restricted bottom-restricted">{{ strtoupper($dakAddress->security_type) }}</p>


            {{-- Date Top Left --}}
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($dakAddress->date)->format('F j, Y') }}</p>

            {{-- Row: From | To | Barcode --}}
            <div class="row mt-4">
                <div class="col-md-4">
                    <h5>From:</h5>
                    <p><strong>Name:</strong> {{ $dakAddress->from_name }}</p>
                    <p><strong>Address:</strong> {{ $dakAddress->from_address }}</p>
                </div>
                <div class="col-md-4">
                    <h5>To:</h5>
                    <p><strong>Name:</strong> {{ $dakAddress->to_name }}</p>
                    <p><strong>Address:</strong> {{ $dakAddress->to_address }}</p>
                </div>
                <div class="col-md-4 text-left">
                    <div>
                        <p><strong>Letter No:</strong> {{ $dakAddress->letter_no }}</p>

                        {{-- QR Code --}}
                        {!! QrCode::size(100)->generate($dakAddress->barcode) !!}

                        <p class="mt-2"><strong>QR Code:</strong> {{ $dakAddress->barcode }}</p>
                    </div>
                </div>
                {{-- Bottom Restricted Heading (Centered) --}}
                <p class="text-center restricted bottom-restricted">{{ strtoupper($dakAddress->security_type) }}</p>
            </div>
        </div>
    </div>
@endsection
