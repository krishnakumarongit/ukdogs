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


//registration links
Route::get('/user-register', 'UserController@index')->name('user-register');
Route::post('/do-sign-in', 'UserController@check')->name('do-sign-in');

Route::get('/password-forgot', 'UserController@passwordForgot')->name('password-forgot');
Route::post('/post-password', 'UserController@postPassword')->name('post-password');


Route::get('/validate-email/{token}', 'CommonController@validateEmail')->name('validate-email');
Route::get('/verify-your-email', 'UserController@verifyYourEmail')->name('verify-email');
Route::get('/everify', 'UserController@sendEmailVerification')->name('everify');
Route::get('/reset-password', 'UserController@passwordReset')->name('reset-password');
Route::post('/email-check', 'UserController@emailCheck')->name('email-check'); 
Route::get('/reset-password-page/{token}', 'UserController@passwordResetPage')->name('reset-password-page');    
Route::post('/reset-password-page-check', 'UserController@passwordResetPageCheck')->name('reset-password-page-check'); 
Route::get('/my-account', 'MyaccountController@index')->name('my-account');
Route::post('/my-image', 'MyaccountController@uploadImage')->name('my-image');
Route::get('/my-account/change-password', 'MyaccountController@changePassword')->name('my-account-change-password');
Route::post('/my-account/change-password-confirm', 'MyaccountController@myAccountPassword')->name('my-account-change-password-confirm');
Route::get('/my-account/profile', 'MyaccountController@profile')->name('my-account-profile');
Route::post('/my-account/profile-confirm', 'MyaccountController@profileConfirm')->name('my-profile-confirm');
Route::get('/my-account/resent-mail', 'MyaccountController@resentMail')->name('resent-mail');
Route::post('/my-account/resent-mail-confirm', 'MyaccountController@resentMailConfirm')->name('resent-mail-confirm');
Route::get('/my-account/email', 'MyaccountController@email')->name('my-account-email');
Route::post('/my-account/email-confirm', 'MyaccountController@emailConfirm')->name('my-account-email-confirm');
//end of registration links
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');