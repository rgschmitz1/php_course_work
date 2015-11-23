<?php
    require_once('appvars.php');
    include('header.php');
    session_start();
    if (!isset($_SESSION['username']))
        header('Location: ' . SITE_ROOT . '/login.php');

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connectionto MySQL server.');

    if (isset($_POST['submit']))
    {
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $body = mysqli_real_escape_string($dbc, trim($_POST['body']));
        if (empty($title) || empty($body))
        {
?>

<div class="alert alert-warning">
    <h4>Warning</h4>
    <p>Both title and body must be filled present to post.</p>
</div>

<?php
        }
        else
        {
            # Construct new blog post query
            $query = "INSERT INTO blog (date, title, post) VALUES (NOW(), '$title', '$body')";

            # Execute MySQL query
            mysqli_query($dbc, $query) or die('Error querying database');

            # Close MySQL connection
            mysqli_close($dbc);
?>

<div class="alert alert-success">
    <h4>Success</h4>
    <p>Post was successufully submitted to blog.</p>
</div>

<?php
            $title = '';
            $body = '';
        }
    }
?>

<form class="form-horizontal" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <fieldset>
        <div class="container">
            <legend>New Post</legend>
            <div class="form-group">
                <label for="title" class="col-lg-1 control-label">Title</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" value="<?= $title ?>" id="title" name="title">
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
