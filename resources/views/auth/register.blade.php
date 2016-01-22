<!-- Displays the Innovator registration page -->

@extends('layout')


@section('content')
<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();
        
        $('a.scroll-down').click(function(e){
            e.preventDefault();
            scroll_target = $(this).data('href');
             $('html, body').animate({
                 scrollTop: $(scroll_target).offset().top - 60
             }, 1000);
        });

    });
    
    function rotateCard(btn){
        var $card = $(btn).closest('.r-card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
    
    
</script>
<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block">
                <h3 class="section__title">So you're an innovator?</h3>
                <p>You have to have a big vision and take very small steps to get there. You have to be humble as you execute but visionary and gigantic in terms of your aspiration. In the Internet industry, it's not about grand innovation, it's about a lot of little innovations: every day, every week, every month, making something a little bit better. - <em>Jason Calacanis</em></p>
                <p>Here's what you can do:</p>
                <ol>
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                    <li>Vestibulum auctor dapibus neque.</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/innovator.jpg') }}')">
        <div class="__content-block">
            @if(Session::has('flash_message'))

            <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
                @if(Session::has('flash_message_important'))

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                @endif

                {{ session('flash_message') }}

            </div>

            @endif

            <form method="POST" action="{{ url('auth/register/innovator') }}" class="form-signin">
                {!! csrf_field() !!}
                <div class="r-card-container manual-flip">
                    <div class="r-card">
                        <div class="front">
                            <div class="content">
                                <h3 class="form__heading">Let's get started!</h3>
                                <fieldset name="personal" class="form__cluster">
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
                                        <div class="form__field {{ $errors->has('email') ? 'has-error' : ''}}">
                                            <label for="email" class="sr-only">Email</label>
                                            {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form__field {{ $errors->has('password') ? 'has-error' : ''}}">
                                            <label for="password" class="sr-only">Password</label>
                                            {!! $errors->first('password', '<label class="help-block">:message</label>' ) !!}
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form__field">
                                            <label for="password_confirmation" class="sr-only">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form__field {{ $errors->has('terms') ? 'has-error' : ''}}">
                                    {!! $errors->first('terms', '<label class="help-block">:message</label>' ) !!}
                                    <label class="c-input c-checkbox">
                                        <input name="terms" value="1" type="checkbox" checked>
                                        <span class="c-indicator"></span>
                                        Agree with <a href="">Terms and Conditions</a>
                                    </label>
                                </div>

                                <div class="form__field">
                                    <button type="button" class="cta cta__btn" onclick="rotateCard(this)">Get Started</button>
                                </div>
                            </div>
                        </div> <!-- end front panel -->
                        <div class="back">
                            <div class="content">
                                <h3 class="form__heading">Almost Done!</h3>
                                <fieldset name="personal" class="form__cluster">
                                    <div class="form-group">
                                        <div class="form__field {{ $errors->has('more_details') ? 'has-error' : ''}}" >
                                            <label for="more_details" class="sr-only">More about you</label>
                                            {!! $errors->first('more_details', '<label class="help-block">:message</label>' ) !!}
                                            <textarea name="more_details" class="form-control" placeholder="Tell us about yourself in a paragraph or two" rows="7">{{ old('more_details') }}</textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <footer class="form__footer">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-link" onclick="rotateCard(this)">
                                            <i class="fa fa-reply"></i> Back
                                        </button>
                                        <button type="submit" class="cta cta__btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Complete Profile</button>
                                    </div>
                                </footer>
                            </div>
                        </div> <!-- end back panel -->
                    </div> <!-- end card -->
                </div> <!-- end card-container -->
            </form>
        </div>
    </section>
</div>
@stop
