<!-- Displays the Bongo Afrika Expert Dashboard -->

@extends('layout')

@section('content')

<div class="container">
    <nav class="innoFilters">
        <button class="filter current" data-filter="*">Show all</button>
        @if($categories->count())

        @foreach($categories as $category)
        <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
        @endforeach

        @endif
    </nav>

    <header>

        <h2 class="section__title">All Projects: @include('partials.innovations.all_innovations_count')</h2>
    </header>
    
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
    
    @if($innovations->count())

    <section class="innoList innoGrid">

        @foreach($innovations as $innovation)
        <article class="inno {{$innovation->category->categoryName}}" data-category="{{ $innovation->category->id }}">
            <header>
                <h3 class="inno-title">

                    <a  href="{{url('innovation/'.$innovation->id)}}">

                        {{ $innovation->innovationTitle }}
                    </a>
                    ({{$innovation->created_at->diffForHumans()}})

                </h3>
                @if(\Auth::user()->id == $innovation->user_id)

                @else
                <span class="inno-innovator">Posted by: {{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</span>
                @endif
            </header>

            <section class="inno-summary">
                <p>{!! $innovation->innovationShortDescription !!}</p>
                @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)

                @else
                <span class="inno-funding-needed">Ksh. {{ number_format($innovation->innovationFund, 0) }}</span>
                @endif

            </section>

            <footer class="inno-meta">
                <div class="inno-category">{{ $innovation->category->categoryName }}</div>
<!--                <div class="inno-likes">756</div>-->
                @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
                <div class="inno-funding funded">Fully funded</div>
                @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund > 0)
                <div class="inno-funding partial">Partially funded</div>
                @else
                <div class="inno-funding">Open</div>
            </footer>
            @endif
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $innovations->render() !!}

    @else

    <p class="alert-info"><h3>No innovations found</h></h3><p>

        @endif
</div>

@stop