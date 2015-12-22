@extends('layout')

@section('content')
<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block">
                <h3 class="section__title">Are you an expert in your field?</h3>
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
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/expert.jpg') }}')">
        <div class="__content-block">
            <form method="post" action="{{ url('request/bongo/send') }}" class="form-signin">
                {!! csrf_field() !!}
                
                <h3 class="form__heading">Request Invitation</h3>
                {!! $errors->first('first_name', '<span class="help-block">:message</span>' ) !!}
                {!! $errors->first('last_name', '<span class="help-block">:message</span>' ) !!}
                {!! $errors->first('company', '<span class="help-block">:message</span>' ) !!}
                {!! $errors->first('job_title', '<span class="help-block">:message</span>' ) !!}
                {!! $errors->first('field', '<span class="help-block">:message</span>' ) !!}
                {!! $errors->first('bongo_email', '<span class="help-block">:message</span>' ) !!}




                <div class="form-group">
                    <div class="form_field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                        <label for="first_name" class="sr-only">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name">
                    </div>

                    <div class="form_field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                        <label for="last_name" class="sr-only">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form_field {{ $errors->has('company') ? 'has-error' : ''}}" >
                        <label class="sr-only">Company Name</label>
                        <input type="text" name="company" class="form-control" placeholder="Your company name" />
                    </div>
                    <div class="form_field {{ $errors->has('job_title') ? 'has-error' : ''}}" >
                        <label class="sr-only">Job Title</label>
                        <input type="text" name="job_title" class="form-control" placeholder="Job title" />
                    </div>
                </div>

                <div class="form_field {{ $errors->has('field') ? 'has-error' : ''}}" >
                    <label class="sr-only">Expertise</label>
                    <input type="text" name="field" class="form-control" placeholder="Your field" />
                </div>

                <p class="form_field {{ $errors->has('field') ? 'has-error' : ''}}">
                    <label class="sr-only"></label>
                    <input type="email" name="bongo_email" class="form-control" placeholder="Please enter a valid email address" />
                </p>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
</div>
@stop