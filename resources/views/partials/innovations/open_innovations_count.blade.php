<!-- The partial for displaying the count of open innovations -->

@if(Auth::check())
<?php
$count = $innovations_open->count();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-success label-pill {{$cssClass}}">{!! $count !!}</span>
@endif