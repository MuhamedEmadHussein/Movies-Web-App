<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MovieViewModel extends ViewModel
{
    public $movie;
    public function __construct($movie)
    {
        //
        $this->movie = $movie;
    }

    public function movie(){
        $formattedGenres = collect($this->movie['genres'])->pluck('name')->flatten()->implode(', ');
        return collect($this->movie)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500".$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => $formattedGenres,
            'crews' => collect($this->movie['credits']['crew'])->take(2),
            'casts' => collect($this->movie['credits']['cast']),
            'images' => collect($this->movie['images']['backdrops'])
        ])->only([
            'poster_path', 'id', 'overview', 'vote_average', 'title', 'release_date', 'genres','casts','crews','videos','images','credits'
        ]);
    }
}
