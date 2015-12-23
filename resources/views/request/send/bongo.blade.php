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
                <fieldset class="form__cluster">
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                            <label for="first_name" class="sr-only">First Name</label>
                            {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name">
                        </div>

                        <div class="form__field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                            <label for="last_name" class="sr-only">Last Name</label>
                            {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('company') ? 'has-error' : ''}}" >
                            <label class="sr-only">Company Name</label>
                            {!! $errors->first('company', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="company" class="form-control" placeholder="Company name" />
                        </div>

                        <div class="form__field {{ $errors->has('job_title') ? 'has-error' : ''}}" >
                            <label class="sr-only">Job Title</label>
                            {!! $errors->first('job_title', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="job_title" class="form-control" placeholder="Job title" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('field') ? 'has-error' : ''}}" >
                            <label class="sr-only">Expertise</label>
                            {!! $errors->first('field', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="field" class="form-control" placeholder="What's your field of expertise" />
                        </div>
                    </div>
                       
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('bongo_email') ? 'has-error' : ''}}" >
                            <label class="sr-only"></label>
                            {!! $errors->first('bongo_email', '<label class="help-block">:message</label>' ) !!}
                            <input type="email" name="bongo_email" class="form-control" placeholder="Please enter a valid email address" />
                        </div>
                    </div>
                </fieldset>
                
                <footer class="form__footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </footer>
            </form>
        </div>
    </section>
</div>
@stop