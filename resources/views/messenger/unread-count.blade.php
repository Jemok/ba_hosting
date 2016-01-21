<!-- Counts all thread with unread messages -->

@if(Auth::check())
<?php
$count = Auth::user()->newMessagesCount();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-success label-pill {{$cssClass}}">{!! $count !!}</span>
@endif
