<li class="nav-item {{Request::path() == 'innovations/open' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('messages') }}">Messages @include('messenger.unread-count')</a>
</li>

@if(\Auth::user()->isInvestor())

@include('partials.layout.funded_open')

@endif

@if(\Auth::user()->isAdmin())

@include('partials.layout.funded_open')

@endif


@if(\Auth::user()->isMother())

@include('partials.layout.requests')

@include('partials.layout.funded_open')

@endif