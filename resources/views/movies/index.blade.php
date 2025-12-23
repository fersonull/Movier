@extends('layouts.app')

@section('title', 'Movier - Discover Great Movies')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: #ffffff;
        border-bottom: 1px solid #e4e4e7;
        padding: 4rem 0;
        text-align: center;
        margin-bottom: 0;
    }

    .hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 3rem;
        margin-bottom: 1rem;
        font-weight: 700;
        color: #0a0a0a;
        letter-spacing: -0.025em;
    }

    .hero p {
        font-family: 'Outfit', sans-serif;
        font-size: 1.125rem;
        color: #52525b;
        max-width: 600px;
        margin: 0 auto;
        font-weight: 400;
    }

    /* Genre Filter */
    .genre-filter {
        background: #ffffff;
        border: 1px solid #e4e4e7;
        padding: 2rem;
        border-radius: 12px;
        margin: 2rem 0;
    }

    .genre-filter h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #0a0a0a;
    }

    .genre-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .genre-tag {
        font-family: 'Outfit', sans-serif;
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #f4f4f5;
        color: #52525b;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid #e4e4e7;
        transition: all 0.2s ease;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .genre-tag:hover {
        background: #e4e4e7;
        color: #0a0a0a;
        border-color: #d4d4d8;
    }

    .genre-tag.active {
        background: #0a0a0a;
        color: #ffffff;
        border-color: #0a0a0a;
    }

    /* Movies Grid */
    .section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #0a0a0a;
        font-weight: 600;
        letter-spacing: -0.025em;
    }

    .movies-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .movie-card {
        background: #ffffff;
        border: 1px solid #e4e4e7;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .movie-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-color: #d4d4d8;
    }

    .movie-poster {
        width: 100%;
        height: 400px;
        object-fit: cover;
        background: #f4f4f5;
    }

    .movie-info {
        padding: 1.5rem;
    }

    .movie-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #0a0a0a;
        line-height: 1.3;
    }

    .movie-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .movie-year {
        font-family: 'Outfit', sans-serif;
        color: #71717a;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .movie-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: #eab308;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .card-star-icon {
        width: 14px;
        height: 14px;
        color: #eab308;
        fill: #eab308;
    }

    .movie-genres {
        font-family: 'Outfit', sans-serif;
        color: #71717a;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        font-weight: 400;
    }

    .movie-description {
        font-family: 'Outfit', sans-serif;
        color: #52525b;
        font-size: 0.875rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-weight: 400;
    }

    /* Featured Section */
    .featured-movies {
        margin-bottom: 4rem;
        background: #ffffff;
        border: 1px solid #e4e4e7;
        border-radius: 12px;
        padding: 2rem;
        margin-top: 2rem;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #71717a;
        background: #ffffff;
        border: 1px solid #e4e4e7;
        border-radius: 12px;
        margin: 2rem 0;
    }

    .empty-state h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #0a0a0a;
    }

    .empty-state p {
        font-family: 'Outfit', sans-serif;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero {
            padding: 3rem 0;
        }

        .hero h1 {
            font-size: 2.25rem;
        }

        .hero p {
            font-size: 1rem;
        }
        
        .genre-filter {
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .genre-filter h2 {
            font-size: 1.25rem;
        }
        
        .movies-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .featured-movies {
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .featured-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
        
        .genre-tags {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero {
            padding: 2rem 0;
        }

        .hero h1 {
            font-size: 1.875rem;
        }

        .genre-filter {
            padding: 1rem;
        }

        .movies-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .featured-grid {
            grid-template-columns: 1fr;
        }

        .movie-info {
            padding: 1.25rem;
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
                                <i data-lucide="star" class="card-star-icon"></i>
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