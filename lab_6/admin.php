<?php
  //User name and password for authentication
  $username = 'rock';
  $password = 'roll';
  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
      // Send authentication headers
      header('HTTP/1.1 401 Unauthorized');
      header('WWW-Authenticate: Basic relm="Guitar Wars"');
      exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user name and ' .
        'password to access this page.');
  }
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Guitar Wars - High Scores Administration</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Guitar Wars - High Scores Administration</h2>
  <p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed.</p>
  <hr />

<?php
  require_once('appvars.php');
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = 'SELECT * FROM guitarwars ORDER BY score DESC, date ASC';
  $data = mysqli_query($dbc, $query);

  // Loop through the array of score data, formatting it as HTML
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) {
    $id = $row['id'];
    $date = $row['date'];
    $name = $row['name'];
    $score = $row['score'];
    $screenshot = $row['screenshot'];
    // Display the score data
    echo "<tr class='scorerow'><td><strong>$name</strong></td>";
    echo "<td>$date</td>";
    echo "<td>$score</td>";
    echo "<td><a href='removescore.php?id=$id&amp;date=$date&amp;name=$name" .
      "&amp;score=$score&amp;screenshot=$screenshot'>Remove</a></td></tr>";
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body>
</html>
