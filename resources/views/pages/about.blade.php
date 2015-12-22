@extends('layout')

@section('content')

<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block m-b-lg">
                <h3 class="section__title">Who are we?</h3>
                <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea</p>
            </div>

            <div class="__section with-columns">
                <div class="__content-block">
                    <h4 class="section__title">Our mission</h4>
                    <p>Lorem ipsum Rebum erat iriure vero sed delenit. Velit aliquyam clita accumsan et eum ipsum tation.</p>
                </div>
                <div class="__content-block">
                    <h4 class="section__title">Our vision</h4>
                    <p>Lorem ipsum Rebum erat iriure vero sed delenit. Velit aliquyam clita accumsan et eum ipsum tation.</p>
                </div>
            </div>

            <div class="__content-block m-b-lg">
                <h3 class="section__title">Bongo afrika offers..</h3>
                <p>Lorem ipsum Et lorem magna feugiat et magna. Sea tation sed vero sed tempor est lorem doming. Ipsum at vel nisl nobis elit et elit molestie vel rebum. Invidunt takimata qui duo duo justo erat rebum sea</p>
            </div>
        </div>
    </section>
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/innovation-1.jpg') }}')">
        <div class="__content-block">

        </div>
    </section>
</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>