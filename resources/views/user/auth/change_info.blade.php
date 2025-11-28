@extends('user.layouts.master')
@section('page-title', 'Update Infomation')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Update Infomation</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Infomation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p text-center">
                    <div class="profile-photo">
                        <img src="{{ $user->avatar ?? asset('assets_admin/vendors/images/photo1.jpg') }}"
                            alt="avatar" class="avatar-photo mb-2" />
                    </div>
                    <br>
                    <h5 class="h5 mb-0">{{ $user->full_name }}</h5>
                    <p class="text-muted font-14">{{ $user->username }}</p>
                </div>
            </div>

            <!-- Bên phải: Form cập nhật -->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <h5 class="h5 text-blue mb-20">Infomation</h5>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('user.auth.updateInfo') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Avatar</label>
                            <input type="file" name="avatar" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection