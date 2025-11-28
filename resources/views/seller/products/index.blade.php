@extends('seller.layouts.master')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 50px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        border-radius: 50%;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #4CAF50;
    }

    input:checked+.slider:before {
        transform: translateX(14px);
    }

    .table {
        width: 100%;
        table-layout: fixed;
    }

    .table th,
    .table td {
        word-wrap: break-word;
        white-space: nowrap;
    }
</style>
@section('page-title', 'Product Management')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Product Management</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('seller.dashboard') }}">Seller</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Product Management
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        @if(session('add'))
        <div class="alert alert-success">Added Successfully</div>
        @endif

        @if(session('update'))
        <div class="alert alert-success">Updated Successfully</div>
        @endif

        @if(session('updateStatus'))
        <div class="alert alert-success">Status Updated Successfully</div>
        @endif

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Product Management</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th> <!-- cột mới -->
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                    alt="Product Image"
                                    style="height:50px; object-fit:cover;">
                                @else
                                <span class="text-muted">Don't have</span>
                                @endif
                            </td>

                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name ?? 'None' }}</td>
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
                                            <i class="dw dw-edit2"></i> Update
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