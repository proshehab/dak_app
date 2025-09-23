@extends('unit.layouts.app')

@section('content')
    <div class="card">
        {{-- 
        <div class="row g-4">
            <!-- Total Customers -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-people-fill display-3 text-primary" style="opacity: 0.8;"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Unit DR</h6>
                            <h3 class="mb-2 fw-bold">{{ $totalDR ?? '0' }}</h3>
                            <a href="{{ route('unit.unitperson') }}" class="btn btn-sm btn-outline-primary">More info <i
                                    class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Shipments -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-box-seam display-3 text-success" style="opacity: 0.8;"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Received</h6>
                            <h3 class="mb-2 fw-bold">{{ $totalShipments ?? '0' }}</h3>
                            <a href="{{ route('unit.addresses.recevied-confirmation') }}"
                                class="btn btn-sm btn-outline-success">More info <i
                                    class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Shipments -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-clock-history display-3 text-warning" style="opacity: 0.8;"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h3 class="mb-2 fw-bold">{{ $pending ?? '0' }}</h3>
                            <a href="{{ route('unit.addresses.index') }}" class="btn btn-sm btn-outline-warning">More info
                                <i class="bi bi-arrow-right-circle ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-md-4">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $totalDR ?? '0' }}</h3>
                        <p>Total Unit DR</p>
                    </div>
                    <i class="bi bi-people-fill small-box-icon"></i>
                    <a href="{{ route('unit.unitperson') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $totalShipments ?? '0' }}</h3>
                        <p> Total Received</p>
                    </div>
                    <i class="bi bi-cart-fill small-box-icon"></i>
                    <a href="{{ route('unit.addresses.recevied-confirmation') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $pending ?? '0' }}</h3>
                        <p>Total Pending</p>
                    </div>
                    <i class="bi bi-eye-fill small-box-icon"></i>
                    <a href="{{ route('unit.addresses.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Dispatch Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="text-center fw-bold mb-0">

                    Dispatch Unit Letters
                </h5>

            </div>
            <div class="card-body">
                <!-- 🔍 Search Form -->
                <div class="d-flex justify-content-center">
                    <form method="GET" action="{{ route('unit.dashboard') }}" class="row g-3 mb-4 w-100"
                        style="max-width: 900px;">
                        <div class="col-md-4">
                            <input type="text" name="barcode" class="form-control" placeholder="Search by QR Code"
                                value="{{ request('barcode') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <button type="submit" class="btn btn-primary me-2"><i
                                    class="bi bi-search me-1"></i>Search</button>
                            <a href="{{ route('unit.dashboard') }}" class="btn btn-secondary"><i
                                    class="bi bi-arrow-clockwise me-1"></i>Reset</a>
                        </div>
                    </form>
                </div>
                <!-- End Search Form -->

                <!-- Table Form -->
                <form method="POST" action="{{ route('admin.barcode.bulkPrint') }}" target="_blank">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-primary">
                                <tr>

                                    <th>SL</th>
                                    <th>Letter No</th>
                                    <th>Form</th>
                                    <th>Date</th>
                                    <th>QR Code</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dispatches as $key => $dispatche)
                                    <tr>

                                        <td>{{ ++$key }}</td>
                                        <td>{{ $dispatche->letter_no }}</td>
                                        <td>{{ $dispatche->from_name ?? 'N/A' }} ({{ $dispatche->from_address }})</td>
                                        <td>{{ \Carbon\Carbon::parse($dispatche->date)->format('F j, Y') }}</td>
                                        <td>{{ $dispatche->barcode }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match ($dispatche->status) {
                                                    'received' => 'success',
                                                    'pending' => 'danger',
                                                    'rejected' => 'warning',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span
                                                class="badge bg-{{ $badgeClass }}">{{ ucfirst($dispatche->status) }}</span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No dispatch letters found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Pagination -->

                {{ $dispatches->appends(request()->query())->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
@endsection
