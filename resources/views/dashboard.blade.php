<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />
        
        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="alert alert-success text-center mx-4">
                <a href="{{ $telegramChannel }}">Join Our Telegram Channel For Daily Coupon &amp; Support <b><u>Click Here</u></b></a>
            </div>
    
            <!--======= Bonus Coupon Code Start ======= -->
            <div
                class="alert text-center mx-4"
                style="
                    background: linear-gradient(90deg, #005cff, #29b6ff);
                    color: white;
                    border-radius: 15px;
                    padding: 15px;
                    font-weight: 600;
                "
            >
                🎁 Redeem coupon code <b>FIRSTENERGY</b> to get <b>Free 1500 Energy!</b>
    
                <a
                    href="{{ route('coupon') }}"
                    style="
                        background: white;
                        color: #0066ff;
                        padding: 6px 15px;
                        border-radius: 10px;
                        text-decoration: none;
                        margin-left: 10px;
                        font-weight: bold;
                    "
                >
                    Click Here
                </a>
            </div>
            <!--======= Bonus Coupon Code End ======= -->
    
            <div class="container-fluid">
                <div class="dash_top_section">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <div class="navcard mb-4">
                                <img src="{{ asset('dash/img/energy.svg') }}" alt=""/>
                                <div
                                    class="navcard_content"
                                    style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px 14px"
                                >
                                    <h3 style="margin: 0">Total Energy : {{ $energy }}</h3>
                                    <span
                                        class="dash_userid_badge"
                                        title="Your User ID - mention this when contacting support"
                                        style="
                                            display: inline-flex;
                                            align-items: center;
                                            gap: 7px;
                                            background: linear-gradient(90deg, #7b2ff7, #4f2bd6);
                                            color: #fff;
                                            font-weight: 700;
                                            font-size: 15px;
                                            line-height: 1;
                                            padding: 8px 16px;
                                            border-radius: 12px;
                                            box-shadow: 0 2px 10px rgba(123, 47, 247, 0.4);
                                            white-space: nowrap;
                                        "
                                    >
                                        <i class="fas fa-user"></i> User ID: {{ auth()->user()->unique_id ?? '0' }}
                                    </span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-xl-4 col-lg-6 col-sm-6">
                            <div class="dashboard_info_card">
                                <div class="dic_title">
                                    <i class="fas fa-circle"></i>
                                    <p>Faucet Status</p>
                                    <i class="fas fa-circle"></i>
                                </div>
                                <img
                                    src="{{ asset('dash/img/3dheart.svg') }}"
                                    class="dic_img"
                                    alt=""
                                />
                                <div class="dic_status">Healthy</div>
                            </div>
                        </div>
    
                        <div class="col-xl-4 col-lg-6 col-sm-6">
                            <div class="dashboard_info_card">
                                <div class="dic_title">
                                    <i class="fas fa-circle"></i>
                                    <p>Claim Timer</p>
                                    <i class="fas fa-circle"></i>
                                </div>
                                <img
                                    src="{{ asset('dash/img/3dhourglass.svg') }}"
                                    class="dic_img"
                                    alt=""
                                />
                                <div class="dic_status">Ready</div>
                            </div>
                        </div>
    
                        <div class="col-xl-4 col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="navcard mb-4">
                                        <img
                                            src="{{ asset('dash/img/3dmouse.svg') }}"
                                            alt=""
                                        />
                                        <div class="navcard_content">
                                            <h3>Surf Web</h3>
                                            <p>Earn More</p>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-12">
                                    <div class="navcard mb-4">
                                        <img
                                            src="{{ asset('dash/img/3dlink.svg') }}"
                                            alt=""
                                        />
                                        <div class="navcard_content">
                                            <h3>Shortlinks</h3>
                                            <p>Visit &amp; Get Rewards</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row section px-3">
                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Payment Proofs</h2>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>FaucetPay Email</th>
                                            <th>Amount</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ $payment->user ? Str::mask($payment->user->email, '*', 3, max(0, strpos($payment->user->email, '@') - 1)) : '-' }}</td>
                                            <td>
                                                <img src="{{ asset('coin/' . $payment->currency->image) }}" class="payment_icon" />
                                                {{ $payment->amount }}
                                            </td>
                                            <td>{{ $payment->created_at?->diffForHumans() ?? '-' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No payment records found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>