@if(\Auth::user()->isInnovator())
@include('partials.layout.message')

@endif


@if(\Auth::user()->isInvestor())
@if(\Auth::user()->investor_finance != 0)
    @include('partials.layout.message')
    @include('partials.layout.funded_open')
@elseif(\Auth::user()->investor_finance == 0)
    @include('partials.layout.logout')
@endif

@endif

@if(\Auth::user()->isAdmin())
@include('partials.layout.message')

@include('partials.layout.funded_open')

@endif


@if(\Auth::user()->isMother())
@include('partials.layout.message')

@include('partials.layout.requests')

@include('partials.layout.funded_open')

@endif