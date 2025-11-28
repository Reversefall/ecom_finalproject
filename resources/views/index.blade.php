@extends('user.layouts.master')
@section('page-title', 'Main Page')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Main Page</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Main Page
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="product-wrap">
            <div class="product-list">
                <ul class="row">

                    @foreach ($products as $product)
                    <li class="col-lg-4 col-md-6 col-sm-12">
                        <div class="product-box">
                            <div class="producct-img">
                                <img
                                    src="{{ $product->images->first()->image_url ?? asset('assets_admin/vendors/images/no-image.png') }}"
                                    alt="{{ $product->product_name }}">
                            </div>

                            <div class="product-caption">
                                <h4><a href="#">{{ $product->product_name }}</a></h4>

                                <div class="price">
                                    {{ number_format($product->price, 0, ',', '.') }} ₫
                                </div>

                                <a href="{{ route('products.detail', $product->product_id) }}" class="btn btn-outline-primary">
                                    More Details
                                </a>

                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
</div>
@endsection