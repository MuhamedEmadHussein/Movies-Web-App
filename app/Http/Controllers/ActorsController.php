<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        //
        $fetchPopularActors = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/popular?page='.$page)->json();

        $popularActors = $fetchPopularActors['results'];
        $total_pages = $fetchPopularActors['total_pages'];

        return view('actors.index',new ActorsViewModel($popularActors, $page, $total_pages));
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
        //https://api.themoviedb.org/3/person/{person_id}/external_ids
        $social = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')->json();

        $credits = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')->json();

        $actor = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/person/'.$id)->json();

        return view('actors.show',new ActorViewModel($actor, $social, $credits));
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