<!--
<div class="media">
    <a class="pull-left" href="#">
        
    </a>
    <div class="media-body">
        <h5 class="media-heading">{!! $message->user->first_name !!} {!! $message->user->last_name !!}</h5>
    </div>
</div>
-->
@if(\Auth::user()->id == $message->user_id)
<li class="message left appeared">
    <div class="avatar">
        <img src="//www.gravatar.com/avatar/{!! md5($message->user->email) !!}?s=64" alt="{!! $message->user->first_name !!}">
    </div>
    <div class="text_wrapper">
        <div class="text">{!! $message->body !!}</div>
        <div class="text-muted">{!! $message->created_at->diffForHumans() !!}</div>
    </div>
</li>

@elseif(\Auth::user()->id != $message->user_id)
<li class="message right appeared">
    <div class="avatar">
        <img src="//www.gravatar.com/avatar/{!! md5($message->user->email) !!}?s=64" alt="{!! $message->user->first_name !!}">
    </div>
    <div class="text_wrapper">
        <div class="text">{!! $message->body !!}</div>
        <div class="text-muted">{!! $message->created_at->diffForHumans() !!}</div>
    </div>
</li>
@endif