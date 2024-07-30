<html>
<body>
<div class="m-content">
<?php 
	  
  foreach($query_class->result() as $val){
	  
	  ?>
<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">TEACHER'S INFO</span>
    </div>
  <div class="content">
<div class="flex-grid margin3">
<form method="post" action="" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<div class="row flex-just-sb">
<div class="cell colspan3">
 <input type="hidden" name="staffid" id="staffid" value="<?php echo $val->staff_id; ?>"
<label>Staff Name:</label>
<div class="input-control text full-size">
        <input name="fname" id="fname" type="text" data-validate-hint-position="top" value="<?php echo $val->name; ?>"    data-validate-func="required"           
            data-validate-hint="First Name is Required!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span> 
</div>
</div>
<div class="cell colspan2">
<label>Mobile Number:</label>
<div class="input-control text">
  <input name="phone" id="phone" value="<?php echo $val->phone; ?>" type="text"  />
</div>
</div>
<div class="cell colspan2">
<label>Username:</label>
<div class="input-control text">
  <input name="username" id="username" type="text" value="<?php echo $val->username;?>" data-validate-hint-position="top"    data-validate-func="required"           
            data-validate-hint="Username is Required!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Email</label>
<div class="input-control text full-size">
    <input name="email" id="email" type="text" value="<?php echo $val->email; ?>" />
</div>
</div>
<div class="cell colspan2">
<label>Password:</label>
<div class="input-control password">
  <input name="password" id="password" value="<?php echo $val->password; ?>" type="text" readonly="readonly" />
</div>
</div>
 
</div>
<div class="row flex-just-sb">
<div class="cell colspan2">
     <input type="button" id="submit" value="Update" class="button success" onclick="upDateStaff()">

</div>
   </div>
   <?php }?>
</form>
</div>
</div>
</div>
</body>
</html>
 <script type="text/javascript">
function check() {
    if(document.getElementById('new_password').value === document.getElementById('confirm_password').value) {
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
<script>
function upDateStaff()
{	
	var staffid = $('#staffid').val();
	var fname = $('#fname').val();
	var username = $('#username').val();
	var phone = $('#phone').val();
	var password = $('#password').val();
	var email = $('#email').val();
	console.log(fname);
	if(fname == "") {
		$('#fname').html('Name Field cannot be empty');
		swal("Error", "Name Field cannot be empty!", "error");
	}
	else if(username == "") {
		$('#username').html('Username Field cannot be empty');
		swal("Error", "Username Field cannot be empty!", "error");
	}
	else if(phone == "") {
		$('#phone').html('Phone Field cannot be empty');
		swal("Error", "Phone Number Field cannot be empty!", "error");
	}
	else if(password == "") {
		$('#password').html('Password Field cannot be empty');
		swal("Error", "Password Field cannot be empty!", "error");
	}
	else if(email == "") {
		$('#email').html('Email Field cannot be empty');
		swal("Error", "Email Field cannot be empty!", "error");
	}
	else {
	$.post("AjaxStaff_Update",
	{
	 staffid:staffid,
	 fname:fname,
	 username:username,
	 phone:phone,
	 password:password,
	 email:email
	 
	 },
	function(data){
	//console.log(data);
	//window.alert(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("Staff Info Updated Successfully!");
	}
	});
}
}

</script>