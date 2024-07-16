<?php

namespace App\Livewire\Forms;

use App\Enums\Users\Role;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class UserForm extends Form
{
    //
    public User $user;

    public $name = '';

    public $email = '';

    public Role $role = Role::User;

    public $changePass = false;

    public $password = '';

    public $password_confirmation = '';

    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email,'.$this->user->id],
            'password' => ['sometimes', 'required', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->role = $this->role;
        $this->user->password = bcrypt($this->password);
        $this->user->save();
    }

    // used when form being initialised on edit
    public function setUser($user = null)
    {
        if (! $user) {
            $this->user = User::make();
            $this->editMode = false;
        } else {
            $this->user = User::find($user);
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role = $this->user->role;
            // $this->password = $this->user->password;
            // $this->password_confirmation = $this->user->password;
        }
    }
}
