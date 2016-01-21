<!-- Displays a count of all posted innovations in Bongo Afrika -->

@if(Auth::check())
<?php
$count = $innovations->count();
$cssClass = $count == 0 ? 'hidden' : '';
?>
<span id="unread_messages" class="label label-info label-pill {{$cssClass}}">{!! $count !!}</span>
@endif