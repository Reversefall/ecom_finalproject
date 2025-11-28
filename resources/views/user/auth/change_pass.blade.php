@extends('user.layouts.master')
@section('page-title', 'Change Password')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Change Password</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Side: User Info -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <a href="modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                        <img src="{{ asset('assets_admin/vendors/images/photo1.jpg') }}" alt=""
                            class="avatar-photo" />
                    </div>
                    <h5 class="text-center h5 mb-0">{{ $user->full_name }}</h5>
                    <p class="text-center text-muted font-14">{{ $user->username }}</p>

                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li><span>Email:</span> {{ $user->email }}</li>
                            <li><span>Phone Number:</span> {{ $user->phone_number }}</li>
                            <li><span>Country:</span> Vietnam</li>
                            <li><span>Address:</span> {{ $user->address ?? 'Not updated' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Side: Change Password Form -->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <h5 class="h5 text-blue mb-20">Change Password</h5>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('user.auth.updatePass') }}">
                        @csrf

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
