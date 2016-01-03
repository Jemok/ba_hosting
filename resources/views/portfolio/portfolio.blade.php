@extends('layout')

@section('content')
<div class="container">
    <h3>{{ $innovationTitle }}  Funding History</h3>

    <div class="col-lg-9">
        @if($funds->count())
        <section class="innoList innoGrid">

            @foreach($funds as $fund)
            <article>
                <header>
                    <h5 class="inno-title">

                        Ksh. {{$fund->amount}}

                        by

                        @if(\Auth::user()->id == $fund->investor_id)

                        <a href="{{ url('investor/profile/'.$fund->investor->hash_id) }}">Me</a>

                        @else
                        <a href="{{ url('investor/profile/'.$fund->investor->hash_id) }}">{{$fund->name}}</a>
                        @endif

                        {!! $fund->created_at->diffForHumans() !!}
                    </h5>
                    @endforeach

                    <h4>Total needed Ksh. {{ $funds->sum('amount') + $totalNeeded }} </h4>
                    <h4>Total funded: Ksh. {{ $funds->sum('amount') }} </h4>
                    <h4>Expected: Ksh. {{ $totalNeeded }} </h4>


                    @else

                    <p class="alert-info"><h3>No fundings</h></h3><p>

                    @endif
    </div>
</div>
@stop