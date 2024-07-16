<?php

test('when included in a component it contains necessary elements', function () {
    $this->signIn();
    $this->get('/user/listing')->assertOk()
        ->assertSee('All Parties')
        ->assertSee('All Transactions')
        ->assertDontSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});
