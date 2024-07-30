<?php
if (isset($this->session->userdata['logged_in'])) {

//header("location: http://localhost/schoolmanager/index.php/school_settings/user_login_process");
}
?>




<?php echo form_open('staff/staff_login_process'); ?>
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

<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>
        <form method="post" action="staff/staff_login_process">
            <h1 class="text-light">Staff Login Form</h1>
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
				<p>Not Staff, <?php echo anchor('school_settings', 'Click here to Login as Admin');?></p>
            </div>
        </form>
    </div>

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


<!--<div class="details">
<div class="panel">
<form action="" method="post" class="login-form" >
<div class="input-control modern text iconic" data-role="input">
<input name="username" id="name" style="padding-right: 5px;" type="text">
                            <span class="label">Your Username</span>
                            <span class="informer">Please enter your Username</span>
                            <span style="display: block;" class="placeholder">Input Username</span>
                            <span class="icon mif-user"></span>
                        </div>




<br />
<div class="input-control modern password iconic " data-role="input">
                            <input name="password" id="password" style="padding-right: 39px;" type="password">
                            <span class="label">Your password</span>
                            <span class="informer">Please enter your password</span>
                            <span style="display: block;" class="placeholder">Input Password</span>
                            <span class="icon mif-lock"></span>
                            <button type="button" tabindex="-1" class="button helper-button reveal"><span class="mif-looks"></span></button>
                        </div>
<br />
<br />
<input type="submit" value=" Login " name="submit" class="button success text-shadow"/><br />
<br>


</div>

</form>-->



</body>
</html>
