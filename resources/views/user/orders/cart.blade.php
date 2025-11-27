@extends('user.layouts.master')

@section('page-title', 'My Cart')

@section('content')
<style>
    .total-wrapper {
        font-size: 1.1rem;
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-radius: 8px;
        min-width: 200px;
    }

    .form-control {
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .quantity {
        width: 70px;
        text-align: center;
    }

    table.data-table td,
    table.data-table th {
        vertical-align: middle;
    }

    #checkoutForm .row.mb-3>.col-md-6 {
        margin-bottom: 15px;
    }

    .data-table img {
        border-radius: 4px;
    }

    .btn-primary {
        border-radius: 6px;
        padding: 8px 20px;
    }

    .selectProduct {
        transform: scale(1.2);
        margin: 0 auto;
        display: block;
    }
</style>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>My Cart</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Main Page</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Order Infomation</h4>
            </div>

            <div class="pd-20">
                <form action="{{ route('user.cart.checkout') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="full_name">FullName</label>
                                <input type="text" name="full_name" id="full_name" class="form-control"
                                    required value="{{ old('full_name', Auth::user()->full_name) }}" style="padding:10px; border-radius:6px;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    required value="{{ old('email', Auth::user()->email) }}" style="padding:10px; border-radius:6px;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">PhoneNumber</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    required value="{{ old('phone', Auth::user()->phone_number) }}" style="padding:10px; border-radius:6px;">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required
                                    value="{{ old('address', Auth::user()->address ?? '') }}" style="padding:10px; border-radius:6px;">
                            </div>
                        </div>
                    </div>


                    <hr>

                    {{-- Table sản phẩm --}}
                    <table class="data-table table stripe hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Group</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Price after discount</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            @php
                            $product = $group->product;
                            if(!$product) continue;
                            $discountBase = 10;
                            $additionalDiscount = floor(($group->members->count()-1)/5)*2;
                            $discount = $discountBase + $additionalDiscount;
                            if($discount>50) $discount = 50;
                            $unitPrice = $product->price;
                            $finalPrice = $unitPrice * (1 - $discount/100);
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" class="selectProduct" name="products[{{ $product->product_id }}][selected]" value="1" data-price="{{ $finalPrice }}" checked>
                                </td>
                                <td>
                                    @if($product->images->count() > 0)
                                    <img src="{{ asset($product->images->first()->image_url) }}" alt="{{ $product->product_name }}" style="height:50px; object-fit:cover;">
                                    @else
                                    <span class="text-muted">Don't have</span>
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td><a href="{{ url('/groups/'.$group->group_id) }}">{{ $group->group_name }}</a></td>
                                <td>{{ number_format($unitPrice) }} đ</td>
                                <td>{{ $discount }}%</td>
                                <td class="finalPrice">{{ number_format($finalPrice) }} đ</td>
                                <td>
                                    <input type="number" name="products[{{ $product->product_id }}][quantity]" value="1" min="1" class="form-control quantity">
                                </td>
                                <td class="rowTotal">{{ number_format($finalPrice) }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 d-flex justify-content-end align-items-center">
                        <div class="total-wrapper mr-3">
                            <strong>Total : </strong>
                            <span id="totalPrice">0 đ</span>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 py-2">Confirm Order</button>
                    </div>
                </form>

                <script>
                    function updateTotal() {
                        let total = 0;
                        document.querySelectorAll('tbody tr').forEach(row => {
                            let checkbox = row.querySelector('.selectProduct');
                            let qtyInput = row.querySelector('.quantity');
                            let rowTotalCell = row.querySelector('.rowTotal');
                            let price = parseFloat(checkbox.dataset.price);
                            let qty = parseInt(qtyInput.value) || 0;

                            if (rowTotalCell) {
                                rowTotalCell.innerText = new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(price * qty);
                            }

                            if (checkbox.checked) {
                                total += price * qty;
                            }
                        });

                        document.getElementById('totalPrice').innerText = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(total);
                    }

                    document.querySelectorAll('.selectProduct, .quantity').forEach(el => {
                        el.addEventListener('change', updateTotal);
                    });

                    document.getElementById('selectAll').addEventListener('change', function() {
                        document.querySelectorAll('.selectProduct').forEach(el => {
                            el.checked = this.checked;
                        });
                        updateTotal();
                    });

                    updateTotal();
                </script>
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
    });
</script>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); 

        Swal.fire({
            title: 'Are you sure to place this order?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); 
            }
        });
    });
</script>
@endsection