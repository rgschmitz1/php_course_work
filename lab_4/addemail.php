<?php
  # Create database connection variable
  $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'elvis_store')
    or die('Error connecting to MySQL server.');

  # Store variables from user input
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $email = $_POST['email'];

  # Create database query
  $query = "INSERT INTO email_list (first_name, last_name, email) " .
    "VALUES ('$first_name', '$last_name', '$email')";

  # Execute database query
  mysqli_query($dbc, $query)
    or die('Error querying database');

  # Confirm query success
  echo 'Customer added.';

  # Close database connection
  mysqli_close($dbc);
?>
