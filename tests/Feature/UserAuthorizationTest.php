<?php

use App\Livewire\Transaction\ListTransactions;
use App\Livewire\Users\UserListing;
use App\Models\Asset;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Livewire;

test('an authorized user can delete a user', function () {
    $user1 = User::factory()->create(['role' => 'superadmin']);
    $user2 = User::factory()->create();
    $this->signIn($user1);
    expect(User::count())->toBe(2);

    Livewire::test(UserListing::class)
    ->call('delete', $user2->id);
    expect(User::count())->toBe(1);
});

test('an non authorized user cannot delete a user', function () {
    $user1 = User::factory()->create(['role' => 'admin']);
    $user2 = User::factory()->create();
    $this->signIn($user1);
    expect(User::count())->toBe(2);

    Livewire::test(UserListing::class)
    ->call('delete', $user2->id)
    ->assertStatus(403);
    expect(User::count())->toBe(2);
});

test('an authorized user can delete a Transaction', function () {
    Asset::factory()->create();
    $user1 = User::factory()->create(['role' => 'superadmin']);
    Transaction::factory()->count(4)->create();
    $transaction = Transaction::first();
    $this->signIn($user1);
    expect(Transaction::count())->toBe(4);

    Livewire::test(ListTransactions::class)
    ->call('delete', $transaction->id);
    expect(Transaction::count())->toBe(3);
});

test('an non-authorized user cannot delete a Transaction', function () {
    $user1 = User::factory()->create(['role' => 'guest']);
    $asset = Asset::factory()->create(['user_id' => $user1->id]);

    Transaction::factory()->count(4)->create(['asset_id' => $asset->id]);
    $transaction = Transaction::first();
    $this->signIn($user1);
    expect(Transaction::count())->toBe(4);

    Livewire::test(UserListing::class)
    ->call('delete', $transaction->id)
    ->assertStatus(403);
    expect(Transaction::count())->toBe(4);
});

test('an authorised user can see the All Users menu item', function () {
    $user1 = User::factory()->create(['role' => 'user']);
    $this->signIn($user1);

    $this->get('/user/listing')->assertOk()
        ->assertDontSee('All Users')
        ->assertDontSee('Edit User')
        ->assertDontSee('Delete User')
        ->assertSee('Logout');
});
