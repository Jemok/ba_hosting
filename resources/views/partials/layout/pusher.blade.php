@if(Auth::check())
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var pusher = new Pusher('{{Config::get('pusher.appKey')}}');
    var channel = pusher.subscribe('for_user_{{Auth::id()}}');
    channel.bind('new_message', function(data) {
        var thread = $('#' + data.div_id);
        var thread_id = data.thread_id;
        var thread_plain_text = data.text;

        if (thread.length) {
            // add new message to thread
            thread.append(data.html);

            // make sure the thread is set to read
            $.ajax({
                url: "/messages/" + thread_id + "/read"
            });
        } else {
            var message = '<p>' + data.sender_name + ' said: ' + data.text + '</p><p><a href="' + data.thread_url + '">View Message</a></p>';

            // notify the user
            $.growl.notice({ title: data.thread_subject, message: message });

            // set unread count
            $.ajax({
                url: "{{route('messages.unread')}}"
            }).success(function( data ) {
                var div = $('#unread_messages');

                var count = data.msg_count;
                if (count == 0) {
                    $(div).addClass('hidden');
                } else {
                    $(div).text(count).removeClass('hidden');

                    // if on messages.index - add alert class and update latest message
                    $('#thread_list_' + thread_id).addClass('card-info');
                    $('#thread_list_' + thread_id + '_text').html(thread_plain_text);
                }
            });
        }
    });
</script>

@endif