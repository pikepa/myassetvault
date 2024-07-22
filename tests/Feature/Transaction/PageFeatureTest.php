<?php

use App\Livewire\Navigation;
use App\Livewire\Transaction\ListTransactions;
use App\Models\Asset;
use App\Models\Transaction;
use Livewire\Livewire;

beforeEach(function () {
    $this->signIn();
    $asset = Asset::factory()->create();
});
it('an auth user can load the Transactions Page', function () {
    $trans = Transaction::Factory()->create();
    $this->get('/transactions/index')->assertStatus(200)
    ->assertSeeLivewire(Navigation::class)
    ->assertSee('Transaction Listing')
    ->assertSee('Search Name')
    ->assertSee('Date')
    ->assertSee('Asset Name')
    ->assertSee('Doc Ref.')
    ->assertSee('Year')
    ->assertSee('Month')
    ->assertSee('Valuation')
    ->assertSee('Paid Status');
});

it('allows for a search on name of the asset', function () {
    $assetA = Asset::factory()->create(['name' => 'AAAAAAAAAAAAAAAAAAA']);  // field valuea
    $assetB = Asset::factory()->create(['name' => 'BBBBBBBBBBBBBBBBBB']); // field valueb
    $transA = Transaction::factory()->create(['asset_id' => $assetA->id]);
    $transB = Transaction::factory()->create(['asset_id' => $assetB->id]);
    Livewire::test(ListTransactions::class)
        ->assertOk()
        ->set('search', $transA->asset->name) // field $value $valueb
        ->assertSee($transA->asset->name) // $value
        ->assertDontSee($transB->asset->name)  //$valueb
        ->set('search', $transB->asset->name)  //$valueb
        ->assertSee($transB->asset->name)  // valueb
        ->assertDontSee($transA->asset->name); // valuea
});

test('a user can sort records by created_at', function () {
    $trans1 = Transaction::factory()->create(['created_at' => now()->submonth(1)]);
    $trans2 = Transaction::factory()->create();
    Livewire::test(ListTransactions::class)
        ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name])
        ->call('sortBy', 'created_at')
        ->assertSeeInOrder([$trans2->asset->name, $trans1->asset->name])
        ->call('sortBy', 'created_at')
        ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name]);
});

test('a user can sort records by year', function () {
    $trans1 = Transaction::factory()->create(['year' => '2020']);
    $trans2 = Transaction::factory()->create(['year' => '2024']);
    Livewire::test(ListTransactions::class)
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name])
    ->call('sortBy', 'year')
    ->assertSeeInOrder([$trans2->asset->name, $trans1->asset->name])
    ->call('sortBy', 'year')
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name]);
});

test('a user can sort records by month', function () {
    $trans1 = Transaction::factory()->create(['month' => 'Jan']);
    $trans2 = Transaction::factory()->create(['month' => 'Jul']);
    Livewire::test(ListTransactions::class)
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name])
    ->call('sortBy', 'month')
    ->assertSeeInOrder([$trans2->asset->name, $trans1->asset->name])
    ->call('sortBy', 'month')
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name]);
});
test('a user can sort records by document ref', function () {
    $trans1 = Transaction::factory()->create(['document_ref' => 'AAAAA']);
    $trans2 = Transaction::factory()->create(['document_ref' => 'BBBBB']);
    Livewire::test(ListTransactions::class)
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name])
    ->call('sortBy', 'document_ref')
    ->assertSeeInOrder([$trans2->asset->name, $trans1->asset->name])
    ->call('sortBy', 'document_ref')
    ->assertSeeInOrder([$trans1->asset->name, $trans2->asset->name]);
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
