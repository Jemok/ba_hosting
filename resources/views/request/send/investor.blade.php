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
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/investor.jpg') }}')">
        <div class="__content-block">
            <form method="post" action="{{ url('request/investor/send') }}" class="form-signin">

                {!! csrf_field() !!}

                <p class="form_field {{ $errors->has('company') ? 'has-error' : ''}}" >
                    <label for="company">Company</label>
                    <input type="text" name="company" class="form-control" placeholder="Your company" />
                </p>
                {!! $errors->first('company', '<span class="help-block">:message</span>' ) !!}

                <p class="form_field {{ $errors->has('job_title') ? 'has-error' : ''}}" >
                    <label for="job_title">Job Title</label>
                    <input type="text" name="job_title" class="form-control" placeholder="Job title" />
                </p>
                {!! $errors->first('job_title', '<span class="help-block">:message</span>' ) !!}


                <p class="form_field {{ $errors->has('investor_email') ? 'has-error' : ''}}" >
                    <label for="investor_email">Your Email</label>
                    <input type="email" name="investor_email" class="form-control" placeholder="Please enter a valid email address" />
                </p>
                {!! $errors->first('investor_email', '<span class="help-block">:message</span>' ) !!}
                
                <div class="form_field">
                    <button type="submit" class="cta cta__btn">Send Invitation</button>
                </div>
            </form>
        </div>
    </section>
</div>
@stop