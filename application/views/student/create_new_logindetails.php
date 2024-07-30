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
            height: 24.75rem;
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

<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>

<form method="post" action="sign_up" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
            <h3 class="text-light">Create Username and Password</h3>
            <hr class="thin"/>
            <br />
			<div class="input-control text full-size" data-role="input">
                <label for="user_login">Admission No:</label>
                <input type="text" name="adminno" id="adminno" value="<?php //$student_id = ($this->session->userdata['my_id']['student_id']);?>" data-validate-hint-position="left"  data-validate-func="number"           
            data-validate-hint="Field cannot be Empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Username(Minimum 6):</label>
                <input type="text" name="username" id="username" data-validate-hint-position="right" data-validate-arg="6" data-validate-func="minlength"           
            data-validate-hint="Field cannot be Empty! <br>Maximum Character is: <h4>6!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password(Minimum 5):</label>
                <input type="password" name="password" id="password" data-validate-hint-position="left" data-validate-arg="5" data-validate-func="minlength"           
            data-validate-hint="Field cannot be Empty! <br>Maximum Character is: <h4>5!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
			<div class="input-control password full-size" data-role="input">
                <label for="user_password">Password Confirmation:</label>
                <input type="password" onkeyup="check()" name="confirm_password" id="confirm_password" data-validate-hint-position="right"  data-validate-func="required"           
            data-validate-hint="Field cannot be Empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button><span id='message'></span>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
            </div>
        </form>
        </div>



</body>
</html>

 <script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        if (password != confirm_password) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
 <script type="text/javascript">
function check() {
    if(document.getElementById('password').value === document.getElementById('confirm_password').value) {
        $('#message').html('Password Match Correctly').css('color',  'green');
    } else 
        $('#message').html('Password Not Matching').css('color', 'red');
}
</script>

<script>
        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
    </script>