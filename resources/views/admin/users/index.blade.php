@extends('admin.layouts.master')

@section('page-title', 'Quản lý Tài Khoản')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Quản lý Tài Khoản</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Quản trị</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý Tài Khoản
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        @if(session('add'))
        <div class="alert alert-success">Thêm thành công!</div>
        @endif

        @if(session('update'))
        <div class="alert alert-success">Cập nhật thành công!</div>
        @endif

        @if(session('updateStatus'))
        <div class="alert alert-success">Cập nhật trạng thái thành công!</div>
        @endif

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Quản lý Tài Khoản</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Quyền</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $emp)
                        <tr>
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->username }}</td>
                            <td>{{ strtoupper($emp->role) }}</td>
                            <td>{{ $emp->full_name }}</td>
                            <td>{{ $emp->phone_number }}</td>
                            <td>{{ $emp->email }}</td>

                            <td>
                                <label class="switch">
                                    <input
                                        type="checkbox"
                                        {{ $emp->status == 1 ? 'checked' : '' }}
                                        onclick="toggleStatus({{ $emp->id }})">
                                    <span class="slider round"></span>
                                </label>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('admin.users.edit', $emp->id) }}">
                                            <i class="dw dw-edit2"></i> Cập nhật
                                        </a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.dataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable().destroy();
        }

        $('.data-table').DataTable({
            responsive: true,
            autoWidth: false,
        });

        $('.dropdown-toggle').dropdown();
    });

    function toggleStatus(id) {
        window.location.href = '/admin/users/toggle-status/' + id;
    }
</script>
@endsection