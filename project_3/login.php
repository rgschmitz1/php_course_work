<?php
    include('header.php');
    require_once('appvars.php');

    # Start the session
    session_start();

    # Clear error message
    $error_msg = '';

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    # If the user isn't logged in, try to log them in
    if (!isset($_SESSION['username']))
    {
        if (isset($_POST['submit']))
        {
            # grab username and password from user
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password))
            {
                # lookup userid from the database
                $query = "SELECT * FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 1)
                {
                    # Login is OK, set the user ID and username cookies, then redirect to homepage
                    $row = mysqli_fetch_array($data);
                    $_SESSION['username'] = $user_username;
                    header("Location: " . HOME_URL);
                }
                else
                {
                    $error_msg = 'Sorry, you must enter a valid username and password to login.';
                }
            }
            else
            {
                $error_msg = 'Sorry, you must enter your username and password to login.';
            }
        }
    }
?>
    <div class='container'>
    <h1>Login</h1>
    <hr>
<?php
    # If the cookie is empty, show any error message and the lgin form; otherwise confirm the login
    if (empty($_SESSION['username']))
    {
        echo "<p class='text-danger'>$error_msg</p>";
?>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <div class="col-xs-2">
            <label for="username">Username:</label>
            <input class="form-control" type="text" id="username" placeholder="Username" name="username"
                value="<?= $user_username; ?>" />
            <br/>
            <label for="password">Password:</label>
            <input class="form-control" type="password" id="password" placeholder="Password" name="password" />
            <br/>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </div>
    </form>
<?php
    }
    else
    {
        # Confirm the successful log in
        echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    }
    echo '</div>';
    include('footer.html');
?>
