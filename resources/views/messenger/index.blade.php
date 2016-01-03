@extends('layout')

@section('content')

<div class="container">

    <header>
        <h2 class="section__title">My Chats:</h2>
    </header>



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
            <h4 class="card__title"> {!! link_to('messages/' . $thread->id, 'Chat '.$thread->subject) !!} about <a href="{{ url('innovation/'.$thread->innovation->id) }}">{{$thread->innovation->innovationTitle}}</a>
            </h4>
            <p class="card__text" id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}  - <span class="card__text">{!! $thread->latestMessage->created_at->diffForHumans() !!}</span></p>
            <p class="card__meta"><small><strong>Participant:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!} </small></p>
        </div>
        @endforeach
        </div>
        @else
        <p>Sorry, no threads found.</p>
        @endif
    </div>

</div>
@stop
