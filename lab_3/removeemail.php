<?php
  # Create database connection variable
  $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'elvis_store')
    or die('Error connecting to MySQL server.');

  # Construct varaibles
  $email = $_POST['email'];

  # Create database query
  $query = "DELETE FROM email_list WHERE email = '$email'";

  # Execute database query
  mysqli_query($dbc, $query)
    or die('Error querying database');

  # Confirm email was removed from database
  echo "$email successfully removed from email list";

  # Close database connection
  mysqli_close($dbc);
?>
