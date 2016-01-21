<div class="col-sm-3">
        <ul class="list-group" id="myTab" role="tablist">
            @if($threads_count > 0)
            <a class="list-group-item" data-toggle="tab" href="#expert" role="tab" aria-controls="expert">
                Expert <i class="ion-plus-round pull-right"></i>
            </a>
            <a class="list-group-item" data-toggle="tab" href="#investor" role="tab" aria-controls="mother">
                Investor <i class="ion-plus-round pull-right"></i>
            </a>
            @foreach($threads as $thread)
            <?php $class = $thread->isUnread($currentUserId) ? 'text-default' : 'text-info'; ?>
            <a  class="list-group-item {!!$class !!}" data-toggle="tab" href="#thread_{{$thread->id}}" role="tab" aria-controls="thread_list_{{$thread->id}}" data-id="thread_{{$thread->id}}">
                @if($thread->messages()->count() == 1)

                <span style="color: #ff0000;">new</span>
                <span style="color: green;">{{$thread->subject}} with {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</span>
                @else
                <span class="label label-info label-pill {!! $class !!}">m</span> {{$thread->subject}} with {!! $thread->participantsString(Auth::id(), ['first_name']) !!}
                @endif
            </a>
            @endforeach
            @endif
        </ul>
</div>

<div class="tab-content col-sm-9">
    @if($threads_count > 0)
    <div class="tab-pane" id="expert" role="tabpanel">@include('messenger.create_expert')</div>
    <div class="tab-pane" id="investor" role="tabpanel">@include('messenger.create_investor')</div>
    @foreach($threads as $thread)
    <div class="tab-pane" id="thread_{{$thread->id}}" data-id="{{$thread->id}}" role="tabpanel">@include('partials.messenger.loop_all_messages')</div>
    @endforeach
    @endif
</div>
