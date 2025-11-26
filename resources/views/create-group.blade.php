@extends('user.layouts.master')
@section('page-title', 'Tạo Nhóm Mua Chung')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tạo nhóm Mua Chung</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <h4 class="text-blue h4">Tạo nhóm Mua Chung cho sản phẩm: {{ $product->product_name }}</h4>
            </div>

            <form action="{{ route('user.groups.store', ['product' => $product->product_id]) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Sản phẩm</label>
                    <div class="card p-3 mb-3" style="border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="{{ $product->images->first()->image_url ?? asset('no-image.png') }}"
                                    class="img-fluid rounded mb-2" style="max-height:120px; object-fit:cover;">
                            </div>

                            <div class="col-md-9">
                                <h5 class="mb-2">{{ $product->product_name }}</h5>
                                <p class="mb-1"><strong>Danh mục:</strong> {{ $product->category->category_name ?? 'Chưa có' }}</p>
                                <p class="mb-1"><strong>Giá:</strong> {{ number_format($product->price) }}₫</p>
                                <p class="mb-1"><strong>Số lượng hiện tại:</strong> {{ $product->current_quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Tên nhóm</label>
                    <input type="text" name="group_name" class="form-control"
                        placeholder="Nhập tên nhóm" value="{{ old('group_name', $product->product_name . ' - Nhóm Mua Chung') }}">
                    @error('group_name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="max_quantity">Số lượng tối đa cho nhóm</label>
                    <input type="number"
                        name="max_quantity"
                        id="max_quantity"
                        class="form-control"
                        value="{{ old('max_quantity', $product->current_quantity) }}"
                        min="1"
                        max="{{ $product->current_quantity }}"
                        placeholder="Nhập số lượng tối đa cho nhóm">
                    @error('max_quantity')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mô tả nhóm</label>
                    <textarea name="description" class="form-control" placeholder="Nhập mô tả nhóm">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Tạo nhóm</button>
                    <a href="{{ route('user.groups.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection