<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('admin.dashboard') }}">
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
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-fill"></span>
                        <span class="mtext">Accounts</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.users.index') }}">List</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Add</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-receipt"></span>
                        <span class="mtext">Orders</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.orders.index') }}">List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
