<?php

use App\Livewire\Users\UserListing;
use Livewire\Livewire;

test('an authorised user can see the User listing page', function () {
    $this->signIn();
    $this->get(route('user.listing'))
        ->assertOk()
        ->assertSeeLivewire(UserListing::class);
});

test('a guest can not see the User listing page and get redirected', function () {
    $this->get(route('user.listing'))->assertStatus(302)
        ->assertRedirect('/login');
});

test('an authorised user sees User Listing and their Username', function () {
    $this->signIn();
    Livewire::test(UserListing::class)
        ->assertOk()
        ->assertSee('Users Listing')
        ->assertSee('Logged in as: '.auth()->user()->name)
        ->assertSee('Search')
        ->assertSee('Add User')
        ->assertSee('User Name')
        ->assertSee('Email')
        ->assertSee('Date Created')
        ->assertSee('Assigned Role')
        ->assertSee(auth()->user()->name)
        ->assertSee(auth()->user()->email)
        ->assertSee(auth()->user()->created_at->format('M d, Y'))
        ->assertSee(auth()->user()->role->label())
        ->assertSee('Add User')
        ->assertMethodWired('createUser')
        ->assertSee('Results : 1');
});
test('The add button on the userlisting opens the CreateUser livewire component', function () {
    //Arrange
    $this->signIn();
    //Arrange and Assert
    Livewire::test(UserListing::class)
    ->call('createUser')
    ->assertRedirect(route('user.create'));
});
