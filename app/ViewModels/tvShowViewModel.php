<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class tvShowViewModel extends ViewModel
{
    public $tvShow;
    public function __construct($tvShow)
    {
        //
        $this->tvShow = $tvShow;
    }

    PUBLIC FUNCTION tvShow(){
        $formattedGenres = collect($this->tvShow['genres'])->pluck('name')->flatten()->implode(', ');
        return collect($this->tvShow)->merge([
            'poster_path' => "https://image.tmdb.org/t/p/w500".$this->tvShow['poster_path'],
            'vote_average' => $this->tvShow['vote_average'] * 10,
            'release_date' => Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
            'genres' => $formattedGenres,
            'crews' => collect($this->tvShow['credits']['crew'])->take(2),
            'casts' => collect($this->tvShow['credits']['cast']),
            'images' => collect($this->tvShow['images']['backdrops']),
            'title' => $this->tvShow['name']
        ])->only([
            'created_by','poster_path', 'id', 'overview', 'vote_average', 'title', 'release_date', 'genres','casts','crews','videos','images','credits'
        ]);
    }
}