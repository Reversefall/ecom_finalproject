@extends('user.layouts.master')
@section('page-title', 'Lịch sử đơn hàng')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header mb-20">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h4 class="title">Order History</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Main Page</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Order History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Order List</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Buy Date</th>
                            <th>Name</th>
                            <th>PhoneNumber</th>
                            <th>Pricen</th>
                            <th>Status</th>
                            <th>Amount already paid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ number_format($order->total_amount) }} đ</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ number_format($order->payments->sum('amount_paid')) }} đ</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('user.orders.detail', $order->order_id) }}">
                                            <i class="dw dw-eye"></i> Details
                                        </a>
                                        <a href="#"
                                            class="dropdown-item text-success"
                                            data-toggle="modal"
                                            data-target="#paymentModal"
                                            data-order-id="{{ $order->order_id }}"
                                            data-max="{{ $order->total_amount - $order->payments->sum('amount_paid') }}">
                                            <i class="dw dw-credit-card"></i> Payment
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

<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('user.orders.payments.store') }}" method="POST" id="paymentForm">
            @csrf
            <input type="hidden" name="order_id" id="modal_order_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Order payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="amount_paid">Amount Payment (VND)</label>
                        <input type="number" class="form-control" name="amount_paid" id="modal_amount_paid" min="1" required>
                        <small class="form-text text-muted">Total Amount : <span id="maxAmountText"></span> đ</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </form>
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

<script>
    $('#paymentModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var orderId = button.data('order-id');
        var maxAmount = button.data('max');

        var modal = $(this);
        modal.find('#modal_order_id').val(orderId);
        modal.find('#modal_amount_paid').attr('max', maxAmount);
        modal.find('#maxAmountText').text(new Intl.NumberFormat('vi-VN').format(maxAmount));
    });
</script>

@endsection