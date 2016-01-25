<!-- Displays the Bongo Moderator Creation Page  -->
@extends('layout')

@section('content')

@if(Session::has('flash_message'))

<div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    @endif

    {{ session('flash_message') }}

</div>

@endif

<form method="POST" action="{{ route('registerModerator') }}" class="form-signin">
    {!! csrf_field() !!}
    <div class="r-card-container manual-flip">
        <div class="r-card">
            <div class="front">
                <div class="content">
                    <h3 class="form__heading">Register</h3>
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

                    <footer class="form__footer">
                        <div class="btn-group">

                            <button type="submit" class="cta cta__btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Add Moderator</button>
                        </div>
                    </footer>
                </div>
            </div> <!-- end back panel -->
        </div> <!-- end card -->
    </div> <!-- end card-container -->
</form>

@stop
