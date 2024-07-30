<html>
<body>
<div class="m-content">
<?php 
	  
 foreach($query_student->result() as $row){
	  
	  ?>
<div class="panel">
<div class="heading">
        <span class="mif-user icon"></span>
        <span class="title">CHANGE STUDENT CLASS/CLASS-ARM</span>
    </div>
  <div class="content">
<form id="form2" action="" method="post">
		<div class="flex-grid">
        <div class="panel_bg_2">
		
   <div class="row flex-just-sb">
<div class="cell colspan4">
<label>Student Name</label>
<div class="input-control text full-size">
        <input type="text" name="studentname" readonly="readonly" value="<?php echo $row->surname; echo " "; echo $row->firstname; echo " "; echo $row->othername; ?>" />
		</div>
		</div>
		<div class="cell colspan4">
<label>Student Id</label>
<div class="input-control text full-size">
        <input type="text" name="student_id" id="student_id" readonly="readonly" value="<?php echo $row->student_id; ?>" />
      </div>
	  </div>
	  </div>
	  <div class="row flex-just-sb">
<div class="cell colspan4">
<label>Old Class Arm</label>
<h6 class="tx-red" id="oldclassarm_error"></h6>
<div class="input-control text full-size">
<input type="text" readonly="reaonly" name="oldclass_arm" id="oldclass_arm" value="<?php echo $row->class_division; ?>" />
</div>
</div>

<div class="cell colspan4">
<label>New Class Arm</label>
<h6 class="tx-red" id="newclassarm_error"></h6>
<div class="input-control full-size">
  <select name="newclass_arm" id="newclass_arm" class="select">
    <option value=""<?php echo set_select('newclass_arm', '', TRUE); ?>>--SELECT--</option>
  	<?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
    <option value="<?php echo $val->division;?>" ><?php echo $val->division;?>   		  </option>
 <?php } ?>
  </select>
</div>
		</div>
		</div>
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>Old Class</label>
<h6 class="tx-red" id="oldclass_error"></h6>
<div class="input-control text full-size">
        <input type="text" name="oldclass" id="oldclass" readonly="readonly" value="<?php echo $row->class; ?>" />
		</div>
		</div>

<div class="cell colspan4">
<label>New Class</label>
<h6 class="tx-red" id="newclass_error"></h6>
<div class="input-control full-size">
  <select name="newclass" id="newclass" class="select">
    <option value=""<?php echo set_select('newclass', '', TRUE); ?>>--SELECT--</option>
  	<?php $i=0;  foreach($query_class->result() as $val){ $i+=1;?>
    <option value="<?php echo $val->class;?>" ><?php echo $val->class;?>   		  </option>
 <?php } ?>
  </select>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>Old Session: </label>
<div class="input-control full-size ">
       <input type="text" name="old_session" id="old_session" readonly="readonly" value="<?php echo $row->session; ?>" />
        
</div>
</div>
	<div class="cell colspan4">
<label>Current Session: </label>
<div class="input-control full-size ">
        <select id="new_session" class="select">
        <option value="">SELECT SESSION</option>
      	<option value="2014/2015">2014/2015</option>
		<option value="2015/2016">2015/2016</option>
		<option value="2016/2017">2016/2017</option>
		<option value="2017/2018">2017/2018</option>
		<option value="2018/2019">2018/2019</option>
		<option value="2019/2020">2019/2020</option>
		<option value="2020/2021">2020/2021</option>
		<option value="2021/2022">2021/2022</option>
		<option value="2022/2023">2022/2023</option>
		<option value="2023/2024">2023/2024</option>
		<option value="2024/2025">2024/2025</option>		
      </select>
</div>
</div>
</div>		
			<input type="button" id="submit" value="Update" class="button success" onClick="upClassDetails()">
           
       	 
		</div>
		</div>
		 <?php } ?>
</form>
</body>
</html>

<script>
function upClassDetails()
{
	var student_id = $('#student_id').val();
	var oldclass_arm = $('#oldclass_arm').val();
	var newclass_arm = $('#newclass_arm').val();
	var oldclass = $('#oldclass').val();
	var newclass = $('#newclass').val();
	var old_session = $('#old_session').val();
	var new_session = $('#new_session').val();
	
	console.log(student_id);
	if(oldclass_arm == "") {
		$('#oldclassarm_error').html('The old class field is required');
		swal("Error", "The Old Class Arm field is required", "error");
	} else if (newclass_arm == "") {
		$('#newclassarm_error').html('The new class arm field is required');
		swal("Error", "Type The New Class Arm", "error");
	} else if (oldclass == "") {
		$('#oldclass_error').html('The old class field is required');
		swal("Error", "Type The Old Class", "error");
	} else if (newclass == "") {
		$('#newclass_error').html('The new class field is required');
		swal("Error", "Type The New Class", "error");
	} else if (old_session== "") {
		$('#old_session_error').html('The old session field is required');
		swal("Error", "Old Session is Required", "error");
	} else if (new_session == "") {
		$('#newsession_error').html('The new session field is required');
		swal("Error", "Select The New Session", "error");
	} else {
	$.post("ajax_change_student_class",
	{
		student_id:student_id,
		oldclass_arm:oldclass_arm,
		newclass_arm:newclass_arm,
		oldclass:oldclass,
		newclass:newclass,
		old_session:old_session,
		new_session:new_session
		
	},
	function(data){
	//console.log(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("Class and Class Arm Successfully Updated!");
	}
	});
}
}

</script>
