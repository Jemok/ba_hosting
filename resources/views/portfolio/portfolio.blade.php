@extends('layout')

@section('content')
<h3>Funding History</h3>
<div class="col-lg-9">
    @if($funds->count())
    <section class="innoList innoGrid">

        @foreach($funds as $fund)
        <article>
            <header>
                <h5 class="inno-title">

                    ksh {{$fund->amount}}

                    by

                    @if(\Auth::user()->id == $fund->investor_id)

                    <a href="{{ url('innovator/profile/'.$fund->investor_id) }}">Me</a>

                    @else
                    <a href="{{ url('innovator/profile/'.$fund->investor_id) }}">{{$fund->name}}</a>
                    @endif


                    {!! $fund->created_at->diffForHumans() !!}
                </h5>
                @endforeach
                @else

                <p class="alert-info"><h3>No fundings</h></h3><p>

                    @endif
</div>


@stop