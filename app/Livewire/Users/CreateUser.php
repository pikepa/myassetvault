<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class CreateUser extends Component
{
    public UserForm $form;

    public $pageTitle = 'Add New User';

    public $showSuccessIndicator = false;

    public $passwordHidden = true;

    public $buttonHidden = false;

    public $editMode = false;

    public function mount($user = null)
    {
        $this->form->setUser($user);
        if ($user) {
            $this->pageTitle = 'Edit User';
            $this->editMode = true;
        } else {
            $this->passwordHidden = false;
            $this->editMode = false;
        }
    }

    public function toggleHidden()
    {
        if ($this->passwordHidden == true && $this->editMode = true) {
            $this->passwordHidden = false;

            return;
        }
        $this->passwordHidden = true;
    }

    public function render()
    {
        return view('livewire.users.create-user');
    }

    public function save()
    {
        $this->form->update();
        $this->showSuccessIndicator = true;
    }

    public function backtolist()
    {
        return redirect(route('user.listing'));
    }
}
