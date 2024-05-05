<?php

namespace App\Http\Controllers;

use App\ViewModels\tvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $popularTv = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/tv/popular')->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/tv/top_rated')->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')->json()['genres'];

        return view('tv.index', new TvViewModel($popularTv, $topRatedTv, $genres));
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
    public function show($id)
    {
        //
        $tvShow = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')->json();

        return view('tv.show', new tvShowViewModel($tvShow));
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