<div class="left-side-bar">
    <div class="brand-logo">
        <a th:href="@{/admin/dashboard}">
            <img th:src="@{/image/carcare.jpg}" alt="" class="dark-logo" />
            <img th:src="@{/image/carcare.jpg}" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a th:href="@{/admin/dashboard}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-home"></span><span class="mtext">Trang chủ</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-fill"></span>
                        <span class="mtext">Tài khoản</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Thêm</a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>