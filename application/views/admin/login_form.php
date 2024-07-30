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
            height: 18.75rem;
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
<?php echo form_open('school_settings/user_login_process'); ?>
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
echo "<h4 class='head_bg_1'>";
if (isset($error_message)) {
echo $error_message;
}
echo validation_errors();
echo "</h4>";
?>
<h1 class="text-light" style="font-weight:bold;"><?php echo anchor('student', 'Click Me to Login as a Student/Parent');?></h1> 
<h4 class="text-light" style="font-weight:bold; color:#009900"><?php echo  'Need Help? Please Call: 09014562186,  Whatsapp: 07053796686'; ?></h4>
<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('message')) { ?>
<h4 class="message_bg_1"><?php echo($this->session->flashdata('message')); ?></h4>
<?php } ?>
        <form method="post" action="user_login_process">
            <h1 class="text-light">Admin Login Form</h1>
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
            </div>
			<p>Not Admin, <?php echo anchor('staff', 'Click here to Login as Staff');?></p>
           <!-- <p>Click <a href="index.php/staff">here</a> to log in as staff</p>-->
        </form>
    </div>



</body>
</html>
