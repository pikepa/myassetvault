<?php

use App\Livewire\Users\CreateUser;
use App\Models\User;
use Livewire\Livewire;

test('a guest can not see the create user page', function () {
    $this->get(route('user.create'))
        ->assertRedirect('login');
});
test('an authorised user can see the create user page', function () {
    $this->signIn();
    $this->get(route('user.create'))
        ->assertOk()
        ->assertSeeLivewire(CreateUser::class);
});

it('an authorised user can load  Create user with  wired properties', function () {
    $this->signIn();
    Livewire::test(CreateUser::class)
        ->assertStatus(200)
        ->assertSee('Add New User')
        ->assertDontSee('Change Password')
        ->assertPropertyWired('form.name')
        ->assertPropertyWired('form.email')
        ->assertPropertyWired('form.role')
        ->assertMethodWiredToForm('save');
});

test('when form is loaded Password / confirmation is hidden', function () {
    $this->signIn();
    Livewire::test(CreateUser::class)
        ->assertOk()
        ->assertSee('Add New User')
        ->assertDontSee('Change Password')
        ->assertSee('New Password')
        ->assertSee('New Password Confirmation');
});

test('when in edit mode password is not displayed', function () {
    //Arrange
    $this->signIn();
    $user = User::factory()->create([
        'name' => 'Top ten bath bombs',
    ]);
    Livewire::test(CreateUser::class, [$user->id])
    ->assertOk()
    ->assertSee('Name')
    ->assertSet('form.name', 'Top ten bath bombs')
    ->assertSet('form.email', $user->email)
    ->assertSee('Role')
    ->assertSet('form.role', $user->role)
    ->assertDontSee('New Password')
    ->assertDontSee('New Password Confirmation')
    // ->assertSee('Password Change')
    ->call('toggleHidden')
    ->assertSee('Password change')
    ->assertSee('New Password')
    ->assertSee('New Password Confirmation')
    ->assertSet('form.password', '')
    ->assertSet('form.password-confirmation', '')
    ->assertSee('Edit User');
});
