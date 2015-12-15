@extends('layout')

@section('content')

<div class="container">
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
</div>

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


<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>


