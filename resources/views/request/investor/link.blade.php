@extends('layout')

@section('content')

<h3><a href="{{ url('request/bongo/confirm/'.$request_link) }}">{{ $request_link }}</a></h3>

@stop

