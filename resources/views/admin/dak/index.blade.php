@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"> <strong>Unit Letter Details</strong>
            <a href="{{ route('admin.dakCreate.create') }}" class="btn btn-primary float-end">Add New Letter</a>
        </div>

        <div class="card-body">
            <!-- 🔍 Search Form -->
            <div class="d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.dakCreate.index') }}" class="row g-3 mb-4 w-100"
                    style="max-width: 900px;">
                    <div class="col-md-4">
                        <input type="text" name="barcode" class="form-control" placeholder="Search by QR Code"
                            value="{{ request('barcode') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-4 d-flex">
                        <button type="submit" class="btn btn-primary me-2">Search</button>
                        <a href="{{ route('admin.dakCreate.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
            <!-- 🔍 End Search Form -->

            <form method="POST" action="#">
                @csrf

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>SL</th>
                                <th>Date</th>
                                <th>QR Code</th>
                                <th>To</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($addresses as $key => $address)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $address->barcode }}</td>
                                    <td>{{ $address->to_name }}</td>
                                    <td>
                                        @if ($address->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($address->status === 'received')
                                            <span class="badge bg-success">Received</span>
                                        @endif
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No letters found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>



            </form>


        </div>
    </div>
@endsection
