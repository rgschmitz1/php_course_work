<?php
    # Check BMI
    function check_bmi($weight, $height)
    {
        # Calculate BMI
        $bmi = ($weight / ($height * $height)) * 703;
        # Construct BMI message
        $bmi_msg = "Your BMI is $bmi<br/>";
        if ($bmi >= BMI_MIN && $bmi <= BMI_MAX)
        {
            # BMI is normal
            echo "<div class='alert alert-success'>" . $bmi_msg . BMI_NORM_MSG .
                "</div>";
        }
        else if ($bmi < BMI_MIN)
        {
            # BMI is less than normal
            echo "<div class='alert alert-danger'>" . $bmi_msg . BMI_UNDER_MSG .
                "</div>";
        }
        else
        {
            # BMI is greater than normal
            echo "<div class='alert alert-danger'>" . $bmi_msg . BMI_OVER_MSG .
                "</div>";
        }
    }

    # Empty inputs warning
    function empty_input()
    {
        echo "<div class='alert alert-dismissible alert-warning'><b>Oops</b>," .
            " you left a field empty, try again!</div>";
    }

    # Non numeric input warning
    function non_numeric_input()
    {
        echo "<div class='alert alert-warning'>Height and weight must be" .
            " numeric inputs</div>";
    }
?>
