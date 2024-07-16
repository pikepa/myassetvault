<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Livewire\Party\CreateParty;
use App\Livewire\Party\Index;
use App\Livewire\Transaction\CreateTransaction;
use App\Livewire\Transaction\ListTransactions;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\UserListing;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');

// Route::get("/register", [RegisterController::class, 'create'])->name('register');
// Route::post("/register", [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', LogoutController::class)->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', Index::class)->middleware('auth')->name('party.listing');
    Route::get('/add', CreateParty::class);
    Route::get('/edit/{party}', CreateParty::class);
    Route::get('/{memb}', Index::class)->name('party.index.select');
    Route::get('/transactions/index', ListTransactions::class)->name('transaction.listing');
    Route::get('/transactions/add', CreateTransaction::class)->name('transaction.add');
    Route::get('/transactions/edit/{trans}', CreateTransaction::class)->name('transaction.edit');
    Route::get('/user/listing', UserListing::class)->name('user.listing');
    Route::get('/user/create', CreateUser::class)->name('user.create');
    Route::get('/user/edit/{user}', CreateUser::class)->name('user.with.id');
});
