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

//Participants Page Route
Route::get('participants/{id}', 'Frontend\ParticipantController@index');

//Vote Participants
Route::get('vote/{id}','Frontend\VoteController@index');

//Register
//Route::get('register',function(){
//   return view('frontend.registration');
//});

Route::resource('register','Frontend\RegisterController');