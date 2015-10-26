<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Risky Jobs - Search</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Risky Jobs - Search Results</h3>

  <table border="0" cellpadding="2">
    <tr class="heading">
      <td>Job Title</td><td>Description</td><td>State</td><td>Date Posted</td>
    </tr>

<?php
  function build_query($user_search) {
    // Query to get the results
    $query = "SELECT * FROM riskyjobs";
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
      foreach ($search_words as $word) {
        if (!empty($word)) {
          $final_search_words[] = $word;
        }
      }
    }
  
    // Generate a WHERE clause using all of the search keywords
    $where_list = array();
    if (count($final_search_words) > 0) {
      foreach ($final_search_words as $word) {
        $where_list[] = "description LIKE '%$word%'";
      }
    }
    $where_clause = implode(' OR ', $where_list);
  
    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $query .= " WHERE $where_clause";
    }
    return $query;
  }

  // Grab the sort setting and search keywords from the URL using GET
  $sort = $_GET['sort'];
  $user_search = $_GET['usersearch'];

  $search_query = build_query($user_search);

  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  $result = mysqli_query($dbc, $search_query);
  while ($row = mysqli_fetch_array($result)) {
?>
    <tr class="results">
      <td valign="top" width="20%"><?= $row['title'] ?></td>
      <td valign="top" width="50%"><?= substr($row['description'], 0, 100) ?>...</td>
      <td valign="top" width="10%"><?= $row['state'] ?></td>
      <td valign="top" width="20%"><?= substr($row['date_posted'], 0, 10) ?></td>
    </tr>
<?php
  }

  mysqli_close($dbc);
?>

  </table>
</body>
</html>
