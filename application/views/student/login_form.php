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
<?php echo form_open('student/user_login_process'); ?>
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
<h4 class="text-light" style="font-weight:bold; text-align:center"><?php echo anchor('student/activate_pin', 'New Student, Click Here to ACTIVATE PIN');?></h4>
<h2 class="text-light" style="font-weight:bold; color:#009900"><?php echo  'Need Help? Please Call: 09014562186,  Whatsapp: 07053796686'; ?></h2>
<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<form method="post" action="student/user_login_process">
            <h1 class="text-light">Student Login</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Username:</label>
                <input type="text" name="username" id="username">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="password" id="password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
                <p>Forgot Username/Password?, <?php echo anchor('student/recover_Pass', 'Click here to Recorver');?></p>
            </div>
        </form>
        </div>



</body>
</html>
