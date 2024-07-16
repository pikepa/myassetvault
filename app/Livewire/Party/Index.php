<?php

namespace App\Livewire\Party;

use App\Models\Party;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Parties')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $memb_type = null;

    #[Url]
    public $sortCol;

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
                'trans_status' => 'trans_status',
                'firstname' => 'firstname',
                'trans_member' => 'trans_member',
                'trans_year' => 'trans_year',
                'location' => 'location',
            };
            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }

        return $query;
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where('email', 'like', '%'.$this->search.'%')
            ->orWhere('firstname', 'like', '%'.$this->search.'%')
            ->orWhere('surname', 'like', '%'.$this->search.'%');
    }

    protected function applyFilter($query)
    {
        return $this->memb_type === ''
            ? $query
            : $query->where('trans_member', $this->memb_type);
    }

    public function delete($id)
    {
        $party = Party::find($id);

        $this->authorize('delete', $party);

        $party->delete();

        return '/home';
    }

    public function edit($id)
    {
        return redirect('/edit/'.$id);
    }

    public function render()
    {
        $query = Party::orderBy('created_at')->get()->toQuery();
        if ($this->memb_type != '') {
            $query = $this->applyFilter($query);
        }
        $query = $this->applySearch($query);
        $query = $this->applySorting($query);

        return view('livewire.party.index', [
            'parties' => $query->paginate(12),
        ]);
    }
}
