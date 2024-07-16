<?php

use App\Livewire\Navigation;
use App\Livewire\Transaction\ListTransactions;
use App\Models\Transaction;
use Livewire\Livewire;

beforeEach(function () {
    $this->signIn();
});
it('an auth user can load the Transactions Page', function () {
    $party = Transaction::Factory()->create();
    $this->get('/transactions/index')->assertStatus(200)
    ->assertSeeLivewire(Navigation::class)
    ->assertSee('Transaction Listing')
    ->assertSee('Search Name')
    ->assertSee('Name in Full')
    ->assertSee('Date')
    ->assertSee('Doc Ref.')
    ->assertSee('Membership')
    ->assertSee('Sub Year')
    ->assertSee('Amount')
    ->assertSee('Paid Status');
});

it('allows for a search on name', function () {
    $partyA = Transaction::factory()->create();
    $partyB = Transaction::factory()->create();
    Livewire::test(ListTransactions::class)
        ->assertOk()
        ->set('search', $partyA->owner->firstname)
        ->assertSee($partyA->owner->fullname)
        ->assertDontSee($partyB->owner->fullname)
        ->set('search', $partyB->owner->firstname)
        ->assertSee($partyB->owner->fullname)
        ->assertDontSee($partyA->owner->fullname);
});

test('a user can sort records by firstname', function () {
    $trans1 = Transaction::factory()->create();
    $trans2 = Transaction::factory()->create();
    Livewire::test(ListTransactions::class)
        ->assertSeeInOrder([$trans1->owner->firstname, $trans2->owner->firstname])
        ->call('sortBy', 'party_id')
        ->assertSeeInOrder([$trans2->owner->firstname, $trans1->owner->firstname])
        ->call('sortBy', 'party_id')
        ->assertSeeInOrder([$trans1->owner->firstname, $trans2->owner->firstname]);
});

test('a user can sort records by membership', function () {
    $trans1 = Transaction::factory()->create(['membership_type' => 'ord']);
    $trans2 = Transaction::factory()->create(['membership_type' => 'stu']);
    Livewire::test(ListTransactions::class)
            ->assertSeeInOrder(['Ordinary', 'Student'])
            ->call('sortBy', 'membership_type')
            ->assertSeeInOrder(['Student', 'Ordinary'])
            ->call('sortBy', 'membership_type')
            ->assertSeeInOrder(['Ordinary', 'Student']);
});

test('a user can sort records by Doc Ref', function () {
    $trans1 = Transaction::factory()->create(['document_ref' => 'kud']);
    $trans2 = Transaction::factory()->create(['document_ref' => 'sand']);
    Livewire::test(ListTransactions::class)
            ->assertSeeInOrder([$trans1->document_ref, $trans2->document_ref])
            ->call('sortBy', 'document_ref')
            ->assertSeeInOrder([$trans2->document_ref, $trans1->document_ref])
            ->call('sortBy', 'document_ref')
            ->assertSeeInOrder([$trans1->document_ref, $trans2->document_ref]);
});

test('a user can sort records by status', function () {
    $trans1 = Transaction::factory()->create(['status' => 'paid']);
    $trans2 = Transaction::factory()->create(['status' => 'unpaid']);
    Livewire::test(ListTransactions::class)
            ->assertSeeInOrder(['Paid', 'Unpaid'])
            ->call('sortBy', 'status')
            ->assertSeeInOrder(['Unpaid', 'Paid'])
            ->call('sortBy', 'status')
            ->assertSeeInOrder(['Paid', 'Unpaid']);
});
