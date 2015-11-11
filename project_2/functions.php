<?php
    # Alert message
    function alert_msg($type,$msg)
    {
?>
    <div class='alert alert-dismissable alert-<?= $type ?>'>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $msg ?>
    </div>
<?php
    }

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
            alert_msg('success', $bmi_msg . BMI_NORM_MSG);
        }
        else if ($bmi < BMI_MIN)
        {
            # BMI is less than normal
            alert_msg('danger', $bmi_msg . BMI_UNDER_MSG);
        }
        else
        {
            # BMI is greater than normal
            alert_msg('danger', $bmi_msg . BMI_OVER_MSG);
        }
    }
?>
