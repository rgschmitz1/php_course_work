<?php
    require_once('appvars.php');

    session_start();
    if (isset($_SESSION['username'])) {
        # Delete session array
        $_SESSION = array();

        session_destroy();
    }

    # Redirect to the home page
    header("Location: " . HOME_URL);
?>
