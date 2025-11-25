<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('seller.dashboard') }}">
            <img src="{{ asset('assets_admin/vendors/images/logo-icon.png') }}" alt="" class="dark-logo" />
            <img src="{{ asset('assets_admin/vendors/images/logo-icon.png') }}" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('seller.dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-home"></span><span class="mtext">Trang chủ</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-box"></span>
                        <span class="mtext">Quản lý sản phẩm</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('seller.products.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('seller.products.create') }}">Thêm</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>