<li class="nav-item {{Request::path() == 'innovator/profile/'.\Auth::user()->id ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('innovator/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a>
</li>