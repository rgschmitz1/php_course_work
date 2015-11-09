<?php
    require_once('bmivars.php');
    require_once('functions.php');
    include('header.html');
    if (isset($_POST['submit']))
    {
        $weight = $_POST['user_weight'];
        $height = $_POST['user_height'];
        if (empty($weight) || empty($height))
        {
            empty_input();
        }
        else if (!is_numeric($weight) || !is_numeric($height))
        {
            non_numeric_input();
        }
        else
        {
            # Inputs passed all error checks, process below
            check_bmi($weight, $height);
            # Reset variables
            $weight = '';
            $height = '';
        }
    }
    include('body.html');
?>
