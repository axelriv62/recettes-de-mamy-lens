<!-- resources/views/components/message-info.blade.php -->
<div class="msg-info {{ $type }}">
    <div class="msg-icon">
        @if($type == 'primary')
            ✅
        @elseif($type == 'warning')
            ⚠️
        @else
            ❗️
        @endif
    </div>
    <div class="msg-message {{ $type }}">
        {{ $message }}
    </div>
</div>
