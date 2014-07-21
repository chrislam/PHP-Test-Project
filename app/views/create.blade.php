@extends('layout')

@section('sub-heading')
  Logged in as: <?php echo $first_name ?> <?php echo $last_name ?>
@stop

@section('content')
  {{ Form::open(array('action' => 'UserController@doCreate' )) }}
  <div>
    <?php
      echo Form::label('first_name', 'First Name');
      echo Form::text('first_name');
      echo $errors->first('first_name');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('last_name', 'Last Name');
      echo Form::text('last_name');
      echo $errors->first('last_name');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('email', 'E-Mail Address');
      echo Form::email('email');
      echo $errors->first('email');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('password', 'Password');
      echo Form::password('password');
      echo $errors->first('password');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('password_confirmation', 'Confirm Password');
      echo Form::password('password_confirmation');
      echo $errors->first('password_confirmation');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('group', 'User Group');
      echo Form::select('group', array('A' => 'Admin', 'U' => 'User'), 'U');
      echo $errors->first('group');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('is_active', 'Is Active');
      echo Form::checkbox('is_active', true, true);
      echo $errors->first('is_active');
    ?>
  </div>
  <div>
    <?php echo Form::submit('Create'); ?>
  </div>
  <div>
    <?php echo link_to_action('UserController@showList', 'View All Users', $parameters = array(), $attributes = array()); ?>
  </div>
  {{ Form::close() }}
@stop
