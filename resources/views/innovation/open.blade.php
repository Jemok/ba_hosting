<!-- Displays all open innovations on their on single page -->

@extends('layout')

@section('content')

<div class="container">
    <nav class="innoFilters">
        <button class="filter current" data-filter="*">Show all</button>
        @if($categories->count())

        @foreach($categories as $category)
        <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
        @endforeach

        @endif
    </nav>

    @include('partials.innovations.open')
</div>

@stop

