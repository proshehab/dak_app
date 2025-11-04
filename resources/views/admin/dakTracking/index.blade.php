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
        <form method="POST" action="{{ route('admin.tracking.scan') }}" class="mb-4" id="scanForm">
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
                <button type="submit" formaction="{{ route('admin.tracking.bulk-confirm') }}" class="btn btn-success"
                    id="confirmSelected" disabled>Confirm
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
                        @include('admin.dakTracking.partials.unit_person_table', [
                        'shipments' => $shipments,
                        ])
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle Bulk Action Form Submission
        document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const action = e.submitter.id;
            const form = e.target;

            if (action === 'rejectSelected') {
                const checked = Array.from(document.querySelectorAll('.shipment-checkbox:checked')).map(cb => cb
                    .value);
                if (checked.length === 0) {
                    alert("Please select at least one shipment to reject.");
                    return;
                }
                // Set shipment IDs in the hidden input
                // document.getElementById('rejectShipmentIds').value = checked.join(',');
                // // Ensure remarks input has the default value (optional, since input is readonly)
                // document.getElementById('remarks').value = 'Unit person does not match.';
                // // Show the modal
                // new bootstrap.Modal(document.getElementById('rejectRemarksModal')).show();
                // return;
            }

            if (action === 'confirmSelected') {
                if (!confirm("Are you sure you want to confirm the selected shipments?")) return;

                const formData = new FormData(form);
                const url = e.submitter.formAction;

                fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        window.location.reload();
                    })
                    .catch(error => {
                        alert('An error occurred: ' + error.message);
                    });
            }
        });

        // Handle Reject Remarks Form Submission
        document.getElementById('rejectRemarksForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            // Convert comma-separated shipment IDs to an array for the 'shipments' field
            const shipmentIds = document.getElementById('rejectShipmentIds').value.split(',');
            shipmentIds.forEach(id => formData.append('shipments[]', id));

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        bootstrap.Modal.getInstance(document.getElementById('rejectRemarksModal')).hide();
                        window.location.reload();
                    } else {
                        alert("Error: " + (data.message || 'Rejection failed.'));
                    }
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                });
        });

        // Show UnitPerson details for a specific shipment
        function showUnitPersonInfo(shipmentId) {
            const myModal = new bootstrap.Modal(document.getElementById('drinfoModal'));
            myModal.show();

            const url = `/admin/tracking/unit-person/${shipmentId}`;
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    const modalBody = document.getElementById('unitPersonInfo');
                    modalBody.innerHTML = data.success ? data.html :
                        '<p class="text-danger">Error loading details.</p>';
                })
                .catch(error => {
                    console.error('Error fetching unit person info:', error);
                    document.getElementById('unitPersonInfo').innerHTML =
                        `<p class="text-danger">Error: ${error.message}</p>`;
                });
        }

        // Select All Checkbox Logic
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.shipment-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            toggleBulkButtons();
        });

        // Handle Scan Form Submission
        document.getElementById('scanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const messageDiv = document.getElementById('scanMessage');

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log('Scan Response Status:', response.status);
                    console.log('Scan Response Headers:', response.headers.get('Content-Type'));
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById('shipmentsTableBody').innerHTML = data.table_body;
                        messageDiv.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                        const newRows = document.querySelectorAll('#shipmentsTableBody tr');
                        if (newRows.length > 0) {
                            newRows[0].classList.add('new-row');
                            setTimeout(() => newRows[0].classList.add('fade-out'), 1000);
                        }
                        form.reset();
                        document.getElementById('barcodeInput').focus();
                        attachCheckboxListeners();
                        attachActionListeners();
                    } else {
                        throw new Error(data.errors?.barcode || data.errors?.general || 'Scan failed.');
                    }
                })
                .catch(error => {
                    console.error('Error scanning barcode:', error);
                    messageDiv.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${error.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                    document.getElementById('barcodeInput').focus();
                });
        });

        // Handle Individual Confirm/Reject/Cancel
        function attachActionListeners() {
            document.querySelectorAll(
                    'form[action*="/admin/tracking/confirm"], form[action*="/admin/tracking/reject"], form.cancel-form')
                .forEach(form => {
                    form.removeEventListener('submit', handleActionSubmit);
                    form.addEventListener('submit', handleActionSubmit);
                });
        }

        function handleActionSubmit(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const url = form.action;
            const isCancel = form.classList.contains('cancel-form');
            const messageDiv = document.getElementById('scanMessage');

            console.log(`Submitting ${isCancel ? 'Cancel' : 'Action'} to:`, url);

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log(`${isCancel ? 'Cancel' : 'Action'} Response Status:`, response.status);
                    console.log(`${isCancel ? 'Cancel' : 'Action'} Response Headers:`, response.headers.get(
                        'Content-Type'));
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response Data:', data);
                    if (data.success) {
                        if (isCancel) {
                            document.getElementById('shipmentsTableBody').innerHTML = data.table_body;
                            messageDiv.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${data.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                            attachCheckboxListeners();
                            attachActionListeners();
                        } else {
                            alert(data.message);
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                window.location.reload();
                            }
                        }
                    } else {
                        messageDiv.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error: ${data.errors?.barcode || data.errors?.general || 'Operation failed.'}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    }
                })
                .catch(error => {
                    console.error(`Error during ${isCancel ? 'cancel' : 'action'}:`, error);
                    messageDiv.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${error.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                });
        }

        // Show Unit Person Info for Selected Shipment
        function showSelectedUnitPersonInfo() {
            const checked = Array.from(document.querySelectorAll('.shipment-checkbox:checked')).map(cb => cb.value);

            if (checked.length === 0) {
                alert("Please select at least one shipment.");
                return;
            }

            // Show the modal
            const myModal = new bootstrap.Modal(document.getElementById('drinfoModal'));
            myModal.show();

            // Set shipment IDs in hidden input
            document.getElementById('modalShipmentIds').value = JSON.stringify(checked);

            // Fetch unit persons and inject into modal
            const url = `/admin/tracking/unit-person/${checked.join(',')}`;
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const modalBody = document.getElementById('unitPersonInfo');
                    modalBody.innerHTML = data.success ? data.html :
                        '<p class="text-danger">Error loading details.</p>';
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('unitPersonInfo').innerHTML =
                        `<p class="text-danger">Error: ${error.message}</p>`;
                });
        }


        document.getElementById('unitPersonForm').addEventListener('submit', function(e) {
            const selectedPersons = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            const shipmentIds = document.getElementById('modalShipmentIds').value;
            const errorDiv = document.getElementById('unitPersonError');

            if (!shipmentIds || JSON.parse(shipmentIds).length === 0) {
                e.preventDefault();
                errorDiv.textContent = "Shipment data is missing. Please go back and try again.";
                errorDiv.style.display = 'block';
                return;
            }

            if (selectedPersons.length === 0) {
                e.preventDefault();
                errorDiv.textContent = "Please select at least one unit person.";
                errorDiv.style.display = 'block';
            } else {
                errorDiv.textContent = "";
                errorDiv.style.display = 'none';
            }
        });


        // Function to attach checkbox event listeners
        function attachCheckboxListeners() {
            document.querySelectorAll('.shipment-checkbox').forEach(checkbox => {
                checkbox.removeEventListener('change', checkboxChangeHandler);
                checkbox.addEventListener('change', checkboxChangeHandler);
            });
        }

        function checkboxChangeHandler() {
            const selectAll = document.getElementById('selectAll');
            const allCheckboxes = document.querySelectorAll('.shipment-checkbox');
            selectAll.checked = Array.from(allCheckboxes).every(cb => cb.checked);
            toggleBulkButtons();
        }

        // Update toggleBulkButtons to enable/disable View Unit Person button
        function toggleBulkButtons() {
            const checkboxes = document.querySelectorAll('.shipment-checkbox');
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            const exactlyOneChecked = Array.from(checkboxes).filter(cb => cb.checked).length === 1;
            document.getElementById('confirmSelected').disabled = !anyChecked;
            document.getElementById('rejectSelected').disabled = !anyChecked;
            document.getElementById('viewUnitPerson').disabled = !anyChecked;
        }

        // Initialize listeners on page load
        attachCheckboxListeners();
        attachActionListeners();
</script>
@endsection