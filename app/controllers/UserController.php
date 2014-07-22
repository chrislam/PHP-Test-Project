<?php

class UserController extends BaseController {

  /*
  |--------------------------------------------------------------------------
  | User Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  |	Route::get('/', 'HomeController@showWelcome');
  |
  */

  public function __construct()
  {
    $firstName = Auth::user()->first_name;
    $lastName = Auth::user()->last_name;
    View::share('first_name', $firstName);
    View::share('last_name', $lastName);
  }

  public function showList()
  {
    $users = User::all();
    $users = DB::table('users')->orderBy('first_name', 'asc')->get();

    return View::make('users')->with('users', $users);
  }

  public function showCreate()
  {
    return View::make('create');
  }

  public function doCreate()
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

    return Redirect::action('UserController@showList');
  }

  public function showEdit($id)
  {
    $user = User::find($id);

    return View::make('user')->with('user', $user);
  }

  public function doEdit($id)
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
        'email' => array('required', 'email', 'unique:users,email,' . $id),
        'password' => array('required', 'alpha_dash', 'min:3', 'confirmed'),
        'password_confirmation' => array('required', 'alpha_dash', 'min:3'),
        'group' => array('required', 'in:A,U'),
        'is_active' => array('boolean')
      )
    );

    if ($validator->fails())
    {
      return Redirect::action('UserController@showEdit', array($id))->withErrors($validator);
    }

    $user = User::find($id);

    $user->first_name = $firstName;
    $user->last_name = $lastName;
    $user->email = $email;
    $user->password = Hash::make($password);
    $user->group = $group;
    $user->is_active = $is_active;

    $user->save();

    return Redirect::action('UserController@showList');
  }

  public function showDelete($id)
  {
    $user = User::find($id);
    return View::make('delete')->with('user', $user);
  }

  public function doDelete($id)
  {
    $user = User::find($id);
    $user->delete();
    return Redirect::action('UserController@showList');
  }
}
