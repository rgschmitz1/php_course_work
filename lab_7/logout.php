<?php
    # If the user is logged in, delete the cookie to log them out
    if (isset($_COOKIE['user_id']))
    {
        # Delete the user id and username cookie by setting the expiration in the past
        setcookie('user_id', '', time() - 1);
        setcookie('username', '', time() - 1);
    }

    # Redirect to the home page
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header("Location: $home_url");
