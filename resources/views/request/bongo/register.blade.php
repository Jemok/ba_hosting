@extends('......layout')


@section('content')
<form method="POST" action="{{ url('auth/register/bongo-employee') }}" class="form-signin">

    {!! csrf_field() !!}

    <h5 class="form__heading">Register as a Bongo Employee</h5>
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

    <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" value="{{ $confirm->bongo_email }}" class="form-control" placeholder="Email">
    </div>
    {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

    <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
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