<?php

use App\Models\Asset;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

test('database has expected columns', function () {
    $this->assertTrue(
          Schema::hasColumns('assets', [
              'id',
              'name',
              'asset_type',
              'description',
              'location',
              'qty',
              'acquired_value',
              'user_id',
              'status',
          ]), 1);
});

it('a transaction belongs to an owner', function () {
    $asset = Asset::factory()->create();
    expect($asset->owner)
        ->toBeInstanceOf(User::class);
});

test('an asset has many transactions', function () {
    $asset = Asset::factory()
        ->has(Transaction::factory())
        ->create();

    expect($asset->transactions)
        ->toBeInstanceOf(Collection::class, $asset->transactions)
        ->first()->toBeInstanceOf(Transaction::class);
});
