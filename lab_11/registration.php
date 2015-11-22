<?php
  include('header.html');
  if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $resume = $_POST['resume'];
    $output_form = 'no';

    if (empty($first_name)) {
      // $first_name is blank
      echo '<p class="error">You forgot to enter your first name.</p>';
      $output_form = 'yes';
    }

    if (empty($last_name)) {
      // $last_name is blank
      echo '<p class="error">You forgot to enter your last name.</p>';
      $output_form = 'yes';
    }

    if (empty($email)) {
      // $email is blank
      echo '<p class="error">You forgot to enter your email address.</p>';
      $output_form = 'yes';
    }

    if (empty($phone)) {
      // $phone is blank
      echo '<p class="error">You forgot to enter your phone number.</p>';
      $output_form = 'yes';
    }
    else if (!preg_match('/^\(?[2-9]\d\d\)?[-\s]\d{3}-\d{4}$/', $phone)) {
      // $phone is invalid
      echo '<p class="error">Your phone number is invalid, please enter in form ###-###-####.</p>';
      $output_form = 'yes';
    }

    if (empty($job)) {
      // $job is blank
      echo '<p class="error">You forgot to enter your desired job.</p>';
      $output_form = 'yes';
    }

    if (empty($resume)) {
      // $resume is blank
      echo '<p class="error">You forgot to enter your resume.</p>';
      $output_form = 'yes';
    }
  }
  else {
    $output_form = 'yes';
  }

  if ($output_form == 'yes') {
    include('body.html');
  }
  else if ($output_form == 'no') {
    echo '<p>' . $first_name . ' ' . $last_name . ', thanks for registering with Risky Jobs!</p>';

    // code to insert data into the RiskyJobs database...
  }
?>

</body>
</html>
