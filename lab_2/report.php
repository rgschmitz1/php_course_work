<html>
<head>
  <title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>
  <h2>Aliens Abducted Me - Report an Abduction</h2>
<?php
  $name = $_POST['firstname'] . ' ' . $_POST['lastname'];
  $when_it_happened = $_POST['whenithappened'];
  $how_long = $_POST['howlong'];
  $how_many = $_POST['howmany'];
  $alien_description = $_POST['aliendescription'];
  $what_they_did = $_POST['whattheydid'];
  $fang_spotted = $_POST['fangspotted'];
  $other = $_POST['other'];
  $email = $_POST['email'];

  echo 'Thanks for submitting the form, <b>' . $name . '</b>.<br/>';
  echo 'You were abducted <b>' . $when_it_happened;
  echo '</b> and were gone for <b>' . $how_long . '</b><br/>';
  echo 'Number or aliens: <b>' . $how_many . '</b><br/>';
  echo 'Describe them: <b>' . $alien_description . '</b><br/>';
  echo 'The aliens did this: <b>' . $what_they_did . '</b><br/>';
  echo 'Was Fang there? <b>' . $fang_spotted . '</b><br/>';
  echo 'Other comments: <b>' . $other . '</b><br/>';
  echo 'Your email address is <b>' . $email . '</b>';
?>
