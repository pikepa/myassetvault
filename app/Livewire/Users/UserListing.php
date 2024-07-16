<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users')]
class UserListing extends Component
{
    use WithPagination;

    public $search = '';

    public $sortCol;

    public $sortAsc = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where('email', 'like', '%'.$this->search.'%')
            ->orWhere('name', 'like', '%'.$this->search.'%');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        $user->delete();

        return redirect('{{ route("user.listing") }}');
    }

    public function createUser()
    {
        return redirect(route('user.create'));
    }

    public function edit($user)
    {
        return redirect(route('user.with.id', $user));
    }

    public function render()
    {
        $query = User::orderBy('created_at')->get()->toQuery();

        $query = $this->applySearch($query);
        //   $query = $this->applySorting($query);
        return view('livewire.users.user-listing', [
            'users' => $query->paginate(10),
        ]);
    }
}
