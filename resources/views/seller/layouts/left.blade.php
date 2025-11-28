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
                        <span class="micon fa fa-home"></span><span class="mtext">Home</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-box"></span>
                        <span class="mtext">Product Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('seller.products.index') }}">Product List</a></li>
                        <li><a href="{{ route('seller.products.create') }}">Add New</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-text"></span>
                        <span class="mtext">Group Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('seller.groups.index') }}">Group List</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-bag-check"></span>
                        <span class="mtext">Sold Products</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('seller.orders.index') }}">Order List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
