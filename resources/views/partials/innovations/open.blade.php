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
                <p class="inno-innovator">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</p>
                @endif
            </header>
            <section class="inno-summary">
                <p>{{ $innovation->innovationShortDescription }}</p>
                <span class="inno-funding-needed">Ksh. {{ $innovation->innovationFund }}</span>
            </section>
            <footer class="inno-meta">
                <span class="inno-category">{{ $innovation->category->categoryName }}</span>
                @if(\Auth::user()->id == $innovation->user_id)
                <span class="inno-category pull-right"><a href="{{url('innovation/edit/'.$innovation->id)}}">Edit</a></span>
                @endif

            </footer>
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $innovations->render() !!}
    @else

    <p class="alert-info"><h3>No open innovations</h></h3><p>

    @endif
</div> <!-- end innovations-pane -->
