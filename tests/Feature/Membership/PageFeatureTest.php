<?php

use App\Livewire\Navigation;
use App\Livewire\Party\Index;
use App\Models\Party;
use Livewire\Livewire;

beforeEach(function () {
    $this->signIn();
});

it('it can load the Membership Page', function () {
    $party = Party::Factory()->create(['firstname' => 'Peter', 'surname' => 'Pike']);

    $this->get('/home')->assertStatus(200)
    ->assertSeeLivewire(Navigation::class)
    ->assertSee('Party Listing')
    ->assertSee('Search Name or Email')
    ->assertSee('Name in Full')
    ->assertSee('Membership')
    ->assertSee('Location')
    ->assertSee('Email')
    ->assertSee('Mobile')
    ->assertSee('Paid Status')
    ->assertSee('Last Payment')
    ->assertSee('Peter Pike');
});

it('allows for a search on name or email', function () {
    $partyA = Party::factory()->create(['firstname' => 'Tom', 'surname' => 'Harry']);
    $partyB = Party::factory()->create(['email' => 'someemail@email.com']);
    Livewire::test(Index::class)
        ->assertOk()
        ->set('search', 'Tom')
        ->assertSee('Tom Harry')
        ->assertDontSee('someemail@email.com')
        ->set('search', 'someem')
        ->assertSee('someemail@email.com')
        ->assertDontSee('Tom Harry');
});

test('a user can sort records by fullname', function () {
    $party1 = Party::factory()->create(['firstname' => 'Peter', 'surname' => 'Pike']);
    $party2 = Party::factory()->create(['firstname' => 'Tom', 'surname' => 'Hicks']);

    Livewire::test(Index::class)
        ->assertSeeInOrder([$party1->firstname, $party2->firstname])
        ->call('sortBy', 'firstname')
        ->assertSeeInOrder([$party2->firstname, $party1->firstname])
        ->call('sortBy', 'firstname')
        ->assertSeeInOrder([$party1->firstname, $party2->firstname]);
});

test('a user can sort records by membership', function () {
    $party1 = Party::factory()->create(['trans_member' => 'ord']);
    $party2 = Party::factory()->create(['trans_member' => 'stu']);
    Livewire::test(Index::class)
            ->assertSeeInOrder(['Ordinary', 'Student'])
            ->call('sortBy', 'trans_member')
            ->assertSeeInOrder(['Student', 'Ordinary'])
            ->call('sortBy', 'trans_member')
            ->assertSeeInOrder(['Ordinary', 'Student']);
});

test('a user can sort records by location', function () {
    $party1 = Party::factory()->create(['location' => 'kud']);
    $party2 = Party::factory()->create(['location' => 'sand']);
    Livewire::test(Index::class)
            ->assertSeeInOrder([$party1->location->label(), $party2->location->label()])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$party2->location->label(), $party1->location->label()])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$party1->location->label(), $party2->location->label()]);
});

test('a user can sort records by status', function () {
    $party1 = Party::factory()->create(['trans_status' => 'paid']);
    $party2 = Party::factory()->create(['trans_status' => 'unpaid']);
    Livewire::test(Index::class)
            ->assertSeeInOrder(['Paid', 'Unpaid'])
            ->call('sortBy', 'trans_status')
            ->assertSeeInOrder(['Unpaid', 'Paid'])
            ->call('sortBy', 'trans_status')
            ->assertSeeInOrder(['Paid', 'Unpaid']);
});
