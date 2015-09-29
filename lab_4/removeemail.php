<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p>Please select the email addresses to delete from the email list and click Remove..</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
  # Create database connection variable
  $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'elvis_store')
    or die('Error connecting to MySQL server.');

  # Delete customer rows if form has been submitted
  if (isset($_POST['submit']) && isset($_POST['todelete'])) {
    foreach ($_POST['todelete'] as $delete_id) {
      $query = "DELETE FROM email_list WHERE id = $delete_id";
      mysqli_query($dbc, $query)
        or die('Error querying database');
    }
  }

  # Display the customer rows with checkboxes for deleting
  $query = "SELECT * FROM email_list";

  # Execute database query
  $result = mysqli_query($dbc, $query)
    or die('Error querying database');

  while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];

    echo "<input type='checkbox' value='$id' name='todelete[]' />";
    echo "$first_name $last_name $email";
    echo "<br/>";
  }

  # Close database connection
  mysqli_close($dbc);
?>
    <input type="submit" name="submit" value="Remove" />
  </form>
</body>
</html>
