<div class="funded-projects">
    <header>
        <h2 class="section__title">Funded Projects</h2>
    </header>

    @if(\Auth::user()->userCategory == 1)
    @if($fundedProjects->count())
    <section class="innoList">

        @foreach($fundedProjects as $funded)

        <article class="inno {{$funded->category->categoryName}}" data-category="{{ $funded->category->id }}">
            <header>
                <h3 class="inno-title">
                    <a href="{{url('innovation/'.$funded->id)}}">
                        {{ $funded->innovationTitle }}
                    </a>
                </h3>
                <p class="inno-innovator">Funded by:{{ $funded->fund->name }}</p>
                <p class="inno-innovator">Amount:{{ $funded->innovationFund }}</p>
                <p class="inno-innovator"><a href="{{ url('innovation/portfolio/'.$funded->id)}}">Portfollio</a></p>
            </header>
            <footer class="inno-meta">
                <div class="inno-category">{{ $funded->category->categoryName}}</div>
                <div class="inno-innovator"></div>
            </footer>
        </article>

        @endforeach
    </section>
    {!! $fundedProjects->render() !!}

    @else
    <h4>No funded projects</h4>
    @endif
    @else

    @if($fundedProjects->count())
    <section class="innoList">

        @foreach($fundedProjects as $funded)

        <article class="inno {{$funded->category->categoryName}}" data-category="{{ $funded->category->id }}">
            <header>
                <h3 class="inno-title">
                    <a href="{{url('innovation/'.$funded->id)}}">
                        {{ $funded->innovationTitle }}
                    </a>
                </h3>
                <h4>Description</h4>
                <p class="inno-summary">
                    {!! $funded->innovationDescription !!}
                </p>
                <p class="inno-innovator">Funded by:{{ $funded->fund->name }}</p>
                <p class="inno-innovator">Amount:{{ $funded->innovationFund }}</p>
                <p class="inno-innovator"><a href="{{ url('innovation/portfolio/'.$funded->id)}}">Portfollio</a></p>
            </header>
            <footer class="inno-meta">
                <div class="inno-category">{{ $funded->category->categoryName}}</div>
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
