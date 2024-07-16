<?php

namespace App\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public $currentRouteName;

    public function render()
    {
        return view('livewire.navigation');
    }
}
