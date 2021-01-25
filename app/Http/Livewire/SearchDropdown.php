<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Serie;

class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {
        $searchResults = [];
        if(strlen($this->search) > 2){
            $searchResults = Serie::where('hidden','!=', 1)->where('name','like','%'.$this->search. '%')
            ->get()
            ->toArray();
        }

        //dump($searchResults);
            
        return view('livewire.search-dropdown', [
        	'searchResults' => collect($searchResults)->take(11),
        ]);
    }
}
