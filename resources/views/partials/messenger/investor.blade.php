@include('partials.messenger.new_chat_selector')

<div class="col-sm-3">
    <ul class="list-group" id="myTab" role="tablist">
        <button class="list-group-item active" data-toggle="tab" data-target="#innovator" role="tab" aria-controls="innovator">
            Innovator
            <span class="label label-success label-pill pull-right">14</span>
        </button>
        <button class="list-group-item" data-toggle="tab" data-target="#expert" role="tab" aria-controls="expert">
            Expert <i class="ion-plus-round pull-right"></i>
        </button>
        <button class="list-group-item" data-toggle="tab" data-target="#mother" role="tab" aria-controls="mother">
            Mother <i class="ion-plus-round pull-right"></i>
        </button>
    </ul>
</div>

<div class="tab-content col-sm-9">
    <div class="tab-pane active" id="innovator" role="tabpanel">Dump chat with Innovator Here</div>
    <div class="tab-pane" id="expert" role="tabpanel">Dump chat with Expert here</div>
    <div class="tab-pane" id="mother" role="tabpanel">Dump chat with Mother here</div>
</div>

@if($threads_count > 0)
    @include('partials.messenger.loop_threads')
@else

<div class="chat_window">
    <div class="top_menu">
        <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
        </div>
        <div class="title">Start a chat with <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a></div>
    </div>

<!--
    <ul class="messages">
        <li class="message">
            <div class="avatar"></div>
            <div class="text_wrapper">
                <div class="text"></div>
            </div>
        </li>
    </ul>
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" placeholder="Type your message here..." />
        </div>
        <div class="send_message">
            <div class="icon"></div>
            <div class="text">Send</div>
        </div>
    </div>
-->
    @include('partials.messenger.send_form')

</div>
@endif
