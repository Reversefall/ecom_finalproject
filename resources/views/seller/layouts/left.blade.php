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

                <li>
                    <a th:href="@{/admin/owner}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-car"></span><span class="mtext">Chủ xe</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-fill"></span><span class="mtext">Nhân viên</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/employee}">Danh sách</a></li>
                        <li><a th:href="@{/admin/employee/add}">Thêm</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-badge"></span><span class="mtext">Lễ tân</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/recep}">Danh sách</a></li>
                        <li><a th:href="@{/admin/recep/add}">Thêm</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-calendar-check"></span><span class="mtext">Ca làm</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/shift}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-newspaper"></span><span class="mtext">Blog</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/blog}">Danh sách</a></li>
                        <li><a th:href="@{/admin/blog/add}">Thêm</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-tools"></span><span class="mtext">Bộ phận xe</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/part}">Danh sách</a></li>
                        <li><a th:href="@{/admin/part/add}">Thêm</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-person-check"></span><span class="mtext">Dịch vụ</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/service}">Danh sách</a></li>
                        <li><a th:href="@{/admin/service/add}">Thêm</a></li>
                    </ul>
                </li>

                <li>
                    <a th:href="@{/admin/review}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-comments"></span><span class="mtext">Đánh giá</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-hdd-network"></span><span class="mtext">Logs hệ thống</span>
                    </a>
                    <ul class="submenu">
                        <li><a th:href="@{/admin/logs}">Danh sách</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>