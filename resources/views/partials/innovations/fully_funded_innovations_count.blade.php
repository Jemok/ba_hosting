<!-- Displays a count for all funded innovations -->

@if(Auth::check())
<?php
$count = $innovations_fully->count();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-success label-pill {{$cssClass}}">{!! $count !!}</span>
@endif