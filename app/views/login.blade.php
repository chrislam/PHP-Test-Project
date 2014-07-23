@extends('layout')

@section('content')
  <h2>Login</h2>
  {{ Form::open(array('action' => 'LoginController@doLogin', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    {{ Form::label('email', 'Email', $attributes = array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::email('email', null, $attributes = array('class' => 'form-control')) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('password', 'Password', $attributes = array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::password('password', $attributes = array('class' => 'form-control')) }}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {{ Form::submit('Login', $attributes = array('class' => 'btn btn-primary')); }}
      {{ link_to_action('RegistrationController@showRegister', 'Register', $parameters = array(), $attributes = array('class' => 'btn btn-default')); }}
    </div>
  </div>
  {{ Form::close() }}
@stop
