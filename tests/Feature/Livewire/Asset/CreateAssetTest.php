<?php

use App\Enums\Assets\AssetStatus;
use App\Enums\Assets\AssetType;
use App\Enums\Assets\Location;
use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Livewire\Asset\CreateAsset;
use App\Models\Asset;
use Livewire\Livewire;

test('a guest can not see the create asset page', function () {
    $this->get(route('asset.add'))
        ->assertRedirect('login');
});
test('an authorised user can see the create asset page', function () {
    $this->signIn();
    $this->get(route('asset.add'))
        ->assertOk()
        ->assertSeeLivewire(CreateAsset::class);
});

it('an authorised user can load  Create Asset with  wired properties', function () {
    $this->signIn();
    Livewire::test(CreateAsset::class)
        ->assertStatus(200)
        ->assertSee('Add Asset')
        ->assertPropertyWired('form.asset_type')
        ->assertPropertyWired('form.qty')
        ->assertPropertyWired('form.location')
        ->assertPropertyWired('form.name')
        ->assertPropertyWired('form.description')
        ->assertPropertyWired('form.year')
        ->assertPropertyWired('form.month')
        ->assertPropertyWired('form.acquired_value')
        ->assertPropertyWired('form.status')
        ->assertMethodWiredToForm('save');
});

test('an authorised user can create an asset', function () {
    //Arrange
    $this->signIn();

    Livewire::test(CreateAsset::class, )
    ->assertOk()
    ->assertSee('Add Asset')
    ->assertSee('Asset Type')
    ->set('form.asset_type', AssetType::Share)
    ->assertSee('Qty')
    ->set('form.qty', 100)
    ->assertSee('Location')
    ->set('form.location', Location::Great_Britain)
    ->assertSee('Asset Name')
    ->set('form.name', 'BHP Shares')
    ->assertSee('Description')
    ->set('form.description', 'This is a new description')
    ->assertSee('Year Acquired')
    ->set('form.acquired_year', Year::_2022)
    ->assertSee('Month')
    ->set('form.acquired_month', Month::Aug)
    ->assertSee('Acquired Value')
    ->set('form.acquired_value', 10000)
    ->assertSee('Status')
    ->set('form.status', AssetStatus::Current)
    ->assertSee('Save')
    ->assertSee('Back')
    ->call('save')
    ->assertRedirect('/asset/listing');

    $this->assertTrue(Asset::whereName('BHP Shares')->exists());
});

test('an authorised user can edit an asset', function () {
    //Arrange
    $this->signIn();
    $asset = Asset::factory()->create();

    Livewire::test(CreateAsset::class, ['asset' => $asset->id])
    ->assertOk()
    ->assertSee('Edit Asset')
    ->assertSet('form.asset_type', $asset->asset_type)
    ->assertSet('form.qty', $asset->qty)
    ->assertSet('form.location', $asset->location)
    ->assertSet('form.name', $asset->name)
    ->assertSet('form.description', $asset->description)
    ->assertSet('form.acquired_year', $asset->acquired_year)
    ->assertSet('form.acquired_month', $asset->acquired_month)
    ->assertSet('form.acquired_value', $asset->acquired_value)
    ->assertSet('form.status', $asset->status)
    ->set('form.name', 'BHP Shares')
    ->set('form.location', Location::United_Arab_Emirates)
    ->assertSee('Save')
    ->assertSee('Back')
    ->call('save')
    ->assertRedirect('/asset/listing');

    $this->assertTrue(Asset::whereName('BHP Shares')->exists());
    $this->assertTrue(Asset::whereLocation('UAE')->exists());
});
