<x-dash-layout>
    <!-- #### dashboard main content #### -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row section px-2">
                    <style>
                        .premium-box {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            gap: 15px;
                            border: 1px solid #f5c518;
                            background: rgba(245, 197, 24, 0.07);
                            border-radius: 12px;
                            padding: 15px 18px;
                            margin-top: 18px;
                        }
                        .premium-box_text h6 {
                            margin: 0 0 4px;
                            font-weight: 700;
                            font-size: 15px;
                            color: #fff;
                        }
                        .premium-box_text p {
                            margin: 0;
                            font-size: 12px;
                            opacity: 0.75;
                            color: #cfcfcf;
                        }
                        .premium-switch {
                            position: relative;
                            display: inline-block;
                            width: 54px;
                            height: 28px;
                            flex: 0 0 54px;
                            margin: 0;
                        }
                        .premium-switch input {
                            opacity: 0;
                            width: 0;
                            height: 0;
                        }
                        .premium-slider {
                            position: absolute;
                            cursor: pointer;
                            inset: 0;
                            background: #555;
                            border-radius: 28px;
                            transition: 0.3s;
                        }
                        .premium-slider:before {
                            content: "";
                            position: absolute;
                            height: 22px;
                            width: 22px;
                            left: 3px;
                            top: 3px;
                            background: #fff;
                            border-radius: 50%;
                            transition: 0.3s;
                        }
                        .premium-switch input:checked + .premium-slider {
                            background: #f5c518;
                        }
                        .premium-switch input:checked + .premium-slider:before {
                            transform: translateX(26px);
                        }
                        .total-cost-box {
                            border: 1px solid var(--purple, #7d3cff);
                            border-radius: 12px;
                            padding: 18px;
                            text-align: center;
                            margin-top: 18px;
                        }
                        .total-cost-box span {
                            display: block;
                            letter-spacing: 2px;
                            font-size: 12px;
                            opacity: 0.7;
                        }
                        .total-cost-box h3 {
                            margin: 6px 0 0;
                            font-weight: 800;
                            font-size: 28px;
                            color: #fff;
                        }
                        .pro-badge {
                            display: inline-block;
                            background: #f5c518;
                            color: #1a1a1a;
                            font-size: 10px;
                            font-weight: 800;
                            padding: 2px 8px;
                            border-radius: 10px;
                            line-height: 1.4;
                            vertical-align: middle;
                        }
                    </style>

                    <div class="col-12">
                        <div class="common_card">
                            <h2 class="section_title">Create ADS</h2>
                            <div class="alert alert-warning text-center">You Have 0.00$ In Deposit Balance</div>
                            
                            <form action="https://gamefaucet.fun/advertise/add" method="POST">
                                <div class="form-group">
                                    <label class="mb-2">Name</label>
                                    <input
                                        type="text"
                                        class="form-input mb-4"
                                        name="name"
                                        minlength="1"
                                        maxlength="75"
                                        autocomplete="off"
                                        required=""
                                    />
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">Description</label>
                                    <input
                                        type="text"
                                        class="form-input mb-4"
                                        name="description"
                                        minlength="1"
                                        maxlength="75"
                                        autocomplete="off"
                                        required=""
                                    />
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">Url</label>
                                    <input type="text" class="form-input mb-4" name="url" autocomplete="off" required="" />
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">Views</label>
                                    <input
                                        type="number"
                                        class="form-input mb-4"
                                        name="view"
                                        id="view"
                                        min="1000"
                                        autocomplete="off"
                                        required=""
                                    />
                                </div>

                                <div class="form-group">
                                    <label class="mb-2">Timer</label>
                                    <select class="form-input mb-4" name="option" required="">
                                        <option>Select Option</option>
                                        <option data-price="0.002500" value="17">
                                            60 seconds (0.002500 $ per view) | Minimum 1000 views
                                        </option>
                                        <option data-price="0.001500" value="16">
                                            30 seconds (0.001500 $ per view) | Minimum 1000 views
                                        </option>
                                        <option data-price="0.000800" value="15">
                                            15 seconds (0.000800 $ per view) | Minimum 1000 views
                                        </option>
                                        <option data-price="0.000400" value="14">
                                            7 seconds (0.000400 $ per view) | Minimum 1000 views
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="mb-2">Interval</label>
                                    <input
                                        type="range"
                                        name="time_interval"
                                        id="interval"
                                        class="form-range"
                                        value="24"
                                        min="1"
                                        max="24"
                                        style="width: 100%"
                                    />
                                    <small class="success_error" id="ptc_interval_error"
                                        >User can watch this ad once every 24 hours.</small
                                    >
                                </div>
                                <div class="premium-box" id="premium-box">
                                    <div class="premium-box_text">
                                        <h6>👑 Premium Highlight (+10%)</h6>
                                        <p>Promote your ad to the top of the list with a premium "PRO" badge.</p>
                                    </div>
                                    <label class="premium-switch">
                                        <input type="checkbox" id="premium" name="premium" value="1" />
                                        <span class="premium-slider"></span>
                                    </label>
                                </div>

                                <div class="total-cost-box">
                                    <span>TOTAL COST</span>
                                    <h3 id="total-cost">0.0000 $</h3>
                                </div>

                                <input type="hidden" name="ci_csrf_token" id="token" value="" />
                                <button type="submit" class="btn btn_primary mt-4" style="width: -webkit-fill-available">
                                    Create
                                </button>
                            </form>
                            
                        </div>
                    </div>

                </div>
            </div>

            <script>
                var site_url = "https://gamefaucet.fun/";

                $("#interval").change(function () {
                    var ptc_interval = $(this).val();
                    $("#ptc_interval_error").text("User can watch this ad once every " + ptc_interval + " hours.");
                });
            </script>

            <script>
                var PREMIUM_PERCENT = 10;

                function calcTotalCost() {
                    var views = parseFloat($("#view").val());
                    var price = parseFloat($("select[name='option'] option:selected").data("price"));
                    if (isNaN(views) || isNaN(price)) {
                        $("#total-cost").text("0.0000 $");
                        return;
                    }
                    var cost = views * price;
                    if ($("#premium").is(":checked")) {
                        cost = cost * (1 + PREMIUM_PERCENT / 100);
                    }
                    $("#total-cost").text(cost.toFixed(4) + " $");
                }

                $(document).on("input change", "#view, select[name='option'], #premium", calcTotalCost);
                $(document).ready(calcTotalCost);
            </script>
        </div>
    </div>
</x-dash-layout>