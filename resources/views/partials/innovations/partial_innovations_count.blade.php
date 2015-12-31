@if(Auth::check())
<?php
$count = $innovations_partial->count();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-info label-pill {{$cssClass}}">{!! $count !!}</span>
@endif