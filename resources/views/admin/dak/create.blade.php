@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header"> <strong>Create Letter Details</strong>
        <a href="{{ route('admin.dakCreate.index') }}" class="btn btn-primary float-end">Back to List</a>
    </div>


    <div class="card-body">

        <form method="POST" action="{{ route('admin.dakCreate.store') }}">
            @csrf
            <div class="row">

                <!-- Left Column - From -->
                <div class="col-md-6">
                    <h5><strong>From</strong></h5>
                    <div class="mb-2">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}">
                        @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="unit_user_id" class="form-label">Select User:</label>
                        <select name="unit_user_id" id="unit_user_id"
                            class="form-select @error('unit_user_id') is-invalid @enderror">
                            <option value="">Select User</option>
                            @foreach ($unit_user as $user)
                            <option value="{{ $user->id }}" data-unit="{{ $user->unit_user_id }}" {{
                                old('unit_user_id')==$user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('unit_user_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- <div class="mb-2">
                        <label for="from_name" class="form-label">Name:</label>
                        <input type="text" name="from_name"
                            class="form-control @error('from_name') is-invalid @enderror"
                            value="{{ old('from_name') }}">
                        @if ($errors->has('from_name'))
                        <span class="text-danger">{{ $errors->first('from_name') }}</span>
                        @endif
                    </div> --}}

                    <div class="mb-2">
                        <label for="unit_id" class="form-label">Name:</label>
                        <select name="unit_id" class="form-select @error('unit_id') is-invalid @enderror">
                            <option value="">Select Name</option>
                            @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id')==$unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('unit_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-2">
                        <label for="from_address" class="form-label">Address:</label>
                        <input type="text" name="from_address"
                            class="form-control @error('from_address') is-invalid @enderror"
                            value="{{ old('from_address') }}">
                        @if ($errors->has('from_address'))
                        <span class="text-danger">{{ $errors->first('from_address') }}</span>
                        @endif
                    </div>


                </div>

                <!-- Right Column - To -->

                <div class="col-md-6">
                    <h5><strong>To</strong></h5>
                    <div class="mb-2">
                        <label for="security_type" class="form-label ">Security Type:</label>
                        <select class="form-control @error('security_type') is-invalid @enderror" name="security_type"
                            id="security_type">
                            <option value="" hidden>Select Security Type</option>
                            <option value="restricted">Restricted</option>
                            <option value="confidential">Confidential</option>
                            <option value="secret">Secret</option>
                            <option value="top_secret">Top Secret</option>
                        </select>
                        @if ($errors->has('security_type'))
                        <span class="text-danger">{{ $errors->first('security_type') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="letter_no" class="form-label">Letter No:</label>
                        <input type="text" name="letter_no"
                            class="form-control @error('letter_no') is-invalid @enderror"
                            value="{{ old('letter_no') }}">
                        @if ($errors->has('letter_no'))
                        <span class="text-danger">{{ $errors->first('letter_no') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="to_name" class="form-label">Name:</label>
                        <input type="text" name="to_name" class="form-control @error('to_name') is-invalid @enderror"
                            value="{{ old('to_name') }}">
                        @if ($errors->has('to_name'))
                        <span class="text-danger">{{ $errors->first('to_name') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="to_address" class="form-label">Address:</label>
                        <input type="text" name="to_address"
                            class="form-control @error('to_address') is-invalid @enderror"
                            value="{{ old('to_address') }}">
                        @if ($errors->has('to_address'))
                        <span class="text-danger">{{ $errors->first('to_address') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@endsection