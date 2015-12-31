<li class="nav-item {{Request::path() == 'request/all/investors' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/investors') }}">
        Investors
        @if(Request::getRequestUri() == '/' || Request::getRequestUri() == '/home')
        @include("partials.innovations.requests_investor_count")
        @endif

    </a>
</li>

<li class="nav-item {{Request::path() == 'request/all/experts' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/all/experts') }}">
        Experts
        @if(Request::getRequestUri() == '/' || Request::getRequestUri() == '/home')
        @include("partials.innovations.requests_expert_count")
        @endif

    </a>
</li>