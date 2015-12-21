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

            <form method="POST" action="{{ url('/password/email') }}" class="form-signin">
                {!! csrf_field() !!}

                @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <p class="form-field">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                </p>

                <div class="form-field">
                    <button type="submit" class="cta cta__btn">
                        Reset my password
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@stop