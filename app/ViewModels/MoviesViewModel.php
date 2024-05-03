<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;
class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $genres;
    public $nowPlayingMovies;

    public function __construct($popularMovies, $genres, $nowPlayingMovies)
    {
        //
        $this->popularMovies = $popularMovies;
        $this->genres = $genres;
        $this->nowPlayingMovies = $nowPlayingMovies;
    }

    public function popularMovies() {
        return $this->formatMovie($this->popularMovies);
    }

    public function nowPlayingMovies() {
        return $this->formatMovie($this->nowPlayingMovies);
    }

    public function genres() {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovie($movieCategory){

        return collect($movieCategory)->map(function($movie){

            $formattedGenres = collect($movie['genre_ids'])->mapWithKeys(function($genreID){
                return [$genreID => $this->genres()->get($genreID)];
            })->implode(', ');


            return collect($movie)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500".$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10,
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $formattedGenres
            ])->only([
                'poster_path', 'id', 'genre_ids', 'overview', 'vote_average', 'title', 'release_date', 'genres'
            ]);
        });
    }
}
