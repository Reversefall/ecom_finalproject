<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/vendors/styles/style.css') }}" />



    <style>
        /* Style cho toast container */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        /* Style cho mỗi toast */
        .toast {
            display: none;
            min-width: 200px;
            margin: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        /* Style cho thông báo thành công */
        .toast.success {
            background-color: #4CAF50;
        }

        /* Style cho thông báo lỗi */
        .toast.error {
            background-color: #f44336;
        }

        /* Style cho thông báo thông tin */
        .toast.info {
            background-color: #2196F3;
        }

        /* Hiển thị toast */
        .toast.show {
            display: block;
            opacity: 1;
        }

 
        .toast.hide {
            opacity: 0;
            transform: translateX(100%);
        }
    </style>
</head>

<body>
    @include('user.layouts.header')
    @include('user.layouts.left')
    @include('user.layouts.right')

    <script>
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @endif

        @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
        @endif

        @if(session('error'))
        toastr.error("{{ session('error') }}");
        @endif

        @if(session('info'))
        toastr.info("{{ session('info') }}");
        @endif
    </script>


    <div class="main-container">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- DeskApp core scripts --}}
    <script src="{{ asset('assets_admin/vendors/scripts/core.js') }}"></script><!--  -->
    <script src="{{ asset('assets_admin/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('assets_admin/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('assets_admin/vendors/scripts/layout-settings.js') }}"></script>

    {{-- DataTables --}}
    <script src="{{ asset('assets_admin/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @yield('scripts')

</body>

</html>