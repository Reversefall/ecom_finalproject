@extends('admin.layouts.master')

@section('page-title', 'Group Details')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">

    <div class="page-header mb-3">
        <div class="title">
            <h4>Group Details #{{ $group->group_id }}</h4>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.groups.index') }}">Group Purchase Management</a>
            </li>
            <li class="breadcrumb-item active">Group Details</li>
        </ol>
    </div>

    <div class="row">
        <!-- Group Information -->
        <div class="col-md-6 mb-30">
            <div class="card-box p-3">
                <h5 class="text-primary mb-3">Group Information</h5>

                <p><strong>Group Title:</strong> {{ $group->group_name }}</p>
                <p><strong>Creator:</strong> {{ $group->creator->full_name }}</p>
                <p><strong>Description:</strong> {{ $group->description }}</p>
                <p><strong>Maximum Quantity:</strong> {{ $group->max_quantity }}</p>
                <p><strong>Status:</strong>
                    <span class="badge badge-info">{{ $group->status }}</span>
                </p>

                <p><strong>Created On:</strong> {{ $group->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Product -->
        <div class="col-md-6 mb-30">
            <div class="card-box p-3">
                <h5 class="text-primary mb-3">Product</h5>

                @if($group->product)
                <div style="display:flex;align-items:center;">
                    @if($group->product->images->count() > 0)
                    <img src="{{ asset($group->product->images->first()->image_url) }}"
                        style="width:80px;height:80px;object-fit:cover;border-radius:8px;margin-right:15px;">
                    @endif

                    <div>
                        <p class="mb-1">
                            <strong>{{ $group->product->product_name }}</strong>
                        </p>
                        <a href="{{ url('/products/' . $group->product->product_id) }}" target="_blank">
                            View Product
                        </a>
                    </div>
                </div>
                @else
                <p class="text-muted">No Product</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Member List -->
    <div class="card-box p-3">
        <h5 class="text-primary mb-3">Member List</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Date Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->members as $member)
                <tr>
                    <td>{{ $member->customer->full_name ?? 'N/A' }}</td>
                    <td>{{ $member->customer->email ?? 'N/A' }}</td>
                    <td>{{ $member->joined_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($group->members->count() == 0)
        <p class="text-muted mt-2">No one has joined this group yet.</p>
        @endif
    </div>
</div>
@endsection
