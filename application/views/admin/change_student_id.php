<html>
<body>
<div class="m-content">
<?php 
	  
 foreach($query_student->result() as $row){
	  
	  ?>
<div class="panel">
<div class="heading">
        <span class="mif-user icon"></span>
        <span class="title">CHANGE STUDENT ID</span>
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
<label>Old Student Id</label>
<div class="input-control text full-size">
        <input type="text" name="old_id" id="old_id" readonly="readonly" value="<?php echo $row->student_id; ?>" />
      </div>
	  </div>
	  </div>
	  <div class="row flex-just-sb">
<div class="cell colspan4">
<label>New Student Id</label>
<h6 class="tx-red" id="oldclassarm_error"></h6>
<div class="input-control text full-size">
 <input type="text" name="new_id" id="new_id" /></div>
</div>

			</div>
			<input type="button" id="submit" value="Update" class="button success" onClick="upSchDetails()">
           
       	 
		</div>
		</div>
		 <?php } ?>
</form>
</body>
</html>
<script>
function upSchDetails()
{
	var old_id = $('#old_id').val();
	var new_id = $('#new_id').val();
	
	console.log(new_id);
	if(old_id == "") {
		$('#oldid_error').html('The old Id field is required');
		swal("Error", "The Old Student Id field is required", "error");
	} else if (new_id == "") {
		$('#newid_error').html('The new Id field is required');
		swal("Error", "Type The New Id", "error");
	} else {
	$.post("ajax_change_student_id",
	{
		
		old_id: old_id,
		new_id: new_id
	},
	function(data){
	//console.log(data);
	//window.alert(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("Student Id Successfully Updated!");
	}
	});
}
}
</script>