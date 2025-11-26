<!DOCTYPE html>
<html lang="en" th:fragment="layout" xmlns:th="http://www.thymeleaf.org">

<head>
  <meta charset="utf-8" />
  <title>Dashboard</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets_admin/vendors/images/apple-touch-icon.png') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets_admin/vendors/images/favicon-32x32.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets_admin/vendors/images/favicon-16x16.png') }}" />

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/vendors/styles/core.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/vendors/styles/icon-font.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/vendors/styles/style.css') }}" />
</head>

<body class="login-page">
  <div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="brand-logo">
        <a href="/register">
          <img src="{{ asset('assets_admin/vendors/images/deskapp-logo.svg') }}" alt="" />
        </a>
      </div>
      <div class="login-menu">
        <ul>
          <li><a href="/register">Đăng ký tài khoản</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
          <img src="{{ asset('assets_admin/vendors/images/login-page-img.png') }}" alt="" />
        </div>
        <div class="col-md-6 col-lg-5">
          <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
              <h2 class="text-center text-primary">Đăng ký tài khoản</h2>
            </div>
            <form method="POST" action="{{ url('/register') }}">
              @csrf

              <div class="input-group custom">
                <input type="text" name="full_name" class="form-control form-control-lg" placeholder="Họ và tên" required />
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
              </div>

              <div class="input-group custom">
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Tên đăng nhập" required />
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
              </div>
              <div class="input-group custom">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required />
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-email"></i></span>
                </div>
              </div>

              <div class="input-group custom">
                <input type="text" name="phone_number" class="form-control form-control-lg" placeholder="Số điện thoại" required />
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-phone"></i></span>
                </div>
              </div>

              <div class="input-group custom">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required />
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
              </div>

              @if($errors->any())
              <div class="text-danger mb-2">
                {{ $errors->first() }}
              </div>
              @endif

              <div class="row">
                <div class="col-sm-12 mb-2">
                  <button class="btn btn-primary btn-lg btn-block">Đăng ký</button>
                </div>

                <!-- Nút quay về đăng nhập -->
                <div class="col-sm-12 text-center">
                  <a href="{{ url('/login') }}" class="text-primary">
                    Đã có tài khoản? Đăng nhập
                  </a>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="{{ asset('assets_admin/vendors/scripts/core.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/scripts/script.min.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/scripts/process.js') }}"></script>
  <script src="{{ asset('assets_admin/vendors/scripts/layout-settings.js') }}"></script>

  <script src="{{ asset('assets_admin/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets_admin/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets_admin/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets_admin/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>