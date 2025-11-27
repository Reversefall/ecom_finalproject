@extends('admin.layouts.master')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Quản lý Đơn Hàng</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Quản trị</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Quản lý Đơn Hàng
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
            <h4 class="text-blue h4">Danh sách đơn hàng</h4>
        </div>

        <div class="pb-20">
            <table class="data-table table stripe hover">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày tạo</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $o)
                    <tr>
                        <td>#{{ $o->order_id }}</td>
                        <td>{{ $o->order_date }}</td>
                        <td>{{ $o->full_name }}</td>
                        <td>{{ $o->phone }}</td>
                        <td>{{ number_format($o->total_amount) }} đ</td>

                        <td>
                            <select class="form-control status-select"
                                data-id="{{ $o->order_id }}">
                                <option value="pending" {{ $o->status == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                                <option value="processing" {{ $o->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="completed" {{ $o->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="canceled" {{ $o->status == 'canceled' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.detail', $o->order_id) }}"
                                class="btn btn-sm btn-primary">
                                Xem chi tiết
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
                title: "Xác nhận",
                text: "Bạn muốn thay đổi trạng thái đơn hàng?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Có, cập nhật",
                cancelButtonText: "Hủy",
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
                                title: "Thành công",
                                text: "Cập nhật trạng thái thành công!",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "Có lỗi xảy ra",
                                text: "Không thể cập nhật trạng thái!",
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