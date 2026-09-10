<x-dash-layout>
    <x-slot:title>Profile</x-slot:title>

    <div class="content-wrap">
        <!-- top row -->
        <x-topbar />

        <!-- #### dashboard main content #### -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="row mx-3">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="alert alert-success text-center">
                            <a href="https://youtube.com/shorts/-plsg2BuGDY?feature=share"
                                >How to Verify Your coindoog Account, Watch This Youtube Tutorial
                                <b><u>Click Here</u></b></a
                            >
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-12">
                        <div class="common_card">
                            <h2 class="section_title">Verified Account</h2>
                            <hr />
                            <label for="old-password" class="mb-2">Verification Code</label>
                            <div class="refer-wrap">
                                <input class="form-input" id="refer-code" type="text" value="RLBWAHG4" readonly="" />
                                <a class="refer-copy-btn"> Copy </a>
                            </div>
                            <hr />
                            <p class="text-center"><b>Follow Step For Verify Account</b></p>
                            <hr />
                            <ol style="line-height: 29px">
                                <li>Open Telegram Bot <a href="" target="_blank">@</a></li>
                                <li>Start bot with command <code>/start</code></li>
                                <li>Enter your verification code.</li>
                                <li>Now your account successfully verified.</li>
                            </ol>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-12">
                        <div class="common_card">
                            <h2 class="section_title">Change Password</h2>
                            <hr />
                            <form action="/account/update_password" method="POST">
                                <div class="form-group">
                                    <label for="old-password" class="mb-2">Old Password</label>
                                    <input
                                        type="password"
                                        class="form-input mb-4"
                                        id="old-password"
                                        name="old_password"
                                        required=""
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="new-password" class="mb-2">New Password</label>
                                    <input
                                        type="password"
                                        class="form-input mb-4"
                                        id="new-password"
                                        name="password"
                                        required=""
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="confirm-new-password" class="mb-2">Confirm New Password</label>
                                    <input
                                        type="password"
                                        class="form-input mb-4"
                                        id="confirm-new-password"
                                        name="confirm_password"
                                        required=""
                                    />
                                </div>
                                <input type="hidden" name="ci_csrf_token" value="" />
                                <button type="submit" class="btn btn_primary" style="width: -webkit-fill-available">
                                    Change Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    // copy referral
                    const copyBtn = document.querySelector(".refer-copy-btn");
                    const copyTxt = document.querySelector("#refer-code");

                    copyBtn.addEventListener("click", () => {
                        copyTxt.select();
                        copyTxt.setSelectionRange(0, 99999);

                        navigator.clipboard.writeText(copyTxt.value);

                        console.log(copyTxt.value);

                        Swal.fire("Copied", "", "success");
                    });
                </script>
            </div>
        </div>
    </div>

</x-dash-layout>
