<div class="chat__box">
    @if (Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {!! Session::get('error_message') !!}
    </div>
    @endif
    @if($threads->count() > 0)
    <div class="card-columns">
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div id="thread_list_{{$thread->id}}" class="card card-block card-{!!$class!!}">
            <h4 class="card__title">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
            <p class="card__text" id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>
            <p class="card__meta"><small class="text-muted">Sent to {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
        </div>
        @endforeach
    </div>
    @else
    <p>Sorry, no chats available</p>
    @endif
</div>