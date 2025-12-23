<?php

namespace App\Models;

use Illuminate\Support\Collection;

class User
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
     * Get all users from JSON file
     */
    public static function all(): Collection
    {
        $path = storage_path('app/data/users.json');
        
        if (!file_exists($path)) {
            return collect();
        }
        
        $json = file_get_contents($path);
        $usersData = json_decode($json, true);

        return collect($usersData)->map(function ($userData) {
            return new static($userData);
        });
    }

    /**
     * Find a user by ID
     */
    public static function find(int $id): ?User
    {
        $users = static::all();
        foreach ($users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Get user's initials for avatar fallback
     */
    public function getInitialsAttribute(): string
    {
        $nameParts = explode(' ', $this->name ?? '');
        $initials = '';
        foreach (array_slice($nameParts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        return $initials ?: 'U';
    }

    /**
     * Get user's display name with verification badge
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name . ($this->verified ? ' ✓' : '');
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}