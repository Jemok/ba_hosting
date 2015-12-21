@include('partials.messenger.new_chat_selector')

@if($threads_count > 0)
    @include('partials.messenger.loop_threads')
@else
<div class="container">
    <h4 class="inno-innovator">Start a chat with <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a></h4> about {{ $innovation->innovationTitle }} </h5>

    @include('partials.messenger.send_form')

</div>
@endif
