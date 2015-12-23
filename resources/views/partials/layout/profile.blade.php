
@if(\Auth::user()->isInnovator())
<li class="nav-item {{Request::path() == 'innovator/profile/'.\Auth::user()->id && \Auth::user()->isInnovator() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('innovator/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isInvestor())
<li class="nav-item {{Request::path() == 'investor/profile/'.\Auth::user()->id && \Auth::user()->isInvestor() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('investor/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isMother())
<li class="nav-item {{Request::path() == 'mother/profile/'.\Auth::user()->id && \Auth::user()->isMother() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('mother/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isAdmin())
<li class="nav-item {{Request::path() == 'expert/profile/'.\Auth::user()->id && \Auth::user()->isAdmin() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('expert/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif
