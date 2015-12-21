<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Bongo Afrika</title>

        <!-- Latest compiled and minified CSS -->
    <!--    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->
    <!--    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">-->
        <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">
    </head>
    
    @if(!\Auth::guest())
    <body class="dashboard">
    @else
    <body>
    @endif
        <nav class="navbar navbar-full navbar-light global-navigation">
            @if(!\Auth::guest())
            <div class="container">
            @endif
                <!-- Brand and toggle get grouped for better mobile display -->
                <button type="button" class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#navbar-main">
                    &#9776;
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Bongo afrika</a>

                <section class="collapse navbar-toggleable-xs" id="navbar-main">
                    <ul class="nav navbar-nav navbar-left">
                        @if(\Auth::guest())                

                            @include('partials.layout.guest')

                        @endif


                        @if(!\Auth::guest())
                            @if(\Auth::user()->isInvestor())

                                <li class="nav-item {{Request::path() == 'innovations/open' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{ url('innovations/open') }}">Open Innovations</a>
                                </li>


                                @if(Request::path() == "innovations/funded")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Funded Innovations</a>
                                </li>
                                @else
                                <li class="nav-item"><a class="nav-link" href="{{ url('innovations/funded') }}">Funded Innovations</a></li>
                                @endif
                            @endif
                        @endif

                        @if(!\Auth::guest())
                            @if(\Auth::user()->isAdmin())
                                @if(Request::path() == "innovations/open")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Open Innovations</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('innovations/open') }}">Open Innovations</a>
                                </li>
                                @endif

                                @if(Request::path() == "innovations/funded")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Funded Innovations</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('innovations/funded') }}">Funded Innovations</a>
                                </li>
                                @endif
                            @endif
                        @endif

                        @if(!\Auth::guest())
                            @if(\Auth::user()->isMother())
                                @if(Request::path() == "request/all/investors")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Investor Requests</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('request/all/investors') }}">Investor Requests</a>
                                </li>
                                @endif

                                @if(Request::path() == "request/all/employees")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Employee Requests</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('request/all/employees') }}">Employee Requests</a>
                                </li>
                                @endif
                                @if(Request::path() == "innovations/open")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Open Innovations</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('innovations/open') }}">Open Innovations</a>
                                </li>
                                @endif

                                @if(Request::path() == "innovations/funded")
                                <li class="nav-item active">
                                    <a class="nav-link" href="">Funded Innovations</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('innovations/funded') }}">Funded Innovations</a>
                                </li>
                                @endif
                            @endif
                        @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if(\Auth::user())

                        @if(Request::path() == "innovator/profile/".\Auth::user()->id)
                        <li class="nav-item active">
                        <a class="nav-link" href="">{{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('innovator/profile/'.\Auth::user()->id) }}">Signed in as {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }}</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ url('logout') }}">Logout</a></li>
                        @else

                        @endif
                    </ul>
                </section> <!-- end collapse -->
                
            @if(!\Auth::guest())
            </div>
            @endif
        </nav> <!-- end navbar -->

<!--        <div class="container-fluid" id="main">-->
            @yield('content')
<!--        </div>-->
        <!-- end container main-->

        <!-- compiled and minified javascript -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ asset('js/bootstrap.js') }}"></script>
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
