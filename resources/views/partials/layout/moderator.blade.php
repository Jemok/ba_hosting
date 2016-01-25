<!-- The moderator part navigation -->

<li class="nav-item {{Request::path() == 'moderator/add/new' ? 'active' : ''}}">
    <a class="nav-link" href="{{ route('newModerator') }}">
        Moderator
    </a>
</li>
