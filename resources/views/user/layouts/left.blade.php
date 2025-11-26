<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
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
                    <a href="/" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-compass"></span>
                        <span class="mtext">Khám phá</span>
                    </a>
                </li>

                <li>
                    <a href="/groups" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-file-text"></span>
                        <span class="mtext">Nhóm mua</span>
                    </a>
                </li>

                <li>
                    <a href="/posts" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-badge"></span>
                        <span class="mtext">Người bán</span>
                    </a>
                </li>
                @if (Auth::check())
                <li>
                    <a href="/user/groups" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-people"></span>
                        <span class="mtext">Nhóm của tôi</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>