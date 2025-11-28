@extends('seller.layouts.master')
@section('page-title', 'Group Details')

@section('content')
<style>
    /* Common card style */
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

    /* Card title */
    .card-box h5 {
        font-size: 18px;
        font-weight: 600;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    /* Related products */
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

    /* Related groups */
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
                    <!-- Group Content -->
                    <div class="col-md-8 col-sm-12">
                        <div class="blog-detail card-box overflow-hidden mb-30">
                            <div class="blog-img">
                                <img src="https://www.grep.sg/wp-content/uploads/2021/08/banner_groupbuy-2.png" alt="" />
                            </div>

                            <div class="blog-caption">
                                <h4 class="mb-10">{{ $group->group_name }}</h4>
                                <p><strong>Created By:</strong> {{ $group->creator->full_name ?? 'Not available' }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($group->status) }}</p>
                                <p>{{ $group->description }}</p>

                                <h4 class="mb-10">Rules and Benefits of Joining a Group Purchase</h4>

                                <p>
                                    Joining a group purchase helps you save costs, take advantage of discounts from suppliers, and create opportunities to connect with like-minded people. Below are the detailed rules and benefits:
                                </p>

                                <h5 class="mb-10">1. General Rules for Joining a Group</h5>
                                <ul>
                                    <li>Each group purchase will have a group creator and participating members.</li>
                                    <li>Members need to register to join the group before the deadline.</li>
                                    <li>Each member commits to purchasing the number of products they have registered for and cannot change it arbitrarily.</li>
                                    <li>The group will only be confirmed as completed when the minimum required number for the discount is reached.</li>
                                    <li>The status of the group will be updated continuously: <strong>pending</strong> (not enough members), <strong>processing</strong> (in progress), <strong>completed</strong> (completed), <strong>cancelled</strong> (cancelled).</li>
                                </ul>

                                <h5 class="mb-10">2. Benefits of Joining</h5>
                                <ul>
                                    <li>Save costs with group purchase discounts.</li>
                                    <li>Get discounts based on the number of participants:</li>
                                    <ul>
                                        <li>5 participants → 10% discount</li>
                                        <li>10 participants → 12% discount</li>
                                        <li>Each additional 5 participants → an extra 2% discount</li>
                                    </ul>
                                    <li>Opportunities to connect and interact with other people joining the group purchase.</li>
                                    <li>Receive special promotions or gifts from the supplier if the group meets the conditions.</li>
                                    <li>The purchase process is transparent, managed, and monitored by the group creator.</li>
                                </ul>

                                <h5 class="mb-10">3. Notes When Joining</h5>
                                <ul>
                                    <li>Make sure the quantity you purchase matches your needs before joining.</li>
                                    <li>Join within the correct time to ensure the group reaches the required number and the discount is applied.</li>
                                    <li>Avoid canceling orders after the group has been confirmed to prevent affecting other members.</li>
                                </ul>

                                <p>
