<?php require_once('appvars.php') ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= HOME_URL ?>">Project 3</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<?php
    session_start();
    if (isset($_SESSION['username']))
    {
        echo "<li><a href='" . LOGOUT_URL . "'>Logout</a></li>";
    }
    else
    {
        echo "<li><a href='" . LOGIN_URL . "'>Login</a></li>";
    }
?>
      </ul>
    </div>
  </div>
</nav>
