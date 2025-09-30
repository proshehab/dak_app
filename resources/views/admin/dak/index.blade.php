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

            <form method="POST" action="{{ route('admin.qrcode.bulkPrint') }}" target="_blank">
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


                <div class="d-flex mt-2">
                    {{-- ✅ Bulk Print Form (POST) --}}
                    <form method="POST" action="{{ route('admin.qrcode.bulkPrint') }}" id="bulk-print-form"
                        target="_blank" class="me-3">

                        @csrf
                        <button type="submit" class="btn btn-success me-4">
                            🖨️ Print Selected
                        </button>
                    </form>

                    {{-- ✅ Bulk Delete Form (DELETE) --}}
                    <form method="POST" action="#" id="bulk-delete-form"
                        onsubmit="return confirm('Are you sure you want to delete the selected addresses?')">
                        @csrf
                        @method('DELETE')

                        {{-- Hidden checkboxes will be injected by JavaScript --}}
                        <button type="submit" class="btn btn-danger me-3">
                            🗑️ Delete Selected
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for 'Select All' checkbox
        document.getElementById('select-all').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        };

        // Handle View Remarks button click
        document.querySelectorAll('.view-remarks').forEach(button => {
            button.addEventListener('click', function() {
                const addressId = this.getAttribute('data-address-id');
                const modal = new bootstrap.Modal(document.getElementById('remarksModal'));
                const remarksContent = document.getElementById('remarksContent');

                // Show modal with loading state
                remarksContent.innerHTML = '<p>Loading...</p>';
                modal.show();


                .then(response => {
                        console.log('Response status:', response.status);
                        console.log('Response headers:', response.headers.get('Content-Type'));
                        if (!response.ok) {
                            return response.text().then(text => {
                                console.error('Response text:', text);
                                throw new Error(`HTTP ${response.status}: ${text}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            remarksContent.innerHTML =
                                `<p><strong class="text-danger">${data.remarks}</strong></p>`;
                        } else {
                            remarksContent.innerHTML = `<p class="text-danger">${data.message}</p>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching remarks:', error);
                        remarksContent.innerHTML = `<p class="text-danger">Error: ${error.message}</p>`;
                    });
            });
        });

        document.querySelector('#bulk-delete-form').addEventListener('submit', function(e) {
            const selected = document.querySelectorAll('input[name="ids[]"]:checked');

            // Clear previously added
            this.querySelectorAll('.bulk-delete-checkbox').forEach(el => el.remove());

            selected.forEach(cb => {
                const clone = document.createElement('input');
                clone.type = 'hidden';
                clone.name = 'ids[]';
                clone.value = cb.value;
                clone.classList.add('bulk-delete-checkbox');
                this.appendChild(clone);
            });
        });
    </script>
@endsection
