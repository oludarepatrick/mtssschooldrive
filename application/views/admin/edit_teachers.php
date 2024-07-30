<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">Edit Teacher Info <h6 class="tx-red" align="right">Required*</h6></span>
    </div>
	<div class="content">
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>First Name*</label>
<h6 class="tx-red" id="fname_error"></h6>
<div class="input-control full-size">
<?php 
    //foreach($query_teachers->result() as $row){?>
<input type="text" id="fname" value="<?php foreach($query_teachers->result() as $row){echo $row->name;} ?>"  >
<input type="hidden" id="staffid" value="<?php foreach($query_teachers->result() as $row){ echo $row->staff_id;}  ?>">
</div>
</div>
<div class="cell colspan4">
<label>Phone*</label>
<h6 class="tx-red" id="phone_error"></h6>
<div class="input-control full-size">
<input type="text" id="phone"  value="<?php foreach($query_teachers->result() as $row){ echo $row->phone;}?>">
          
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>Email*</label>
<h6 class="tx-red" id="email_error"></h6>
<div class="input-control full-size">
<input type="text" id="email"  value="<?php foreach($query_teachers->result() as $row){ echo $row->email; }?>">
            
</div>
</div>

<div class="cell colspan4">
<label>Staff Category*</label>
<h6 class="tx-red" id="cat_error"></h6>
  <div class="input-control full-size">
      <select id="category" class="select">
        <option value="">SELECT CATEGORY</option>
        <option value="CLASS TEACHER">CLASS TEACHER</option>
        <option value="SUBJECT TEACHER">SUBJECT TEACHER</option>
        <option value="PRINCIPAL">PRINCIPAL | HM</option>
        <option value="CLASS | SUBJECT TEACHER">CLASS | SUBJECT TEACHER</option>
        
      </select>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>Class*</label>
<h6 class="tx-red" id="class_error"></h6>
<div class="input-control  full-size ">
	  <select id="classes" class="select">
	  <option value="<?php foreach($query_teachers->result() as $row){ echo $row->class;?>"><?php echo $row->class; }?></option>
	   <?php  foreach($query_class->result() as $val){?>
	  <option value="<?php echo $val->id; echo $val->class;?>"><?php echo $val->class;?></option>
	   <?php } ?>
	  </select>
	  
</div>
</div>

<div class="cell colspan4">
<label>Class Arm*</label>
<h6 class="tx-red" id="arm_error"></h6>
<div class="input-control full-size ">
	  <select id="class_arm" class="select">
	  <option value="<?php foreach($query_teachers->result() as $row){ echo $row->class_arm;?>"><?php echo $row->class_arm; }?></option>
	   <?php  foreach($query_division->result() as $val){?>
	  <option value="<?php echo $val->id; echo $val->division;?>"><?php echo $val->division;?></option>
	  
	   <?php } ?>
	  </select>
	   
</div>
</div>
</div>
<div class="row flex-just-sb" align="center ">
<div class="cell colspan12">
<input type="button" id="submit" value="Update" class="button success" onclick="upTeacherDetails()">
</div>
</div>
</body>
</html>

<script>

function upTeacherDetails()
{
	var staffid = $('#staffid').val();
	var fname = $('#fname').val();
	var phone = $('#phone').val();
	var email = $('#email').val();
	var category = $('#category').val();
	var classes = $('#classes').val();
	var class_arm = $('#class_arm').val();
	
	console.log(fname);
	if(fname == "") {
		$('#fname_error').html('First Name field cannot be empty');
		swal("Error", "First Name field cannot be empty!", "error");
	} else if (phone == "") {
		$('#phone_error').html('The Phone No field is required');
		swal("Error", "Type The New Phone No", "error");
	} else if (email == "") {
		$('#email_error').html('The Email field is required');
		swal("Error", "Type The New Email", "error");
	} else if (category == "") {
		$('#cat_error').html('Select Category');
		swal("Error", "Select Teacher's Category", "error");
	} else if (classes == "") {
		$('#class_error').html('Select Category');
		swal("Error", "Select Teacher's Category", "error");
	} else if (class_arm == "") {
		$('#arm_error').html('Select Class Arm');
		swal("Error", "Select Class Arm", "error");
	} else {
	$.post("ajax_change_staff_details",
	{
	 staffid:staffid,	
     fname:fname,
	 phone:phone,
	 email:email,
	 category:category,
	 classes:classes,
	 class_arm:class_arm
	},
	function(data){
	//console.log(data);
	//window.alert(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("Teacher's Info Successfully Updated!");
	}
	});
}
}
</script>