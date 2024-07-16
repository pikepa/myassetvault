<?php

it('has a login page', function () {
    $this->get('/login')->assertStatus(200)
                        ->assertSee('Sign in to your account')
                        ->assertSee('Email address')
                        ->assertSee('Password');
});
test('a guest trying to load the home page is redirected to Login ', function () {
    $this->get('/home')->assertRedirect('/login');
});
test('a guest trying to load the transaction page is redirected to Login ', function () {
    $this->get('/transactions/index')->assertRedirect('/login');
});
test('a guest trying to load the transaction add page is redirected to Login ', function () {
    $this->get('/transactions/add')->assertRedirect('/login');
});
test('a guest trying to load the add party page is redirected to Login ', function () {
    $this->get('/add')->assertRedirect('/login');
});
