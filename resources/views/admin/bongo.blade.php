@extends('layout')

@section('content')

<div class="col-lg-12">
    <nav class="innoFilters">
        <button class="filter current" data-filter="*">Show all</button>
        @if($categories->count())

        @foreach($categories as $category)
        <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
        @endforeach

        @endif
    </nav>
</div>

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
<div class="col-lg-9">
    @if($innovations->count())

    <section class="innoList innoGrid">

        @foreach($innovations as $innovation)
        <article class="inno {{$innovation->category->categoryName}}" data-category="{{ $innovation->category->id }}">
            <header>
                <h3 class="inno-title">

                    <a  href="{{url('innovation/'.$innovation->id)}}">

                        {{ $innovation->innovationTitle }}
                    </a>

                </h3>
                @if(\Auth::user()->id == $innovation->user_id)

                @else
                <p class="inno-innovator">Posted by: {{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</p>
                @endif
            </header>
            <p class="inno-summary">
                {!! $innovation->innovationDescription !!}
            </p>
            <footer class="inno-meta">

                <div class="inno-category">Category:{{ $innovation->category->categoryName }}</div>

                <br>
                <div class="inno-category">
                    Amount Needed : {{ $innovation->innovationFund }}<br>

                    Amount for:{{ $innovation->justifyFund }}<br>
                </div>
                <div class="inno-likes">756</div>
            </footer>
            @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
            <div class="inno-likes">Status:Fully funded</div>
            @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund > 0)
            <div class="inno-likes">Status:Partially funded</div>
            @else
            <div class="inno-likes">Status:Open</div>
            @endif
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $innovations->render() !!}

    @else

    <p class="alert-info"><h3>No open innovations</h></h3><p>

        @endif
</div>


@stop