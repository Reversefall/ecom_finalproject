@extends('user.layouts.master')
@section('page-title', $product->product_name)

@section('content')
<style>
    .product-slide img {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 8px;
    }

    .product-slide-nav img {
        cursor: pointer;
        transition: transform 0.2s;
    }

    .product-slide-nav img:hover {
        transform: scale(1.1);
        border: 2px solid #007bff;
    }

    .product-box {
        position: relative;
        /* cần để badge vị trí tuyệt đối */
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
</style>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h4>{{ $product->product_name }}</h4>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active">{{ $product->product_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="product-detail-wrap mb-30">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card-box pd-20">
                        {{-- Main Slider --}}
                        <div class="product-slider">
                            @foreach($product->images as $image)
                            <div class="product-slide">
                                <img src="{{ asset($image->image_url) }}" alt="{{ $product->product_name }}" class="img-fluid rounded">
                            </div>
                            @endforeach
                        </div>

                        {{-- Thumbnail Nav --}}
                        <div class="product-slider-nav mt-2">
                            @foreach($product->images as $image)
                            <div class="product-slide-nav mr-2 mb-2">
                                <img src="{{ asset($image->image_url) }}" alt="{{ $product->product_name }}" class="img-thumbnail" style="width:60px; height:60px; object-fit:cover;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="product-detail-desc pd-20 card-box height-100-p">
                        <h4 class="mb-20 pt-20">{{ $product->product_name }}</h4>

                        <p>{{ $product->description ?? 'Không có mô tả cho sản phẩm này' }}</p>

                        <div class="price">
                            <ins>{{ number_format($product->price,0,',','.') }} ₫</ins>
                        </div>

                        <div class="mx-w-150">
                            <div class="form-group">
                                <label class="text-blue">Quantity</label>
                                <input type="number" value="1" class="form-control" name="quantity" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-6">
                                <a href="/user/group/create/{{ $product->product_id }}" class="btn btn-primary btn-block">Tạo Nhóm Mua Chung</a>
                            </div>
                            <div class="col-md-6 col-6">
                                <a href="/user/seller/{{ $product->seller_id }}" class="btn btn-outline-primary btn-block">Xem Người Bán</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <h4 class="mb-20">Các Nhóm Mua Chung Của Sản Phẩm Này</h4>

        @if($product->groups->count() > 0)
        <div class="product-list">
            <ul class="row">
                @foreach($product->groups as $group)
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img">
                            @if($product->images->count() > 0)
                            <img src="{{ asset($product->images->first()->image_url) }}" alt="{{ $product->product_name }}" />
                            @else
                            <img src="{{ asset('assets_admin/vendors/images/default-product.png') }}" alt="No image" />
                            @endif

                            <div class="members-count">
                                {{ $group->members->count() }}
                            </div>
                        </div>

                        <div class="product-caption">
                            <h4>
                                <a href="{{ url('/groups/detail/'.$group->group_id) }}">
                                    {{ $group->group_name }}
                                </a>
                            </h4>
                            <div class="price">
                                Người tạo: {{ $group->creator->full_name ?? 'Không có' }}
                            </div>
                            <a href="{{ url('/groups/detail/'.$group->group_id) }}" class="btn btn-outline-primary">Xem Nhóm</a>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
        </div>
        @else
        <p>Hiện chưa có nhóm mua chung cho sản phẩm này.</p>
        @endif
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.product-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            asNavFor: '.product-slider-nav'
        });

        $('.product-slider-nav').slick({
            slidesToShow: 4, // số thumbnail hiển thị cùng lúc
            slidesToScroll: 1,
            asNavFor: '.product-slider',
            focusOnSelect: true,
            arrows: false,
            dots: false
        });
    });
</script>

@endsection