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
                                <th><input type="checkbox" id="select-all"></th>
                                <th>SL</th>
                                <th>From Name</th>
                                <th>Letter No</th>
                                <th>To Name</th>
                                <th>To Address</th>
                                <th>Date</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($addresses as $key => $address)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $address->id }}"></td>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $address->unit->name }}</td>

                                    <td>{{ $address->letter_no }}</td>
                                    <td>{{ $address->to_name }}</td>
                                    <td>{{ $address->to_address }}</td>

                                    <td>{{ $address->date }}</td>
                                    <td>{{ $address->barcode }}</td>

                                    <td>
                                        @if ($address->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($address->status === 'received')
                                            <span class="badge bg-success">Received</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.qrcode.generate', $address->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i></a>
                                        {{-- @if ($address->status == 'rejected')
                                            <button type="button" class="btn btn-sm btn-outline-danger ms-1 view-remarks"
                                                data-address-id="{{ $address->id }}" title="View Rejection Reason">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                            </button>
                                        @endif --}}
                                        {{-- <a href="{{ route('unit.addresses.edit', $address->id) }}"
                                            class="btn btn-sm btn-secondary ms-1">
                                            <i class="bi bi-pencil-square"></i></a> --}}
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
