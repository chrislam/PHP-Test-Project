<?php

session_start();

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class LoginController extends BaseController {
  public function showLogin()
  {
    FacebookSession::setDefaultApplication($_ENV['FB_APP_ID'], $_ENV['FB_APP_SECRET']);
    $redirectUrl = action('LoginController@doFacebookLogin');
    $helper = new FacebookRedirectLoginHelper($redirectUrl);
    $loginUrl = $helper->getLoginUrl();

    return View::make('login')->with('loginUrl', $loginUrl);
  }

  public function doFacebookLogin()
  {
    FacebookSession::setDefaultApplication($_ENV['FB_APP_ID'], $_ENV['FB_APP_SECRET']);
    $helper = new FacebookRedirectLoginHelper(action('LoginController@doFacebookLogin'));
    try {
      $session = $helper->getSessionFromRedirect();
    } catch(FacebookRequestException $ex) {
      // When Facebook returns an error
      return 'Facebook login is not available at this time. Please return to the login page and log in using your email and password.';
    } catch(\Exception $ex) {
      // When validation fails or other local issues
      return $ex;
    }
    if ($session) {
      // Logged in
      try {

        $user_profile = (new FacebookRequest(
          $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());

        echo "Name: " . $user_profile->getName();

      } catch(FacebookRequestException $e) {

        echo "Exception occured, code: " . $e->getCode();
        echo " with message: " . $e->getMessage();

      }

      $user = User::where('facebook_id', '=', $user_profile->getId())->first();
      if ($user != NULL)
      {
        Auth::login($user);
        return Redirect::action('UserController@showList');
      }

      $user = new User;

      $user->first_name = $user_profile->getFirstName();
      $user->last_name = $user_profile->getLastName();
      $user->facebook_id = $user_profile->getId();
      $user->group = 'U';
      $user->is_active = true;

      $user->save();

      Auth::login($user);

      return Redirect::action('UserController@showList');
    }
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
