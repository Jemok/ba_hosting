<li class="nav-item {{Request::path() == 'innovations/open' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('allOpenInnovations') }}">Open</a>
</li>

<li class="nav-item {{Request::path() == 'innovations/funded' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('allFundedInnovations') }}">Funded</a>
</li>