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

//Home Page Route
Route::get('/', 'Frontend\HomeController@index');

//Participants Route
Route::get('participants/{id}', 'Frontend\ParticipantController@index');
Route::get('participants/details/{id}','Frontend\ParticipantController@details');

//Vote Participants
Route::get('vote/{id}','Frontend\VoteController@index');
Route::post('vote/post','Frontend\VoteController@post');
Route::post('vote/otp','Frontend\VoteController@otp');
//Route::post('vote/post',['as'=>'vote.post','uses'=>'Frontend\VoteController@post']);


//Register
Route::resource('register','Frontend\RegisterController');