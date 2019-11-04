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
    return view('index');
});




Route::get('/terms-conditions', function () {
    return view('terms');
});


/*Route::get('/success', function () {
    return view('success');
});

Route::get('/error', function () {
    return view('error');
});*/


Route::post('/', 'StripeController@store');

Route::get('borrar', 'StripeController@borrar');
Route::get('success', 'StripeController@success');
Route::get('error', 'StripeController@error');

Route::get('stripe', 'StripeController@stripe');
Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');