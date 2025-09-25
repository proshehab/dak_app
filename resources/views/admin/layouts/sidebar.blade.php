<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#"
            class="brand-link d-flex flex-column justify-content-center align-items-center">
            <span class="brand-text fw-light">Admin Portal</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <!-- Unit -->
                <li class="nav-item">
                    <a href="{{ route('admin.unit.index') }}"
                        class="nav-link {{ request()->routeIs('admin.unit.*') ? 'active' : '' }}">
                        <i class="bi bi-house-add-fill me-2"></i> Unit
                    </a>
                </li>

                <!-- Unit Registration -->
                <li class="nav-item">
                    <a href="{{ route('admin.unitRegistration.index') }}"
                        class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="bi bi-person-plus-fill me-2"></i> Unit Registration
                    </a>
                </li>

                <!-- Received Menu -->
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center px-3 {{ request()->routeIs('admin.recevied-confirmation', 'admin.tracking.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#receivedMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.recevied-confirmation', 'admin.tracking.*') ? 'true' : 'false' }}">
                        <span><i class="bi bi-check-circle-fill me-2"></i>Received</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ request()->routeIs('admin.recevied-confirmation', 'admin.tracking.*') ? 'show' : '' }}"
                        id="receivedMenu">
                        <ul class="nav flex-column ps-4">

                            <!-- Tracking -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.tracking.*') ? 'active' : '' }}">
                                    <i class="bi bi-geo-alt-fill me-2"></i> Tracking
                                </a>
                            </li>

                            <!-- Received Confirmation -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.recevied-confirmation') ? 'active' : '' }}">
                                    <i class="bi bi-check2-circle me-2"></i> Received Confirmation
                                </a>
                            </li>

                            <!-- Reject Tracking -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.tracking.reject') ? 'active' : '' }}">
                                    <i class="bi bi-x-octagon-fill me-2"></i> Reject Tracking
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Dispatch Menu -->
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center px-3 {{ request()->routeIs('admin.dispatch.*', 'admin.dispatchReject.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" href="#dispatchMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.dispatch.*', 'admin.dispatchReject.*') ? 'true' : 'false' }}">
                        <span><i class="bi bi-send-fill me-2"></i>Dispatch</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ request()->routeIs('admin.dispatch.*', 'admin.dispatchReject.*') ? 'show' : '' }}"
                        id="dispatchMenu">
                        <ul class="nav flex-column ps-4">

                            <!-- Dispatch Tracking -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.dispatch.tracking.index') ? 'active' : '' }}">
                                    <i class="bi bi-truck me-2"></i> Dispatch Tracking
                                </a>
                            </li>

                            <!-- Dispatch List -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.dispatch.index') ? 'active' : '' }}">
                                    <i class="bi bi-card-list me-2"></i> Dispatch List
                                </a>
                            </li>

                            <!-- Dispatch Reject -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->routeIs('admin.dispatchReject.tracking.reject.*') ? 'active' : '' }}">
                                    <i class="bi bi-x-octagon-fill me-2"></i> Dispatch Reject
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <!-- Logout -->
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="get">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start text-white">
                            <i class="nav-icon bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
