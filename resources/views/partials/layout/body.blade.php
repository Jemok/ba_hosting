@if(!\Auth::guest())
<body class="dashboard">
@else
<body>
@endif

@include('partials.layout.nav')


@yield('content')
