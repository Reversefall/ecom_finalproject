@extends('admin.layouts.master')
@section('page-title', 'Order Management')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Order Management</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Order Management
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    @if(session('updateStatus'))
    <div class="alert alert-success">Status updated successfully!</div>
    @endif

    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Order List</h4>
        </div>

        <div class="pb-20">
            <table class="data-table table stripe hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $o)
                    <tr>
                        <td>#{{ $o->order_id }}</td>
                        <td>{{ $o->order_date }}</td>
                        <td>{{ $o->full_name }}</td>
                        <td>{{ $o->phone }}</td>
                        <td>{{ number_format($o->total_amount) }} VND</td>

                        <td>
                            <select class="form-control status-select" data-id="{{ $o->order_id }}">
                                <option value="pending" {{ $o->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $o->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $o->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $o->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.detail', $o->order_id) }}" class="btn btn-sm btn-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            autoWidth: false
        });

        $('.dropdown-toggle').dropdown();

        $('.status-select').on('change', function() {
            let selectEl = $(this);
            let orderId = selectEl.data('id');
            let status = selectEl.val();

            Swal.fire({
                title: "Confirm",
                text: "Are you sure you want to change the order status?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, update",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.orders.update-status') }}",
                        method: "POST",
                        data: {
                            order_id: orderId,
                            status: status,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Status updated successfully!",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Unable to update the status!",
                            });

                            selectEl.val(selectEl.data('old'));
                        }
                    });

                } else {
                    selectEl.val(selectEl.data('old'));
                }
            });

        }).each(function() {
            $(this).data('old', $(this).val());
        });

    });
</script>
@endsection
