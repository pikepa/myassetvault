<?php

use App\Livewire\Users\CreateUser;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->signIn();
});

test('User Validation basic rules on save', function ($field, $value, $rule) {
    Livewire::test(CreateUser::class)
        ->set($field, $value)
        ->call('save')
        ->assertHasErrors([$field => $rule]);
})->with('user_validation');

test('a non unique email on the users table is rejected', function () {
    //arrange
    $user = User::factory()->create(['email' => 'pikepeter@email.com']);
    Livewire::test(CreateUser::class)
    ->set('form.email', 'pikepeter@email.com')
    ->call('save')
    ->assertHasErrors(['form.email' => 'unique']);
});
// test('a password must be minimum of 8 chars', function () {

//     Livewire::test(CreateUser::class)
//     ->set('form.password', 'abcdef7')
//     ->call('save')
//     ->assertHasErrors(['form.password'=>'min']);
// });
