<!-- ########## Sidebar Menu ########## -->
<div id="menu" class="menu-wrap mm-active">
    <!-- Close button for mobile -->
    <button type="button" class="sidebar-close-btn" id="sidebar-close" aria-label="Close sidebar">
        <i class="fas fa-times"></i>
    </button>

    <!-- Faucet Name / Logo -->
    <div class="site-name mm-active">
        <a href="{{ route('dashboard') }}">
            <!-- Light Mode Logo (shown in light mode) -->
            <img class="logo logo-light" 
                 src="{{ asset('home/img/logo.png') }}" 
                 alt="GameFaucet Logo" 
                 style="display: none;" />
            <!-- Dark Mode Logo (shown in dark mode - default) -->
            <img class="logo logo-dark" 
                 src="{{ asset('dash/img/logoindark.png') }}" 
                 alt="GameFaucet Logo" 
                 style="display: block;" />
        </a>
    </div>

    <!-- Navigation List -->
    <ul class="insideScroll text-white mt-2 mm-show">
        <!-- Menu Section -->
        <li class="title">
            <p>Menu</p>
        </li>
        
        <li class="hover mm-active">
            <a href="{{ route('dashboard') }}" class="menu_item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <img src="{{ asset('dash/img/dashboard.svg') }}" alt="" />
                Dashboard
            </a>
        </li>
        
        <li class="hover">
            <a href="{{ route('mega-reward') }}" class="menu_item {{ request()->routeIs('mega-reward') ? 'active' : '' }}">
                <img src="{{ asset('dash/img/ticket.svg') }}" alt="" />
                Mega Sunday
                <span style="background: linear-gradient(to right bottom, #8bab32, #2e600a); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; margin-left: 6px; letter-spacing: 0.5px;">New</span>
            </a>
        </li>
        
        <li class="hover">
            <a href="{{ route('referrals') }}" class="menu_item {{ request()->routeIs('referrals') ? 'active' : '' }}">
                <img src="{{ asset('dash/img/reficon.svg') }}" alt="" />
                Referrals
            </a>
        </li>
        
        <!-- Earning Options Section -->
        <li class="title">
            <p>Earning Options</p>
        </li>
        
        <li class="hover">
            <a href="{{ route('coupon') }}" class="menu_item">
                <img src="{{ asset('dash/img/ticket.svg') }}" alt="" />
                Daily Coupon
            </a>
        </li>
        
        <!-- Faucets Submenu -->
        <li class="hover">
            <div class="sub-btn-two">
                <div class="sub-btn-two_left menu_item">
                    <img src="{{ asset('dash/img/fauceticon.svg') }}" alt="" />
                    Faucets
                </div>
                <div class="sub-btn-two_right dropdown">
                    <i class="bx bxs-chevron-right"></i>
                </div>
            </div>
            <div class="sub-menu-two">
            @foreach ($currencies as $currency)
            <a
                href="{{ route('faucet', ['coin' => strtolower($currency->coin)]) }}"
                class="{{ request()->route('coin') === strtolower($currency->coin) ? 'active' : '' }}"
            >
                Faucet {{ strtoupper($currency->coin) }}
            </a>
            @endforeach
            </div>
        </li>
                
        <!-- Surf Ad Submenu -->
        <li class="hover">
            <div class="sub-btn-two">
                <div class="sub-btn-two_left menu_item">
                    <img src="{{ asset('dash/img/webicon.svg') }}" alt="" />
                    Surf Ad
                </div>
                <div class="sub-btn-two_right dropdown">
                    <i class="bx bxs-chevron-right"></i>
                </div>
            </div>
            <div class="sub-menu-two">
                @foreach ($currencies as $currency)
                <a
                    href="{{ route('ptc', ['coin' => strtolower($currency->coin)]) }}"
                    class="{{ request()->route('coin') === strtolower($currency->coin) ? 'active' : '' }}"
                >
                    Surf Web {{ strtoupper($currency->coin) }}
                </a>
                @endforeach
            </div>
        </li>
        
        <!-- Miner Submenu -->
        <li class="hover">
            <div class="sub-btn-two">
                <div class="sub-btn-two_left menu_item">
                    <img src="{{ asset('dash/img/webicon.svg') }}" alt="" />
                    Miner
                    <span style="display: inline-block; background: #f5c518; color: #1a1a1a; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 10px; line-height: 1; vertical-align: middle; white-space: nowrap;">20% Bonus</span>
                </div>
                <div class="sub-btn-two_right dropdown">
                    <i class="bx bxs-chevron-right"></i>
                </div>
            </div>
            <div class="sub-menu-two">
                <a href="{{ route('mining') }}" class="">Free Mining</a>
            </div>
        </li>
        
        {{-- <!-- Payment Section -->
        <li class="title">
            <p>Payment</p>
        </li>

        <li class="hover">
            <a href="{{ route('deposit') }}" class="menu_item">
                <img src="{{ asset('dash/img/deposit.svg') }}" alt="" />
                Deposit
            </a>
        </li>

        <li class="hover">
            <a href="{{ route('withdraw') }}" class="menu_item">
                <img src="{{ asset('dash/img/deposit.svg') }}" alt="" />
                Withdraw
            </a>
        </li> --}}
        
        <!-- Advertise Section -->
        <li class="title">
            <p>Advertise</p>
        </li>
        
        <li class="hover">
            <a href="{{ route('ads') }}" class="menu_item">
                <img src="{{ asset('dash/img/createadicon.svg') }}" alt="" />
                Create Ad
            </a>
        </li>
        
        <li class="hover">
            <a href="{{ route('ads.manage') }}" class="menu_item">
                <img src="{{ asset('dash/img/manageadicon.svg') }}" alt="" />
                Manage Ad
            </a>
        </li>
        
        <!-- Others Section -->
        <li class="title">
            <p>Others</p>
        </li>
        
        {{-- <li class="hover">
            <a href="{{ route('profile') }}" class="menu_item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <img src="{{ asset('dash/img/profile.svg') }}" alt="" />
                Profile
            </a>
        </li> --}}
        
        <li class="hover">
            <a href="{{ $telegram_channel }}" target="_blank" class="menu_item">
                <img src="{{ asset('dash/img/telegramicon.svg') }}" alt="" />
                Telegram
            </a>
        </li>
        
        <li class="hover">
            <a href="{{ $telegram_group }}" target="_blank" class="menu_item">
                <img src="{{ asset('dash/img/chat.svg') }}" alt="" />
                Support
            </a>
        </li>
        
        <li class="hover">
            <a href="{{ route('logout') }}" class="menu_item">
                <img src="{{ asset('dash/img/logouticon.svg') }}" alt="" />
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Responsive Overlay -->
<div class="responsive-overlay"></div>
