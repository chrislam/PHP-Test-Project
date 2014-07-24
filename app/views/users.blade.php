@extends('layout')

@section('content')
  <h2>User List</h2>
  <div class="row">
    <div class="col-sm-2">
      @if (Auth::user()->group == 'A')
        {{ link_to_action('UserController@showCreate', 'Create New User', $parameters = array(), $attributes = array('class' => 'btn btn-primary')); }}
      @endif
    </div>
    <div class="col-sm-10 text-right">
      <span>Logged in as: {{ $first_name }} {{ $last_name }}</span>
      {{ link_to_action('LoginController@doLogout', 'Logout', $parameters = array(), $attributes = array('class' => 'btn btn-default')); }}
    </div>
  </div>
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th class="text-right">Active</th>
        <th>Facebook ID</th>
        <th>Created</th>
        @if (Auth::user()->group == 'A')
          <th>Actions</th>
        @endif
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->email }}</td>
        <td class="text-right">{{ $user->is_active }}</td>
        <td>{{ $user->facebook_id }}</td>
        <td>{{ $user->created_at }}</td>
        @if (Auth::user()->group == 'A')
          <td>
            {{ link_to_action('UserController@showEdit', 'Edit', $parameters = array('id' => $user->id), $attributes = array('class' => 'btn btn-sm btn-default')); }}
            {{ link_to_action('UserController@showDelete', 'Delete', $parameters = array('id' => $user->id), $attributes = array('class' => 'btn btn-sm btn-danger')); }}
          </td>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
@stop
