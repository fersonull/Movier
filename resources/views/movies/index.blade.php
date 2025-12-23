@extends('layouts.app')

@section('title', 'Movier - Discover Great Movies')

@section('content')
    @if(!$genre)
        @include('components.movies.hero-section')
    @endif

    @include('components.movies.search-filter', compact('search', 'genre', 'genres'))

    @include('components.movies.featured-section', compact('featuredMovies', 'genre'))

    @include('components.movies.movie-grid', compact('movies', 'search', 'genre'))
@endsection