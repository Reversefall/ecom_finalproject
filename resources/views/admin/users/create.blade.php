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
                                <a th:href="@{/admin/dashboard}">Trang quản trị</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý Tài Khoản
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Employee Form -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Thêm Tài Khoản</h4>
                </div>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="form">
                @csrf

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="username">Tên đăng nhập</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Nhập họ tên" value="{{ old('username') }}">

                        @error('username')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="full_name">Họ tên</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            placeholder="Nhập họ tên" value="{{ old('full_name') }}">

                        @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Nhập email" value="{{ old('email') }}">

                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                 <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="phone_number">Số điện thoại</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            placeholder="Nhập số điện thoại" value="{{ old('phone_number') }}">

                        @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="password">Mật khẩu</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Nhập mật khẩu">

                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="role">Quyền</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="role" id="role" class="custom-select col-12">
                            <option disabled selected>-- Chọn quyền --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Người kiểm duyệt</option>
                            <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Người bán</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Khách hàng</option>
                        </select>

                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Lưu tài khoản</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
</div>
@endsection