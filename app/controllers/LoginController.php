<?php

class LoginController extends BaseController {
  public function showLogin()
  {
    return View::make('login');
  }

  public function doLogin()
  {
    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
    {
      return Redirect::action('UserController@showList');
    }
    return 'The credentials you entered were incorrect.';
  }

  public function doLogout()
  {
    Auth::logout();
    return Redirect::action('LoginController@showLogin');
  }
}
