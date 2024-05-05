<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $genres;

    public function __construct($popularTv, $topRatedTv, $genres)
    {
        //
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function popularTv(){
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv(){
        return $this->formatTv($this->topRatedTv);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function formatTv($tv){

        return collect($tv)->map(function($tvShow){

            $formattedGenres = collect($tvShow['genre_ids'])->mapWithKeys(function($genreID){
                return [$genreID => $this->genres()->get($genreID)];
            })->implode(', ');


            return collect($tvShow)->merge([
                'title' => $tvShow['name'],
                'poster_path' => "https://image.tmdb.org/t/p/w500".$tvShow['poster_path'],
                'vote_average' => $tvShow['vote_average'] * 10,
                'release_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres
            ])->only([
                'poster_path', 'id', 'genre_ids', 'overview', 'vote_average', 'title', 'release_date', 'genres'
            ]);
        });

    }
}