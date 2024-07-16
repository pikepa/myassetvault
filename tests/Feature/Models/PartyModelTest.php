<?php

use App\Models\Party;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

test('database has expected columns', function () {
    $this->assertTrue(
          Schema::hasColumns('parties', [
              'id',
              'firstname',
              'surname',
              'title',
              'gender',
              'party_type',
              'profession',
              'email',
              'mobile',
              'location',
              'branch',
              'mailing_addr',
              'deceased',
              'member_since',
              'trans_member',
              'trans_status',
              'trans_year',
          ]), 1);
});

test('a party has transactions', function () {
    $party = Party::factory()
        ->has(Transaction::factory())
        ->create();

    expect($party->transactions)
        ->toBeInstanceOf(Collection::class, $party->transactions)
        ->first()->toBeInstanceOf(Transaction::class);
});
