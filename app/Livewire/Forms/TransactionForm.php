<?php

namespace App\Livewire\Forms;

use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Enums\Transactions\Status;
use App\Models\Transaction;
use Livewire\Form;

class TransactionForm extends Form
{
    public Transaction $transaction;

    public $asset_id;

    public $transaction_date;

    public $document_ref;

    public Year $year = Year::_2024;  //this relates to year 2024

    public Month $month = Month::January;  //this relates to month january

    public $current_value;

    public Status $status = Status::Unpaid;

    public $comments = '';

    public function rules()
    {
        return [
            'asset_id' => ['required'],
            'transaction_date' => ['required', 'date', 'date_format:Y-m-d'],
            'document_ref' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
            'current_value' => ['required', 'integer'],
            'status' => ['required'],
            'comments' => ['max:250'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->transaction->asset_id = $this->asset_id;
        $this->transaction->transaction_date = $this->transaction_date;
        $this->transaction->document_ref = $this->document_ref;
        $this->transaction->year = $this->year;
        $this->transaction->month = $this->month;
        $this->transaction->current_value = $this->current_value;
        $this->transaction->status = $this->status;
        $this->transaction->comments = $this->comments;
        $this->transaction->save();
    }

    // used when form being initialised on edit
    public function setTransaction($trans = null)
    {
        if (! $trans) {
            $this->transaction = Transaction::make();
        } else {
            $this->transaction = Transaction::find($trans);
            $this->asset_id = $this->transaction->asset_id;
            $this->transaction_date = $this->transaction->transaction_date->format('Y-m-d');
            $this->document_ref = $this->transaction->document_ref;
            $this->year = $this->transaction->year;
            $this->month = $this->transaction->month;
            $this->current_value = $this->transaction->current_value;
            $this->status = $this->transaction->status;
            $this->comments = $this->transaction->comments;
        }
    }
}
