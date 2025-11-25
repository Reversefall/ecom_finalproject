@extends('seller.layouts.master')
@section('page-title', 'Cập nhật Sản phẩm')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <!-- Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Cập nhật Sản phẩm</h4>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">Trang người bán</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cập nhật Sản phẩm
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="pd-20 card-box mb-30">
            <h4 class="text-blue h4 mb-3">Cập nhật thông tin sản phẩm</h4>

            <form action="{{ route('seller.products.update', $product->product_id) }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tên -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Tên sản phẩm</label>
                    <div class="col-md-10">
                        <input type="text"
                            name="product_name"
                            class="form-control"
                            value="{{ old('product_name', $product->product_name) }}">

                        @error('product_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Danh mục -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Danh mục</label>
                    <div class="col-md-10">
                        <select class="custom-select col-12" name="category_id">
                            @foreach($categories as $cate)
                            <option value="{{ $cate->category_id }}"
                                {{ $product->category_id == $cate->category_id ? 'selected' : '' }}>
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
                    <label class="col-md-2 col-form-label">Giá</label>
                    <div class="col-md-10">
                        <input type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price', $product->price) }}">

                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Số lượng -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Số lượng</label>
                    <div class="col-md-10">
                        <input type="number"
                            name="current_quantity"
                            class="form-control"
                            value="{{ old('current_quantity', $product->current_quantity) }}">

                        @error('current_quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ảnh hiện tại -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Ảnh hiện tại</label>
                    <div class="col-md-10">
                        @if($product->images->count() > 0)
                        <div class="row">
                            @foreach($product->images as $img)
                            <div class="col-3 mb-3 text-center position-relative" id="image-{{ $img->image_id }}">
                                <img src="{{ asset($img->image_url) }}"
                                    class="img-thumbnail"
                                    style="height:120px; object-fit:cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute"
                                    style="top:5px; right:5px;"
                                    onclick="deleteImage({{ $img->image_id }})">
                                    &times;
                                </button>
                            </div>

                            @endforeach
                        </div>
                        @else
                        <p class="text-muted">Chưa có ảnh</p>
                        @endif
                    </div>
                </div>


                <!-- Upload ảnh mới -->
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Thêm ảnh mới</label>
                    <div class="col-md-10">
                        <input type="file" name="images[]" class="form-control" multiple>

                        @error('images.*')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="form-group row">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('seller.products.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteImage(imageId) {
        if (!confirm('Bạn có chắc muốn xóa ảnh này?')) return;

        fetch(`/seller/products/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Xóa thất bại');
                return response.json();
            })
            .then(data => {
                alert(data.message);
                document.getElementById(`image-${imageId}`).remove();
            })
            .catch(error => {
                alert(error.message);
            });
    }
</script>
@endsection