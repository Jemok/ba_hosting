<!-- The template for displaying any thread with a subject -->

@extends('layout')

@section('content')
<div class="container">
    <h5>Create a new message</h5>
    {!! Form::open(['route' => 'messages.store']) !!}

    <input type="hidden" name="innovation_id" value="{{$innovation_id}}">
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
            <label title="{!!$user->first_name!!} {!!$user->last_name!!}"><input type="checkbox" name="recipients[]" value="{!!$user->id!!}">{!!$user->first_name!!}</label>
            @endforeach
        </div>
        @endif


        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control', 'onclick' => "this.disabled=true;this.value='Sending, please wait...';this.form.submit();"]) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
