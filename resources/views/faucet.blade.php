<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">            
            <div class="alert alert-success text-center">
                <a href="{{ route('mining') }}">Buy Mining Packages For Free, Mine Your Favourite Crypto <b><u>Click Here</u></b></a>
            </div>
            <div class="container-fluid">
                <div class="row section px-2">
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $coin }}</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img src="{{ asset('coin/' . $coin . '.svg') }}" alt="" style="width: 35px;" />
                                <p>Currently Claiming</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $balance }} <span class="small_txt">{{ $coin }}</span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/3dclaimamount.svg') }}"
                                    alt=""
                                />
                                <p>Amount</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>Ready <span class="small_txt"> ({{ $claimChance }}/{{ $faucetChance }}) </span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/3dhourglass.svg') }}"
                                    style="height: 45px"
                                    alt=""
                                />
                                <p>Every 10 Seconds</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $energy }} <span class="small_txt">Energy</span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/energy.svg') }}"
                                    style="width: 45px"
                                    alt=""
                                />
                                <p>Energy</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row section px-2">
                    <div class="col-lg-3 d-flex justify-content-center text-center"></div>
                    <div class="col-lg-6">
                        <div class="common_card my-3 d-flex flex-column align-items-center">
                            <h2 class="section_title text-center mb-4">Claim Faucet</h2>

                            <div style="width: 100%" id="faucet_card">
                                <style>
                                    #faucet_card img {
                                        width: auto;
                                    }
                                    #faucet_card .atb {
                                        display: flex;
                                        justify-content: center;
                                    }
                                    #faucet_card .atb img {
                                        background: white;
                                    }
                                </style>
                                <form action="{{ route('faucet.verify') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="currency" value="{{ $coin }}" />
                                    <button
                                        type="submit"
                                        class="btn btn_primary claim-button"
                                        style="width: -webkit-fill-available"
                                    >
                                        <i class="far fa-check-circle"></i> Claim Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex justify-content-center text-center"></div>
                </div>
                
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Timer countdown untuk claim button (dari backend: sisa cooldown)
        $(() => {
            @if($nextClaim)
                const nextClaimAt = {{ $nextClaim }};
                let timer = Math.max(0, nextClaimAt - Math.floor(Date.now() / 1000));
            @else
                let timer = 0;
            @endif

            const $claimButton = $('.claim-button');

            if (timer > 0) {
                $claimButton.prop('disabled', true);
            }
            
            const counter = setInterval(() => {
                if (timer === 0) {
                    $claimButton.html('<i class="far fa-check-circle"></i> Claim Now');
                    $claimButton.prop('disabled', false);
                    clearInterval(counter);
                } else {
                    const secondText = timer === 1 ? 'Second' : 'Seconds';
                    $claimButton.text(`Wait ${timer} ${secondText}`);
                    timer--;
                }
            }, 1000);
        });

        // BEHAVIORAL detection (detection only - server e sudhu signal jay)
        (() => {
            const pageStart = Date.now();
            let gestureSeen = 0;
            let captchaTouched = 0;

            const markGesture = (e) => {
                if (e?.isTrusted) {
                    gestureSeen = 1;
                }
            };

            ['mousedown', 'touchstart', 'keydown', 'pointerdown'].forEach(eventType => {
                document.addEventListener(eventType, markGesture, true);
            });

            // Captcha widget ba form area-te asol interaction track
            const markCaptcha = (e) => {
                if (!e?.isTrusted) return;
                
                const form = document.querySelector('form[action*="faucet/verify"]');
                if (form?.contains(e.target)) {
                    captchaTouched = 1;
                }
            };

            ['mousedown', 'touchstart', 'pointerdown', 'change'].forEach(eventType => {
                document.addEventListener(eventType, markCaptcha, true);
            });

            const form = document.querySelector('form[action*="faucet/verify"]');
            if (form) {
                form.addEventListener('submit', () => {
                    const $bhGesture = $('#bh_gesture');
                    const $bhDwell = $('#bh_dwell');
                    const $bhInteracted = $('#bh_interacted');

                    if ($bhGesture.length) $bhGesture.val(gestureSeen ? '1' : '0');
                    if ($bhDwell.length) $bhDwell.val(String(Date.now() - pageStart));
                    if ($bhInteracted.length) $bhInteracted.val(captchaTouched ? '1' : '0');
                }, true);
            }
        })();
    </script>
</x-dash-layout>