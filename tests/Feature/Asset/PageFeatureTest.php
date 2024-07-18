<?php

use Carbon\Carbon;
use App\Models\Asset;
use Livewire\Livewire;
use App\Models\Transaction;
use App\Livewire\Navigation;
use App\Livewire\Asset\ListAssets;

beforeEach(function () {
    $this->signIn();
});

it('an auth user can load the Assets Listing Page', function () {
    Asset::factory()->create();
    $this->get('/asset/listing')->assertStatus(200)
    ->assertSeeLivewire(Navigation::class)
    ->assertSee('Asset & Liability Listing')
    ->assertSee('Search Asset Name')
    ->assertSee('Name')
    ->assertSee('Location')
    ->assertSee('Qty')
    ->assertSee('Value')
    ->assertSee('Status')
    ->assertSee('Owner');
});

it('allows for a search on name', function () {
    $itemA = Asset::factory()->create();
    $itemB = Asset::factory()->create();

    
    Livewire::test(ListAssets::class)
        ->assertOk()
        ->assertSee($itemA->name)
        ->assertSee($itemB->name)
        ->set('search', $itemA->name)
        ->assertSee($itemA->name)
        ->assertDontSee($itemB->name)
        ->set('search', $itemB->name)
        ->assertSee($itemB->name)
        ->assertDontSee($itemA->name);
});

test('a user can sort records by name', function () {
    $item1 = Asset::factory()->create(['name' => 'fred']);
    $item2 = Asset::factory()->create(['name' => 'xred']);
    Livewire::test(ListAssets::class)
        ->assertSeeInOrder([$item1->name, $item2->name])
        ->call('sortBy', 'name')
        ->assertSeeInOrder([$item2->name, $item1->name])
        ->call('sortBy', 'name')
        ->assertSeeInOrder([$item1->name, $item2->name]);
});

test('a user can sort records by asset type', function () {
    $trans1 = Asset::factory()->create(['asset_type' => 'gold']);
    $trans2 = Asset::factory()->create(['asset_type' => 'shares']);
    Livewire::test(Listassets::class)
            ->assertSeeInOrder(['Gold', 'Shares'])
            ->call('sortBy', 'asset_type')
            ->assertSeeInOrder(['Shares', 'Gold'])
            ->call('sortBy', 'asset_type')
            ->assertSeeInOrder(['Gold', 'Shares']);
});

test('a user can sort records by Location', function () {
    $trans1 = Asset::factory()->create(['location' => 'SA']);
    $trans2 = Asset::factory()->create(['location' => 'UAE']);
    Livewire::test(ListAssets::class)
            ->assertSeeInOrder([$trans1->location, $trans2->location])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$trans2->location, $trans1->location])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$trans1->location, $trans2->location]);
});

test('a user can sort records by status', function () {
    $trans1 = Asset::factory()->create(['status' => 'draft']);
    $trans2 = Asset::factory()->create(['status' => 'retired']);
    Livewire::test(ListAssets::class)
            ->assertSeeInOrder([$trans1->status, $trans2->status])
            ->call('sortBy', 'status')
            ->assertSeeInOrder([$trans2->status, $trans1->status])
            ->call('sortBy', 'status')
            ->assertSeeInOrder([$trans1->status, $trans2->status]);
});

