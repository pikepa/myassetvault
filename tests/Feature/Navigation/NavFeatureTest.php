<?php

test('when included in a component it contains necessary elements', function () {
    $this->signIn();
    $this->get('/user/listing')->assertOk()
       ->assertSee('Users Listing')
        ->assertSee('Our Property')
        ->assertDontSee('All Users')
        ->assertSee('Front Page')
        ->assertSee('Logout');
});
