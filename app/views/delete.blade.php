@extends('layout')

@section('content')
  {{ Form::model($user, array('action' => array('UserController@doDelete', $user->id))) }}
  <div>
    <p>Are you sure you wish to delete {{ $user->first_name }} {{ $user->last_name }}?</p>
  </div>
  <div>
    <?php echo Form::submit('Delete'); ?>
  </div>
  <div>
    <?php echo link_to_action('UserController@showList', 'View All Users', $parameters = array(), $attributes = array()); ?>
  </div>
  {{ Form::close() }}
@stop
