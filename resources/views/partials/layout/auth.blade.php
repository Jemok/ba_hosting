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