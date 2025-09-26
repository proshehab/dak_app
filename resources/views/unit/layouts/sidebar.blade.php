<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <div class="sidebar-brand">
        <a href="#" class="brand-link d-flex flex-column justify-content-center align-items-center">

            <span class="brand-text fw-light">Unit Portal</span>
        </a>


    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('unit.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('unit.unitperson*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-plus"></i>
                        <p>Unit DR Add</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('unit.addresses.index', 'unit.addresses.create', 'unit.barcode.generate') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-envelope-plus"></i>
                        <p>Create Letter</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('unit.dak.received-confirmation') }}"
                        class="nav-link {{ request()->routeIs('unit.dak.received-confirmation', 'unit.tracking.confirmation') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-inbox-fill"></i>
                        <p>Received</p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('unit.addresses.dispatch-received-confirmation', 'unit.dispatch.tracking.confirmation') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-send-check-fill"></i>
                        <p>Dispatch</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('unit.Unitlogout') }}" method="get">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start text-white">
                            <i class="nav-icon bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>

        </nav>
    </div>
</aside>
