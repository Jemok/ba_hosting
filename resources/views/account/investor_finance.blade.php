<!-- Displays the view for setting an investors finance -->
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
            <form method="post" action="{{ url('investor/add-finance') }}" class="form-signin">
                {!! CSRF_FIELD() !!}

                <h3 class="form__heading">... One more thing!</h3>
                <div class="form_field {{ $errors->has('financial_amount') ? 'has-error' : ''}}" >
                    <label for="financial_amount" class="sr-only">Amount</label>
                    <input type="text" name="financial_amount" value="{{ old('financial_amount') }}" class="form-control" placeholder="What amount would you like to invest?">
                </div>
                {!! $errors->first('financial_amount', '<span class="help-block">:message</span>' ) !!}

                <button type="submit" class="cta cta_btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Set funding</button>
            </form>
        </div>
    </section>
</div>
@stop