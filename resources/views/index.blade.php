@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 pt-12">
        <div class="popular-movies">
            <h2 class="uppercase text-orange-400 tracking-wider text-lg font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
        </div>
        <div class="now-playing-movies py-14 border-t border-gray-400 mt-6">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie"  />
                @endforeach
            </div>
        </div>
    </div>

@endsection
