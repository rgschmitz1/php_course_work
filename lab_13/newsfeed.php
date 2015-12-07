<?php header('Content-Type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
  <channel>
    <title>Aliens Abducted Me - Newsfeed</title>
    <link>https://php-mysql-rgschmitz11.c9.io/php_course_work/lab_13</link>
    <description>Alien abduction reports from around the world courtesy of Owen and his abducted dog Fang.</description>
    <language>en-us</language>

<?php
  require_once('connectvars.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the alien sighting data from MySQL
  $query = "SELECT abduction_id, first_name, last_name, " .
    "DATE_FORMAT(when_it_happened,'%a, %d %b %Y %T') AS when_it_happened_rfc, " .
    "alien_description, what_they_did " .
    "FROM aliens_abduction " .
    "ORDER BY when_it_happened DESC";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of alien sighting data, formatting it as RSS
  while ($row = mysqli_fetch_array($data)) { 
    // Display each row as an RSS item
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $description = substr($row['alien_description'], 0, 32);
    $id = $row['abduction_id'];
    $when = $row['when_it_happened_rfc'];
    $date = date('T');
    $what = $row['what_they_did'];

?>
    <item>
        <title><?= $firstname . ' ' . $lastname . ' - ' . $description ?>...</title>
        <link>https://php-mysql-rgschmitz11.c9.io/php_course_work/lab_13/?abduction_id=<?= $id ?></link>
        <pubDate><?= $when . ' ' . $date ?></pubDate>
        <description><?= $what ?></description>
    </item>
<?php
  }
?>

  </channel>
</rss>
