<!-- The partial for displaying all the funded innovations by a particular investor -->

<div class="open-projects">
    <header>
        <h2 class="section__title">Funded Projects</h2>
    </header>

    @if(\Auth::user()->userCategory == 1)
    @if($fundedProjects->count())
    <section class="innoList innoGrid">

        @foreach($fundedProjects as $funded)

        <article class="inno {{$funded->category->categoryName}}" data-category="{{ $funded->category->id }}">
            <header>
                <h3 class="inno-title">
                    <a href="{{url('innovation/'.$funded->id)}}">
                        {{ $funded->innovationTitle }}
                    </a>
                </h3>
                <p class="inno-innovator">Funded by:{{ $funded->fund->name }}</p>
                <p class="inno-innovator">Total Funded:{{ $funded->fund->where('innovation_id', '=', $funded->id)->sum('amount') }}</p>
                <p class="inno-innovator"><a href="{{ route('innovationPortfolio', [$funded->id])}}">Portfollio</a></p>
            </header>
            <footer class="inno-meta">
                <div class="inno-category">{{ $funded->category->categoryName}}</div>
            </footer>
        </article>

        @endforeach
    </section>
    {!! $fundedProjects->render() !!}
    @else
    <p>Unfortunately none of your projects has been funded so far</p>
    @endif
    @else

    @if($fundedProjects->count())
    <section class="innoList innoGrid">
        @foreach($fundedProjects as $funded)

        <article class="inno {{$funded->innovation->category->categoryName}}" data-category="{{ $funded->innovation->category->id }}">
            <header>
                <h3 class="inno-title">
                    <a href="{{ url('innovation/'.$funded->innovation_id)}}">{{ $funded->innovation->innovationTitle }}</a>
                </h3>
                <?php

                $totalNeeded = $funded->where('innovation_id', '=', $funded->innovation_id)->sum('amount') + $funded->innovation->innovationFund;

                $totalFunded = $funded->where('investor_id', '=', \Auth::user()->id)->where('innovation_id', '=', $funded->innovation_id)->sum('amount');

                ?>

                <p class="inno-innovator">Posted by: {{ $funded->innovation->user->first_name }} {{ $funded->innovation->user->last_name }}</p>
                <p class="inno-innovator">Needed(Ksh.):{{ number_format($totalNeeded)  }}
                <p class="inno-innovator">Me(Ksh.): {{ number_format($totalFunded) }}</p>
                <p class="inno-innovator">Times funded by me: {{ $funded->where('investor_id', '=', \Auth::user()->id)->where('innovation_id', '=', $funded->innovation_id)->count() }}</p>
                <p class="inno-innovator"><a href="{{ route('innovationPortfolio',$funded->innovation_id)}}">Portfollio</a></p>

            </header>
            <footer class="inno-meta">
                <div class="inno-category">{{ $funded->innovation->category->categoryName}}</div>
                <div class="inno-innovator"></div>
            </footer>
        </article>

        @endforeach

    </section>
    {!! $fundedProjects->render() !!}
    @else
    <h4>No funded projects</h4>
    @endif
    @endif
</div>
