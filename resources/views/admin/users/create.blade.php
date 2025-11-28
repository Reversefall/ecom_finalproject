@extends('admin.layouts.master')
@section('page-title', 'Account Management')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Account Management</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Account Management
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Add Account Form -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Add Account</h4>
                </div>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="form">
                @csrf

                <!-- Username -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="username">Username</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Enter username" value="{{ old('username') }}">

                        @error('username')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Full Name -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="full_name">Full Name</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            placeholder="Enter full name" value="{{ old('full_name') }}">

                        @error('full_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Enter email" value="{{ old('email') }}">

                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="phone_number">Phone Number</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            placeholder="Enter phone number" value="{{ old('phone_number') }}">

                        @error('phone_number')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="password">Password</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter password">

                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="role">Role</label>
                    <div class="col-sm-12 col-md-10">
                        <select name="role" id="role" class="custom-select col-12">
                            <option disabled selected>-- Select Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Customer</option>
                        </select>

                        @error('role')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Save Account</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
</div>
@endsection
