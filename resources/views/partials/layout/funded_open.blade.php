<li class="nav-item {{Request::path() == 'innovations/open' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('innovations/open') }}">Open Innovations</a>
</li>

<li class="nav-item {{Request::path() == 'innovations/funded' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('innovations/funded') }}">Funded Innovations</a>
</li>