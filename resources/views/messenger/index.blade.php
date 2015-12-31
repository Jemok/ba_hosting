@extends('layout')

@section('content')
<div class="chat__box">
    @if (Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {!! Session::get('error_message') !!}
    </div>
    @endif
    @if($threads->count() > 0)
    <div class="card-columns">
    @foreach($threads as $thread)
    <?php $class = $thread->isUnread($currentUserId) ? 'card-info' : ''; ?>
    <div id="thread_list_{{$thread->id}}" class="card card-block alert {!!$class!!}">
        <h4 class="card__title">{!! link_to('messages/' . $thread->id, $thread->subject) !!} about <a href="{{ url('innovation/'.$thread->innovation->id) }}">{{$thread->innovation->innovationTitle}}</a> - <span class="card__text">{!! $thread->latestMessage->created_at->diffForHumans() !!}</span>
        </h4>
        <p class="card__text" id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>
        <p class="card__meta"><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
    </div>
    @endforeach
    </div>
    @else
    <p>Sorry, no threads.</p>
    @endif
</div>
@stop
