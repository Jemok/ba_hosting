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
        <h2 class="section__title">Bongo Investor requests</h2>
        <div class="card-columns">
            @foreach($requests as $request)
            
            @if($request->request_status == 0)
            <form method="get" action="{{ url('request/bongo/send/'.$request->id) }}" class="card card-block request-card">
            @elseif($request->request_status != 0) 
            <div class="card card-block request-card">
            @endif

                <h4 class="request__name">Lorem Ipsum</h4>
                <p class="request__details">
                    <span class="request__company"><i class="ion-briefcase"></i>{{ $request->company }}</span>
                    <span class="request__job-title"><i class="ion-pound"></i>{{ $request->job_title }}</span>
                    <span class="request__email"><i class="ion-at"></i> {{ $request->investor_email }}</span>
                </p>
                
                @if($request->request_status == 0)
                <button type="submit" class="btn btn-primary"><i class="ion-paper-airplane"></i> Send invitation</button>
                @elseif($request->request_status == 1)
                <div class="request__status text-info">Invitation sent </div>
                @elseif($request->request_status == 2)
                <div class="request__status text-success">Registered <i class="ion-checkmark-round"></i></div>
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


