<?php

namespace App\Livewire\Party;

use App\Livewire\Forms\PartyForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Party')]
class CreateParty extends Component
{
    public PartyForm $form;

    public $pageTitle = 'Add New Party';

    public $showSuccessIndicator = false;

    public function mount($party = null)
    {
        $this->form->setParty($party);
        if ($party) {
            $this->pageTitle = 'Edit Party';
        }
    }

    public function render()
    {
        return view('livewire.party.create-party');
    }

    public function save()
    {
        $this->form->update();
        $this->showSuccessIndicator = true;
    }

    public function backtolist()
    {
        return redirect('/home', );
    }
}
