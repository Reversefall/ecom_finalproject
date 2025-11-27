@extends('seller.layouts.master')
@section('page-title', 'Trang chủ')

@section('content')

<style>
    .blog-img {
        position: relative;
    }

    .members-count {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #e74c3c;
        color: #fff;
        font-weight: bold;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        font-size: 0.9rem;
    }

    .badge {
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 12px;
    }
</style>
<div class="pd-ltr-20 height-100-p xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Nhóm của tôi</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Nhóm của tôi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="blog-wrap">
            <div class="container pd-0">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        @if($groups->count() > 0)
                        <div class="blog-list">
                            <ul>
                                @foreach($groups as $group)
                                <li>
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="blog-img position-relative">

                                                @if($group->product && $group->product->images->count() > 0)
                                                <img src="{{ asset($group->product->images->first()->image_url) }}"
                                                    alt="{{ $group->group_name }}" class="bg_img" />
                                                @else
                                                <img src="{{ asset('assets_admin/vendors/images/default-product.png') }}"
                                                    alt="No image" class="bg_img" />
                                                @endif

                                                <div class="members-count">
                                                    {{ $group->members->count() }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-md-12 col-sm-12">
                                            <div class="blog-caption">
                                                <h4>
                                                    <a href="{{ url('/seller/groups/detail/'.$group->group_id) }}">
                                                        {{ $group->group_name }}
                                                    </a>

                                                    {{-- Badge trạng thái --}}
                                                    @php
                                                    $badgeColors = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                    ];
                                                    @endphp

                                                    <span class="badge badge-{{ $badgeColors[$group->status] ?? 'secondary' }}">
                                                        {{ ucfirst($group->status) }}
                                                    </span>
                                                </h4>

                                                <div class="blog-by">
                                                    <p>
                                                        Người tạo: {{ $group->creator->full_name ?? 'Không có' }} <br>
                                                        {{ \Illuminate\Support\Str::limit($group->description, 150) }}
                                                    </p>

                                                    <div class="pt-10">
                                                        <a href="{{ url('/seller/groups/detail/'.$group->group_id) }}" class="btn btn-outline-primary">Chi Tiết</a>

                                                        @if($group->status == 'processing')
                                                        <a href="{{ url('/seller/groups/chat/'.$group->group_id) }}" class="btn btn-outline-success">
                                                            Chat
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-pagination">
                            <div class="btn-toolbar justify-content-center mb-15">
                                <div class="btn-group">
                                    {{ $groups->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                        @else
                        <p>Hiện chưa có nhóm mua chung nào.</p>
                        @endif
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card-box mb-30">
                            <h5 class="pd-20 h5 mb-0">Danh mục</h5>
                            <div class="list-group">
                                <a href="{{ url('/seller/groups') }}" class="list-group-item d-flex align-items-center justify-content-between {{ request('category') == '' ? 'active' : '' }}">
                                    Tất cả
                                    <span class="badge badge-primary badge-pill">{{ $groups->total() }}</span>
                                </a>
                                @foreach($categories as $category)
                                <a href="{{ url('/seller/groups?category='.$category->category_id) }}"
                                    class="list-group-item d-flex align-items-center justify-content-between {{ request('category') == $category->category_id ? 'active' : '' }}">
                                    {{ $category->category_name }}
                                    <span class="badge badge-primary badge-pill">{{ $category->group_count }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection