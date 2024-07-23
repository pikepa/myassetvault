<?php

namespace App\Livewire\Asset;

use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Asset Listing')]
class ListAssets extends Component
{
    use WithPagination;

    public $search = '';

    public $asset_type = '';

    #[Url]
    public $sortCol = 'created_at';

    #[Url]
    public $sortAsc = false;

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
                'asset_type' => 'asset_type',
                'name' => 'name',
                'location' => 'location',
                'status' => 'status',
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
            // : $query->whereHas('owner', function ($query) {
            //     $query->where('name', 'like', '%'.$this->search.'%');
            // });
            : $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('location', 'like', '%'.$this->search.'%')
                ->orWhere('status', 'like', '%'.$this->search.'%')
                ->orWhere('asset_type', 'like', '%'.$this->search.'%');
    }

    protected function applyFilter($query)
    {
        return $this->asset_type === ''
            ? $query
            : $query->where('asset_type', $this->asset_type);
    }

    public function delete($id)
    {
        $transaction = Asset::find($id);
        $this->authorize('delete', $transaction);
        $transaction->delete();

        return '/transactions/index';
    }

    public function edit($id)
    {
        return redirect('/asset/edit/'.$id);
    }

    public function render()
    {
        // Original Query
        //  $query = auth->user->assetsAsset::with('owner')->get()->toquery();
        $query = Auth::user()->assets->toquery();

        $query = $this->applyFilter($query);
        $query = $this->applySearch($query);
        $query = $this->applySorting($query);

        return view('livewire.asset.list-assets', [
            'assets' => $query->paginate(12),
        ]);
    }

    public function mount($type = '')
    {
        $this->asset_type = $type;
    }
}
