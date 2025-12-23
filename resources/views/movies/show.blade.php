@extends('layouts.app')

@section('title', $movie->title . ' - Movier')

@section('styles')
<style>
    /* Movie Hero */
    .movie-hero {
        background: #ffffff;
        border-bottom: 1px solid #e4e4e7;
        padding: 3rem 0;
        margin-bottom: 0;
    }

    .movie-hero-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 4rem;
        align-items: start;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .movie-poster-large {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #e4e4e7;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
    }

    .movie-poster-large:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .movie-details h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 3rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        line-height: 1.1;
        color: #0a0a0a;
        letter-spacing: -0.025em;
    }

    .movie-meta-row {
        display: flex;
        gap: 3rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .meta-label {
        font-family: 'Outfit', sans-serif;
        font-weight: 500;
        font-size: 0.875rem;
        color: #71717a;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .meta-value {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: #0a0a0a;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1rem 0;
    }

    .stars {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .hero-star-icon {
        width: 20px;
        height: 20px;
    }

    .hero-star-icon.filled {
        color: #eab308;
        fill: #eab308;
    }

    .hero-star-icon.empty {
        color: #d1d5db;
        fill: none;
    }

    .rating-number {
        font-family: 'Outfit', sans-serif;
        font-size: 1.125rem;
        font-weight: 600;
        background: #f4f4f5;
        color: #0a0a0a;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #e4e4e7;
    }

    .movie-description {
        font-family: 'Outfit', sans-serif;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 650px;
        color: #52525b;
        font-weight: 400;
    }

    .genres-list {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .genre-badge {
        font-family: 'Outfit', sans-serif;
        background: #f4f4f5;
        color: #52525b;
        padding: 0.5rem 0.875rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid #e4e4e7;
        transition: all 0.2s ease;
    }

    .genre-badge:hover {
        background: #e4e4e7;
        color: #0a0a0a;
    }


    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .info-item h3 {
        color: #e74c3c;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .info-item p {
        color: #666;
        line-height: 1.6;
    }

    /* Comments Section */
    .comments-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin: 3rem 0;
        overflow: hidden;
    }

    .comments-header {
        background: #f8f9fa;
        padding: 2rem;
        border-bottom: 1px solid #e9ecef;
    }

    .comments-title {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0;
        font-size: 1.5rem;
        color: #333;
    }

    .comments-count {
        background: #e74c3c;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .comments-list {
        max-height: 600px;
        overflow-y: auto;
    }

    .comment-item {
        padding: 2rem;
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.3s;
    }

    .comment-item:last-child {
        border-bottom: none;
    }

    .comment-item:hover {
        background: #fafbfc;
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

    .user-avatar-fallback {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .comment-user-info {
        flex: 1;
    }

    .comment-username {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .verified-badge {
        color: #28a745;
        font-size: 0.9rem;
    }

    .comment-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #666;
        font-size: 0.9rem;
    }

    .comment-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #f4f4f5;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        border: 1px solid #e4e4e7;
        font-weight: 500;
    }

    .rating-stars {
        display: flex;
        align-items: center;
        gap: 0.125rem;
    }

    .star-icon {
        width: 14px;
        height: 14px;
        transition: all 0.2s ease;
    }

    .star-icon.filled {
        color: #eab308;
        fill: #eab308;
    }

    .star-icon.empty {
        color: #d1d5db;
        fill: none;
    }

    .rating-text {
        font-family: 'Outfit', sans-serif;
        font-size: 0.875rem;
        color: #52525b;
        font-weight: 600;
    }

    .comment-date {
        color: #999;
    }

    .comment-content {
        margin-bottom: 1rem;
        line-height: 1.6;
        color: #444;
    }

    .comment-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .helpful-votes {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #71717a;
        font-size: 0.875rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 500;
    }

    .helpful-icon {
        width: 16px;
        height: 16px;
        color: #22c55e;
        transition: all 0.2s ease;
    }

    .helpful-votes:hover .helpful-icon {
        color: #16a34a;
    }

    .no-comments {
        padding: 3rem;
        text-align: center;
        color: #666;
    }

    .no-comments h4 {
        margin-bottom: 0.5rem;
        color: #333;
    }

    /* Related Movies */
    .related-section {
        margin-top: 4rem;
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
        color: #333;
        font-weight: 600;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }

    .related-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .related-poster {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .related-info {
        padding: 1.5rem;
    }

    .related-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .related-meta {
        display: flex;
        justify-content: space-between;
        color: #666;
        font-size: 0.9rem;
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #e74c3c;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: color 0.3s;
    }

    .back-button:hover {
        color: #c0392b;
    }

    /* Additional Movie Info Section */
    .movie-info-section {
        background: white;
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin: 3rem 0;
        transform: translateY(-2rem);
        position: relative;
        z-index: 10;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .movie-hero {
            padding: 2rem 0;
        }

        .movie-hero-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 0 1rem;
        }
        
        .movie-details h1 {
            font-size: 2.25rem;
        }
        
        .movie-meta-row {
            gap: 2rem;
            justify-content: center;
        }

        .movie-description {
            max-width: 100%;
            text-align: left;
        }

        .rating-display {
            justify-content: center;
        }

        .genres-list {
            justify-content: center;
        }
        
        .movie-info-section {
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .related-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .movie-hero {
            padding: 1.5rem 0;
        }

        .movie-details h1 {
            font-size: 1.875rem;
        }

        .movie-meta-row {
            gap: 1.5rem;
        }

        .rating-number {
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
        }

        .stars {
            font-size: 1.125rem;
        }

        .genre-badge {
            font-size: 0.8125rem;
            padding: 0.375rem 0.75rem;
        }
    }
</style>
@endsection

@section('content')
    <a href="{{ route('movies.index') }}" class="back-button">
        ← Back to Movies
    </a>

    <!-- Movie Hero Section -->
    <section class="movie-hero">
        <div class="movie-hero-content">
            <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="movie-poster-large">
            
            <div class="movie-details">
                <h1>{{ $movie->title }}</h1>
                
                <div class="movie-meta-row">
                    <div class="meta-item">
                        <span class="meta-label">Year</span>
                        <span class="meta-value">{{ $movie->year }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Duration</span>
                        <span class="meta-value">{{ $movie->getFormattedDurationAttribute() }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Director</span>
                        <span class="meta-value">{{ $movie->director }}</span>
                    </div>
                </div>

                <div class="rating-display">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($movie->rating))
                                <i data-lucide="star" class="hero-star-icon filled"></i>
                            @elseif($i - 0.5 <= $movie->rating)
                                <i data-lucide="star" class="hero-star-icon filled"></i>
                            @else
                                <i data-lucide="star" class="hero-star-icon empty"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="rating-number">{{ number_format($movie->rating, 1) }}/5</div>
                </div>

                <div class="genres-list">
                    @foreach($movie->genres as $genre)
                        <span class="genre-badge">{{ $genre }}</span>
                    @endforeach
                </div>

                <p class="movie-description">{{ $movie->description }}</p>
            </div>
        </div>
    </section>

    <!-- Additional Movie Information -->
    <section class="movie-info-section">
        <div class="info-grid">
            <div class="info-item">
                <h3>Cast</h3>
                <p>{{ $movie->getCastStringAttribute() }}</p>
            </div>
            <div class="info-item">
                <h3>Director</h3>
                <p>{{ $movie->director }}</p>
            </div>
            <div class="info-item">
                <h3>Release Year</h3>
                <p>{{ $movie->year }}</p>
            </div>
            <div class="info-item">
                <h3>Duration</h3>
                <p>{{ $movie->getFormattedDurationAttribute() }}</p>
            </div>
        </div>
    </section>

    <!-- Comments Section -->
    <section class="comments-section">
        <div class="comments-header">
            <h2 class="comments-title">
                User Reviews
                <span class="comments-count">{{ $comments->count() }}</span>
            </h2>
        </div>

        @if($comments->isNotEmpty())
            <div class="comments-list">
                @foreach($comments as $comment)
                    @php
                        $user = $comment->user();
                    @endphp
                    <div class="comment-item">
                        <div class="comment-header">
                            @if($user && $user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="user-avatar">
                            @else
                                <div class="user-avatar-fallback">
                                    {{ $user ? $user->getInitialsAttribute() : 'U' }}
                                </div>
                            @endif
                            
                            <div class="comment-user-info">
                                <div class="comment-username">
                                    {{ $user ? $user->name : 'Anonymous User' }}
                                    @if($user && $user->verified)
                                        <span class="verified-badge">✓</span>
                                    @endif
                                </div>
                                <div class="comment-meta">
                                    <div class="comment-rating">
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $comment->rating)
                                                    <i data-lucide="star" class="star-icon filled"></i>
                                                @else
                                                    <i data-lucide="star" class="star-icon empty"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="rating-text">{{ $comment->rating }}/5</span>
                                    </div>
                                    <span class="comment-date">{{ $comment->getFormattedDateAttribute() }}</span>
                                    @if($user)
                                        <span>{{ $user->total_reviews }} reviews</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="comment-content">
                            {{ $comment->comment }}
                        </div>

                        <div class="comment-actions">
                            <div class="helpful-votes">
                                <i data-lucide="thumbs-up" class="helpful-icon"></i>
                                <span>{{ $comment->helpful_votes }} found this helpful</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-comments">
                <h4>No reviews yet</h4>
                <p>Be the first to share your thoughts about this movie!</p>
            </div>
        @endif
    </section>

    <!-- Related Movies -->
    @if($relatedMovies->isNotEmpty())
    <section class="related-section">
        <h2 class="section-title">More {{ $movie->genres[0] ?? 'Similar' }} Movies</h2>
        <div class="related-grid">
            @foreach($relatedMovies as $relatedMovie)
                <a href="{{ route('movies.show', $relatedMovie->id) }}" class="related-card">
                    <img src="{{ $relatedMovie->poster }}" alt="{{ $relatedMovie->title }}" class="related-poster">
                    <div class="related-info">
                        <h3 class="related-title">{{ $relatedMovie->title }}</h3>
                        <div class="related-meta">
                            <span>{{ $relatedMovie->year }}</span>
                            <span>⭐ {{ number_format($relatedMovie->rating, 1) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
@endsection