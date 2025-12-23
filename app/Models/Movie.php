<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Movie
{
    protected array $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Get all movies from JSON file
     */
    public static function all(): Collection
    {
        $path = storage_path('app/data/movies.json');
        
        if (!file_exists($path)) {
            return collect();
        }
        
        $json = file_get_contents($path);
        $moviesData = json_decode($json, true);

        return collect($moviesData)->map(function ($movieData) {
            return new static($movieData);
        });
    }

    /**
     * Find a movie by ID
     */
    public static function find(int $id): ?Movie
    {
        $movies = static::all();
        foreach ($movies as $movie) {
            if ($movie->id == $id) {
                return $movie;
            }
        }
        return null;
    }

    /**
     * Get movies filtered by genre
     */
    public static function byGenre(string $genre): Collection
    {
        return static::all()->filter(function ($movie) use ($genre) {
            return in_array($genre, $movie->genres ?? []);
        });
    }

    /**
     * Get all unique genres from movies
     */
    public static function getAllGenres(): Collection
    {
        $path = storage_path('app/data/genres.json');
        
        if (!file_exists($path)) {
            return collect();
        }
        
        $json = file_get_contents($path);
        return collect(json_decode($json, true));
    }

    /**
     * Get featured/top rated movies
     */
    public static function featured(): Collection
    {
        return static::all()->sortByDesc('rating')->take(6);
    }

    /**
     * Get movies by year
     */
    public static function byYear(int $year): Collection
    {
        return static::all()->where('year', $year);
    }

    /**
     * Search movies by title
     */
    public static function search(string $query): Collection
    {
        return static::all()->filter(function ($movie) use ($query) {
            return stripos($movie->title, $query) !== false;
        });
    }

    /**
     * Get rating as stars (for display)
     */
    public function getStarsAttribute(): string
    {
        $rating = $this->rating;
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;

        return str_repeat('★', $fullStars) . 
               str_repeat('☆', $halfStar) . 
               str_repeat('☆', $emptyStars);
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): string
    {
        $hours = intval($this->duration / 60);
        $minutes = $this->duration % 60;
        return $hours . 'h ' . $minutes . 'm';
    }

    /**
     * Get genres as comma-separated string
     */
    public function getGenresStringAttribute(): string
    {
        return implode(', ', $this->genres ?? []);
    }

    /**
     * Get cast as comma-separated string
     */
    public function getCastStringAttribute(): string
    {
        return implode(', ', array_slice($this->cast ?? [], 0, 3));
    }

    /**
     * Get comments for this movie
     */
    public function comments(): \Illuminate\Support\Collection
    {
        return Comment::forMovie($this->id);
    }

    /**
     * Get average rating from comments
     */
    public function getCommentAverageRatingAttribute(): float
    {
        $comments = $this->comments();
        if ($comments->isEmpty()) {
            return $this->rating; // Fallback to movie's base rating
        }
        return $comments->avg('rating');
    }

    /**
     * Get total comment count
     */
    public function getCommentCountAttribute(): int
    {
        return $this->comments()->count();
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}