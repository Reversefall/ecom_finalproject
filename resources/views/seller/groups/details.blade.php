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
                        <h4>Group Details</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Group Details
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
                                <p><strong>Creator:</strong> {{ $group->creator->full_name ?? 'Not available' }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($group->status) }}</p>
                                <p>{{ $group->description }}</p>

                                <h4 class="mb-10">Rules and Benefits of Joining Group Buy</h4>

                                <p>
                                    Joining a group buy helps you save costs, take advantage of promotions from suppliers,
                                    and creates an opportunity to connect with like-minded people. Below are the detailed rules and benefits:
                                </p>

                                <h5 class="mb-10">1. General Rules for Joining the Group</h5>
                                <ul>
                                    <li>Each group buy has a group creator and participating members.</li>
                                    <li>Members must register before the group deadline.</li>
                                    <li>Each member commits to purchasing the specified quantity of products, which cannot be changed without prior agreement.</li>
                                    <li>The group will only be confirmed as completed when the minimum required number of members is reached for the discount.</li>
                                    <li>Group statuses are continuously updated: <strong>pending</strong> (not enough members), <strong>processing</strong> (ongoing transactions), <strong>completed</strong> (completed), <strong>cancelled</strong> (cancelled).</li>
                                </ul>

                                <h5 class="mb-10">2. Benefits of Joining</h5>
                                <ul>
                                    <li>Save costs with group buy discounts.</li>
                                    <li>Discounts based on the number of participants:</li>
                                    <ul>
                                        <li>5 participants → 10% discount</li>
                                        <li>10 participants → 12% discount</li>
                                        <li>Every additional 5 participants → additional 2% discount</li>
                                    </ul>
                                    <li>Opportunity to connect and socialize with people who are buying the same product.</li>
                                    <li>Receive promotions or special gifts from suppliers if the group meets the required conditions.</li>
                                    <li>The purchase process is transparent and managed by the group creator.</li>
                                </ul>

                                <h5 class="mb-10">3. Notes When Joining</h5>
                                <ul>
                                    <li>Make sure the quantity you purchase matches your needs before joining.</li>
                                    <li>Join on time so the group reaches the minimum number of members for the discount.</li>
                                    <li>Avoid canceling your order after the group is confirmed to avoid affecting other members.</li>
                                </ul>

                                <p>
                                    By joining a group buy, you not only save money but also enjoy the community benefits. Explore open groups to choose the products and groups that best meet your needs!
                                </p>

                                @if($group->status !== 'processing')
                                <button class="btn btn-secondary" disabled>
                                    The group is {{ $group->status }}
                                </button>
                                @else
                                <a href="{{ url('/seller/groups/chat/'.$group->group_id) }}" class="btn btn-success">
                                    Join the group chat
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar các nhóm liên quan -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card-box mb-30">
                            <h5 class="mb-10">Product</h5>
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