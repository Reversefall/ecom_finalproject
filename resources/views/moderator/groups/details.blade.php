@extends('moderator.layouts.master')

@section('page-title', 'Chi tiết Nhóm')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">

    <div class="page-header mb-3">
        <div class="title">
            <h4>Chi tiết Nhóm #{{ $group->group_id }}</h4>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('moderator.dashboard') }}">Quản trị</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('moderator.groups.index') }}">Quản lý Nhóm Mua Chung</a>
            </li>
            <li class="breadcrumb-item active">Chi tiết nhóm</li>
        </ol>
    </div>

    <div class="row">
        <!-- Thông tin nhóm -->
        <div class="col-md-6 mb-30">
            <div class="card-box p-3">
                <h5 class="text-primary mb-3">Thông tin nhóm</h5>

                <p><strong>Tiêu đề nhóm:</strong> {{ $group->group_name }}</p>
                <p><strong>Người tạo:</strong> {{ $group->creator->full_name }}</p>
                <p><strong>Mô tả:</strong> {{ $group->description }}</p>
                <p><strong>Số lượng tối đa:</strong> {{ $group->max_quantity }}</p>
                <p><strong>Trạng thái:</strong>
                    <span class="badge badge-info">{{ $group->status }}</span>
                </p>

                <p><strong>Ngày tạo:</strong> {{ $group->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Sản phẩm -->
        <div class="col-md-6 mb-30">
            <div class="card-box p-3">
                <h5 class="text-primary mb-3">Sản phẩm</h5>

                @if($group->product)
                <div style="display:flex;align-items:center;">
                    @if($group->product->images->count() > 0)
                    <img src="{{ asset($group->product->images->first()->image_url) }}"
                        style="width:80px;height:80px;object-fit:cover;border-radius:8px;margin-right:15px;">
                    @endif

                    <div>
                        <p class="mb-1">
                            <strong>{{ $group->product->product_name }}</strong>
                        </p>
                        <a href="{{ url('/products/' . $group->product->product_id) }}" target="_blank">
                            Xem sản phẩm
                        </a>
                    </div>
                </div>
                @else
                <p class="text-muted">Không có sản phẩm</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Danh sách thành viên -->
    <div class="card-box p-3">
        <h5 class="text-primary mb-3">Danh sách thành viên</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Ngày tham gia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->members as $member)
                <tr>
                    <td>{{ $member->customer->full_name ?? 'Không có' }}</td>
                    <td>{{ $member->customer->email ?? 'Không có' }}</td>
                    <td>{{ $member->joined_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($group->members->count() == 0)
        <p class="text-muted mt-2">Chưa có ai tham gia nhóm này.</p>
        @endif
    </div>
</div>
@endsection