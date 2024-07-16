<?php

use App\Models\Party;
use App\Models\Transaction;
use Illuminate\Support\Facades\Schema;

test('database has expected columns', function () {
    $this->assertTrue(
          Schema::hasColumns('transactions', [
              'id',
              'party_id',
              'transaction_date',
              'year',
              'membership_type',
              'amount',
              'status',
              'comments',
          ]), 1);
});

it('a transaction belongs to a party', function () {
    $transaction = Transaction::factory()
        ->create();
    expect($transaction->owner)
        ->toBeInstanceOf(Party::class);
});
