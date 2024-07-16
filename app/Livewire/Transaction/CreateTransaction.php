<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Party;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Add Transaction')]
class CreateTransaction extends Component
{
    public TransactionForm $form;

    public $pageTitle = 'Add Transaction';

    public $parties;

    public $showSuccessIndicator = false;

    public function mount($trans = null)
    {
        $this->form->setTransaction($trans);

        if ($trans) {
            $this->pageTitle = 'Edit Transaction';
        }
        $this->parties = Party::orderBy('firstname')->get();
    }

    public function save()
    {
        $this->form->update();
        $this->showSuccessIndicator = true;
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
