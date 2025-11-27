@extends('user.layouts.master')
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
                                <a href="/">Main Page</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Group Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @php
        $memberCount = $group->members->count() - 1;
        $baseDiscount = 10;
        $additionalDiscount = floor($memberCount / 5) * 2; 
        $discount = $baseDiscount + $additionalDiscount;
        if ($discount > 50) $discount = 50; 
        @endphp


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
                                <p><strong>Creator</strong> {{ $group->creator->full_name ?? 'No One' }}</p>
                                <p><strong>Current Discount :</strong> {{ $discount }}%</p>

                                <p><strong>Status</strong> {{ ucfirst($group->status) }}</p>
                                <p>{{ $group->description }}</p>

                                <h4 class="mb-10">Rule and Benefit for Group Buying</h4>

                                <p>
                                    ining a group purchase helps you save costs, take advantage of supplier promotions, and also creates opportunities to connect with people who have similar needs. 
                                    Below are the detailed rules and benefits:
                                </p>

                               <h5 class="mb-10">1. General Rules for Joining a Group</h5>
                                <ul>
                                    <li>Each group purchase will have a creator and participating members.</li>
                                    <li>Members must register to join the group before the group’s deadline.</li>
                                    <li>Each member commits to purchasing the quantity of products they registered for and cannot change it arbitrarily.</li>
                                    <li>The group will only be confirmed as completed when it reaches the minimum required quantity for the promotion.</li>
                                    <li>The group status will be continuously updated: <strong>pending</strong> (insufficient members), <strong>processing</strong> (in progress), <strong>completed</strong> (completed), <strong>cancelled</strong> (cancelled).</li>
                                </ul>

                                <h5 class="mb-10">2. Benefits of Joining</h5>
                                <ul>
                                    <li>Save costs thanks to the special group-purchase pricing.</li>
                                    <li>Receive discounts based on the number of participants:</li>
                                    <ul>
                                        <li>5 participants → 10% off</li>
                                        <li>10 participants → 12% off</li>
                                        <li>Every additional 5 participants → an extra 2% off</li>
                                    </ul>
                                    <li>Have the opportunity to connect and interact with others purchasing the same product.</li>
                                    <li>Receive special promotions or gifts from the supplier if the group meets the required conditions.</li>
                                    <li>Transparent purchasing process, managed and monitored by the group creator.</li>
                                </ul>

                                <h5 class="mb-10">3. Notes When Participating</h5>
                                <ul>
                                    <li>Make sure the quantity you plan to purchase fits your needs before joining.</li>
                                    <li>Join on time so the group can reach the required number of participants to receive the discount.</li>
                                    <li>Avoid canceling your order after the group has been confirmed, as this may affect other members.</li>
                                </ul>

                                <p>
                                    By joining a group purchase, you not only save costs but also enjoy community benefits.
                                    Check out the currently open groups to choose the products and groups that best suit your needs!
                                </p>


                                @if($group->status !== 'processing')
                                <button class="btn btn-secondary" disabled>
                                    Group Has {{ $group->status }}
                                </button>
                                @else
                                @if($isMember)
                                <a href="{{ url('/user/groups/chat/'.$group->group_id) }}" class="btn btn-success">
                                    Join the chat
                                </a>
                                <form action="{{ url('/user/groups/leave/'.$group->group_id) }}"
                                    method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to leave this group?');">
                                    @csrf
                                    <button class="btn btn-danger">Leave the Group</button>
                                </form>
                                @else
                                <a href="{{ route('user.groups.join', $group->group_id) }}" class="btn btn-outline-primary">
                                    Join the Group
                                </a>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>


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
                                    <p class="mb-1">Price: <strong>{{ number_format($group->product->price) }} đ</strong></p>
                                    <p class="mb-1">List: {{ $group->product->category->category_name ?? 'Không có' }}</p>
                                    <p class="mb-1">Seller: <a href="{{ url('/sellers/'.$group->product->seller->id ?? '#') }}">
                                            {{ $group->product->seller->full_name ?? 'Ẩn' }}
                                        </a></p>
                                    <p class="mb-1">Quantity: {{ $group->product->current_quantity }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="card-box mb-30">
                            <h5 class="pd-20 h5 mb-0">Related Groups</h5>
                            <div class="latest-post">
                                <ul>
                                    @foreach($relatedGroups as $rGroup)
                                    <li class="d-flex align-items-center mb-3">
                                        <div class="group-img mr-3">
                                            <a href="{{ url('/groups/'.$rGroup->group_id) }}">
                                                <img src="https://www.grep.sg/wp-content/uploads/2021/08/banner_groupbuy-2.png"
                                                    alt="{{ $rGroup->group_name }}"
                                                    style="width:60px; height:60px; object-fit:cover; border-radius:8px;">
                                            </a>
                                        </div>
                                        <div class="group-info">
                                            <h6 class="mb-1">
                                                <a href="{{ url('/groups/'.$rGroup->group_id) }}">
                                                    {{ $rGroup->group_name }}
                                                </a>
                                            </h6>
                                            <small>Creator : {{ $rGroup->creator->full_name ?? 'No One' }}</small>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection