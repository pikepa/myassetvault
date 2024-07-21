<?php

use App\Livewire\Navigation;
use App\Models\User;

test('when included in a component it contains necessary elements', function () {
    $user = User::factory()->create(['role' => 'guest']);
    $this->signIn($user);
    $this->get('/user/listing')->assertOk()
        ->assertSeeLivewire(Navigation::class)
        ->assertSee('Logged in as:')
        ->assertSee('Users Listing')
        ->assertSee('My Owned Asset Vault')
        ->assertDontSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});
test('when superuser logs in he sees All Users', function () {
    $user = User::factory()->create(['role' => 'superadmin']);
    $this->signIn($user);
    $this->get('/user/listing')->assertOk()
        ->assertSeeLivewire(Navigation::class)
        ->assertSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});
test('when admin logs in he sees All Users', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $this->signIn($user);
    $this->get('/user/listing')->assertOk()
        ->assertSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});

test('when displayed a menu item shows blue', function () {
    $user = User::factory()->create(['role' => 'superadmin']);
    $this->signIn($user);

    $this->get('/user/listing/')
        ->assertOk()
        ->assertSee(' class="text-blue-600 font-semibold">', false)
        ->assertSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});
