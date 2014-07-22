<?php

class RegistrationController extends BaseController {
  public function showRegister()
  {
    return View::make('register');
  }

  public function doRegister()
  {
    $firstName = Input::get('first_name');
    $lastName = Input::get('last_name');
    $email = Input::get('email');
    $password = Input::get('password');
    $password_confirmation = Input::get('password_confirmation');
    $group = Input::get('group');
    $is_active = Input::get('is_active');

    $validator = Validator::make(
      array(
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password_confirmation,
        'group' => $group,
        'is_active' => $is_active
      ),
      array(
        'first_name' => array('required', 'alpha_dash'),
        'last_name' => array('required', 'alpha_dash'),
        'email' => array('required', 'email', 'unique:users'),
        'password' => array('required', 'alpha_dash', 'min:3', 'confirmed'),
        'password_confirmation' => array('required', 'alpha_dash', 'min:3'),
        'group' => array('required', 'in:A,U'),
        'is_active' => array('boolean')
      )
    );

    if ($validator->fails())
    {
      return Redirect::action('UserController@showCreate')->withErrors($validator);
    }

    $user = new User;

    $user->first_name = $firstName;
    $user->last_name = $lastName;
    $user->email = $email;
    $user->password = Hash::make($password);
    $user->group = $group;
    $user->is_active = $is_active;

    $user->save();

    if (Auth::attempt(array('email' => $email, 'password' => $password)))
    {
      return Redirect::action('UserController@showList');
    }

    return Redirect::action('LoginController@showLogin');
  }
}
