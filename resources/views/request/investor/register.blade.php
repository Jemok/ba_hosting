@extends('......layout')

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
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/investor.jpg') }}')">
        <div class="__content-block">            
            <form method="POST" action="{{ url('auth/register/investor') }}" class="form-signin">
                {!! csrf_field() !!}

                <h3 class="form__heading">Let's secure your account!</h3>
                <div class="form-group">
                    <div class="form_field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                        <label for="first_name" class="sr-only">Name</label>
                        <div name="first_name" class="form-control"></div>
                    </div>
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>' ) !!}

                    <div class="form_field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                        <label for="last_name" class="sr-only">Name</label>
                        <div name="last_name" class="form-control"></div>
                    </div>
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>' ) !!}
                </div>

                <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" value="{{ $confirm->investor_email}}" class="form-control" placeholder="Email">
                </div>
                {!! $errors->first('email', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                {!! $errors->first('password', '<span class="help-block">:message</span>' ) !!}

                <div class="form_field">
                    <label for="password" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>

                {!! $errors->first('userCategory', '<span class="help-block">:message</span>' ) !!}

                <button type="submit" class="cta cta_btn">Register</button>
            </form>
        </div>
    </section>
</div>
@stop