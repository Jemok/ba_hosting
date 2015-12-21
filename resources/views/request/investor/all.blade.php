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
        <h2 class="section__title">Investor requests</h2>
        <div class="card-columns">
            @foreach($requests as $request)
            
            @if($request->request_status == 0)
            <form method="get" action="{{ url('request/bongo/send/'.$request->id) }}" class="card card-block request-card">
            @elseif($request->request_status != 0) 
            <div class="card card-block request-card">
            @endif

                <h4 class="request__name">Lorem Ipsum</h4>
                <p class="card-text">
                    <span class="request__company"><i class="ion-briefcase"></i> Company Name</span>
                    <span class="request__job-title"><i class="ion-pound"></i> Job title</span>
                    <span class="request__email"><i class="ion-at"></i> {{ $request->investor_email }}</span>
                </p>
                
                @if($request->request_status == 0)
                <button type="submit">Send invitation</button>
                @elseif($request->request_status == 1)
                <p>Invitation sent </p>
                @elseif($request->request_status == 2)
                <p class="text-success">Registered</p>
                @endif
                
            @if($request->request_status == 0)
            </form>
            @elseif($request->request_status != 0) 
            </div>
            @endif

            @endforeach
        </div>
    </section>
</div>
@stop


<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>


