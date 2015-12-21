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

    <section class="requests">
        <h2 class="section__title">Bongo employee requests</h2>
        <div class="card-columns">
            @foreach($requests as $request)
            
            <div class="card card-block request-card">
                <h4 class="request__name">Lorem Ipsum</h4>
                <p class="card-text">
                    <span class="request__company"><i class="ion-briefcase"></i> Company Name</span>
                    <span class="request__job-title"><i class="ion-pound"></i> Job title</span>
                    <span class="request__email"><i class="ion-at"></i> {{ $request->bongo_email }}</span>
                </p>
                
                @if($request->request_status == 0)
                <a class="btn btn-primary" href="{{ url('request/bongo-employee/send/'.$request->id) }}">Send link</a>
                @elseif($request->request_status == 1)
                <button class="btn btn-primary">Link sent </button>
                @elseif($request->request_status == 2)
                <button class="btn btn-primary">Registered</button>
                @endif
            </div>

            @endforeach
        </div>
    </section>
</div>
@stop



