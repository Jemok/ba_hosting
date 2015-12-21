@extends('layout')

@section('content')

@if(Session::has('flash_message'))

<div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    @endif

    {{ session('flash_message') }}

</div>

@endif

<div class="col-md-6 col-md-offset-4">
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="form-field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-field">
        <label>New Password</label>
        <input type="password" name="password">
    </div>

    <div class="form-field">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit" class="cta cta__btn">Reset Password</button>
    </div>
</form>
</div>

@stop