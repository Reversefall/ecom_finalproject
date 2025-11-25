@extends('seller.layouts.master')
@section('page-title', 'Thêm Sản phẩm')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Quản lý Sản phẩm</h4>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">Trang người bán</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Thêm Sản phẩm
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <h4 class="text-blue h4">Thêm Sản phẩm</h4>
            </div>

            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tên sản phẩm -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tên sản phẩm</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text"
                            name="product_name"
                            class="form-control"
                            placeholder="Nhập tên sản phẩm"
                            value="{{ old('product_name') }}">

                        @error('product_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Danh mục -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Danh mục</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="category_id">
                            <option disabled selected>-- Chọn danh mục --</option>

                            @foreach($categories as $cate)
                            <option value="{{ $cate->category_id }}"
                                {{ old('category_id') == $cate->category_id ? 'selected' : '' }}>
                                {{ $cate->category_name }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Giá -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Giá</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="number"
                            name="price"
                            class="form-control"
                            placeholder="Nhập giá"
                            value="{{ old('price') }}">

                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Số lượng -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Số lượng</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="number"
                            name="current_quantity"
                            class="form-control"
                            placeholder="Nhập số lượng"
                            value="{{ old('current_quantity') }}">

                        @error('current_quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Upload nhiều ảnh -->
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Ảnh sản phẩm</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="file" name="images[]" class="form-control" multiple>

                        @error('images.*')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                        <a href="{{ route('seller.products.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection