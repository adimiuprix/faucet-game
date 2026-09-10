<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row section px-2">
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $coin }}</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img src="{{ asset('dash/img/ltc.svg') }}" alt="" />
                                <p>Currently Claiming</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ number_format($balance, 8) }} <span class="small_txt">{{ $coin }}</span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/3dclaimamount.svg') }}"
                                    alt=""
                                />
                                <p>Balance</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $totalAvailable }} <span class="small_txt">Web</span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/3dmouse.svg') }}"
                                    style="width: 45px"
                                    alt=""
                                />
                                <p>Available Ads</p>
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
                <div class="verification_warning mx-3">
                    <img src="{{ asset('dash/img/warningicon.svg') }}" alt="" />
                    <p>After Complete External Surfing Web Pages. Please Refresh Page.</p>
                </div>
    
                <div class="row section px-2">
                    @forelse($ads as $ad)
                        @php
                            $adReward = $ad->rewards->first();
                            $rewardAmount = $adReward ? $adReward->reward : 0;
                        @endphp
                        <div class="col-lg-6">
                            <div class="common_card ptc_card">
                                <h5>{{ $ad->title }}</h5>
                                <p>{{ $ad->description ?? 'Visit website and earn free cryptocurrency reward.' }}</p>
                                <div class="pill-wrap">
                                    <div class="pill primary">
                                        <i class="fa fa-coins"></i>
                                        {{ number_format($rewardAmount, 8) }} {{ strtolower($coin) }}
                                    </div>
                                    <div class="pill sec">
                                        <i class="fa fa-clock"></i>
                                        {{ $ad->timer }}s
                                    </div>
                                </div>
                                <a href="{{ route('ptc.start', ['coin' => strtolower($coin), 'id' => $ad->id]) }}" class="btn_ptc">
                                    Click To Visit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="common_card p-5">
                                <h4>No ads available for {{ $coin }} right now.</h4>
                                <p class="text-muted">Please check back later or try surfing other coins!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if(session('success') !== null)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire("{{ session('message') }}", "", "success");
            @else
                Swal.fire("{{ session('message') }}", "", "error");
            @endif
        });
    </script>
    @endif
</x-dash-layout>