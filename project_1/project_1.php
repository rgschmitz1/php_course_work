<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!--<title>Mad Libs - Input Form</title>-->
  <img src="MadLibs-Logo.png" width="712" height="235" alt="" style="float:top" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<?php
  $output_form = false;
  if (isset($_POST['submit'])) {
    $noun = $_POST['noun'];
    $verb = $_POST['verb'];
    $adjective = $_POST['adjective'];
    $adverb = $_POST['adverb'];
    if (empty($noun) || empty($verb) || empty($adjective) || empty($adverb)) {
      echo '<br/><b>Oops, you left a field empty, try again!</b><br/><br/>';
      $output_form = true;
    } else {
      # Create database connection variable
      $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'mad_libs')
        or die('Error connecting to MySQL server.');
      # Create database query
      $query = "INSERT INTO user_input (noun, verb, adjective, adverb) " .
        "VALUES ('$noun', '$verb', '$adjective', '$adverb')";
      # Execute database query
      mysqli_query($dbc, $query)
        or die('Error querying database');
      # Output Mad Lib!
      # TODO create mad lib here
      # Close database connection
      mysqli_close($dbc);
    }
  } else {
    $output_form = true;
  }
  if ($output_form) {
?>
<body>
  <!--<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />-->
  <p>Enter in a noun, verb, adjective, and adverb below.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="noun">Enter in a noun:</label>
    <input type="text" id="noun" name="noun" value="<?php echo $noun; ?>"/><br />
    <label for="verb">Enter in a verb:</label>
    <input type="text" id="verb" name="verb" value="<?php echo $verb; ?>"/><br />
    <label for="adjective">Enter in an adjective:</label>
    <input type="text" id="adjective" name="adjective" value="<?php echo $adjective; ?>"/><br />
    <label for="adverb">Enter in an adverb:</label>
    <input type="text" id="adverb" name="adverb" value="<?php echo $adverb; ?>"/><br />
    <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>
<?php
  }
?>
