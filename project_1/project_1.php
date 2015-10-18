<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<title>Mad Libs - Input Form</title>-->
    <img src="MadLibs-Logo.png" width="712" height="235" alt="" style="float:top" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<?php
    # Create database connection variable
    $dbc = mysqli_connect('localhost', 'rgschmitz11', '', 'mad_libs')
        or die('Error connecting to MySQL server.');
    if (isset($_POST['submit'])) {
        $noun = $_POST['noun'];
        $verb = $_POST['verb'];
        $adjective = $_POST['adjective'];
        $adverb = $_POST['adverb'];
        if (empty($noun) || empty($verb) || empty($adjective) || empty($adverb)) {
            echo '<br/><b>Oops, you left a field empty, try again!</b><br/><br/>';
        } else {
            # Create database query
            $query = "INSERT INTO user_input (date, noun, verb, adjective, adverb) " .
                "VALUES (now(), '$noun', '$verb', '$adjective', '$adverb')";
            # Execute database query
            mysqli_query($dbc, $query)
                or die('Error querying database');
            # Close database connection
            mysqli_close($dbc);
            # Reset variables after successfully including into datebase
            $noun = '';
            $verb = '';
            $adjective = '';
            $adverb = '';
        }
    }
?>
<body>
    <!--<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />-->
    <p>Enter in a noun, verb, adjective, and adverb below.</p>
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <label for="noun">Enter in a noun:</label>
        <input type="text" id="noun" name="noun" value="<?= $noun; ?>"/><br />
        <label for="verb">Enter in a verb:</label>
        <input type="text" id="verb" name="verb" value="<?= $verb; ?>"/><br />
        <label for="adjective">Enter in an adjective:</label>
        <input type="text" id="adjective" name="adjective" value="<?= $adjective; ?>"/><br />
        <label for="adverb">Enter in an adverb:</label>
        <input type="text" id="adverb" name="adverb" value="<?= $adverb; ?>"/><br />
        <input type="submit" name="submit" value="Submit" />
    </form>
    <hr>
</body>
</html>
<?php
    # Construct query
    $query = "SELECT * FROM user_input ORDER BY id DESC";
    # Execute database query
    $result = mysqli_query($dbc, $query)
        or die('Error querying database');
    while ($row = mysqli_fetch_array($result)) {
        $date = $row['date'];
        $noun = $row['noun'];
        $verb = $row['verb'];
        $adjective = $row['adjective'];
        $adverb = $row['adverb'];
        # Output Mad Libs!
?>
    <span class='left'>
        The <u><b><?= $adjective; ?></b></u> fox <u><b><?= $adverb; ?></b></u> 
        <u><b><?= $verb; ?></b></u> over the lazy brown <u><b><?= $noun; ?></b></u>.
    </span>
    <span class='right'><?= $date; ?></span>
    <br/><hr>
<?php
    }
    # Close database connection
    mysqli_close($dbc);
?>
