<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bongo Afrika</title>

    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">



</head>
<body>
<div class="container-fluid" id="main">
    <div class="navbar navbar-default global-navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Bongo afrika</a>
        </div>

        <div class="navbar-collapse collapse navbar-responsive-collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-left">
<!--
                @if(Request::path() == "/" || Request::path() == "auth/login")
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                @else
                <li><a href="{{ url('/') }}">Home</a></li>
                @endif
-->
                
                @if(\Auth::guest())                
                @if(Request::path() == "about")
                <li class="active"><a href="{{ url('/about') }}">About</a></li>
                @else
                <li><a href="{{ url('/about') }}">About</a></li>
                @endif                
                @endif
                
                @if(Request::path() == "auth/register")
                <li class="active"><a href="">Get Started</a></li>
                @else
                <li><a href="{{ url('auth/register') }}">Get Started</a></li>
                @endif

                @if(Request::path() == "request/investor/send")
                <li class="active"><a href="{{ url('request/investor/send') }}">For Investors</a></li>
                @else
                <li><a href="{{ url('request/investor/send') }}">For Investors</a></li>
                @endif

                @if(Request::path() == "request/bongo/send")
                <li class="active"><a href="{{ url('request/bongo/send') }}">For Experts</a></li>
                @else
                <li><a href="{{ url('request/bongo/send') }}">For Experts</a></li>
                @endif


                @if(!\Auth::guest())
                @if(\Auth::user()->isInvestor())
                @if(Request::path() == "innovations/open")
                <li class="active"><a href="">Open Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/open') }}">Open Innovations</a></li>
                @endif

                @if(Request::path() == "innovations/funded")
                <li class="active"><a href="">Funded Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/funded') }}">Funded Innovations</a></li>
                @endif
                @endif
                @endif

                @if(!\Auth::guest())
                @if(\Auth::user()->isAdmin())
                @if(Request::path() == "innovations/open")
                <li class="active"><a href="">Open Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/open') }}">Open Innovations</a></li>
                @endif

                @if(Request::path() == "innovations/funded")
                <li class="active"><a href="">Funded Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/funded') }}">Funded Innovations</a></li>
                @endif
                @endif
                @endif

                @if(!\Auth::guest())
                @if(\Auth::user()->isMother())

                @if(Request::path() == "request/all/investors")
                <li class="active"><a href="">Investor Requests</a></li>
                @else
                <li><a href="{{ url('request/all/investors') }}">Investor Requests</a></li>
                @endif

                @if(Request::path() == "request/all/employees")
                <li class="active"><a href="">Employee Requests</a></li>
                @else
                <li><a href="{{ url('request/all/employees') }}">Employee Requests</a></li>
                @endif
                @if(Request::path() == "innovations/open")
                <li class="active"><a href="">Open Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/open') }}">Open Innovations</a></li>
                @endif

                @if(Request::path() == "innovations/funded")
                <li class="active"><a href="">Funded Innovations</a></li>
                @else
                <li><a href="{{ url('innovations/funded') }}">Funded Innovations</a></li>
                @endif
                @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(\Auth::user())

                @if(Request::path() == "innovator/profile/".\Auth::user()->id)
                <li class="active"><a href="">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a></li>
                @else
                <li><a href="{{ url('innovator/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a></li>
                @endif
                <li><a href="{{ url('logout') }}">Logout</a></li>
                @else
                
                @endif
            </ul>
        </div> <!-- end nav-collapse -->
    </div> <!-- end navbar -->

    @yield('content')
</div> <!-- end container main-->

<!-- compiled and minified javascript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<!-- Start Messenger Demo Changes -->
<script src="{{ asset('/js/all.js') }}" type="text/javascript"></script>
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
                    $('#thread_list_' + thread_id).addClass('alert-info');
                    $('#thread_list_' + thread_id + '_text').html(thread_plain_text);
                }
            });
        }
    });
</script>
@endif
@yield('script')


</body>
</html>
