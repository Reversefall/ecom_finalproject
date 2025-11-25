<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Miễn phí vận chuyển cho đơn hàng trên 2.000.000đ
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Hỗ trợ & FAQs
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Tài khoản của tôi
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        VN
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        VND
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/images/icons/logo-01.png') }}" alt="Logo Web Mua Chung">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ url('/') }}">Trang chủ</a>
                        </li>

                        <li>
                            <a href="{{ url('/products') }}">Sản phẩm</a>
                        </li>

                        <li>
                            <a href="{{ url('/features') }}">Tính năng</a>
                        </li>

                        <li>
                            <a href="{{ url('/blog') }}">Blog</a>
                        </li>

                        <li>
                            <a href="{{ url('/about') }}">Giới thiệu</a>
                        </li>

                        <li>
                            <a href="{{ url('/contact') }}">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo mobile -->
        <div class="logo-mobile">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/icons/logo-01.png') }}" alt="Logo Web Mua Chung">
            </a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Miễn phí vận chuyển cho đơn hàng trên 2.000.000đ
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Hỗ trợ & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Tài khoản của tôi
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        VN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        VND
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ url('/') }}">Trang chủ</a>
            </li>

            <li>
                <a href="{{ url('/products') }}">Sản phẩm</a>
            </li>

            <li>
                <a href="{{ url('/features') }}">Tính năng</a>
            </li>

            <li>
                <a href="{{ url('/blog') }}">Blog</a>
            </li>

            <li>
                <a href="{{ url('/about') }}">Giới thiệu</a>
            </li>

            <li>
                <a href="{{ url('/contact') }}">Liên hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('assets/images/icons/icon-close2.png') }}" alt="Đóng">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Tìm kiếm sản phẩm...">
            </form>
        </div>
    </div>
</header>