@extends('......layout')


@section('content')
<form method="POST" action="{{ url('auth/register/bongo-employee') }}" class="form-signin">

    {!! csrf_field() !!}

    <h5 class="form__heading">Register as a Bongo Expert</h5>

    <div class="form-group">
        <div class="form_field {{ $errors->has('company') ? 'has-error' : ''}}" >
            <label for="company" class="sr-only">Company</label>
            <div name="company" class="form-control">{{ $confirm->company }}</div>
        </div>
        {!! $errors->first('company', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('field') ? 'has-error' : ''}}" >
            <label for="field" class="sr-only">Field</label>
            <div name="field" class="form-control">{{ $confirm->field }}</div>
        </div>
        {!! $errors->first('field', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('job_title') ? 'has-error' : ''}}" >
            <label for="job_title" class="sr-only">Job Title</label>
            <div name="job_title" class="form-control">{{ $confirm->job_title }}</div>
        </div>
        {!! $errors->first('job_title', '<span class="help-block">:message</span>' ) !!}

    </div>


    <div class="form_field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
        <label for="first_name" class="sr-only">Name</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="first name">
    </div>
    {!! $errors->first('first_name', '<span class="help-block">:message</span>' ) !!}

    <div class="form_field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
        <label for="last_name" class="sr-only">Name</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="last name">
    </div>
    {!! $errors->first('last_name', '<span class="help-block">:message</span>' ) !!}

    <div class="form_field {{ $errors->has('email') ? 'has-error' : ''}}">
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" value="{{ $confirm->bongo_email }}" class="form-control" placeholder="Email">
    </div>
    {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

    <div class="form_field {{ $errors->has('password') ? 'has-error' : ''}}">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="password">
    </div>
    {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}

    <div class="form_field">
        <label for="password" class="sr-only">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
    </div>

    <div class="form_field">
        <button type="submit" class="cta cta_btn">Register</button>
    </div>
</form>
@stop