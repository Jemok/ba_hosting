@extends('layout')

@section('content')

@if(\Auth::user()->isInnovator())

{{$profile->first_name}} {{$profile->last_name}}<br>
{{$profile->email}}<br>

@endif

@if(\Auth::user()->isInvestor())

<h4>Account Settings</h4>

{{$profile->first_name}} {{$profile->last_name}}<br>
{{$profile->email}}<br>

@endif

@if(\Auth::user()->isAdmin())

{{$profile->first_name}} {{$profile->last_name}}<br>
{{$profile->email}}<br>

@endif

@if(\Auth::user()->isMother())

{{$profile->first_name}} {{$profile->last_name}}<br>
{{$profile->email}}<br>

@endif


@stop
