@extends('seller.layouts.master')
@section('page-title', 'Trang chủ')

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Chat</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bg-white border-radius-4 box-shadow mb-30">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="chat-list bg-light-gray">
                        <div class="chat-search">
                            <span class="ti-search"></span>
                            <input type="text" placeholder="Tìm kiếm" />
                        </div>
                        <div
                            class="notification-list chat-notification-list customscroll">
                            <ul>
                                @foreach($members as $m)
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('assets_admin/vendors/images/img.jpg') }}" alt="" />

                                        <h3 class="clearfix">{{ $m->customer->full_name ?? 'Không tên' }}</h3>

                                        <p>
                                            @if($m->isOnline)
                                            <i class="fa fa-circle text-light-green"></i> online
                                            @else
                                            <i class="fa fa-circle text-light-orange"></i> offline
                                            @endif
                                        </p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="chat-detail">
                        <a href="{{ url('/groups/' . $group->group_id) }}" class="w-100 d-block text-reset" style="text-decoration:none;">
                            <div class="chat-profile-header clearfix" style="cursor:pointer;">
                                <div class="left">
                                    <div class="clearfix">
                                        <div class="chat-profile-photo">
                                            <img src="{{ asset('assets_admin/vendors/images/profile-photo.jpg') }}" alt="" />
                                        </div>
                                        <div class="chat-profile-name">
                                            <h3>{{ $group->group_name }}</h3>
                                            <span>{{ $group->members->count() }} người tham gia</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="chat-box">
                            <div class="chat-desc customscroll">
                                <ul>
                                    @foreach($messages as $msg)
                                    @php
                                    $isMine = $msg->customer_id == Auth::id();
                                    @endphp

                                    <li class="clearfix {{ $isMine ? 'admin_chat' : '' }}">
                                        <span class="chat-img">
                                            <img src="{{ asset('assets_admin/vendors/images/chat-img' . ($isMine ? '2' : '1') . '.jpg') }}" alt="" />
                                        </span>

                                        <div class="chat-body clearfix">
                                            <strong style="font-size:13px; color:#555;">
                                                {{ $msg->customer->full_name ?? 'Không tên' }}
                                            </strong>
                                            <p>{{ $msg->message_text }}</p>
                                            <div class="chat_time">
                                                {{ \Carbon\Carbon::parse($msg->sent_at)->format('H:i d/m') }}
                                            </div>
                                        </div>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="chat-footer">
                                <div class="file-upload">
                                    <a href="#"><i class="fa fa-paperclip"></i></a>
                                </div>
                                <div class="chat_text_area">
                                    <textarea id="chat-message" placeholder="Nhập tin nhắn…"></textarea>
                                </div>

                                <div class="chat_send">
                                    <button class="btn btn-link" type="submit" id="send-btn">
                                        <i class="icon-copy ion-paper-airplane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $("#send-btn").click(function() {
        let msg = $("#chat-message").val().trim();
        let groupId = "{{ $group->group_id }}";

        if (msg === "") return;

        $.ajax({
            url: "/seller/groups/chat/" + groupId,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                message: msg
            },
            success: function(res) {
                if (res.success) {
                    $(".chat-desc ul").append(res.html);
                    $("#chat-message").val("");
                    $(".chat-desc").scrollTop($('.chat-desc')[0].scrollHeight);
                }
            }
        });
    });
</script>

@endsection