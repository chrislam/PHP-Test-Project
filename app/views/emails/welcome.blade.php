<html>
  <body>
    <h1>Welcome {{ $user->first_name }}!</h1>
    <div>
      <p>Thank you for registering, you can login <?php echo link_to_action('LoginController@showLogin', 'here', $parameters = array(), $attributes = array()); ?></p>
    </div>
  </body>
</html>
