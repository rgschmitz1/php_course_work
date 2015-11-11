<?php
    require_once('bmivars.php');
    require_once('functions.php');
    include('header.html');
    if (isset($_GET['submit']))
    {
        $weight = $_GET['user_weight'];
        $height = $_GET['user_height'];
        if (empty($weight) || empty($height))
        {
            # Empty inputs warning
            alert_msg('warning', '<b>Oops,</b> you left a field empty, try again!');
        }
        else if (!is_numeric($weight) || !is_numeric($height))
        {
            # Non-numeric input warning
            alert_msg('warning', 'Height and weight must be numeric inputs');
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
