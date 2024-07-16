<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Welcome')]
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome')->layout('components.layouts.guest');
    }
}
