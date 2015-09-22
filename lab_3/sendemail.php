<?php
  $from = 'elmer@makemeelvis.com';
  $subject = $_POST['subject'];
  $text = $_POST['elvismail'];

  # Create database connection variable
  $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'elvis_store')
    or die('Error connecting to MySQL server.');

  # Create database query
  $query = "SELECT * FROM email_list";
  # Execute database query
  $result = mysqli_query($dbc, $query)
    or die('Error querying database');

  while($row = mysqli_fetch_array($result)) {
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];

      $msg = "Dear $first_name $last_name,\n $text";
      $to = $row['email'];

      mail($to, $subject, $msg, 'From:' . $from);
      echo 'Email sent to: ' . $to . '<br/>';
  }

  # Close database connection
  mysqli_close($dbc);
?>
