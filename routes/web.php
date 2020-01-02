<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::GET('profile/{user}/edit', 'UserController@edit')->name('profile.edit');
    Route::GET('transactions', 'TransactionsController@index')->name('transactions.index');
    Route::GET('calendar', 'TransactionsController@calendar')->name('transactions.calendar');
});
