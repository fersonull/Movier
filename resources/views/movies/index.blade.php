@extends('layouts.app')

@section('title', 'Movier - Discover Great Movies')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 3rem;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .hero p {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Genre Filter */
    .genre-filter {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 3rem;
    }

    .genre-filter h2 {
        margin-bottom: 1rem;
        color: #333;
    }

    .genre-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .genre-tag {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #f1f3f4;
        color: #333;
        text-decoration: none;
        border-radius: 25px;
        transition: all 0.3s;
        font-weight: 500;
    }

    .genre-tag:hover,
    .genre-tag.active {
        background: #e74c3c;
        color: white;
        transform: translateY(-2px);
    }

    /* Movies Grid */
    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #333;
        font-weight: 600;
    }

    .movies-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .movie-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .movie-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .movie-poster {
        width: 100%;
        height: 400px;
        object-fit: cover;
        background: #f0f0f0;
    }

    .movie-info {
        padding: 1.5rem;
    }

    .movie-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
        line-height: 1.3;
    }

    .movie-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .movie-year {
        color: #666;
        font-size: 0.9rem;
    }

    .movie-rating {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: #f39c12;
        font-weight: 600;
    }

    .movie-genres {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .movie-description {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Featured Section */
    .featured-movies {
        margin-bottom: 4rem;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #666;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2rem;
        }
        
        .movies-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .genre-tags {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    @if(!$genre)
    <section class="hero">
        <h1>Discover Great Movies</h1>
        <p>Explore our curated collection of top-rated films from every genre. Find your next favorite movie today.</p>
    </section>
    @endif

    <!-- Genre Filter -->
    <div class="genre-filter">
        <h2>Browse by Genre</h2>
        <div class="genre-tags">
            <a href="{{ route('movies.index') }}" class="genre-tag {{ !$genre ? 'active' : '' }}">
                All Movies
            </a>
            @foreach($genres as $genreItem)
                <a href="{{ route('movies.index') }}?genre={{ $genreItem['name'] }}" 
                   class="genre-tag {{ $genre === $genreItem['name'] ? 'active' : '' }}">
                    {{ $genreItem['name'] }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Featured Movies (only on homepage) -->
    @if($featuredMovies->isNotEmpty() && !$genre)
    <section class="featured-movies">
        <h2 class="section-title">Featured Movies</h2>
        <div class="featured-grid">
            @foreach($featuredMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="movie-card">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="movie-poster">
                    <div class="movie-info">
                        <h3 class="movie-title">{{ $movie->title }}</h3>
                        <div class="movie-meta">
                            <span class="movie-year">{{ $movie->year }}</span>
                            <div class="movie-rating">
                                <span>⭐</span>
                                <span>{{ number_format($movie->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="movie-genres">{{ $movie->getGenresStringAttribute() }}</div>
                        <p class="movie-description">{{ $movie->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- All Movies -->
    <section>
        <h2 class="section-title">
            @if($genre)
                {{ $genre }} Movies
            @else
                All Movies
            @endif
        </h2>

        @if($movies->isNotEmpty())
            <div class="movies-grid">
                @foreach($movies as $movie)
                    <a href="{{ route('movies.show', $movie->id) }}" class="movie-card">
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="movie-poster">
                        <div class="movie-info">
                            <h3 class="movie-title">{{ $movie->title }}</h3>
                            <div class="movie-meta">
                                <span class="movie-year">{{ $movie->year }}</span>
                                <div class="movie-rating">
                                    <span>⭐</span>
                                    <span>{{ number_format($movie->rating, 1) }}</span>
                                </div>
                            </div>
                            <div class="movie-genres">{{ $movie->getGenresStringAttribute() }}</div>
                            <p class="movie-description">{{ $movie->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>No movies found</h3>
                <p>Try selecting a different genre or check back later.</p>
            </div>
        @endif
    </section>
@endsection