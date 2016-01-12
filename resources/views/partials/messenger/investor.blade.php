<div class="col-sm-3">
    Chats:
    <ul class="list-group" id="myTab" role="tablist">
        @if(!$threads_count > 0)
        <a class="list-group-item active" data-toggle="tab" href="#innovator" role="tab" aria-controls="innovator">
            Messages
            <span class="label label-success label-pill pull-right"></span>
        </a>
        @endif
        @if($threads_count > 0)
        <a class="list-group-item" data-toggle="tab" href="#expert" role="tab" aria-controls="expert">
            Expert <i class="ion-plus-round pull-right"></i>
        </a>
        <a class="list-group-item" data-toggle="tab" data-target="#mother" role="tab" aria-controls="mother">
            Mother <i class="ion-plus-round pull-right"></i>
        </a>
        @foreach($threads as $thread)
        <?php

        $class = $thread->isUnread($currentUserId) ? 'text-default' : 'text-info';

        if($thread->receiver_id == $innovation->user_id)
            {
                $class_list = 'active';
            }else
            {
                $class_list = '';
            }
        ?>
        <a class="list-group-item {{$class_list}} {{$class}}" data-toggle="tab" href="#thread_{{$thread->id}}" role="tab" aria-controls="thread_list_{{$thread->id}}" data-id="thread_{{$thread->id}}">

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
    @if(!$threads_count > 0)
    <div class="tab-pane active" id="innovator" role="tabpanel">


           @include('partials.messenger.send_form')
    </div>
    @endif

    @if($threads_count > 0)
    <div class="tab-pane" id="expert" role="tabpanel">@include('messenger.create_expert')</div>
    <div class="tab-pane" id="mother" role="tabpanel">@include('messenger.create_mother')</div>
    @foreach($threads as $thread)
    <?php

    if($thread->receiver_id == $innovation->user_id)
    {
        $class_content = 'active';
    }else
    {
        $class_content = '';
    }
    ?>
    <div class="tab-pane {{$class_content}}" id="thread_{{$thread->id}}" data-id="{{$thread->id}}" role="tabpanel">
            @include('partials.messenger.loop_all_messages')
        </div>
    @endforeach
    @endif
</div>

