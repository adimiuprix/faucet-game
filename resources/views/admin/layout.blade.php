<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Panel Admin - Dashboard</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ admin('images/favicon.ico') }}" />

        <!-- Local Third-Party Libraries (100% Offline Compatible) -->
        <link rel="stylesheet" href="{{ admin('libs/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ admin('libs/bootstrap-icons/bootstrap-icons.css') }}" />
        <link rel="stylesheet" href="{{ admin('libs/apexcharts/apexcharts.css') }}" />
        <link rel="stylesheet" href="{{ admin('libs/flatpickr/flatpickr.min.css') }}" />

        <!-- Main Design System & Custom Stylesheet -->
        <link rel="stylesheet" href="{{ admin('css/main.css') }}" />
    </head>

    <body>

        @include('admin.components.sidebar')
        
        <!-- ==========================================
         START: Main Content Area
         ========================================== -->
        <div class="main-wrapper">
            <!-- START: Top Navbar Component -->
            <header class="navbar-custom">
                <div class="navbar-left">
                    <!-- Desktop sidebar toggle (visible on large screens only) -->
                    <button
                        class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                        id="desktop-sidebar-toggle"
                        aria-label="Minimize Sidebar"
                    >
                        <i class="bi bi-chevron-bar-left"></i>
                    </button>
                    <!-- Mobile sidebar toggle -->
                    <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                        <i class="bi bi-list"></i>
                    </button>

                </div>

                <!-- Mid navbar: search pill -->
                <div class="navbar-search-wrapper"></div>

                <!-- Right actions -->
                <div class="navbar-actions">
                    <!-- Fullscreen Toggle -->
                    <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="dropdown ms-2">
                        <button
                            class="navbar-profile-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            id="profile-dropdown"
                        >
                            <img src="images/avatar.png" alt="Profile Image" class="navbar-profile-img" />
                            <span class="navbar-profile-name d-none d-md-inline">Administrator</span>
                            <i class="bi bi-chevron-down navbar-profile-caret"></i>
                        </button>
                        <ul
                            class="dropdown-menu dropdown-menu-end dropdown-menu-profile"
                            aria-labelledby="profile-dropdown"
                        >
                            <li class="dropdown-header">Welcome !</li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"
                                    ><i class="bi bi-box-arrow-right"></i> Logout</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- END: Top Navbar Component -->

            @yield('content')

            <!-- START: Footer Component -->
            <footer class="footer-custom">
                <div class="footer-content">
                    <span class="footer-logo"> <i class="bi bi-asterisk"></i> Admin Panel </span>
                    <span class="footer-separator">|</span>
                    <span class="footer-copy"
                        >&copy; 2026 Made with <i class="bi bi-heart-fill text-danger footer-heart"></i> by Adimiuprix
                    </span>
                </div>
            </footer>
            <!-- END: Footer Component -->
        </div>
        <!-- ==========================================
         END: Main Content Area
         ========================================== -->

        <!-- Local Third-Party Libraries Script dependencies -->
        <script src="{{ admin('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ admin('libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ admin('libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- Local dashboard interactions controller -->
        <script src="{{ admin('js/dashboard.js') }}"></script>
    </body>
</html>
