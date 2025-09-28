@extends('unit.layouts.app')

@section('content')


    <div class="card">
        <div class="card-header">
            <strong>Received Letter Confirmations</strong>

        </div>
        <div class="card-body">
            <!-- Search Form -->

            <form method="GET" action="#" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="barcode" class="form-control" placeholder="Search by QR Code"
                            value="{{ request('barcode') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="letter_no" class="form-control" placeholder="Search by Letter No"
                            value="{{ request('letter_no') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    <div class="col-md-1">
                        <a href="#" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>


            @if ($addresses->count() > 0)
                <div class="card-body table-responsive">


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>QR Code</th>
                                <th>Letter No</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $key => $address)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $address->barcode }}</td>
                                    <td>{{ $address->letter_no }}</td>
                                    <td>{{ $address->unit->name }}</td>
                                    <td>{{ $address->to_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($address->date)->format('F j, Y') }}</td>
                                    <td>
                                        @if ($address->status == 'received')
                                            <span class="badge bg-success">{{ ucfirst($address->status) }}</span>
                                        @elseif ($address->status == 'pending')
                                            <span class="badge bg-danger">{{ ucfirst($address->status) }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ ucfirst($address->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="bi bi-check"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{-- {{ $addresses->links('pagination::bootstrap-5') }} --}}
                </div>
            @else
                <p>No pending confirmations found.</p>
            @endif
        </div>
    </div>

@endsection
