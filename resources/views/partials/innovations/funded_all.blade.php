<!-- The partial for displaying all the funded innovations -->

<div class="open-projects">
    <header>
        <h2 class="section__title">Funded Projects</h2>
    </header>

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
                <p class="inno-innovator">Posted by: {{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</p>
                @endif
            </header>
            <section class="inno-summary">

                <?php

                    $fundingNeeded = $innovation->fund->where('innovation_id', '=', $innovation->fund->innovation_id)->sum('amount') + $innovation->innovationFund;

                    $fundingFunded =  $innovation->fund->where('innovation_id', '=', $innovation->fund->innovation_id)->sum('amount');
                ?>

                <p>{!! $innovation->innovationShortDescription !!}</p>
                <span class="inno-funding-needed">Needed: Ksh. {{ number_format($fundingNeeded)  }}</span><br>
                <span class="inno-funding-needed">Funded: Ksh. {{ number_format($fundingFunded)}}</span>
                <p class="inno-innovator"><a href="{{ route('innovationPortfolio', [$innovation->id])}}">Portfollio</a></p>

            </section>
            <footer class="inno-meta">
                <span class="inno-category">{{ $innovation->category->categoryName }}</span>
                <div class="inno-category">{{ $innovation->category->categoryName }}</div>
                @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
                <div class="inno-funding funded">Fully funded</div>
                @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund > 0)
                <div class="inno-funding partial">Partially funded</div>
                @else
                <div class="inno-funding">Open</div>
                @endif
            </footer>
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $innovations->render() !!}
    @else

    <p class="alert-info"><h3>No funded innovations</h></h3><p>

        @endif
</div> <!-- end innovations-pane -->
