<?php

namespace App\Http\Controllers;

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
        $movies = $genre ? Movie::byGenre($genre) : Movie::all();
        $genres = Movie::getAllGenres();
        $featuredMovies = Movie::featured();

        return view('movies.index', compact('movies', 'genres', 'featuredMovies', 'genre'));
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