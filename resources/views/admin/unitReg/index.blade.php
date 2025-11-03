@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Units List
        <a href="{{ route('admin.unitRegistration.create') }}" class="btn btn-primary float-end">Add Unit</a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.unitRegistration.index') }}" class="row mb-3">
            <div class="col-md-8">
                <input type="text" name="name" class="form-control" placeholder="Search by name"
                    value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('admin.unitRegistration.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $key => $unit)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $unit->unit_id }}</td>
                        <td>{{ $unit->email }}</td>
                        <td>{{ $unit->phone }}</td>
                        <td>{{ $unit->password }}</td>
                        <td>
                            @if ($unit->status === 'pending')
                            <span class="badge bg-danger text-white">Pending</span>
                            @elseif ($unit->status === 'received')
                            <span class="badge bg-success">Received</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.unitRegistration.edit', $unit->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.unitRegistration.destroy', $unit->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this unit?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="mt-3">
                {{ $units->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    @endsection