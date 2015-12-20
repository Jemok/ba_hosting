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


<div class="col-md-6 col-md-offset-2">
    <form method="POST" action="/password/email">
        {!! csrf_field() !!}

        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>

        <div>
            <button type="submit" class="cta cta__btn">
                Send Password Reset Link
            </button>
        </div>
    </form>
</div>

@stop