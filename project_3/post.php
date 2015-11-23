<?php
    require_once('appvars.php');
    include('header.php');
    session_start();
    if (!isset($_SESSION['username']))
        header('Location: ' . SITE_ROOT . '/login.php');

    if (isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $body = $_POST['body'];
        if (empty($title) || empty($body))
        {
?>
<div class="alert alert-warning">
    <h4>Warning</h4>
    <p>Both title and body must be filled present to post.</p>
</div>
<?php
        }
    }
?>
<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
  <fieldset>
    <legend>New Post</legend>
    <div class="form-group">
      <label for="title" class="col-lg-1 control-label">Title</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" value="<?= $title ?>" id="title" name="title" placeholder="Title">
      </div>
    </div>
    <div class="form-group">
      <label for="body" class="col-lg-1 control-label">Body</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="10" id="body" name="body"><?= $body ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-1">
          <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
<?php
    include('footer.html');
?>
