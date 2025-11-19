@extends('admin.layouts.master')
@section('page-title', 'Cập nhật Tài Khoản')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Cập nhật Tài Khoản</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.users.index') }}">Quản lý Tài Khoản</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cập nhật
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Cập nhật Tài Khoản</h4>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form">
                @csrf

                {{-- Username --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tên đăng nhập</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="username" class="form-control"
                            value="{{ old('username', $user->username) }}">

                        @error('username')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Full name --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Họ tên</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="full_name" class="form-control"
                            value="{{ old('full_name', $user->full_name) }}">

                        @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email) }}">

                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Phone number --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="phone_number" class="form-control"
                            value="{{ old('phone_number', $user->phone_number) }}">

                        @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Role --}}
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Quyền</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="role" class="custom-select col-12">
                            <option disabled>-- Chọn quyền --</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="moderator" {{ old('role', $user->role) == 'moderator' ? 'selected' : '' }}>Người kiểm duyệt</option>
                            <option value="seller" {{ old('role', $user->role) == 'seller' ? 'selected' : '' }}>Người bán</option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Khách hàng</option>
                        </select>

                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection