<div class="open-projects">
    <header>
        @if(!Request::is('innovation/*'))
        <h2 class="section__title">Open Projects</h2>
        @endif
    </header>

    @if($onProgress->count())

    <section class="innoList innoGrid">

        @foreach($onProgress as $innovation)
        <article class="inno {{$innovation->innovation->category->categoryName}}" data-category="{{ $innovation->innovation->category->id }}">
            <header>
                <h3 class="inno-title">
                    <a  href="{{url('innovation/'.$innovation->innovation->id)}}">
                        {{ $innovation->innovation->innovationTitle }}
                    </a>
                    ({{$innovation->innovation->created_at->diffForHumans()}})
                </h3>

                <p class="inno-innovator">{{ $innovation->innovation->user->first_name }} {{ $innovation->innovation->user->last_name }}</p>

            </header>
            <section class="inno-summary">
                <p>{{ $innovation->innovation->innovationShortDescription }}</p>
            </section>
            <footer class="inno-meta">
                <span class="inno-category">{{ $innovation->innovation->category->categoryName }}</span>

            </footer>
        </article>

        @endforeach
    </section> <!-- end innoList -->
    {!! $onProgress->render() !!}
    @else

    <p class="alert-info"><h3>No innovations in progress</h></h3><p>

        @endif
</div> <!-- end innovations-pane -->
