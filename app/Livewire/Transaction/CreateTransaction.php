<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Transaction;
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
        if ($trans) {
            $this->form->setTransaction($trans);
            $this->pageTitle = 'Edit Valuation';
        } else {
            $this->form->transaction = Transaction::make();
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
