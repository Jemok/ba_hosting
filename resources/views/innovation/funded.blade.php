@extends('layout')

@section('content')

<div class="col-lg-12">
    <nav class="innoFilters">
        <button class="filter current" data-filter="*">Show all</button>
        @if($categories->count())

        @foreach($categories as $category)
        <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
        @endforeach

        @endif
    </nav>
</div>

@include('partials.innovations.funded')

@stop
