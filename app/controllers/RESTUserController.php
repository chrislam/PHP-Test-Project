<?php

class RESTUserController extends BaseController {
  public function postAuth()
  {
    $RESTAPIToken = NULL;
    $success = false;
    $message = NULL;
    $email = Input::get('email');
    $password = Input::get('password');

    if (Auth::validate(array('email' => $email, 'password' => $password)))
    {
      $RESTAPIToken = Crypt::encrypt($email . ',' . date_format(date_create(), 'YmdHis'));
      $success = true;
      $message = 'Your token will expire in 24 hours. Please authenticate again after that.';
    }
    else
    {
      $message = 'Authentication failed: User credentials not valid.';
    }

    return Response::json(array('token' => $RESTAPIToken, 'success' => $success, 'message' => $message));
  }

  public function getUsers($token)
  {
    // $combined = Crypt::decrypt($token);

    $users = User::all(
      array(
        'first_name',
        'last_name',
        'email',
        'group',
        'is_active'
      )
    );

    return Response::json($users);
  }
}
