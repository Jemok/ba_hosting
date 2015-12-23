@extends('layout')

@section('content')
<div class="chat_window">
    <div class="top_menu">
        <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
        </div>
        <div class="title">Conversation with {!! $thread->subject !!}</div>
    </div>

    <ul class="messages" id="thread_{{$thread->id}}">
        @foreach($thread->messages()->oldest()->get() as $message)
        @include('messenger.html-message', $message)
        @endforeach
    </ul>
        
    <div class="bottom_wrapper clearfix">
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <div class="message_input_wrapper">
            {!! Form::textarea('message', 'Type your message here...', ['class' => 'form-control message_input']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'form-control send_message']) !!}
           

        <!--
        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!! $user->first_name !!} {!! $user->last_name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->first_name !!}</label>
            @endforeach
        </div>
        @endif-->

        {!! Form::close() !!}
    </div>

</div>
@stop
