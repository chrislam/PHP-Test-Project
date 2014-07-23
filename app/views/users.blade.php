@extends('layout')

@section('sub-heading')
  Logged in as: <?php echo $first_name ?> <?php echo $last_name ?>
@stop

@section('content')
  @if (Auth::user()->group == 'A')
    <?php echo link_to_action('UserController@showCreate', 'Create New User', $parameters = array(), $attributes = array()); ?>
  @endif
  <table>
    <thead>
      <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Active</td>
        <td>Facebook ID</td>
        <td>Created</td>
        @if (Auth::user()->group == 'A')
          <td>Actions</td>
        @endif
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->is_active }}</td>
        <td>{{ $user->facebook_id }}</td>
        <td>{{ $user->created_at }}</td>
        @if (Auth::user()->group == 'A')
          <td>
            <?php echo link_to_action('UserController@showEdit', 'Edit', $parameters = array('id' => $user->id), $attributes = array()); ?>
            <?php echo link_to_action('UserController@showDelete', 'Delete', $parameters = array('id' => $user->id), $attributes = array()); ?>
          </td>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
  <?php echo link_to_action('LoginController@doLogout', 'Logout', $parameters = array(), $attributes = array()); ?>
@stop
