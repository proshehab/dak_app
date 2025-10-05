@extends('admin.layouts.app')

@section('content')
    <style>
        .table th:first-child,
        .table td:first-child {
            width: 50px;
            text-align: center;
        }

        .table input[type="checkbox"] {
            margin: 0;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }

        .table img {
            border-radius: 5px;
        }

        #scanMessage {
            margin-bottom: 15px;
        }

        .new-row {
            background-color: #e6ffed;
            transition: background-color 2s;
        }

        .new-row.fade-out {
            background-color: transparent;
        }
    </style>

    <div class="card">
        <div class="card-header">
            Letter Tracking
            <a href="#" class="btn btn-primary float-end">View Daily Scan
                Report</a>
        </div>
        <div class="card-body">
            {{-- @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <!-- Scan Message Placeholder -->
            <div id="scanMessage"></div>

            <!-- Scan Form -->
            <form method="POST" action="#" class="mb-4" id="scanForm">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <input type="text" name="barcode" id="barcodeInput"
                            class="form-control @error('barcode') is-invalid @enderror" placeholder="Scan QR Code"
                            autofocus>
                        @error('barcode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="location" class="form-control" value="SSC JSR" readonly>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Scan</button>
                    </div>
                </div>
            </form>

            <!-- Bulk Action Buttons -->
            <form id="bulkActionForm" method="POST">
                @csrf
                <div class="mb-3">
                    <button type="submit" formaction="#" class="btn btn-success" id="confirmSelected" disabled>Confirm
                        Selected</button>
                    <button type="submit" formaction="#" class="btn btn-danger" id="rejectSelected" disabled>Reject
                        Selected</button>
                    <button type="submit" formaction="#" class="btn btn-info" id="viewUnitPerson" disabled
                        onclick="showSelectedUnitPersonInfo()">View Unit Person</button>
                </div>

                <!-- Shipment Table -->
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-striped" id="shipmentsTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>SL</th>
                                <th>Unit</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="shipmentsTableBody">
                            {{-- @include('admin.tracking.partials.shipments_table_body') --}}
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="mt-3">
                {{-- {{ $shipments->links('pagination::bootstrap-5') }} --}}
            </div>
        </div>
    </div>


    <!-- Modal for Unit Person Selection -->
    <div class="modal fade" id="drinfoModal" tabindex="-1" aria-labelledby="drinfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="#" id="unitPersonForm">
                @csrf
                <input type="hidden" name="shipment_ids" id="modalShipmentIds">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="drinfoModalLabel">Unit Person Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="unitPersonInfo">
                        <p>Loading...</p> <!-- AJAX content will be injected here -->
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Selected</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Remarks Modal -->
    <div class="modal fade" id="rejectRemarksModal" tabindex="-1" aria-labelledby="rejectRemarksModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="rejectRemarksForm" method="POST" action="#">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectRemarksModalLabel">Reject Shipments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Reason for rejection</label>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="Unit person does not match." readonly>
                        </div>
                        <input type="hidden" name="shipments" id="rejectShipmentIds">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Submit Rejection</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
