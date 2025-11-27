@extends('seller.layouts.master')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Quản lý đơn hàng</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">Quản trị</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý đơn hàng
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        @if(session('updateStatus'))
        <div class="alert alert-success">Cập nhật trạng thái thành công!</div>
        @endif

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Quản lý đơn hàng</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th> 
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>

                            <!-- Ảnh đầu tiên -->
                            <td>
                                @if($product->images->count() > 0)
                                <img src="{{ asset($product->images->first()->image_url) }}"
                                    alt="Ảnh sản phẩm"
                                    style="height:50px; object-fit:cover;">
                                @else
                                <span class="text-muted">Chưa có</span>
                                @endif
                            </td>

                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name ?? 'Không có' }}</td>
                            <td>{{ number_format($product->price) }} đ</td>
                            <td>{{ $product->current_quantity }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" {{ $product->status == 1 ? 'checked' : '' }}
                                        onclick="toggleStatus({{ $product->product_id }})">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('seller.products.edit', $product->product_id) }}">
                                            <i class="dw dw-edit2"></i> Cập nhật
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.dataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable().destroy();
        }

        $('.data-table').DataTable({
            responsive: true,
            autoWidth: false,
        });

        $('.dropdown-toggle').dropdown();
    });

    function toggleStatus(id) {
        window.location.href = '/seller/products/toggle-status/' + id;
    }
</script>
@endsection