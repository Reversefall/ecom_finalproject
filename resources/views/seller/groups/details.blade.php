@extends('seller.layouts.master')
@section('page-title', 'Chi tiết nhóm')

@section('content')
<style>
    /* Card chung */
    .card-box {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 15px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .card-box:hover {
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    /* Tiêu đề card */
    .card-box h5 {
        font-size: 18px;
        font-weight: 600;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    /* Sản phẩm liên quan */
    .related-product {
        text-align: center;
        transition: transform 0.3s ease;
    }

    .related-product:hover {
        transform: translateY(-5px);
    }

    .related-product img {
        border-radius: 8px;
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .related-product img:hover {
        transform: scale(1.05);
    }

    .related-product p {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin: 0;
        text-align: center;
    }

    /* Các nhóm liên quan */
    .latest-post ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .latest-post li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s ease;
    }

    .latest-post li:last-child {
        border-bottom: none;
    }

    .latest-post li:hover {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding-left: 5px;
    }

    .latest-post h4 a {
        font-size: 15px;
        font-weight: 500;
        color: #007bff;
        text-decoration: none;
        display: block;
    }

    .latest-post h4 a:hover {
        text-decoration: underline;
    }

    .latest-post span {
        font-size: 12px;
        color: #6c757d;
        display: block;
        margin-top: 3px;
    }
</style>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Chi tiết nhóm</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Trang chủ</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chi tiết nhóm
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="blog-wrap">
            <div class="container pd-0">
                <div class="row">
                    <!-- Nội dung nhóm -->
                    <div class="col-md-8 col-sm-12">
                        <div class="blog-detail card-box overflow-hidden mb-30">
                            <div class="blog-img">
                                <img src="https://www.grep.sg/wp-content/uploads/2021/08/banner_groupbuy-2.png" alt="" />
                            </div>

                            <div class="blog-caption">
                                <h4 class="mb-10">{{ $group->group_name }}</h4>
                                <p><strong>Người tạo:</strong> {{ $group->creator->full_name ?? 'Không có' }}</p>
                                <p><strong>Trạng thái:</strong> {{ ucfirst($group->status) }}</p>
                                <p>{{ $group->description }}</p>

                                <h4 class="mb-10">Quy Tắc và Lợi Ích Khi Tham Gia Nhóm Mua Chung</h4>

                                <p>
                                    Tham gia nhóm mua chung giúp bạn tiết kiệm chi phí, tận dụng khuyến mãi từ nhà cung cấp,
                                    và đồng thời tạo cơ hội kết nối với những người có cùng nhu cầu. Dưới đây là các quy tắc và lợi ích chi tiết:
                                </p>

                                <h5 class="mb-10">1. Quy tắc chung khi tham gia nhóm</h5>
                                <ul>
                                    <li>Mỗi nhóm mua chung sẽ có người tạo nhóm (creator) và các thành viên tham gia.</li>
                                    <li>Thành viên cần đăng ký tham gia nhóm trước khi hết hạn nhóm (deadline).</li>
                                    <li>Mỗi thành viên cam kết mua số lượng sản phẩm đã đăng ký, không được thay đổi tùy tiện.</li>
                                    <li>Nhóm chỉ được xác nhận hoàn tất khi đạt số lượng tối thiểu quy định cho ưu đãi.</li>
                                    <li>Trạng thái nhóm sẽ được cập nhật liên tục: <strong>pending</strong> (chưa đủ thành viên), <strong>processing</strong> (đang giao dịch), <strong>completed</strong> (hoàn tất), <strong>cancelled</strong> (hủy).</li>
                                </ul>

                                <h5 class="mb-10">2. Lợi ích khi tham gia</h5>
                                <ul>
                                    <li>Tiết kiệm chi phí nhờ mức giá ưu đãi nhóm mua chung.</li>
                                    <li>Được giảm giá theo số lượng người tham gia:</li>
                                    <ul>
                                        <li>5 người tham gia → giảm 10%</li>
                                        <li>10 người tham gia → giảm 12%</li>
                                        <li>Mỗi 5 người tăng thêm → giảm thêm 2%</li>
                                    </ul>
                                    <li>Có cơ hội kết nối và giao lưu với những người cùng mua chung sản phẩm.</li>
                                    <li>Nhận được các khuyến mãi hoặc quà tặng đặc biệt từ nhà cung cấp nếu nhóm đủ điều kiện.</li>
                                    <li>Quy trình mua minh bạch, được quản lý và theo dõi bởi người tạo nhóm.</li>
                                </ul>

                                <h5 class="mb-10">3. Lưu ý khi tham gia</h5>
                                <ul>
                                    <li>Hãy chắc chắn số lượng mua phù hợp với nhu cầu của bạn trước khi tham gia.</li>
                                    <li>Tham gia đúng thời gian để nhóm đủ số lượng và nhận ưu đãi.</li>
                                    <li>Tránh hủy đơn sau khi nhóm đã xác nhận để không ảnh hưởng đến các thành viên khác.</li>
                                </ul>

                                <p>
                                    Khi tham gia nhóm mua chung, bạn vừa tiết kiệm chi phí vừa tận hưởng các quyền lợi cộng đồng.
                                    Hãy tham khảo các nhóm đang mở để lựa chọn sản phẩm và nhóm phù hợp với nhu cầu của bạn!
                                </p>

                                @if($group->status !== 'processing')
                                <button class="btn btn-secondary" disabled>
                                    Nhóm đã {{ $group->status }}
                                </button>
                                @else
                                <a href="{{ url('/seller/groups/chat/'.$group->group_id) }}" class="btn btn-success">
                                    Vào đoạn chat nhóm
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar các nhóm liên quan -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card-box mb-30">
                            <h5 class="mb-10">Sản phẩm</h5>
                            @if($group->product)
                            <div class="related-product mb-20 position-relative">
                                <a href="{{ url('/products/'.$group->product->product_id) }}">
                                    @if($group->product->images->count() > 0)
                                    <img src="{{ asset($group->product->images->first()->image_url) }}"
                                        alt="{{ $group->product->product_name }}" class="w-100" style="max-height:200px; object-fit:cover;">
                                    @else
                                    <img src="{{ asset('assets_admin/vendors/images/default-product.png') }}" alt="No image" class="w-100" style="max-height:200px; object-fit:cover;">
                                    @endif
                                </a>
                                <div class="product-badge position-absolute" style="top:10px; right:10px; background:#ff6b6b; color:white; border-radius:50%; width:30px; height:30px; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                                    {{ $group->members->count() }}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ url('/products/'.$group->product->product_id) }}">
                                        <h6>{{ $group->product->product_name }}</h6>
                                    </a>
                                    <p class="mb-1">Giá: <strong>{{ number_format($group->product->price) }} đ</strong></p>
                                    <p class="mb-1">Danh mục: {{ $group->product->category->category_name ?? 'Không có' }}</p>
                                    <p class="mb-1">Người bán: <a href="{{ url('/sellers/'.$group->product->seller->id ?? '#') }}">
                                            {{ $group->product->seller->full_name ?? 'Ẩn' }}
                                        </a></p>
                                    <p class="mb-1">Số lượng tồn: {{ $group->product->current_quantity }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection