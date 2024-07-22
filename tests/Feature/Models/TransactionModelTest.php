<?php

use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Support\Facades\Schema;

test('database has expected columns', function () {
    $this->assertTrue(
          Schema::hasColumns('transactions', [
              'id',
              'asset_id',
              'transaction_date',
              'year',
              'month',
              'current_value',
              'status',
              'comments',
          ]), 1);
});

it('a transaction belongs to an asset', function () {
    Asset::factory()->create();
    $transaction = Transaction::factory()
        ->create();
    expect($transaction->asset)
        ->toBeInstanceOf(Asset::class);
});
