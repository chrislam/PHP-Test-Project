<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'guest', 'uses' => 'LoginController@showLogin'));

Route::get('login', array('before' => 'guest', 'uses' => 'LoginController@showLogin'));

Route::post('login', array('before' => 'guest|csrf', 'uses' => 'LoginController@doLogin'));

Route::any('fb-login', array('uses' => 'LoginController@doFacebookLogin'));

Route::get('logout', array('before' => 'auth', 'uses' => 'LoginController@doLogout'));

Route::get('register', array('before' => 'guest', 'uses' => 'RegistrationController@showRegister'));

Route::post('register', array('before' => 'guest|csrf', 'uses' => 'RegistrationController@doRegister'));

Route::get('users', array('before' => 'auth', 'uses' => 'UserController@showList'));

Route::get('user/create', array('before' => 'auth|admin', 'uses' => 'UserController@showCreate'));

Route::post('user/create', array('before' => 'auth|admin|csrf', 'uses' => 'UserController@doCreate'));

Route::get('user/edit/{id}', array('before' => 'auth|admin', 'uses' => 'UserController@showEdit'));

Route::post('user/edit/{id}', array('before' => 'auth|admin|csrf', 'uses' => 'UserController@doEdit'));

Route::get('user/delete/{id}', array('before' => 'auth|admin', 'uses' => 'UserController@showDelete'));

Route::post('user/delete/{id}', array('before' => 'auth|admin|csrf', 'uses' => 'UserController@doDelete'));

Route::controller('api', 'RESTUserController');
