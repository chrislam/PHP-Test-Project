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
      $expiry_date = date_create();
      date_add($expiry_date, date_interval_create_from_date_string('+24 hour'));
      $RESTAPIToken = Crypt::encrypt($email . ',' . date_format($expiry_date, 'Y-m-d H:i:s'));
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
    $token_pieces = explode(',', Crypt::decrypt($token));

    $expiry_date = date_create($token_pieces[1]);

    $now = date_create();

    if ($expiry_date > $now)
    {
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
    
    return Response::json('Token expired');
  }
}
