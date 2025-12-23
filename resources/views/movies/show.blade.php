@extends('layouts.app')

@section('title', $movie->title . ' - Movier')

@section('content')
    <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-2 text-red-500 no-underline font-medium mb-8 hover:text-red-600">
        ← Back to Movies
    </a>

    @include('components.movies.detail.hero-section', ['movie' => $movie])

    @include('components.movies.detail.movie-info', ['movie' => $movie])

    @include('components.movies.detail.reviews-section', compact('movie', 'comments'))

    @include('components.movies.detail.related-movies', compact('movie', 'relatedMovies'))
@endsection

@section('scripts')
<script>
function toggleReviewForm() {
    const form = document.getElementById('reviewForm');
    form.classList.toggle('hidden');
}
</script>
@endsection