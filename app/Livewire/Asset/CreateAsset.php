<?php

namespace App\Livewire\Asset;

use App\Livewire\Forms\AssetForm;
use App\Models\Asset;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Asset')]
class CreateAsset extends Component
{
    public AssetForm $form;

    public $pageTitle = 'Add Asset';

    public $showSuccessIndicator = false;

    public function mount($asset = null)
    {
        if ($asset) {
            $this->form->setAsset($asset);
            $this->pageTitle = 'Edit Asset';
        } else {
            $this->form->asset = Asset::make();
        }
    }

    public function save()
    {
        $this->form->update();
        $this->showSuccessIndicator = true;

        return redirect('/asset/listing', );
    }

    public function render()
    {
        return view('livewire.asset.create-asset');
    }

    public function backtolist()
    {
        $this->redirect('/asset/listing', navigate: true);
    }
}
