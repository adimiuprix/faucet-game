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
                                <h3>0.00$</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('assets/faucetkite/dash/img/3dclaimamount.svg') }}"
                                    alt=""
                                />
                                <p>Current Balance</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>0.00$</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('assets/faucetkite/dash/img/3dclaimamount.svg') }}"
                                    alt=""
                                />
                                <p>Total Deposit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="common_page_stat_card">
                            <div class="cpsc_top">
                                <h3>0.00$</h3>
                            </div>
                            <div class="cpsc_bottom">
                                <img
                                    src="{{ asset('assets/faucetkite/dash/img/3dclaimamount.svg') }}"
                                    alt=""
                                />
                                <p>Total Earned</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row section px-2">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="common_card">
                            <h2 class="section_title">Advertising Deposit</h2>
    
                            <form action="https://faucetpay.io/merchant/webscr" method="POST" id="dep_form">
                                <div class="form-group">
                                    <label class="mb-1">Amount (USDT)</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        min="1"
                                        name="token"
                                        id="token"
                                        class="form-input mb-2"
                                        onchange=""
                                    />
                                </div>
                                <div class="form-group" style="display: none">
                                    <select class="form-control" name="method" id="method">
                                        <option value="faucetpay">FaucetPay</option>
                                        '
                                    </select>
                                </div>
    
                                <script>
                                    var rate = 1;
                                    $("#token").keypress(() => {
                                        setTimeout(() => {
                                            $("input[name=amount1]").val($("#token").val());
                                        }, 50);
                                    });
                                </script>
    
                                <input type="hidden" name="ci_csrf_token" id="token" value="" />
                                <input type="hidden" name="merchant_username" value="jarna" />
                                <input type="hidden" name="item_description" value="Deposit to gardecet" />
                                <input type="hidden" name="currency1" value="USDT" />
                                <input type="hidden" name="currency2" value="" />
                                <input type="hidden" id="amount1" name="amount1" value="1" />
                                <input type="hidden" name="custom" value="{{ Auth::user()->id }}" />
                                <input
                                    type="hidden"
                                    name="callback_url"
                                    value=""
                                />
                                <input
                                    type="hidden"
                                    name="success_url"
                                    value="{{ route('deposit', ['success' => 'true']) }}"
                                />
                                <input
                                    type="hidden"
                                    name="cancel_url"
                                    value=""
                                />
                                <center><small id="minDep">Minimum Deposit - 1 USD</small></center>
                                <center>
                                    <button
                                        type="submit"
                                        class="btn btn_primary mt-4"
                                        style="width: -webkit-fill-available"
                                    >
                                        <b
                                            ><i class="bx bx-chevrons-up"></i> DEPOSIT
                                            <i class="bx bx-chevrons-up"></i
                                        ></b>
                                    </button>
                                </center>
                            </form>
                        </div>
                    </div>
                    <div class="col-3"></div>
    
                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Deposit History</h2>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>
