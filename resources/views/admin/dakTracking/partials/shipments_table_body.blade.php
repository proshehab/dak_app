@foreach ($shipments as $key => $shipment)
@if (in_array($shipment->barcode, session('scanned_barcodes', [])))
<tr>
    <td><input type="checkbox" name="shipment_ids[]" value="{{ $shipment->id }}" class="shipment-checkbox"></td>
    <td>{{ ++$key }}</td>
    <td>{{ $shipment->user->name ?? 'N/A' }}</td>
    <td>{{ $shipment->barcode }}</td>
    <td>
        @if ($shipment->status == 'received')
        <span class="badge bg-success">{{ ucfirst($shipment->status) }}</span>
        @elseif ($shipment->status == 'pending')
        <span class="badge bg-danger">{{ ucfirst($shipment->status) }}</span>
        @else
        <span class="badge bg-warning text-dark">{{ ucfirst($shipment->status) }}</span>
        @endif
    </td>
    <td>
        <form action="#" method="POST" style="display:inline;">
            @csrf
            {{-- <button type="submit" class="btn btn-sm btn-success" title="Confirm">
                <i class="bi bi-check"></i>
            </button> --}}
        </form>
        <form action="#" method="POST" style="display:inline;">
            @csrf
            {{-- <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                <i class="bi bi-x"></i>
            </button> --}}
        </form>
        {{-- <button type="button" class="btn btn-sm btn-info" title="Check Unit Person Info"
            onclick="showUnitPersonInfo({{ $shipment->id }})">
            <i class="bi bi-person"></i>
        </button> --}}

        <a href="{{ route('admin.tracking.confirmation', $shipment->id) }}" class="btn btn-sm btn-primary"
            title="View Confirmation">
            <i class="bi bi-eye"></i>
        </a>
        <form action="{{ route('admin.tracking.cancel', $shipment->barcode) }}" method="POST" style="display:inline;"
            class="cancel-form">
            @csrf
            <button type="submit" class="btn btn-sm btn-warning" title="Cancel Barcode">
                <i class="bi bi-x-circle"></i>
            </button>
        </form>
</tr>
@endif
@endforeach