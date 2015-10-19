<?php
    require_once('connectvars.php');

    # Clear error message
    $error_msg = '';

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    # If the user isn't logged in, try to log them in
    if (!isset($_COOKIE['user_id']))
    {
        if (isset($_POST['submit']))
        {

            # grab username and password from user
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password))
            {
                # lookup userid from the database
                $query = "SELECT user_id FROM mismatch_user WHERE username = '$user_username' AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 1)
                {
                    # Login is OK, set the user ID and username cookies, then redirect to homepage
                    $row = mysqli_fetch_array($data);
                    setcookie('user_id', $row['user_id']);
                    setcookie('username', $user_username);
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                    header("Location: $home_url");
                }
                else
                {
                    $error_msg = 'Sorry, you must enter your username and password to login.';
                }
            }
            else
            {
                $error_msg = 'Sorry, you must enter your username and password to login.';
            }
        }
    }
?>

<html>
<head>
    <title>Mismatch - Log In</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h3>Mismatch - Log In</h3>
<?php
    # If the cookie is empty, show any error message and the lgin form; otherwise confirm the login
    if (empty($_COOKIE['user_id']))
    {
        echo "<p class='error'>$error_msg</p>";
?>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Log In</legend>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"
                value="<?= $user_username; ?>" /><br/>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" />
        </fieldset>
        <input type="submit" value="Log In" name="submit" />
    </form>
<?php
    }
    else
    {
        # Confirm the successful log in
        echo('<p class="login">You are logged in as ' . $_COOKIE['username'] . '.</p>');
    }
?>
</body>
</html>
