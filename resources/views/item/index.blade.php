<div id="messages" class="list-group">
    @foreach ($chats->with('messages')->get() as $chat)

    <a href="/chats">{{$chat->id}}</a>

    @foreach($chat->messages as $message)

        @include('item.show')


    @endforeach

    @endforeach


</div>



<hr>










