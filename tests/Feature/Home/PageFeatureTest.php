<?php

use App\Livewire\Navigation;

it('returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('Sabah Society Membership Application')
        ->assertDontSeeLivewire(Navigation::class);
});
