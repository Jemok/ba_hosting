<li class="nav-item {{Request::path() == 'request/all/investors' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/investors') }}">
        Investor Requests
        @if(Request::getRequestUri() == '/')
        @include("partials.innovations.requests_investor_count")
        @endif

    </a>
</li>

<li class="nav-item {{Request::path() == 'request/all/experts' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/experts') }}">Expert Requests</a>
</li>