<!-- Structures the navbar -->

<nav class="navbar navbar-full navbar-light global-navigation">
    @if(!\Auth::guest())
        <div class="container">
    @endif
        <!-- Brand and toggle get grouped for better mobile display -->
        <button type="button" class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#navbar-main">
            &#9776;
        </button>

        <a class="navbar-brand {{Request::path() == 'auth/login' ? 'active' : ''}}" href="{{ url('auth/login') }}">Bongo afrika</a>


        <section class="collapse navbar-toggleable-xs" id="navbar-main">

            <ul class="nav navbar-nav navbar-left">
                @if(\Auth::guest())

                    @include('partials.layout.guest')

                @else
                    @include('partials.layout.auth')
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @include('partials.layout.nav_right')
            </ul>
        </section> <!-- end collapse -->

    @if(!\Auth::guest())
        </div>
    @endif
</nav> <!-- end navbar -->