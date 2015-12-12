@extends('layout')

@section('content')
{{$profile->first_name}} {{$profile->last_name}}<br>
{{$profile->email}}<br>
@stop
