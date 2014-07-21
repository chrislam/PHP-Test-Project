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
    $first_name = Auth::user()->first_name;
    $last_name = Auth::user()->last_name;
    View::share('first_name', $first_name);
    View::share('last_name', $last_name);
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
    $firstName =

    $validator = Validator::make(
      array(
        'first_name' => Input::get('first_name'),
        'last_name' => Input::get('last_name'),
        'email' => Input::get('email'),
        'password' => Input::get('password'),
        'password_confirmation' => Input::get('password_confirmation'),
        'group' => Input::get('group'),
        'is_active' => Input::get('is_active')
      ),
      array(
        'first_name' => array('required', 'alpha_dash'),
        'last_name' => array('required', 'alpha_dash'),
        'email' => array('required', 'email', 'unique:users'),
        'password' => array('required', 'alpha_dash', 'min:3', 'confirmed'),
        'password_confirmation' => array('required', 'alpha_dash', 'min:3'),
        'group' => array('required', 'in:A,U'),
        'is_active' => array('required', 'boolean')
      )
    );

    if ($validator->fails())
    {
      return Redirect::action('UserController@showCreate')->withErrors($validator);
    }

    $user = new User;

    $user->first_name = Input::get('first_name');
    $user->last_name = Input::get('last_name');
    $user->email = Input::get('email');
    $user->password = Hash::make(Input::get('password'));
    $user->group = Input::get('group');
    $user->is_active = Input::get('is_active');

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
    return $id;
  }

  public function showDelete($id)
  {
    return 'Delete';
  }

  public function doDelete($id)
  {
    return 'Deleted';
  }
}
