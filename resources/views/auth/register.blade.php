@extends('......layout')


@section('content')



<div class="col-md-6">

    <div class="col-md-12">
        <h4>About Bongo afrika Innovators account</h4>

        <section>
            <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea.</p>
        </section>

    </div>

    <img src="{{ asset('images/image4.jpg')}}">

</div>
<div class="col-md-6">
    <form method="POST" action="{{ url('auth/register/innovator') }}" class="form-signin">

        {!! csrf_field() !!}

        <h3 class="form__heading">Register</h3>
        <div class="form_field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
            <label for="first_name" class="sr-only">Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="first name">
        </div>
        {!! $errors->first('first_name', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
            <label for="last_name" class="sr-only">Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="last name">
        </div>
        {!! $errors->first('last_name', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('more_details') ? 'has-error' : ''}}" >
            <label for="more_details" class="sr-only">More about you</label>
            <textarea name="more_details" class="form-control" placeholder="More details about you">{{ old('more_details') }}</textarea>
        </div>
        {!! $errors->first('more_details', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
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

        <p>Terms and conditions here</p>

        Agree with terms and conditions
        <div class="form_field {{ $errors->has('terms') ? 'has-error' : ''}}">
            <input name="terms" value="1" type="checkbox">
        </div>
        {!! $errors->first('terms', '<span class="help-block">:message</span>' ) !!}

        <div class="form_field">
            <button type="submit" class="cta cta_btn">Register</button>
        </div>
    </form>
</div>
@stop
