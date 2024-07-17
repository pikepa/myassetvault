<?php

use App\Livewire\Navigation;

it('returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('My Asset Vault')
        ->assertDontSeeLivewire(Navigation::class);
});
