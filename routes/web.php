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
Route::get('participants/result/{id}','Frontend\ParticipantController@result');

Route::get('participants/upload/{id}','Frontend\ParticipantController@verificationForUploadAssets');
Route::post('participants/sendOtpforupload','Frontend\ParticipantController@sendOtpForUpload');
Route::post('participants/verify','Frontend\ParticipantController@otpVerification');
Route::get('participants/uploadform/{id}/{event_p_id}','Frontend\ParticipantController@uploadAssetsForm');
Route::post('participants/uploadassets','Frontend\ParticipantController@uploadAssets');

//Vote Participants
Route::get('vote/{id}','Frontend\VoteController@index');
Route::post('vote/sendOtp','Frontend\VoteController@sendOtp');
Route::post('vote/otp','Frontend\VoteController@otp');
Route::get('vote/test','Frontend\VoteController@test');

//Route::post('vote/post',['as'=>'vote.post','uses'=>'Frontend\VoteController@post']);


//Register
Route::post('register/checkemail', 'Frontend\RegisterController@checkEmailExistence');
Route::resource('register','Frontend\RegisterController');
