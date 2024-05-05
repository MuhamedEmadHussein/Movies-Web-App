<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;
    public $total_pages;

    public function __construct($popularActors, $page, $total_pages)
    {
        //
        $this->popularActors = $popularActors;
        $this->page = $page;
        $this->total_pages = $total_pages;
    }
    public function popularActors(){
        return collect($this->popularActors)->map(function($actor){
            $famous_movies = collect($actor['known_for'])->flatMap(function($movie) {
                return isset($movie['original_title']) ? collect($movie['original_title'])->flatten() : collect($movie['original_name'])->flatten();
            })->implode(', ');

            return collect($actor)->merge([
                'profile_path' => isset($actor['profile_path'])
                 ? "https://image.tmdb.org/t/p/w235_and_h235_face".$actor['profile_path']
                 : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
                'famous_movies' => $famous_movies
            ])->only([
                'original_name', 'famous_movies', 'profile_path','id'
            ]);
        });
    }

    public function previous(){
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next(){
        return $this->page < $this->total_pages ? $this->page + 1 : null;
    }
}