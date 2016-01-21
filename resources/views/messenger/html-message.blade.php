<!-- Displays instances of messages -->

@if(\Auth::user()->id == $message->user_id)
<li class="message left appeared" data-id="{{ $thread->id }}">
    @if(\Auth::user()->prof_pic->image != null)
    <div class="avatar">
        <img src="{{ asset('uploads/'.\Auth::user()->prof_pic->image)}}" alt="{!! \Auth::user()->first_name !!}">
    </div>
    @else
    <div class="avatar">
        <img src="{{ asset('uploads/default.png')}}" alt="prof pic">
    </div>
    @endif

    <div class="text_wrapper">
        <div class="text">{!! $message->body !!}</div>
        <div class="text-muted">{!! $message->created_at->diffForHumans() !!}</div>
    </div>
</li>
@elseif(\Auth::user()->id != $message->user_id)
<li class="message right appeared">
    @if($message->user->prof_pic->image != null)
    <div class="avatar">
        <img src="{{ asset('uploads/'.$message->user->prof_pic->image)}}" alt="{!! $message->user->first_name !!}">
    </div>
    @else
    <div class="avatar">
        <img src="{{ asset('uploads/default_prof_pic.png')}}" alt="prof pic">
    </div>
    @endif
    <div class="text_wrapper">
        <div class="text">{!! $message->body !!}</div>
        <div class="text-muted">{!! $message->created_at->diffForHumans() !!}</div>
    </div>
</li>
@endif