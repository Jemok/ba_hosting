@extends('layout')

@section('content')

<div class="col-md-6">

    <div class="col-md-12">
        <h4>About Bongo afrika Expert accounts</h4>

        <section>
            <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea.</p>
        </section>

    </div>

    <img src="{{ asset('images/image2.jpg')}}">


</div>


<form method="post" action="{{ url('request/bongo/send') }}">

    {!! csrf_field() !!}

    <label for="bongo_email">Your Email</label>

    <input type="email" name="bongo_email" />

    {!! $errors->first('bongo_email', '<span class="help-block">:message</span>' ) !!}

    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@stop