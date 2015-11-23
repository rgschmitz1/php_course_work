<?php
    include('header.php');

    # connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connectionto MySQL server.');
    $query = "SELECT * FROM blog ORDER BY id DESC;";
    $result = mysqli_query($dbc, $query) or die('Error querying database');
    while ($record = mysqli_fetch_assoc($result))
    {
?>
        <div class="col-lg-12">
            <p class="lead"><?= $record['title']?></p>
            <p>
                <span class="glyphicon glyphicon-time"></span>
                <?= $record['date']?>
            </p>
            <hr>
            <p><?= $record['post']?></p>
            <hr>
        </div>
<?php
    }
    include('footer.html');
?>
