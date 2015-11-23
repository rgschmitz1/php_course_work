<?php require_once('appvars.php') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Project 3 - Blog</title>
    <!-- https://bootswatch.com/simplex -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= SITE_ROOT ?>/index.php">Project 3</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
<?php
    session_start();
    if (isset($_SESSION['username']))
    {
        echo "<li><a href='" . SITE_ROOT . "/logout.php'>Logout</a></li>";
        echo "<li><a href='" . SITE_ROOT . "/post.php'>New Post</a></li>";
    }
    else
    {
        echo "<li><a href='" . SITE_ROOT . "/login.php'>Login</a></li>";
    }
?>
            </ul>
        </div>
    </div>
</nav>
