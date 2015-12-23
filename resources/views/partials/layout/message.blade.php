<li class="nav-item {{Request::path() == 'messages' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('messages') }}">Messages @include('messenger.unread-count')</a>
</li>