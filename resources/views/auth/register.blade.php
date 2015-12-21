@extends('......layout')


@section('content')
<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block">
                <h3 class="section__title">So you're an innovator?</h3>
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
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/innovator.jpg') }}')">
        <div class="__content-block">
            @if(Session::has('flash_message'))

            <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
                @if(Session::has('flash_message_important'))

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                @endif

                {{ session('flash_message') }}

            </div>

            @endif

            <form method="POST" action="{{ url('auth/register/innovator') }}" class="form-signin">

                {!! csrf_field() !!}

                <h3 class="form__heading">Let's get started!</h3>
                <div class="form-group">
                    <div class="form_field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                        <label for="first_name" class="sr-only">Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name">
                    </div>
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>' ) !!}
                    <div class="form_field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                        <label for="last_name" class="sr-only">Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name">
                    </div>
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>' ) !!}
                </div>
<!--
                <div class="form_field {{ $errors->has('more_details') ? 'has-error' : ''}}" >
                    <label for="more_details" class="sr-only">More about you</label>
                    <textarea name="more_details" class="form-control" placeholder="Tell us about yourself in one paragraph">{{ old('more_details') }}</textarea>
                </div>
                {!! $errors->first('more_details', '<span class="help-block">:message</span>' ) !!}
-->

                <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                </div>
                {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}
                <div class="form_field">
                    <label for="password" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>

                <div class="form_field {{ $errors->has('terms') ? 'has-error' : ''}}">
                    <label class="c-input c-checkbox">
                        <input name="terms" value="1" type="checkbox">
                        <span class="c-indicator"></span>
                        Agree with <a href="">Terms and Conditions</a>
                    </label>
                </div>
                {!! $errors->first('terms', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field">
                    <button type="submit" class="cta cta__btn">Get Started</button>
                </div>
            </form>
        </div>
    </section>
</div>
@stop
