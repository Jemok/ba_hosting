@extends('layout')



@section('content')

<div class="container">
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
</div>
<div class="col-md-6">
    <form method="POST" action="{{ url('login') }}" class="form-signin">
        <h3 class="form__heading">Login</h3>
        {!! csrf_field() !!}

        <div class="form_field {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
        </div>
        {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password">
        </div>
        {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}

        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember"> Remember me
            </label>
        </div>
        <button type="submit" class="cta cta_btn">Login</button>
    </form>
</div>
<!--
<div class="col-md-6">

    <div class="col-md-12">

        <img src="{{ asset('images/image1.jpg')}}">
        <span class="col-md-offset-9">Be Free, Think, Live</span>

    </div>

</div>
-->
<div>
    <div class="col-md-6">

        <div class="col-md-3">

            <img src="{{ asset('images/image2.jpg')}}">
        </div>
        <div class="col-md-12">
            <h4>Why should you be part of this community?</h4>

            <section>
                <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea.<a href="{{ url('about')}}">More</a></p>
            </section>

        </div>
        <div class="col-md-6">
            <div class="col-md-6">

                <img src="{{ asset('images/image4.jpg')}}">
            </div>


            <div class="col-md-12">
                <h4>For Innovators</h4>
                <section>
                    <p>Lorem ipsum Rebum erat iriure vero sed delenit. Velit aliquyam clita accumsan et eum ipsum tation. <a href="{{ url('auth/register')}}">Register</a> </p>
                </section>
            </div>
        </div>

        <div class="col-md-6">

            <div class="col-md-6">

                <img src="{{ asset('images/image3.jpeg')}}">
            </div>

            <div class="col-md-12">
                <h4>For Investors</h4>
                <section>
                    <p>Lorem ipsum Feugiat ea erat dolor ipsum ullamcorper. Invidunt eum et rebum diam stet labore consequat est.<a href="{{ url('request/investor/send')}}">Send Request</a> </p>
                </section>
            </div>
        </div>
    </div>


</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>



