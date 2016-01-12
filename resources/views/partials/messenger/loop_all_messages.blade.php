<div class="top_menu">

    <div class="title">
        Chat {!! $thread->subject !!},

        @if($thread->messages()->with('user')->oldest()->first()->user->userCategory == 1)
        <a href="{{ url('innovator/profile/'.$thread->messages()->with('user')->oldest()->first()->user->hash_id) }}">
            started by:{{\Auth::user()->id == $thread->messages()->with('user')->oldest()->first()->user->id ? 'Me' : $thread->messages()->with('user')->oldest()->first()->user->first_name. ' -
            (Innovator)' }}
        </a>
        @endif

        @if($thread->messages()->with('user')->oldest()->first()->user->userCategory == 2)
        <a href="{{ url('investor/profile/'.$thread->messages()->with('user')->oldest()->first()->user->hash_id) }}">
            started by:{{\Auth::user()->id == $thread->messages()->with('user')->oldest()->first()->user->id ? 'Me' : $thread->messages()->with('user')->oldest()->first()->user->first_name. ' -
            (Investor)' }}
        </a>
        @endif

        @if($thread->messages()->with('user')->oldest()->first()->user->userCategory == 3)
        <a href="{{ url('expert/profile/'.$thread->messages()->with('user')->oldest()->first()->user->hash_id) }}">
            started by:{{\Auth::user()->id == $thread->messages()->with('user')->oldest()->first()->user->id ? 'Me' : $thread->messages()->with('user')->oldest()->first()->user->first_name. ' -
            (Expert)' }}
        </a>
        @endif

        @if($thread->messages()->with('user')->oldest()->first()->user->userCategory == 4)
        <a href="{{ url('mother/profile/'.$thread->messages()->with('user')->oldest()->first()->user->hash_id) }}">
            started by:{{\Auth::user()->id == $thread->messages()->with('user')->oldest()->first()->user->id ? 'Me' : $thread->messages()->with('user')->oldest()->first()->user->first_name. ' -
            (Moderator)' }}
        </a>
        @endif

        {{$thread->messages()->with('user')->oldest()->first()->created_at->diffForHumans()}}

        <!--about <a href="{{ url('innovation/'.$thread->innovation->id) }}">{{$thread->innovation->innovationTitle}}</a>-->

    </div>
</div>

<ul class="messages messages_{{$thread->id}}"  data-id="{{ $thread->id }}" id="thread_{{$thread->id}}">
    @foreach($thread->messages()->oldest()->get() as $message)
    @include('messenger.html-message', $message)
    @endforeach
    <li id="alert_message"></li>
</ul>

<div class="bottom_wrapper clearfix">

    <form class="addForm" data-id="{{$thread->unique_id}}">
    <!--{!! Form::open(['id'=> 'addFrmOne', 'role'=>'form']) !!}-->
    <label class="help-block text-danger" id="help-block_{{$thread->id}}"></label>
    <div class="message_input_wrapper">
        {!! $errors->first('message', '<label class="help-block" id="help-block_{{$thread->id}}">:message</label>' ) !!}
        {!! Form::textarea('message', null, ['class' => 'form-control message_input']) !!}
    </div>
    {!! Form::submit('Submit', ['class' => 'form-control send_message']) !!}
    {!! Form::close() !!}
</div>

