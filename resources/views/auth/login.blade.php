@extends('layout')

@section('content')

<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block m-b-lg">
                <h3 class="section__title">Why should you be part of this community?</h3>
                <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea... <a href="{{ url('about')}}">Tell me more</a></p>
            </div>
            <div class="__section with-columns">            
                <div class="__content-block">
                    <h4 class="section__title">For Innovators</h4>
                    <p>Lorem ipsum Rebum erat iriure vero sed delenit. Velit aliquyam clita accumsan et eum ipsum tation.</p>
                    <a href="{{ url('auth/register') }}" class="btn btn-primary">Get Started Today</a>
                </div>
                <div class="__content-block">
                    <h4 class="section__title">For Investors</h4>
                    <p>Lorem ipsum Rebum erat iriure vero sed delenit. Velit aliquyam clita accumsan et eum ipsum tation.</p>
                    <a href="{{ url('request/investor/send') }}">Request Invitation</a>
                </div>
            </div>
        </div>
    </section>
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/innovation-1.jpg') }}')">
        <div class="__content-block">
            @if(Session::has('flash_message'))

            <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
                @if(Session::has('flash_message_important'))

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                @endif

                {{ session('flash_message') }}

            </div>

            @endif

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
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}

                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember"> Remember me
                    </label>
                </div>
                <button type="submit" class="cta cta__btn">Login</button>

                <a href="{{ url('password/email') }}">Forgot Password?</a>
            </form>



        </div>
    </section>
</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>