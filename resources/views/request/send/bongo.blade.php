@extends('layout')

@section('content')
<form method="post" action="{{ url('request/bongo/send') }}">

    {!! csrf_field() !!}

    <label for="bongo_email">Your Email</label>

    <input type="email" name="bongo_email" />

    {!! $errors->first('bongo_email', '<span class="help-block">:message</span>' ) !!}

    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@stop