@extends('layout')

@section('content')
  {{ Form::open(array('action' => 'LoginController@doLogin' )) }}
  <div>
    <?php
      echo Form::label('email', 'Email');
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
    <?php echo Form::submit('Login'); ?>
  </div>
  {{ Form::close() }}
@stop
