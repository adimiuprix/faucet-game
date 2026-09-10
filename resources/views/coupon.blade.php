<x-dash-layout>
    <!-- #### dashboard main content #### -->
    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="mx-3 alert alert-success text-center">
                    Follow our channel for daily coupon code
                    <a href="{{ $telegramChannel }}" style="color: maroon"><b><u>Here</u></b></a>
                </div>
                <div class="row section px-2">
                    <div class="col-lg-3 d-flex justify-content-center text-center"></div>
                    <div class="col-lg-6">
                        <div class="common_card my-3 d-flex flex-column align-items-center">
                            <h2 class="section_title text-center mb-4">Daily coupon</h2>
                            <div style="width: 100%">
                                <form action="{{ route('coupon.redeem') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-2" style="float: inline-start">Select Currency</label>
                                        <select name="currency" class="form-input mb-4">
                                            @foreach($currency as $currency)
                                                <option value="{{ $currency }}">{{ $currency }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" style="float: inline-start">Coupon Code</label>
                                        <input
                                            type="text"
                                            class="form-input mb-4"
                                            name="code"
                                            placeholder="Enter your coupon code"
                                            autocomplete="off"
                                        />
                                    </div>

                                    <button type="submit" class="btn btn_primary" style="width: -webkit-fill-available">
                                        Redeem
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>