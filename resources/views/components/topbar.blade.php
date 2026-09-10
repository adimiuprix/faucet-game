<!-- top row -->
<div class="top-bar sticky-top">
    <div class="container-fluid">
        <div class="row px-3">
            <div class="col-12 bg">
                <div class="row">
                    <div class="col-2 col-sm-1">
                        <!-- ## hamburger icon ## -->
                        <div id="hideshow" href="#!" class="menu-toggle-btn">
                            <img
                                src="{{ asset('dash/img/menutoggle.svg') }}"
                                alt=""
                            />
                        </div>
                        <!-- ## hamburger icon responsive ## -->
                        <div id="hideshow-lg" href="#!" class="menu-toggle-btn lg">
                            <img
                                src="{{ asset('dash/img/menutoggle.svg') }}"
                                alt=""
                            />
                        </div>
                    </div>
                    <!-- top row cta -->
                    <div class="col-10 d-flex justify-content-end align-items-center">
                        <!-- ## User ID badge (for support) ## -->
                        <div
                            class="topbar_userid_badge"
                            title="Your User ID - mention this when contacting support"
                            style="
                                display: inline-flex;
                                align-items: center;
                                gap: 6px;
                                background: linear-gradient(90deg, #7b2ff7, #4f2bd6);
                                color: #fff;
                                font-weight: 700;
                                font-size: 14px;
                                padding: 6px 14px;
                                border-radius: 12px;
                                margin-right: auto;
                                box-shadow: 0 2px 8px rgba(123, 47, 247, 0.35);
                                white-space: nowrap;
                            "
                        >
                            <i class="fas fa-user"></i> User ID: {{ auth()->user()->unique_id ?? '0' }}
                        </div>

                        <div class="topbar_link_icon">
                            <a href="" target="_blank">
                                <img
                                    src="{{ asset('dash/img/white_tg.svg') }}"
                                    alt=""
                                />
                            </a>
                        </div>
                        <div class="topbar_link_icon">
                            <a href="" target="_blank">
                                <img
                                    src="{{ asset('dash/img/white_support.svg') }}"
                                    alt=""
                                />
                            </a>
                        </div>

                        <div class="theme-toggler ms-1">
                            <i class="fas fa-moon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>