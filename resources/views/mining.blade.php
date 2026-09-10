<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <center style="overflow: hidden"></center>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <style>
                .modal-content {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: rgb(193 131 30);
                    background-clip: padding-box;
                    border: 1px solid rgb(255 1 1 / 20%);
                    border-radius: 1.3000000000000007rem;
                    outline: 0;
                    color: #fff;
                    box-shadow: 3px 11px 30px 10px rgb(9 5 61 / 50%);
                }
                .common_card {
                    background: #021c09;
                }
            </style>
    
            <div class="mx-3 row" style="margin-bottom: unset">
                <div class="row section px-2">
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $energy }}</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img src="{{ asset('dash/img/amount.svg') }}" alt="" />
                                <p>Current Energy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $miner }} Miner</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img src="{{ asset('dash/img/amount.svg') }}" alt="" />
                                <p>Active Miner</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>0.00$</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img src="{{ asset('dash/img/amount.svg') }}" alt="" />
                                <p>Total Mined</p>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success text-center mx-4">
                        <a href="https://youtu.be/2YdbXuS9fuw"
                            >How to Buy Mining Package? Watch Youtube Tutorial <b><u>Click Here</u></b></a
                        >
                    </div>
                </div>
                <div class="col-12 text-center"></div>
                <div class="row section px-2">
                    @foreach($plans as $plan)
                    <div class="col-12 col-md-6 col-lg-6 order-md-2 mb-4">
                        <div class="common_card">
                            <div class="card-header text-center">
                                <img
                                    src="{{ asset('dash/img/diamond.png') }}"
                                    style="width: 48px; height: 48px"
                                />
                                <h2>{{ $plan->plan_name }}</h2>
                            </div>
                            <div class="card-body">
                                <p style="padding: 5px">
                                    <span>Cost :</span><span style="float: right">{{ $plan->cost }} {{ $plan->cost_unit }}</span>
                                </p>
                                <p style="padding: 5px">
                                    <span>Estimated Reward :</span
                                    ><span style="float: right">{{ $plan->reward }} {{ $plan->rewardCurrency->symbol }}</span>
                                </p>
                                <p style="padding: 5px">
                                    <span>Time :</span><span style="float: right">{{ $plan->duration_in_days }} Days</span>
                                </p>
                                <hr />
                                <div class="text-center">
                                    <form action="{{ route('mining.buy', $plan->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <button
                                                    type="submit"
                                                    class="btn btn_primary"
                                                    style="width: -webkit-fill-available"
                                                >
                                                    Hire
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mx-3 row px-2" style="margin-bottom: unset">
                <div class="common_card">
                    <div class="card-header text-center">
                        <h4>Active Miners</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($user_mining as $mining)
                    <div class="col-12 col-md-6 col-lg-6 order-md-2 mb-4">
                        <div class="common_card">
                            <div class="card-header text-center">
                                <img src="https://img.icons8.com/color/48/oil-pump-jack.png" style="width: 48px; height: 48px" />
                                <h2>{{ $mining->plan->plan_name }}</h2>
                            </div>
                            <div class="card-body">
                                <p style="padding: 5px">
                                    <span>Estimated Reward :</span>
                                    <span style="float: right">{{ $mining->plan->reward }} {{ $mining->plan->rewardCurrency->coin }}</span>
                                </p>
                                @if($mining->status == 'process')
                                <p style="padding: 5px">
                                    <span>Status :</span>
                                    <span style="float: right">Active</span>
                                </p>
                                @else
                                <form action="{{ route('mining.claim', $mining->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="mining_id" value="{{ $mining->id }}">
                                    <div class="form-row">
                                        <div class="col-12">
                                            <button
                                                type="submit"
                                                class="btn btn_primary"
                                                style="width: -webkit-fill-available"
                                            >
                                                Claim
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>