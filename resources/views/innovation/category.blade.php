@extends('layout')

@section('content')

<div class="container">
    <header>

        <h2 class="section__title">Open Projects under - {{$categoryName}}</h2>

    </header>
    @include('partials.innovations.open')
</div>


@stop

