@extends('layout')

@section('content')
  <h2>Register</h2>
  {{ Form::open(array('action' => 'RegistrationController@doRegister', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::text('first_name', null, array('class' => 'form-control')) }}
      {{ $errors->first('first_name') }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::text('last_name', null, array('class' => 'form-control')) }}
      {{ $errors->first('last_name') }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('email', 'E-Mail Address', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::email('email', null, array('class' => 'form-control')) }}
      {{ $errors->first('email') }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::password('password', array('class' => 'form-control')) }}
      {{ $errors->first('password') }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
      {{ $errors->first('password_confirmation') }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('group', 'User Group', array('class' => 'col-sm-2 control-label')) }}
    <div class="col-sm-4">
      {{ Form::select('group', array('U' => 'User', 'A' => 'Admin'), 'U', array('class' => 'form-control')) }}
      {{ $errors->first('group') }}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
      <div class="checkbox">
        <label>
          {{ Form::checkbox('is_active', true, true) }}
          Is Active
        </label>
        {{ $errors->first('is_active') }}
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6 text-right">
      {{ link_to_action('LoginController@showLogin', 'Login', $parameters = array(), $attributes = array('class' => 'btn btn-default')); }}
      {{ Form::submit('Register', array('class' => 'btn btn-primary')); }}
    </div>
  </div>
  {{ Form::close() }}
@stop
