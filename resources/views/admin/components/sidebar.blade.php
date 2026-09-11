<!-- ==========================================
    START: Sidebar Component
    Highly polished, dark-green sticky navigation
    ========================================== -->
<div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <i class="bi bi-asterisk"></i>
        <span>Admin Panel</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
        <!-- Group: Menu -->
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">Menu</div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.coupon.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.coupon*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>Coupon</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.faucet') }}" class="sidebar-menu-link {{ request()->routeIs('admin.faucet*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>Faucet</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.ptc.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.ptc*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>PTC</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.mining') }}" class="sidebar-menu-link {{ request()->routeIs('admin.mining*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>Mining</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.user') }}" class="sidebar-menu-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>User</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.captcha.index') }}" class="sidebar-menu-link {{ request()->routeIs('admin.captcha*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>Captcha</span>
                    </a>
                </li>


                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.setting') }}" class="sidebar-menu-link {{ request()->routeIs('admin.setting*') ? 'active' : '' }}">
                        <i class="bi bi-table"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
        <img
            src="admin/images/avatar.png"
            alt="Administrator"
            class="sidebar-profile-img"
            onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'"
        />
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">Administrator</div>
            <div class="sidebar-profile-email">admin@email.com</div>
        </div>
    </div>
</div>
<!-- ==========================================
    END: Sidebar Component
    ========================================== -->
