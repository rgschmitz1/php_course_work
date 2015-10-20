<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        # Delete session array
        $_SESSION = array();

        # Delete session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 1);
        }
        session_destroy();
    }

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
