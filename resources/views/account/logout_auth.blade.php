<!-- Displays the view that enables a logged in user to logout if the site requires so  -->

@extends('layout')

@section('content')

<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block">
                <h3 class="section__title">Glad to have another investor onboard!</h3>
                <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea.</p>
                <p>Here's what you can do:</p>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                    <li>Vestibulum auctor dapibus neque.</li>
                </ol>
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
                <h3 class="form__heading">Not you? Click logout, then go click the email link again</h3>
                {!! csrf_field() !!}

                <div class="form_field {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="email" class="sr-only">Email address</label>
                    <p name="email" class="form-control">{{ $email }}</p>
                </div>
                {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field {{ $errors->has('password') ? 'has-error' : ''}}">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" value="remember">
                        <span class="c-indicator"></span>
                        Remember me | <a href="{{ url('password/email') }}">Forgot Password?</a>
                    </label>
                </div>
                <button type="submit" class="btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Login</button> <a href="{{ url('/logout') }}" class="btn btn-primary">Logout</a>
            </form>
        </div>
    </section>
</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>