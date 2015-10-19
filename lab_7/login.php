<?php
    require_once('connectvars.php');

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))
    {
        # Send authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic relm="Mismatch"');
        exit('<h2>Mismatch</h2>Sorry, you must enter a valid user name and ' .
            'password to access this page.');
    }

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    # grab username and password from user
    $user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
    $user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

    # lookup userid from the database
    $query = "SELECT user_id FROM mismatch_user WHERE username = '$user_username' AND password = SHA('$user_password')";
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1)
    {
        $row = mysqli_fetch_array($data);
        $user_id = $row['user_id'];
    }
    else
    {
        # Send authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic relm="Mismatch"');
        exit('<h2>Mismatch</h2>Sorry, you must enter a valid user name and ' .
            'password to access this page. If you are not a registerd member,' .
            ' please <a href="signup.php">sign up</a>.');
    }

    # confirm successful login
    echo("<p class='login'>You are logged in as $user_username.</p>");
?>
