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
                                <a href="#" class="btn btn-primary btn-block">Đăng Tin Mua Chung</a>
                            </div>
                            <div class="col-md-6 col-6">
                                <a href="#" class="btn btn-outline-primary btn-block">Xem Người Bán</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <h4 class="mb-20">Các Tin Mua Chung Của Sản Phẩm Này</h4>
        <div class="product-list">
            <ul class="row">
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img">
                            <img src="vendors/images/product-img1.jpg" alt="" />
                        </div>
                        <div class="product-caption">
                            <h4><a href="#">Gufram Bounce Black</a></h4>
                            <div class="price"><del>$55.5</del><ins>$49.5</ins></div>
                            <a href="#" class="btn btn-outline-primary">Xem Tin</a>
                        </div>
                    </div>
                </li>
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img">
                            <img src="vendors/images/product-img2.jpg" alt="" />
                        </div>
                        <div class="product-caption">
                            <h4><a href="#">Gufram Bounce White</a></h4>
                            <div class="price"><del>$75.5</del><ins>$50</ins></div>
                            <a href="#" class="btn btn-outline-primary">Xem Tin</a>
                        </div>
                    </div>
                </li>
                <li class="col-lg-4 col-md-6 col-sm-12">
                    <div class="product-box">
                        <div class="producct-img">
                            <img src="vendors/images/product-img3.jpg" alt="" />
                        </div>
                        <div class="product-caption">
                            <h4><a href="#">Contrast Lace-Up Sneakers</a></h4>
                            <div class="price">
                                <ins>$80</ins>
                            </div>
                            <a href="#" class="btn btn-outline-primary">Xem Tin</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
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