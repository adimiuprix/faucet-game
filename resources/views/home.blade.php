<!doctype html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" href="{{ asset('home/img/favicon.ico') }}" />

        <!-- AOS -->
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.css" rel="stylesheet" />

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- fontAwesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/css/fontawesome.min.css" />

        <!-- boxicons -->
        <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

        <!-- main stylesheet -->
        <link rel="stylesheet" href="{{ asset('home/css/main.css') }}" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- title -->
        <title>Home | {{ $sitename }}</title>
        <meta name="keywords" content="{{ $keywords }}" />
        <meta name="description" content="{{ $description }}" />
    </head>

    <body oncontextmenu="return true">
        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="nav-bar">
                    <a href="#" class="logo">
                        <img id="logoimg" src="{{ asset('home/img/logo.png') }}" alt="" />
                    </a>

                    <div class="d-flex align-items-center">
                        <div class="nav-links">
                            <a href="#features">Features</a>
                            <a href="#hero">Supported Coins</a>
                            <a href="#payment_proof">Payment Proof</a>
                            <a href="#faqs">FAQs</a>
                            <a href="#!">Telegram</a>
                        </div>

                        <div class="nav-toggler">
                            <i class="bx bx-menu-alt-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- hero -->
        <section id="hero">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="hero-title" data-aos="fade-down" data-aos-duration="500">Claim Instant Cryptos</h2>
                        <p class="hero-subtitle" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
                            Login With Your FaucetPay Email & Claim Any Major Coin! Payment Sent Instantly.
                        </p>

                        <div class="crypto_wrap">
                            <img src="{{ asset('coin/btc.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/ltc.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/bnb.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/ton.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/trx.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/fey.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/sol.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/dash.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/cash.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/zec.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/dash.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/usdc.svg') }}" class="crypto" alt="" />
                            <img src="{{ asset('coin/eth.svg') }}" class="crypto" alt="" />
                        </div>

                        <div data-aos="zoom-in" data-aos-delay="700">
                            <form action="{{ route('auth.process') }}" method="POST">
                                @csrf
                                <input type="email" name="email" id="email" class="form-input" placeholder="Enter Your FaucetPay Email" required value="{{ old('email') }}" />
                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                                <br />
                                <div class="h-captcha" data-sitekey="{{ $sitekey }}"></div>
                                <br />
                                <button type="submit" class="hero_form_btn">Login Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <div class="row features_content">
                    <div class="col-lg-6 col-md-12">
                        <h2 class="fs_title" data-aos="fade-down" data-aos-duration="500">
                            <span class="fw-bold">We Have</span> The Best<br />Features
                            <span class="fw-bold">For You!</span>
                        </h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/instant_p.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>Instant Payment</h3>
                                        <p>Claim & Get Paid Instantly</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/10_cryptos.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>10+ Cryptos</h3>
                                        <p>Supported Various Crypto For Payment</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/claim_u.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>Claim Unlimited</h3>
                                        <p>Claim Every Minutes, No limit!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/refer_earn.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>Refer & Earn</h3>
                                        <p>Get Paid Instantly While Referral Claim!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/daily_coupon.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>Daily Coupon</h3>
                                        <p>Get Free Coupon Daily</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="feature_item">
                                    <img src="{{ asset('home/img/daily_achieve.svg') }}" alt="" />
                                    <div class="feature_content">
                                        <h3>Daily Achievement Rewards</h3>
                                        <p>Complete Target & Claim Your Rewards</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <img
                            src="{{ asset('home/img/feature_img.svg') }}"
                            class="feature_section_img"
                            data-aos="fade-down"
                            data-aos-duration="500"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </section>

        <section id="payment_proof">
            <div class="container">
                <div class="row">
                    <h2 class="pp_title" data-aos="fade-down" data-aos-duration="500">
                        <span class="ppt_light">Live Transaction</span><br />All Latest User Payouts
                    </h2>

                    <div class="col-12">
                        <div class="table-responsive" data-aos="fade-down" data-aos-duration="500">
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
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ Str::mask($payment->user->email, '*', 3, strpos($payment->user->email, '@') - 1) }}</td>
                                        <td><img src="{{ asset('coin/' . $payment->currency->image) }}" class="payment_icon" /> {{ $payment->amount }}</td>
                                        <td>{{ $payment->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faqs">
            <div class="container">
                <div data-aos="fade-down" data-aos-duration="500">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <h2 class="faqs_section_title">
                                <span class="fw-bold">FAQs</span><br />Confused? Have Question? Check It
                            </h2>
                            <div class="col-12">
                                <div class="faqs">
                                    <div class="col-lg-12">
                                        <div class="accordion" id="accordion">
                                            @foreach ($faqs as $faq)
                                            <div class="accordion-item mb-4 aos-init aos-animate" data-aos="fade-up">
                                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                                    <button
                                                        class="accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $faq->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $faq->id }}"
                                                    >
                                                        <img
                                                            src="{{ asset('home/img/water_droplet.svg') }}"
                                                            class="faq_icon"
                                                        />
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>

                                                <div
                                                    id="collapse{{ $faq->id }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $faq->id }}"
                                                    data-bs-parent="#accordion{{ $faq->id }}"
                                                >
                                                    <div class="accordion-body">
                                                        <p>
                                                            {{ $faq->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <img src="{{ asset('home/img/faq_img.svg') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer id="footer">
            <div class="container">
                <p class="text-center fw-bold">All Right Reserve - {{ $sitename }}</p>
            </div>
        </footer>

        <div class="backdrop-filter"></div>
    </body>

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('home/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('home/js/home.js') }}"></script>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <script>
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            confirmButtonColor: '#d33',
        });
    @endif
    </script>
</html>
