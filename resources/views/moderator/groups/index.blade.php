@extends('moderator.layouts.master')

@section('page-title', 'Quản lý Nhóm Mua Chung')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Quản lý Nhóm Mua Chung</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('moderator.dashboard') }}">Quản trị</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý Nhóm Mua Chung
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if(session('updateStatus'))
        <div class="alert alert-success">
            {{ session('message') ?? 'Cập nhật trạng thái thành công!' }}
        </div>
        @endif

        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Danh sách nhóm</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover">
                    <thead>
                        <tr>
                            <th>ID nhóm</th>
                            <th>Người tạo</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng người</th>
                            <th>Tiêu đề nhóm</th>
                            <th>Trạng thái</th>
                            <th class="datatable no-sort">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->group_id }}</td>
                            <td>{{ $group->creator->full_name ?? 'Không có' }}</td>
                            <td>
                                @if($group->product)
                                <a href="{{ url('/products/' . $group->product->product_id) }}" target="_blank" style="display:flex; align-items:center;">
                                    @if($group->product->images->count() > 0)
                                    <img src="{{ asset($group->product->images->first()->image_url) }}"
                                        alt="{{ $group->product->product_name }}"
                                        style="height:40px; width:40px; object-fit:cover; margin-right:8px; border-radius:4px;">
                                    @endif
                                    <span>{{ $group->product->product_name }}</span>
                                </a>
                                @else
                                <span class="text-muted">Không có</span>
                                @endif
                            </td>
                            <td>{{ $group->members->count() }}</td>
                            <td>{{ $group->group_name }}</td>
                            <td>
                                <form action="{{ route('moderator.groups.updateStatus', $group->group_id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" {{ $group->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="processing" {{ $group->status == 'processing' ? 'selected' : '' }}>Đang thực hiện</option>
                                        <option value="completed" {{ $group->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ $group->status == 'cancelled' ? 'selected' : '' }}>Đã huỷ</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('moderator.groups.detail', $group->group_id) }}">
                                            <i class="dw dw-edit2"></i> Chi tiết
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
    });
</script>
@endsection