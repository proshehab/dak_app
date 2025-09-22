@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Unit Create Details
            <a href="{{ route('admin.unit.create') }}" class="btn btn-primary float-end">Add Unit Name</a>
        </div>
        <div class="card-body">

            {{-- Centered Search Bar --}}
            <div class="d-flex justify-content-center mb-3">
                <form method="GET" action="{{ route('admin.unit.index') }}" class="row w-100 justify-content-center"
                    style="max-width: 600px;">
                    <div class="col-md-8 mb-2 mb-md-0">
                        <input type="text" name="name" class="form-control" placeholder="Search by name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-4 d-flex justify-content-md-start justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">Search</button>
                        <a href="{{ route('admin.unit.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                 <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $key => $unit)
                        <tr>
                            <td>{{ $units->firstItem() + $key }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->address }}</td>
                            <td>
                                <a href="{{ route('admin.unit.edit', $unit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.unit.destroy', $unit->id) }}" method="POST" class="d-inline">
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

            </div>
           

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $units->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
@endsection
