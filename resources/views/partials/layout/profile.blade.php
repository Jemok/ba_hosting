<!-- Displays the profile portion of the navbar  -->

@if(\Auth::user()->isInnovator())
<li class="nav-item {{Request::path() == 'innovator/profile/'.\Auth::user()->hash_id && \Auth::user()->isInnovator() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('innovator/profile/'.\Auth::user()->hash_id) }}">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isInvestor())
<li class="nav-item {{Request::path() == 'investor/profile/'.\Auth::user()->hash_id && \Auth::user()->isInvestor() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('investor/profile/'.\Auth::user()->hash_id) }}">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isMother())
<li class="nav-item {{Request::path() == 'mother/profile/'.\Auth::user()->hash_id && \Auth::user()->isMother() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('mother/profile/'.\Auth::user()->hash_id) }}">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif

@if(\Auth::user()->isAdmin())
<li class="nav-item {{Request::path() == 'expert/profile/'.\Auth::user()->hash_id && \Auth::user()->isAdmin() ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('expert/profile/'.\Auth::user()->hash_id) }}">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>
@endif
