<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Transactions')]
class ListTransactions extends Component
{
    use WithPagination;

    public $search = '';

    public $memb_type = null;

    #[Url]
    public $sortCol = 'created_at';

    #[Url]
    public $sortAsc = false;

    public function mount($memb = '')
    {
        if ($memb) {
            $this->memb_type = $memb;
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = false;
        }
    }

    protected function applySorting($query)
    {
        if ($this->sortCol) {
            $column = match ($this->sortCol) {
                'party_id' => 'party_id',
                'transaction_date' => 'transaction_date',
                'document_ref' => 'document_ref',
                'status' => 'status',
                'membership_type' => 'membership_type',
                'year' => 'year',
                'created_at' => 'created_at',
            };
            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->whereHas('owner', function ($query) {
                $query->where('firstname', 'like', '%'.$this->search.'%')
                    ->orWhere('surname', 'like', '%'.$this->search.'%');
            });
    }

    protected function applyFilter($query)
    {
        return $this->memb_type === ''
            ? $query
            : $query->where('membership', $this->memb_type);
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        $this->authorize('delete', $transaction);
        $transaction->delete();

        return '/transactions/index';
    }

    public function edit($id)
    {
        return redirect('/transactions/edit/'.$id);
    }

    public function render()
    {
        $query = Transaction::with('owner')->get()->toquery();

        // if ($this->memb_type != '') {
        //     $query = $this->applyFilter($query);
        // }
        $query = $this->applySearch($query);
        $query = $this->applySorting($query);

        return view('livewire.transaction.list-transactions', [
            'transactions' => $query->paginate(12),
        ]);
    }
}
