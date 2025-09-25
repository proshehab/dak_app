{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unit | DAK Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CDN for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #191b1d;
            color: white;
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #404549;
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
        }

        .sidebar .nav-link i {
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="text-center mb-4">
            <strong>Unit Portal</strong><br>
            <small>{{ Auth::user()->name }}</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('unit.dashboard') ? 'active' : '' }}"
                    href="{{ route('unit.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('unit.unitperson*') ? 'active' : '' }}"
                    href="{{ route('unit.unitperson.create') }}">
                    <i class="fas fa-user-plus"></i> Unit DR Add
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('unit.addresses.index', 'unit.addresses.create') ? 'active' : '' }}"
                    href="{{ route('unit.addresses.create') }}">
                    <i class="fas fa-pencil-alt"></i> Create Letter
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('unit.addresses.recevied-confirmation') ? 'active' : '' }}"
                    href="{{ route('unit.addresses.recevied-confirmation') }}">
                    <i class="fas fa-check-circle"></i> Received Confirmation
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('unit.addresses.dispatch-received-confirmation') ? 'active' : '' }}"
                    href="{{ route('unit.addresses.dispatch-received-confirmation') }}">
                    <i class="fas fa-check-circle"></i> Dispatch Confirmation
                </a>
            </li>

            <li class="nav-item mt-3">
                <form action="{{ route('unit.logout') }}" method="get">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start text-white">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> --}}







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit | DAK Management System</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta1/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css">
    <!-- iziToast CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
</head>

<body class="layout-fixed sidebar-expand-lg">
    <div class="app-wrapper">
        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <strong class="d-none d-md-inline"> Unit Name : {{ Auth::user()->name }}</strong>
                        </a>


                    </li>

                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        @include('unit.layouts.sidebar')
        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">DAK Management System</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')

                </div>
            </div>
        </main>
        <!-- Footer -->
        <footer class="app-footer">
            {{-- <div class="float-end d-none d-sm-inline">Custom Dashboard</div> --}}
            <strong>Copyright © 2025 <a href="#" class="text-decoration-none">Static Signal
                    Company,Jsr</a>.</strong> All
            rights reserved.
        </footer>

        <!-- 🔝 Scroll to Top Button -->
        <button type="button" class="btn btn-primary btn-lg rounded-circle shadow scroll-top-button" id="scrollTopBtn">
            <i class="bi bi-arrow-up"></i>
        </button>

    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta1/dist/js/adminlte.min.js"></script>
    <!-- Custom Js -->
    <script src="{{ asset('unit') }}/js/custom.js"></script>

    <!-- iziToast JS -->
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <!-- iziToast Notification Handling -->
    <script>
        @if (session('success'))
            iziToast.success({
                title: 'Success',
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        @endif

        @if (session('error'))
            iziToast.error({
                title: 'Error',
                message: "{{ session('error') }}",
                position: 'topRight'
            });
        @endif
    </script>

    <script>
        // Show or hide the scroll top button
        window.onscroll = function() {
            const btn = document.getElementById("scrollTopBtn");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        };

        // Scroll to top on click
        document.getElementById("scrollTopBtn").addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

</body>

</html>
