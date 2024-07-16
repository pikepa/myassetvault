<?php

namespace App\Livewire\Forms;

use App\Enums\Transactions\Membership;
use App\Enums\Transactions\Status;
use App\Enums\Transactions\Year;
use App\Models\Party;
use App\Models\Transaction;
use Livewire\Form;

class TransactionForm extends Form
{
    public Transaction $transaction;

    public $party_id;

    public $transaction_date;

    public $document_ref;

    public Membership $membership_type = Membership::Ordinary;

    public Year $year = Year::_2024;  //this relates to year 2024

    public $amount = 0;

    public Status $status = Status::Unpaid;

    public $comments = '';

    public function rules()
    {
        return [
            'party_id' => ['required'],
            'transaction_date' => ['required', 'date', 'date_format:Y-m-d'],
            'document_ref' => ['required'],
            'membership_type' => ['required'],
            'year' => ['required'],
            'amount' => ['required', 'integer'],
            'status' => ['required'],
            'comments' => ['max:250'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->transaction->party_id = $this->party_id;
        $this->transaction->transaction_date = $this->transaction_date;
        $this->transaction->document_ref = $this->document_ref;
        $this->transaction->membership_type = $this->membership_type;
        $this->transaction->year = $this->year;
        $this->transaction->amount = $this->amount;
        $this->transaction->status = $this->status;
        $this->transaction->comments = $this->comments;

        $this->transaction->save();
        $owner = Party::find($this->party_id);
        $owner->trans_member = $this->membership_type;
        $owner->trans_year = $this->year;
        $owner->trans_status = $this->status;
        $owner->save();
    }

    // used when form being initialised on edit
    public function setTransaction($trans = null)
    {
        if (! $trans) {
            $this->transaction = Transaction::make();
        } else {
            $this->transaction = Transaction::find($trans);
            $this->party_id = $this->transaction->party_id;
            $this->transaction_date = $this->transaction->transaction_date->format('Y-m-d');
            $this->document_ref = $this->transaction->document_ref;
            $this->membership_type = $this->transaction->membership_type;
            $this->year = $this->transaction->year;
            $this->amount = $this->transaction->amount;
            $this->status = $this->transaction->status;
            $this->comments = $this->transaction->comments;
        }
    }
}
