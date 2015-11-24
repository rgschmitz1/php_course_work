<?php
    require_once('appvars.php');
    include('header.php');
    session_start();

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connectionto MySQL server.');
    $query = "SELECT * FROM blog ORDER BY id DESC;";
    $result = mysqli_query($dbc, $query) or die('Error querying database');

    if (isset($_SESSION['username']))
    {
?>
<form method="post" action="<?= SITE_ROOT . '/removepost.php' ?>">
    <div class="col-xs-offset-9 col-xs-3">
        <div class="affix">
            <div class="well">
                <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                <span class="help-block">Push to delete selected post.</span>
            </div>
        </div>
    </div>
<?php
    }
    while ($record = mysqli_fetch_assoc($result))
    {
?>
    <div class="container">

<?php if (isset($_SESSION['username'])) { ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="check_list[]" value="<?= $record['id'] ?>"><label>Delete Post</label>
            </label>
        </div>
<?php } ?>

        <p>
            <strong class="lead"><?= $record['title']?></strong>
        </p>
        <p>
            <small style="padding-left:20px" class="glyphicon glyphicon-time"><?= $record['date']?></small>
        </p>
        <br/>
        <p><?= $record['post']?></p>
        <hr>
    </div>
<?php
    }
    if (isset($_SESSION['username']))
    {
        echo '</form>';
    }
    include('footer.html');
?>
