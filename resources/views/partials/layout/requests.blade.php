<li class="nav-item {{Request::path() == 'request/all/investors' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/investors') }}">Investor Requests</a>
</li>

<li class="nav-item {{Request::path() == 'request/all/employees' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/employees') }}">Expert Requests</a>
</li>