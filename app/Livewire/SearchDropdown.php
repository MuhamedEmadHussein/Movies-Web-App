<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchDropdown extends Component
{

    #[Url()]
    public $search = '';

    #[Computed]
    public function movies(){
        return collect(Http::withToken(config('services.tmdb.token'))
                    ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)->json()['results'])->take(8);

    }
    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
