<?php

use App\Livewire\Asset\ListAssets;
use App\Livewire\Navigation;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

beforeEach(function () {
    $this->signIn();
});

it('an auth user can load the Assets Listing Page', function () {
    Asset::factory()->create(['user_id' => Auth::user()->id]);

    $this->get('/asset/listing')->assertStatus(200)
    ->assertSeeLivewire(Navigation::class)
    ->assertSeeLivewire(ListAssets::class)
    ->assertSee('Asset & Liability Listing')
    ->assertSee('Search Asset Name')
    ->assertSee('Name in Full')
    ->assertSee('Location')
    ->assertSee('Acquired Value')
    ->assertSee('Current Value')
    ->assertSee('Status');
});

test('it only displays assets for the signed in user', function () {
    $assetControl = Asset::factory()->create(['user_id' => Auth::user()->id]);
    $assetRandom = Asset::factory()->create();

    $response = $this->get('/asset/listing')
        ->assertStatus(200);
    $response->assertSee($assetControl->name); // Adjust the count based on your test data
    $response->assertDontSee($assetRandom->name); // Adjust the count based on your test data
});

it('allows for a search on name', function () {
    $itemA = Asset::factory()->create(['user_id' => Auth::user()->id]);
    $itemB = Asset::factory()->create(['user_id' => Auth::user()->id]);

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
    $item1 = Asset::factory()->create(['name' => 'fred', 'user_id' => Auth::user()->id]);
    $item2 = Asset::factory()->create(['name' => 'xred', 'user_id' => Auth::user()->id]);
    Livewire::test(ListAssets::class)
        ->assertSeeInOrder([$item1->name, $item2->name])
        ->call('sortBy', 'name')
        ->assertSeeInOrder([$item2->name, $item1->name])
        ->call('sortBy', 'name')
        ->assertSeeInOrder([$item1->name, $item2->name]);
});

test('a user can sort records by asset type', function () {
    $trans1 = Asset::factory()->create(['asset_type' => 'gold', 'user_id' => Auth::user()->id]);
    $trans2 = Asset::factory()->create(['asset_type' => 'shares', 'user_id' => Auth::user()->id]);
    Livewire::test(Listassets::class)
            ->assertSeeInOrder(['Gold', 'Shares'])
            ->call('sortBy', 'asset_type')
            ->assertSeeInOrder(['Shares', 'Gold'])
            ->call('sortBy', 'asset_type')
            ->assertSeeInOrder(['Gold', 'Shares']);
})->skip('Not on screen at this time');

test('a user can sort records by Location', function () {
    $trans1 = Asset::factory()->create(['location' => 'GBR', 'user_id' => Auth::user()->id]);
    $trans2 = Asset::factory()->create(['location' => 'UAE', 'user_id' => Auth::user()->id]);
    Livewire::test(ListAssets::class)
            ->assertSeeInOrder([$trans1->location, $trans2->location])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$trans2->location, $trans1->location])
            ->call('sortBy', 'location')
            ->assertSeeInOrder([$trans1->location, $trans2->location]);
});

test('a user can sort records by status', function () {
    $trans1 = Asset::factory()->create(['status' => 'draft', 'user_id' => Auth::user()->id]);
    $trans2 = Asset::factory()->create(['status' => 'retired', 'user_id' => Auth::user()->id]);
    Livewire::test(ListAssets::class)
            ->assertSeeInOrder(['Draft', 'Retired'])
            ->call('sortBy', 'status')
            ->assertSeeInOrder(['Retired', 'Draft'])
            ->call('sortBy', 'status')
            ->assertSeeInOrder(['Draft', 'Retired']);
});
