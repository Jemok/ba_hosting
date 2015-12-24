@if(Auth::check())
<?php
$count = $innovations->count();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-success label-pill {{$cssClass}}">{!! $count !!}</span>
@endif