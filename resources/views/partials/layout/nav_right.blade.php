<!-- Displays the right side of the navbar -->

@if(\Auth::user())

@if(!(\Auth::user()->isInvestor() && \Auth::user()->investor_finance == 0))
@include('partials.layout.profile')
@include('partials.layout.logout')

@endif
@endif