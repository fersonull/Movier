<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display the homepage with all movies
     */
    public function index(Request $request): View
    {
        $genre = $request->get('genre');
        $search = $request->get('search');

        if ($search) {
            $movies = Movie::search($search);
            if ($genre) {
                $movies = $movies->filter(function ($movie) use ($genre) {
                    return in_array($genre, $movie->genres ?? []);
                });
            }
        } else {
            $movies = $genre ? Movie::byGenre($genre) : Movie::all();
        }

        $genres = Movie::getAllGenres();
        $featuredMovies = $search || $genre ? collect() : Movie::featured();

        return view('movies.index', compact('movies', 'genres', 'featuredMovies', 'genre', 'search'));
    }

    /**
     * Display a specific movie's details
     */
    public function show(int $id): View
    {
        $movie = Movie::find($id);

        if (!$movie) {
            abort(404, 'Movie not found');
        }

        // Get related movies (same genre, excluding current movie)
        $relatedMovies = collect();
        if (!empty($movie->genres)) {
            $relatedMovies = Movie::byGenre($movie->genres[0])
                ->reject(function ($relatedMovie) use ($id) {
                    return $relatedMovie->id === $id;
                })
                ->take(4);
        }

        // Get comments for this movie
        $comments = $movie->comments();

        return view('movies.show', compact('movie', 'relatedMovies', 'comments'));
    }

    /**
     * Store a new comment for a movie
     */
    public function storeComment(Request $request, int $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $movie = Movie::find($id);
        if (!$movie) {
            return back()->with('error', 'Movie not found');
        }

        $userData = [
            'id' => rand(1000, 9999),
            'name' => $request->user_name,
            'username' => strtolower(str_replace(' ', '_', $request->user_name)),
            'avatar' => 'https://picsum.photos/100/100?random=' . rand(200, 999),
            'verified' => false,
            'total_reviews' => 1
        ];

        Comment::create([
            'movie_id' => $id,
            'user_id' => $userData['id'],
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $usersPath = storage_path('app/data/users.json');
        $users = json_decode(file_get_contents($usersPath), true) ?? [];
        $users[] = $userData;
        file_put_contents($usersPath, json_encode($users, JSON_PRETTY_PRINT));

        return back()->with('success', 'Review added successfully!');
    }

    /**
     * Display movies by genre
     */
    public function byGenre(string $genreSlug): View
    {
        $genres = Movie::getAllGenres();
        $currentGenre = $genres->firstWhere('slug', $genreSlug);

        if (!$currentGenre) {
            abort(404, 'Genre not found');
        }

        $movies = Movie::byGenre($currentGenre['name']);
        $featuredMovies = collect(); // Empty for genre pages

        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres,
            'featuredMovies' => $featuredMovies,
            'genre' => $currentGenre['name'],
            'currentGenre' => $currentGenre
        ]);
    }
}