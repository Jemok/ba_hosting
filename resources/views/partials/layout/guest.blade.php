<li class="nav-item {{Request::path() == 'about' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('/about') }}">About</a>
</li>

<li class="nav-item {{Request::path() == 'auth/register' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('auth/register') }}">Get Started</a>
</li>

<li class="nav-item {{Request::path() == 'request/investor/send' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/investor/send') }}">For Investors</a>
</li>

<li class="nav-item {{Request::path() == 'request/bongo/send' ? 'active' : ''}}">
    <a class="nav-link" href="{{ url('request/bongo/send') }}">For Experts</a>
</li>