<div class="chat__box">
    @if (Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {!! Session::get('error_message') !!}
    </div>
    @endif
    @if($threads->count() > 0)
    <div class="card-columns">
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'card-inverse card-info' : ''; ?>
        <div id="thread_list_{{$thread->id}}" class="card card-block {!!$class !!}">
            <h4 class="card__title">{!! link_to('messages/' . $thread->id, 'Chat '. $thread->subject) !!}</h4>
            <p class="card__text" id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>
            <span class="card__text">{!! $thread->latestMessage->created_at->diffForHumans() !!}</span>
            <p class="card__meta"><small class="text-muted">Participant:{!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
        </div>
        @endforeach
    </div>
    @else
    <p>Sorry, no chats available</p>
    @endif
</div>