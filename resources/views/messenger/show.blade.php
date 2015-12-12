@extends('layout')

@section('content')
<div class="container">
    <div class="col-md-6">
        <h5>Started  by: {!! $thread->subject !!}</h5>

        <div id="thread_{{$thread->id}}">
            @foreach($thread->messages()->oldest()->get() as $message)
            @include('messenger.html-message', $message)
            @endforeach
        </div>

        <h5>Add a new message</h5>
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <!--
        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!! $user->first_name !!} {!! $user->last_name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->first_name !!}</label>
            @endforeach
        </div>
        @endif-->

        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
