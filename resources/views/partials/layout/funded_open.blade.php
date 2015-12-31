<li class="nav-item {{Request::path() == 'innovations/open' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('allOpenInnovations') }}">
    Open
    @if(Request::getRequestUri() == '/' || Request::getRequestUri() == '/home')
    @include("partials.innovations.open_innovations_count")
    @endif
    </a>
</li>

<li class="nav-item {{Request::path() == 'innovations/funded' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('allFundedInnovations') }}">
        All Funded
        @if(Request::getRequestUri() == '/' || Request::getRequestUri() == '/home')
            @include("partials.innovations.partial_innovations_count")
        @endif

        @if(Request::getRequestUri() == '/' || Request::getRequestUri() == '/home')
            @include("partials.innovations.fully_funded_innovations_count")
        @endif
    </a>
</li>