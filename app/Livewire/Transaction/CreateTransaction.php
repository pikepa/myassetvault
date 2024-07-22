<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Valuation')]
class CreateTransaction extends Component
{
    public TransactionForm $form;

    public $pageTitle = 'Add Valuation';

    public $assets;

    public $showSuccessIndicator = false;

    public function mount($trans = null)
    {
        $this->form->setTransaction($trans);

        if ($trans) {
            $this->pageTitle = 'Edit Valuation';
        }
        $this->assets = Auth::user()->activeAssets;
    }

    public function save()
    {
        $this->form->update();
        $this->showSuccessIndicator = true;

        return redirect('/transactions/index', );
    }

    public function render()
    {
        return view('livewire.transaction.create-transaction');
    }

    public function backtolist()
    {
        $this->redirect('/transactions/index', navigate: true);
    }
}
