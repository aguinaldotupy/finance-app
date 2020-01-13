<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//})->name('api.user');

Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::GET('/', 'UserController@user')->name('api.user');
        Route::PUT('/{user}', 'UserController@update')->name('api.user.update');
    });

    Route::prefix('accounts')->group(function () {
        Route::GET('/', 'AccountController@list')->name('api.accounts.list');
    });

    Route::prefix('transaction')->group(function () {
        Route::POST('/', 'TransactionsController@store')->name('api.transactions.store');
        Route::GET('/search', 'TransactionsController@search')->name('api.transactions.search');
        Route::PUT('/{transaction}', 'TransactionsController@update')->name('api.transactions.update');
    });

    Route::prefix('company')->group(function () {
        Route::GET('/search', 'CompanyController@search')->name('api.company.search');
    });

    Route::prefix('category')->group(function () {
        Route::GET('/search', 'CategoryController@search')->name('api.category.search');
    });
});
Route::prefix('transaction')->group(function () {
    Route::GET('/calendar', 'TransactionsController@searchCalendar')->name('api.transactions.calendar');
});
