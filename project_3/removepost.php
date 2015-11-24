<?php
    require_once('appvars.php');
    session_start();

    # If someone tries to access this page
    # without being logged in, redirect...
    if (!isset($_SESSION['username']))
    {
        header('Location: ' . SITE_ROOT . '/login.php');
    }

    if (isset($_POST['submit']) && !empty($_POST['check_list']))
    {
        # Connect to database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connectionto MySQL server.');

        # Delete selected post
        foreach($_POST['check_list'] as $selected)
        {
            $query = "DELETE FROM blog WHERE id = '$selected' LIMIT 1";
            mysqli_query($dbc, $query);
        }

        # Close database connection
        mysqli_close($dbc);

        # Navigate back to index after completion
        header('Location: ' . SITE_ROOT . '/index.php');
    }
?>
