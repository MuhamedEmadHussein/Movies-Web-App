<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $popularMovies = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];

        return view('index', new MoviesViewModel( $popularMovies, $genres, $nowPlayingMovies));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $movie = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')->json();

        return view('show', new MovieViewModel($movie));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
