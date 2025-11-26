@extends('user.layouts.master')
@section('page-title', 'Trang chủ')

@section('content')
<style>
    <style>.product-card {
        height: 336px;
        /* chiều cao tổng */
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .product-card img {
        height: 180px;
        /* ảnh cố định */
        object-fit: cover;
        border-radius: 6px;
        width: 100%;
    }

    .product-card .product-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-card h6 {
        font-size: 16px;
        font-weight: 600;
        margin-top: 8px;
        height: 40px;
        overflow: hidden;
    }

    .product-card p {
        margin-bottom: 4px;
    }

    .product-card .btn {
        margin-top: auto;
    }
</style>

</style>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Người bán
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <a
                            href="modal"
                            class="edit-avatar"><i class="fa fa-pencil"></i></a>
                        <img
                            src="{{ asset('assets_admin/vendors/images/photo1.jpg') }}"
                            alt=""
                            class="avatar-photo" />
                    </div>
                    <h5 class="text-center h5 mb-0">{{ $seller->full_name }}</h5>
                    <p class="text-center text-muted font-14">{{ $seller->username }}</p>

                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Thông tin liên hệ</h5>
                        <ul>
                            <li><span>Email:</span> {{ $seller->email }}</li>
                            <li><span>Phone Number:</span> {{ $seller->phone_number }}</li>
                            <li><span>Quốc gia:</span> Việt Nam</li>
                            <li><span>Địa chỉ:</span> {{ $seller->address ?? 'Chưa cập nhật' }}</li>
                        </ul>

                    </div>
                    <div class="profile-social">
                        <h5 class="mb-20 h5 text-blue">Mạng xã hội</h5>
                        <ul class="clearfix">
                            <li>
                                <a
                                    href="#"
                                    class="btn"
                                    data-bgcolor="#3b5998"
                                    data-color="#ffffff"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="btn"
                                    data-bgcolor="#1da1f2"
                                    data-color="#ffffff"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="btn"
                                    data-bgcolor="#f46f30"
                                    data-color="#ffffff"><i class="fa fa-instagram"></i></a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="btn"
                                    data-bgcolor="#db4437"
                                    data-color="#ffffff"><i class="fa fa-google-plus"></i></a>
                            </li>

                        </ul>
                    </div>
                    <div class="profile-skills">
                        <h5 class="mb-20 h5 text-blue">Thông Số</h5>
                        <h6 class="mb-5 font-14">Sản phẩm bán ra</h6>
                        <div class="progress mb-20" style="height: 6px">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $seller->products->count() * 10 }}%">
                            </div>
                        </div>
                        <h6 class="mb-5 font-14">Đơn hàng</h6>
                        <div class="progress mb-20" style="height: 6px">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 70%"
                                aria-valuenow="0"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        data-toggle="tab"
                                        href="#timeline"
                                        role="tab">Sản Phẩm Của Người Bán</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div
                                    class="tab-pane fade show active"
                                    id="timeline"
                                    role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row">
                                            @foreach($seller->products as $product)
                                            <div class="col-md-6 col-lg-4 mb-20">
                                                <div class="product-card p-3">

                                                    <img
                                                        src="{{ $product->images->first()->image_url ?? asset('no-image.png') }}"
                                                        class="img-fluid rounded mb-2" />

                                                    <div class="product-body">
                                                        <h6 class="mb-0">{{ $product->product_name }}</h6>

                                                        <p class="text-muted mb-2">{{ number_format($product->price) }}₫</p>

                                                        <p class="mt-2">
                                                            Số lượng hiện tại:
                                                            <strong>{{ $product->current_quantity }}</strong>
                                                        </p>

                                                        <a href="/products/{{ $product->product_id }}" class="btn btn-primary btn-sm">
                                                            Xem chi tiết
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        @if($seller->products->isEmpty())
                                        <p class="text-muted">Người bán chưa đăng sản phẩm nào.</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection