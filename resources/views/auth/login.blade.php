<!-- Displays the login page -->

@extends('layout')

@section('content')

<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block m-b-lg">
                <h3 class="section__title">What we do?</h3>
                <ul>
                    <li>Aid and link to resource mobilization</li>
                    <li>Networking and interaction platform for innovators, entrepreneurs and investors. </li>
                    <li>Link to employment and consultancy opportunities. </li>
                    <li>Showcasing innovations, solutions and talents to potential investors and consumers</li>
                    <li>A digital footprint of intellectual work</li>
                </ul>
             </div>
            <div class="__section with-columns">            
                <div class="__content-block">
                    <h4 class="section__title">Our mission</h4>
                    <p>Bongo Afrika is committed to discover and explore African ingenuity by creating infrastructures that meet needs of entrepreneurs, innovators and consumers.</p>
                    <h4 class="section__title">Our vision</h4>
                    <p>Driven by African Ingenuity.</p>
                </div>
                <!--<div class="__content-block">

                </div>-->
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



            <form method="POST" action="{{ url('login') }}" class="form-signin">
                <h3 class="form__heading">Login</h3>
                {!! csrf_field() !!}
                <fieldset class="form__cluster">
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="sr-only">Email address</label>
                            {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password" class="sr-only">Password</label>
                            {!! $errors->first('password', '<label class="help-block">:message</label>' ) !!}
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                </fieldset>
                <div class="form__field">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" value="remember">
                        <span class="c-indicator"></span>
                        Remember me | <a href="{{ url('password/email') }}">Forgot Password?</a>
                    </label>
                </div>
                <footer class="form__footer">
                    <button type="submit" class="btn btn-primary" id="btnADD" data-clicked="Logging you in...">Login</button>
                </footer>
            </form>
        </div>
    </section>
</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>

<script>
    var $myForm = $("#my_form");
    $myForm.submit(function(){
        $myForm.submit(function(){
            return false;
        });
    });
</script>