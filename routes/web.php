<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('new_ticket', 'TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');
Route::get('tickets/{ticket_id}', 'TicketsController@show');
Route::post('tickets/edit/{ticket_id}', 'TicketsController@edit');
Route::get('my_tickets', 'TicketsController@userTickets');
Route::get('/users', 'UsersController@index');
//Route::resource('users', 'UsersController@userTickets');



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('tickets', 'TicketsController@index');
//    Route::get('/users', 'UsersController@index');
    Route::post('close_ticket/{ticket_id}', 'TicketsController@close');

});

Route::post('comment', 'CommentsController@postComment');


