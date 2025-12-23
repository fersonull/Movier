<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Carbon\Carbon;

class Comment
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
     * Get all comments from JSON file
     */
    public static function all(): Collection
    {
        $path = storage_path('app/data/comments.json');
        
        if (!file_exists($path)) {
            return collect();
        }
        
        $json = file_get_contents($path);
        $commentsData = json_decode($json, true);

        return collect($commentsData)->map(function ($commentData) {
            return new static($commentData);
        });
    }

    /**
     * Get comments for a specific movie
     */
    public static function forMovie(int $movieId): Collection
    {
        return static::all()
            ->filter(function ($comment) use ($movieId) {
                return (int)$comment->movie_id === (int)$movieId;
            })
            ->sortByDesc('helpful_votes')
            ->values();
    }

    /**
     * Get user who made this comment
     */
    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute(): string
    {
        try {
            return Carbon::parse($this->created_at)->format('M j, Y');
        } catch (\Exception $e) {
            return $this->created_at ?? '';
        }
    }

    /**
     * Get relative time (e.g., "2 weeks ago")
     */
    public function getRelativeTimeAttribute(): string
    {
        try {
            return Carbon::parse($this->created_at)->diffForHumans();
        } catch (\Exception $e) {
            return 'Recently';
        }
    }

    /**
     * Get rating as stars
     */
    public function getStarsAttribute(): string
    {
        $rating = $this->rating ?? 0;
        $stars = str_repeat('⭐', $rating) . str_repeat('☆', 5 - $rating);
        return $stars;
    }

    /**
     * Get truncated comment for previews
     */
    public function getTruncatedCommentAttribute(): string
    {
        $comment = $this->comment ?? '';
        return strlen($comment) > 150 ? substr($comment, 0, 150) . '...' : $comment;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}