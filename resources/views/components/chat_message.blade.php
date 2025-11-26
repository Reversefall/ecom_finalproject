@php
$isMine = $msg->customer_id == auth()->id();
@endphp

<li class="clearfix {{ $isMine ? 'admin_chat' : '' }}">
  <span class="chat-img">
    <img src="{{ asset('assets_admin/vendors/images/chat-img2.jpg') }}" alt="">
  </span>
  <div class="chat-body clearfix">
    <p>{{ $msg->message_text }}</p>
    <div class="chat_time">{{ $msg->sent_at->format('H:i') }}</div>
  </div>
</li>