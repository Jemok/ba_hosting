@extends('layout')

@section('content')
<h4>Investor requests</h4>
@foreach($requests as $request)


{{ $request->investor_email }}

@if($request->request_status == 0)

<a href="{{ url('request/bongo/send/'.$request->id) }}"><button>Send link</button></a>

@elseif($request->request_status == 1)

<button>Link sent </button>
@elseif($request->request_status == 2)

<button>Registered</button>
@endif

<br>

@endforeach
@stop


