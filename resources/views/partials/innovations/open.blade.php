<div class="open-projects">
    <header>
        <h2 class="section__title">Open Projects</h2>
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
                </h3>
                @if(\Auth::user()->id == $innovation->user_id)
                @else
                <p class="inno-innovator">{{ $innovation->user->name }}</p>
                @endif
            </header>
            <section class="inno-summary">
                {!! $innovation->innovationDescription !!}
                <div class="inno-amount-needed">Ksh. {{ $innovation->innovationFund }}</div>
            </section>
            <footer class="inno-meta">
                <span class="inno-category">{{ $innovation->category->categoryName }}</span>
            </footer>
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $innovations->render() !!}
    @else

    <p class="alert-info"><h3>No open innovations</h></h3><p>

        @endif
</div> <!-- end innovations-pane -->
