<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<body>
<style>
        #background {
            width: 100%;
            max-height:50%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .login-form {
            width: 25rem;
            height:11rem;
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

<h1 class="text-light" style="font-weight:bold; text-align:center"><?php echo anchor('student/activate_pin', 'New Pupil?  Click Here to ACTIVATE PIN');?></h1>
<h4 class="text-light" style="font-weight:bold; color:#009900; text-align:center"><?php echo  'Need Help? Please Call: 09014562186,  Whatsapp: 07053796686'; ?></h4>
<div class="login-form padding20 block-shadow">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<form method="post" action="">
            <h4 class="text-light">Student Username & Password Recorvery</h4>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Admission No:</label>
                <input type="text" name="username" id="username" onkeyup="adminNoCheck()" required>
                <p id="adminreport" style="color: red; font-size: 12px; font-weight:bold"></p>
            </div>
            
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Click Me</button>
                            </div>
        </form>
        </div>
</div>


</body>
</html>

<script>

function adminNoCheck()
        {
          var student_id = $('#username').val();
          $.post("checkAdminNo_Ajax",
                    {
                        student_id: student_id
                    },
                    function(data)
                    {
                        $('#adminreport').text(data)

                    });
        }
</script>
