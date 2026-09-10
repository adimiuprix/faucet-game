<x-dash-layout>
    <!-- ########## main content ########## -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row section px-2">
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>{{ $refCount }} <span class="small_txt">Users</span></h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('dash/img/3dmyref.svg') }}"
                                    alt=""
                                />
                                <p>My Referrals</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row section px-2">
                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Refer Your Friends &amp; Earn {{ $commission }}% Commissions</h2>
                            <div class="refer-wrap mt-3">
                                <input
                                    class="form-input"
                                    id="refer-code"
                                    type="text"
                                    value="{{ $referralUrl }}"
                                    readonly=""
                                />
                                <a href="#" class="refer-copy-btn"> Copy </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row section px-2">
                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Recent Referrals</h2>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Joined At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($downlines as $downline)
                                            <tr>
                                                <td>{{ $downline->id }}</td>
                                                <td>{{ $downline->email }}</td>
                                                <td>{{ $downline->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
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
