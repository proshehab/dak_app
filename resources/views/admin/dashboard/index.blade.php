@extends('admin.layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard Overview</h4>
        </div>
        <div class="card-body">

            {{-- <div class="row g-4">

                <!-- Total Customers -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-people-fill display-4 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Unit</h5>
                                <p class="card-text fs-4">{{ $customers }}</p>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-light btn-sm mt-2">
                                    More info <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Shipments -->
                <div class="col-md-4">
                    <div class="card text-white bg-success h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-box-seam display-4 me-3"></i>
                            <div>
                                <h5 class="card-title">Total Shipments</h5>
                                <p class="card-text fs-4">{{ $shipments }}</p>
                                <a href="{{ route('admin.dispatch.index') }}" class="btn btn-outline-light btn-sm mt-2">
                                    More info <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Shipments -->
                <div class="col-md-4">
                    <div class="card text-white bg-warning h-100 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-clock-history display-4 me-3"></i>
                            <div>
                                <h5 class="card-title">Pending Shipments</h5>
                                <p class="card-text fs-4">{{ $pending }}</p>
                                <a href="{{ route('admin.dispatch.tracking.index') }}" class="btn btn-outline-light btn-sm mt-2">
                                    More info <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

             <div class="row">
            <div class="col-md-4">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>#</h3>
                        <p>Total Unit</p>
                    </div>
                    <i class="bi bi-people-fill small-box-icon"></i>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>#</h3>
                        <p> Total Received</p>
                    </div>
                    <i class="bi bi-cart-fill small-box-icon"></i>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>#</h3>
                        <p>Total Pending</p>
                    </div>
                    <i class="bi bi-eye-fill small-box-icon"></i>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
