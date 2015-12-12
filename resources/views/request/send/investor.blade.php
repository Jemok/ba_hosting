@extends('layout')

@section('content')
<form method="post" action="{{ url('request/investor/send') }}">

    {!! csrf_field() !!}

    <label for="investor_email">Your Email</label>

    <input type="email" name="investor_email" />

    {!! $errors->first('investor_email', '<span class="help-block">:message</span>' ) !!}

    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@stop