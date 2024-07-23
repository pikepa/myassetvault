<?php

use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Enums\Transactions\Status;
use App\Livewire\Transaction\CreateTransaction;
use App\Models\Asset;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Livewire;

test('a guest can not see the create transaction page', function () {
    $this->get(route('transaction.add'))
        ->assertRedirect('login');
});
test('an authorised user can see the create user page', function () {
    $this->signIn();
    $this->get(route('transaction.add'))
        ->assertOk()
        ->assertSeeLivewire(CreateTransaction::class);
});

it('an authorised user can load  Create Transaction with  wired properties', function () {
    $this->signIn();
    Livewire::test(CreateTransaction::class)
        ->assertStatus(200)
        ->assertSee('Add Valuation')
        ->assertPropertyWired('form.asset_id')
        ->assertPropertyWired('form.transaction_date')
        ->assertPropertyWired('form.document_ref')
        ->assertPropertyWired('form.year')
        ->assertPropertyWired('form.month')
        ->assertPropertyWired('form.current_value')
        ->assertPropertyWired('form.status')
        ->assertPropertyWired('form.comments')
        ->assertMethodWiredToForm('save');
});

test('an authorised user can create a transaction', function () {
    //Arrange
    $this->signIn();
    $asset = Asset::factory()->create();

    Livewire::test(CreateTransaction::class)
    ->assertOk()
    ->assertSee('Add Valuation')
    ->assertSee('Asset')
    ->set('form.asset_id', $asset->id)
    ->Set('form.transaction_date', Carbon::now()->format('Y-m-d'))
    ->Set('form.document_ref', 'document reference')
    ->assertSee('Valuation Year')
    ->Set('form.year', Year::_2024)
    ->assertSee('Month')
    ->Set('form.month', Month::July)
    ->assertSee('Current Value')
    ->Set('form.current_value', 200000)
    ->assertSee('Valuation Status')
    ->Set('form.status', Status::Paid)
    ->assertSee('Comments')
    ->Set('form.comments', 'Some Comment')
    ->assertSee('Save')
    ->assertSee('Back')
    ->call('save')
    ->assertRedirect('/transactions/index');
    $this->assertDatabasehas('transactions',
                            ['id' => 1,
                                'asset_id' => 1,
                                'status' => 'paid',
                                'comments' => 'Some Comment',
                            ]);
});

test('an authorised user can edit a transaction', function () {
    //Arrange
    $this->signIn();
    $asset = Asset::factory()->create();
    $trans = Transaction::factory()->create();

    Livewire::test(CreateTransaction::class, ['trans' => $trans->id])
    ->assertOk()
    ->assertSee('Edit Valuation')
    ->assertSee('Asset')
    // ->assertSet('form.asset_id', $asset->id)
    ->set('form.asset_id', $asset->id)
    ->assertSet('form.asset_id', $asset->id)
    ->assertSee('Transaction Date')
    ->assertSet('form.transaction_date', $trans->transaction_date->format('Y-m-d'))
    ->assertSee('Document No.')
    ->assertSet('form.document_ref', $trans->document_ref)
    ->assertSee('Valuation Year')
    ->assertSet('form.year', $trans->year)
    ->assertSee('Month')
    ->assertSet('form.month', $trans->month)
    ->assertSee('Current Value')
    ->assertSet('form.current_value', $trans->current_value)
    ->assertSee('Valuation Status')
    ->assertSet('form.status', $trans->status)
    ->assertSee('Comments')
    ->assertSet('form.comments', $trans->comments)
    ->assertSee('Save')
    ->assertSee('Back')
    ->set('form.comments', 'A new comment')
    ->call('save')
    ->assertRedirect('/transactions/index');

    $this->assertDatabasehas('transactions',
                            [
                                'comments' => 'A new comment',
                            ]);
});
