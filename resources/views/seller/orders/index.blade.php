@extends('seller.layouts.master')

@section('page-title', 'Products Sold')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <div class="page-header">
            <h4>Products Sold</h4>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">List of Products Sold</h4>
            </div>

            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>PhoneNumber</th>
                            <th>Amount</th>
                            <th>Original Price</th>
                            <th>Discount(%)</th>
                            <th>Discounted Price</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($soldItems as $item)
                        @php
                        $price = $item->unit_price;
                        $discount = $item->discount ?? 0;
                        $finalPrice = $price - ($price * $discount / 100);
                        @endphp

                        <tr>
                            <td>
                                @if($item->product->images->first())
                                <img src="{{ asset($item->product->images->first()->image_url) }}"
                                    width="60" height="60" style="object-fit: cover;">
                                @else
                                <span>No Image</span>
                                @endif
                            </td>

                            <td>{{ $item->product->product_name }}</td>
                            <td>DH0{{ $item->order_id }}</td>
                            <td>{{ $item->order->full_name }}</td>
                            <td>{{ $item->order->phone }}</td>

                            <td>{{ $item->quantity }}</td>

                            <td>{{ number_format($price) }}đ</td>

                            <td>{{ $discount }}%</td>

                            <td>{{ number_format($finalPrice) }}đ</td>

                            <td class="text-primary font-weight-bold">
                                {{ number_format($finalPrice * $item->quantity) }}đ
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
</script>
@endsection