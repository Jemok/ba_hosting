<header class="chat__head">
    <h4 class="section__title">Chats</h4>
    <div class="section__toolbox btn-group">
        @if(\Auth::user()->isMother())

            @include('partials.messenger.new_chat_expert')

            @include('partials.messenger.new_chat_investor')

        @endif

        @if(\Auth::user()->isAdmin())

            @include('partials.messenger.new_chat_mother')

        @endif

        @if(\Auth::user()->isInvestor())

            @include('partials.messenger.new_chat_mother')

            @include('partials.messenger.new_chat_expert')

        @endif

        @if(\Auth::user()->isInnovator())

            @include('partials.messenger.new_chat_moderator')

            @include('partials.messenger.new_chat_expert')

        @endif
    </div>
</header>