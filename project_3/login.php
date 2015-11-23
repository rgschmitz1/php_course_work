<?php
    include('header.php');
    require_once('appvars.php');

    # Start the session
    session_start();

    # Clear error message
    $error_msg = '';

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connectionto MySQL server.');

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
                # lookup user from the database
                $query = "SELECT * FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 1)
                {
                    # Login is OK, set the SESSION username, then redirect to homepage
                    $_SESSION['username'] = $user_username;
                    header('Location: ' . SITE_ROOT . '/index.php');
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
<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <fieldset>
        <div class="container">
            <legend>Login</legend>
<?php
    if (empty($_SESSION['username']))
    {
        if (!empty($error_msg))
        {
?>
<div class="alert alert-warning">
    <h4>Warning</h4>
    <p><?= $error_msg ?></p>
</div>
<?php
        }
?>
            <div class="form-group">
                <label for="username" class="col-lg-1 control-label">Username</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" value="<?= $user_username ?>" id="username" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-lg-1 control-label">Password</label>
                 <div class="col-lg-2">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-1 col-lg-offset-1">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<?php
    }
    else
    {
        # Confirm the successful log in
        echo('<p>You are logged in as ' . $_SESSION['username'] . '.</p>');
    }
    include('footer.html');
?>
