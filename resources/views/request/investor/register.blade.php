<!-- Displays the investor registration page -->

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
                <fieldset class="form__cluster">
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('company') ? 'has-error' : ''}}" >
                            <label for="company" class="sr-only">Company</label>
                            {!! $errors->first('company', '<label class="help-block">:message</label>' ) !!}
                            <div name="company" class="form-control">{{ $confirm->company }}</div>
                        </div>

                        <div class="form__field {{ $errors->has('job_title') ? 'has-error' : ''}}" >
                            <label for="job_title" class="sr-only">Job Title</label>
                            {!! $errors->first('job_title', '<label class="help-block">:message</label>' ) !!}
                            <div name="job_title" class="form-control">{{ $confirm->job_title }}</div>
                        </div>
                    </div>

                    <div class="form__field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                        <label for="first_name" class="sr-only">First Name</label>
                        {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                        <input name="first_name" value="{{ $confirm->first_name }}" class="form-control" placeholder="First Name">
                    </div>

                    <div class="form__field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                        <label for="last_name" class="sr-only">Last Name</label>
                        {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                        <input name="last_name" value="{{ $confirm->last_name }}" class="form-control" placeholder="Last Name">
                    </div>

                    <div class="form__field {{ $errors->has('email') ? 'has-error' : ''}}">
                        <label for="email" class="sr-only">Email</label>
                        {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                        <input type="email" name="email" value="{{ $confirm->investor_email}}" class="form-control" placeholder="Email">
                    </div>

                    <div class="form__field {{ $errors->has('more_details') ? 'has-error' : ''}}" >
                         <label for="more_details" class="sr-only">More about you</label>
                         {!! $errors->first('more_details', '<label class="help-block">:message</label>' ) !!}
                         <textarea name="more_details" class="form-control" placeholder="Tell us about yourself in a paragraph or two" rows="7">{{ old('more_details') }}</textarea>
                    </div>


                    <div class="form__field {{ $errors->has('password') ? 'has-error' : ''}}">
                        <label for="password" class="sr-only">Password</label>
                        {!! $errors->first('password', '<label class="help-block">:message</label>' ) !!}
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>

                    <div class="form__field">
                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        {!! $errors->first('password_confirmation', '<label class="help-block">:message</label>' ) !!}
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>
                </fieldset>
                
                <footer class="form__footer">
                    <button type="submit" class="cta cta_btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Register</button>
                </footer>
            </form>
        </div>
    </section>
</div>
@stop