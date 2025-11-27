@extends('admin.layouts.master')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

        <div class="page-header mb-20">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h4 class="title">Chi tiết đơn hàng</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mb-3 ">
                        &larr; Quay lại
                    </a>
                </div>
            </div>
        </div>


        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Hóa đơn - Đơn hàng #{{ $order->order_id }}</h4>
                <p>Ngày đặt: {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</p>
                <p>Trạng thái: <strong>{{ ucfirst($order->status) }}</strong></p>
            </div>


            <div class="pd-20">
                <h5>Thông tin người nhận</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Họ tên</th>
                        <td>{{ $order->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <th>Điện thoại</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Chi tiết sản phẩm</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Giảm giá</th>
                            <th>Giá sau giảm</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order->details as $detail)
                        @php
                        $product = $detail->product;
                        $discount = $detail->discount ?? 0;
                        $priceAfterDiscount = $detail->unit_price * (1 - $discount / 100);
                        $rowTotal = $priceAfterDiscount * $detail->quantity;
                        $total += $rowTotal;
                        @endphp
                        <tr>
                            <td>
                                @if($product && $product->images->count())
                                <img src="{{ asset($product->images->first()->image_url) }}" style="height:50px; object-fit:cover;">
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $product->product_name ?? 'Sản phẩm đã xóa' }}</td>
                            <td>{{ number_format($detail->unit_price) }} đ</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $discount }}%</td>
                            <td>{{ number_format($priceAfterDiscount) }} đ</td>
                            <td>{{ number_format($rowTotal) }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right mt-3">
                    <h5>Tổng cộng: {{ number_format($total) }} đ</h5>
                </div>

                @if($order->payments->count())
                <h5 class="mt-4">Thanh toán đã thực hiện</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ngày</th>
                            <th>Số tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->payments as $payment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($payment->amount_paid) }} đ</td>
                            <td>{{ ucfirst($payment->payment_status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection