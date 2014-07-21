@extends('layout')

@section('content')
  {{ Form::open(array('action' => 'UserController@doEdit' )) }}
  <?php echo Form::model($user, array('action' => array('UserController@doEdit', $user->id))) ?>
  <div>
    <?php
      echo Form::label('first_name', 'First Name');
      echo Form::text('first_name');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('last_name', 'Last Name');
      echo Form::text('last_name');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('email', 'E-Mail Address');
      echo Form::email('email');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('password', 'Password');
      echo Form::password('password');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('confirm_password', 'Confirm Password');
      echo Form::password('confirm_password');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('group', 'User Group');
      echo Form::select('group', array('A' => 'Admin', 'U' => 'User'), 'U');
    ?>
  </div>
  <div>
    <?php
      echo Form::label('is_active', 'Is Active');
      echo Form::checkbox('is_active', 'value', true);
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
