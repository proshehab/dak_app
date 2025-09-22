@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Unit Create
            <a href="{{ route('admin.unit.index') }}" class="btn btn-primary float-end">Back to List</a>
        </div>

        <div class="card-body mb-4">
            <form method="POST" action="{{ route('admin.unit.store') }}">
                @csrf
                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-2">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address') }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
@endsection
