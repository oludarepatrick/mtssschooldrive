<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
if (isset($this->session->userdata['logged_in'])) {

//header("location: http://localhost/schoolmanager/index.php/school_settings/user_login_process");
}
?>

<body>
<style>
        #background {
            width: 100%;
            max-height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .login-form {
            width: 25rem;
            height: 21.75rem;
            background-color: #ffffff;
            margin-top: 5%;
        }

        .login-form input[type='text'] {
            border-radius: 0;
        }

        .login-form input[type='password'] {
            border-radius: 0;
        }

    </style>

<div class="panel">
<?php //echo form_open('student/user_login_process'); ?>
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>
<?php
if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}
?>

<?php
echo "<div class='error_msg'>";
if (isset($error_message)) {
echo $error_message;
}
echo validation_errors();
echo "</div>";
?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<h4 class="text-light" style="font-weight:bold; text-align:center"><?php echo anchor('student', 'Old Student, Click Here to Login');?></h4>
<h4 class="text-light" style="font-weight:bold; color:#006600"><?php echo  'Need Help? Please Call: 09014562186,  Whatsapp: 07053796686'; ?></h4>
<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>

<form method="post" action="" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
            <h1 class="text-light">Activate Your Pin</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Admission No:</label><p id="adminreport" style="color: red; font-size: 12px; font-weight:bold"></p>
                <input type="text" name="adminno" id="adminno" onkeyup="adminNoCheck()"  data-validate-hint-position="left"  data-validate-func="number"           
            data-validate-hint="Field cannot be Empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
			<br />
			<br />
			
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Pin Codes:</label>
                <input type="password" name="pincode" id="pincode" data-validate-hint-position="right"   data-validate-func="number"           
            data-validate-hint="Field cannot be Empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Activate</button>
            </div>
        </form>
        </div>



</body>
</html>
<script>
        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
		
		
function adminNoCheck()
        {
          var student_id = $('#adminno').val();
          $.post("checkAdminNoActivation_Ajax",
                    {
                        student_id: student_id
                    },
                    function(data)
                    {
                        $('#adminreport').text(data)

                    });
        }
    </script>