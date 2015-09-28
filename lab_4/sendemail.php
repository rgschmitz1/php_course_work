<?php
  $from = 'elmer@makemeelvis.com';
  $subject = $_POST['subject'];
  $text = $_POST['elvismail'];
  $output_form = false;

  if (empty($subject) && empty($text)) {
    echo 'You forgot the email subject and body test, you dummy!<br/>';
    $output_form = true;
  } else if (empty($subject)) {
    echo 'You forgot the subject.<br/>';
    $output_form = true;
  } else if (empty($text)) {
    echo 'You forgot the body text.<br/>';
    $output_form = true;
  } else {
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
  }
  if ($output_form) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Send Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p><strong>Private:</strong> For Elmer's use ONLY<br />
  Write and send an email to mailing list members.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="subject">Subject of email:</label><br />
    <input id="subject" name="subject" type="text" size="30" /><br />
    <label for="elvismail">Body of email:</label><br />
    <textarea id="elvismail" name="elvismail" rows="8" cols="40"></textarea><br />
    <input type="submit" name="Submit" value="Submit" />
  </form>
</body>
</html>
<?php
  }
?>
