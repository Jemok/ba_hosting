<div class="col-sm-3">
    <ul class="list-group" id="myTab" role="tablist">
        <!--<button class="list-group-item active" data-toggle="tab" data-target="#innovator" role="tab" aria-controls="innovator">
            Messages
            <span class="label label-success label-pill pull-right"></span>
        </button>-->
        @if($threads_count > 0)
        <a class="list-group-item" data-toggle="tab" href="#mother" role="tab" aria-controls="mother">
            Mother <i class="ion-plus-round pull-right"></i>
        </a>
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'text-default' : 'text-info'; ?>
        <a class="list-group-item" data-toggle="tab" href="#thread_{{$thread->id}}" role="tab" aria-controls="thread_list_{{$thread->id}}" data-id="thread_{{$thread->id}}">


            @if($thread->messages()->count() == 1)

            <span style="color: #ff0000;">new</span>
            <span style="color: green;">{{$thread->subject}} with {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</span>
            @else
              <span class="label label-info label-pill {!! $class !!}">m</span>{{$thread->subject}} with {!! $thread->participantsString(Auth::id(), ['first_name']) !!}
            @endif
        </a>
        @endforeach
        @endif
    </ul>
</div>

<div class="tab-content col-sm-9">
    <!--<div class="tab-pane active" id="innovator" role="tabpanel">
        @if($threads_count > 0)
        @include('partials.messenger.loop_threads')
        @else
        <h4>No chats available</h4>
        @endif
    </div>-->
    <div class="tab-pane" id="mother" role="tabpanel">@include('messenger.create_mother')</div>
    @foreach($threads as $thread)
        <div class="tab-pane" id="thread_{{$thread->id}}" data-id="{{$thread->id}}" role="tabpanel">@include('partials.messenger.loop_all_messages')</div>
    @endforeach
</div>