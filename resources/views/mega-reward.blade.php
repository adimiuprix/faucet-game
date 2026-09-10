<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />
        
        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- ===================== MEGA SUNDAY EVENT ===================== -->
                <style>
                    .ms-wrap {
                        --ms-accent: #8bab32;
                        --ms-accent-dark: #2e600a;
                        margin: 10px auto 30px;
                        max-width: 1100px;
                    }

                    /* ---- Hero banner ---- */
                    .ms-hero {
                        position: relative;
                        overflow: hidden;
                        border-radius: 18px;
                        padding: 34px 22px;
                        text-align: center;
                        background: linear-gradient(to right bottom, #8bab32, #2e600a);
                        box-shadow: 0 12px 30px rgba(46, 96, 10, 0.35);
                        margin-bottom: 26px;
                    }
                    .ms-hero::before,
                    .ms-hero::after {
                        content: "";
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.1);
                    }
                    .ms-hero::before {
                        width: 180px;
                        height: 180px;
                        top: -70px;
                        right: -40px;
                    }
                    .ms-hero::after {
                        width: 130px;
                        height: 130px;
                        bottom: -60px;
                        left: -30px;
                    }
                    .ms-badge {
                        display: inline-block;
                        background: #fff;
                        color: #2e600a;
                        font-weight: 800;
                        font-size: 12px;
                        letter-spacing: 1px;
                        padding: 5px 14px;
                        border-radius: 30px;
                        text-transform: uppercase;
                        margin-bottom: 12px;
                    }
                    .ms-hero h1 {
                        color: #fff;
                        font-weight: 800;
                        font-size: 34px;
                        margin: 0 0 8px;
                        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
                    }
                    .ms-hero h1 .ms-emoji {
                        filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.2));
                    }
                    .ms-hero p {
                        color: rgba(255, 255, 255, 0.92);
                        font-size: 15px;
                        margin: 0 auto;
                        max-width: 620px;
                    }

                    /* ---- Reward grid ---- */
                    .ms-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 18px;
                    }
                    @media (max-width: 680px) {
                        .ms-grid {
                            grid-template-columns: 1fr;
                        }
                        .ms-hero h1 {
                            font-size: 26px;
                        }
                    }

                    .ms-card {
                        position: relative;
                        overflow: hidden;
                        background: var(--bg-primary);
                        border: 1px solid rgba(139, 171, 50, 0.35);
                        border-radius: 16px;
                        padding: 22px 20px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        text-align: center;
                        box-shadow: var(--myshadow);
                        transition:
                            transform 0.2s ease,
                            box-shadow 0.2s ease;
                    }
                    .ms-card:hover {
                        transform: translateY(-4px);
                        box-shadow: 0 14px 28px rgba(46, 96, 10, 0.28);
                    }
                    .ms-card .ms-ribbon {
                        position: absolute;
                        top: 14px;
                        right: -34px;
                        transform: rotate(45deg);
                        background: linear-gradient(to right bottom, #8bab32, #2e600a);
                        color: #fff;
                        font-size: 11px;
                        font-weight: 700;
                        letter-spacing: 0.5px;
                        padding: 4px 40px;
                    }
                    .ms-icon {
                        width: 74px;
                        height: 74px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: linear-gradient(
                            to right bottom,
                            rgba(139, 171, 50, 0.18),
                            rgba(46, 96, 10, 0.18)
                        );
                        border: 1px solid rgba(139, 171, 50, 0.35);
                        margin-bottom: 14px;
                    }
                    .ms-icon img {
                        width: 42px;
                        height: 42px;
                    }
                    .ms-card h3 {
                        color: var(--text-primary);
                        font-size: 18px;
                        font-weight: 700;
                        margin: 0 0 6px;
                    }
                    .ms-percent {
                        font-size: 30px;
                        font-weight: 800;
                        line-height: 1;
                        background: linear-gradient(to right, #8bab32, #2e600a);
                        -webkit-background-clip: text;
                        background-clip: text;
                        -webkit-text-fill-color: transparent;
                        margin: 2px 0 4px;
                    }
                    .ms-sub {
                        color: var(--text-primary);
                        opacity: 0.65;
                        font-size: 13px;
                        margin-bottom: 16px;
                    }
                    .ms-btn {
                        display: inline-flex;
                        align-items: center;
                        gap: 8px;
                        background: linear-gradient(to right bottom, #8bab32, #2e600a);
                        color: #fff !important;
                        text-decoration: none;
                        font-weight: 700;
                        font-size: 14px;
                        padding: 10px 26px;
                        border-radius: 30px;
                        box-shadow: 0 6px 14px rgba(46, 96, 10, 0.35);
                        transition:
                            filter 0.15s ease,
                            transform 0.15s ease;
                        margin-top: auto;
                    }
                    .ms-btn:hover {
                        filter: brightness(1.08);
                        transform: translateY(-2px);
                        color: #fff;
                    }
                    .ms-btn i {
                        font-size: 15px;
                    }

                    /* ---- Footer note ---- */
                    .ms-note {
                        margin-top: 24px;
                        text-align: center;
                        color: var(--text-primary);
                        opacity: 0.7;
                        font-size: 13px;
                    }
                    .ms-note b {
                        color: var(--ms-accent);
                    }
                </style>

                <div class="ms-wrap">
                    <!-- Hero -->
                    <div class="ms-hero">
                        <span class="ms-badge">Limited Time • Every Sunday</span>
                        <h1><span class="ms-emoji">🎉</span> Mega Sunday <span class="ms-emoji">🎉</span></h1>
                        <p>
                            Every Sunday all rewards get a massive boost! Claim more, earn more — only for
                            today. Don't miss out, grab your increased rewards now!
                        </p>
                    </div>

                    <!-- Reward Cards -->
                    <div class="ms-grid">
                        <!-- Faucet -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/fauceticon.svg') }}"
                                    alt="Faucet"
                                />
                            </div>
                            <h3>Faucet Reward</h3>
                            <div class="ms-percent">+25%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="" class="ms-btn">
                                <i class="fas fa-faucet-drip"></i> Claim Faucet
                            </a>
                        </div>

                        <!-- Shortlink -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/slicon.svg') }}"
                                    alt="Shortlink"
                                />
                            </div>
                            <h3>Shortlink Reward</h3>
                            <div class="ms-percent">+20%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="" class="ms-btn">
                                <i class="fas fa-link"></i> Claim Shortlink
                            </a>
                        </div>

                        <!-- Coupon -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/ticket.svg') }}"
                                    alt="Coupon"
                                />
                            </div>
                            <h3>Coupon Reward</h3>
                            <div class="ms-percent">+25%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="{{ route('coupon') }}" class="ms-btn">
                                <i class="fas fa-ticket"></i> Claim Coupon
                            </a>
                        </div>

                        <!-- Surf Ad -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/3dmouse.svg') }}"
                                    alt="Surf Ad"
                                />
                            </div>
                            <h3>Surf Ad Reward</h3>
                            <div class="ms-percent">+20%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="{{ route('ptc', ['ltc']) }}" class="ms-btn">
                                <i class="fas fa-globe"></i> Surf Ad
                            </a>
                        </div>

                        <!-- Mining -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/3dmouse.svg') }}"
                                    alt="Mining"
                                />
                            </div>
                            <h3>Mining Reward</h3>
                            <div class="ms-percent">+20%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="{{ route('mining') }}" class="ms-btn">
                                <i class="fas fa-microchip"></i> Start Mining
                            </a>
                        </div>

                        <!-- Energy -->
                        <div class="ms-card">
                            <div class="ms-ribbon">HOT</div>
                            <div class="ms-icon">
                                <img
                                    src="{{ asset('dash/img/energy.svg') }}"
                                    alt="Energy"
                                />
                            </div>
                            <h3>Energy Reward</h3>
                            <div class="ms-percent">+100%</div>
                            <div class="ms-sub">Increased this Sunday</div>
                            <a href="{{ route('ptc', ['ltc']) }}" class="ms-btn">
                                <i class="fas fa-bolt"></i> Earn Energy
                            </a>
                        </div>
                    </div>

                    <div class="ms-note">
                        ⏳ These boosted rewards are active <b>only on Sunday</b>. Make the most of your Mega
                        Sunday!
                    </div>
                </div>
                <!-- =================== END MEGA SUNDAY EVENT =================== -->
            </div>
        </div>
    </div>
</x-dash-layout>