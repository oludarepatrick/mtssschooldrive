<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<div class="m-content">

<?php 
    foreach($query_student->result() as $row){
	
    ?>
<div class='flex-grid'>
<div class='row'>
<div class='cell colspan3'>
<img id='picture' style="width: 100%" src="<?php echo base_url().'uploads/perm_upload/student/'.$row->student_id.'.jpg'; ?>">
<input type="file" name='userfile' id="pictureinput" accept="image/*" style="display:none">
<button class='button mini-button' id="fileSelect">Choose Image</button>
<button type='button' class='button mini-button' id="" onclick="uploadImage('<?php echo $row->student_id; ?>')">Start Upload</button>
</div>
<div class='cell colspan1'>
</div>
<div class='cell colspan3'>
<p>Upload progress: </p><br />
<div id='progress' data-role="progress" class="progress" data-color='red' data-value="0" data-color="bg-red"></div><span id='uploadprogress'>0%</span>
</div>
</div>
</div>
<h4 class="head_bg_1">Student Information</h4>
<form action="" method="post" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Surname:</label>
<div class="input-control text full-size">
        <input id="surname" type="text" value="<?php echo $row->surname; ?>" data-validate-hint-position="bottom"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div>
<div class="cell colspan3">
<h6 class="tx-red"><?php //echo form_error('fname');?></h6>
<label>First Name:</label>
<div class="input-control text full-size">
        <input id="fname" type="text" value="<?php echo $row->firstname; ?>" />
		<input type="hidden" id="studentid" value="<?php echo $row->student_id; ?>" />
</div>
</div>
<div class="cell colspan3">
<h6 class="tx-red"><?php //echo form_error('fname');?></h6>
<label>Other Name:</label>
<div class="input-control text full-size">
        <input id="othername" type="text" value="<?php echo $row->othername; ?>" />
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Date of Birth:</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input id="dob" type="text" value="<?php echo $row->dob; ?>">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
<div class="cell colspan3">
<label>Gender:</label>
<div class="input-control full-size">
<select id="gender" class="select">
      <option value="<?php echo $row->sex; ?>"><?php echo $row->sex; ?></option>
      <option value="MALE">Male</option>
      <option value="FEMALE">Female</option>
</select>
</div>
</div> 
<div class="cell colspan3">
<label>House:</label>
<div class="input-control full-size">
<select id="house" class="select">
      <option value="<?php echo $row->house; ?>"><?php echo $row->house; ?></option>
      <option value="BLUE HOUSE">Blue House</option>
      <option value="GREEN HOUSE">Green House</option>
      <option value="YELLOW HOUSE">Yellow House</option>
</select>
</div>
</div> 
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Date of Admission:</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input id="date_admission" type="text" value="<?php echo $row->date_admitted; ?>">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
<div class="cell colspan3">
<label>Last School Attended:</label>
<div class="input-control text full-size">
    <input id="last_school" type="text" value="<?php echo $row->last_school;?>">
</div>
</div>
<div class="cell colspan3">
<label>Last Class:</label>
<div class="input-control text full-size">
    <input id="last_class" type="text" value="<?php echo $row->last_class;?>">
</div>
</div>
</div>
<hr />
<h4 class="head_bg_1">Personal Information</h4>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>State of Origin:</label>
<div class="input-control full-size">
<select class="select" id="state_of_origin" >
      <option value="<?php echo $row->state_of_origin; ?>"><?php echo $row->state_of_origin; ?></option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
    <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
</div>
</div>
<div class="cell colspan3">
<label>Nationality:</label>
<div class="input-control text full-size">
    <input id="nationality" type="text" value="<?php echo $row->nationality;?>" />
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Religion:</label>
<div class="input-control text full-size">
    <select class="select" id="religion">
    <option value="<?php echo $row->religion;?>"><?php echo $row->religion;?></option>
    <option value="CHRISTIANITY">CHRISTIANITY</option>
    <option value="MUSLIM">MUSLIM</option>
    <option value="OTHERS">OTHERS</option>
    </select>
</div>
</div>
<div class="cell colspan3">
<label>Blood Group:</label>
<div class="input-control full-size">
   <select class="select" id="blood_group">
      <option value="<?php echo $row->blood_grp; ?>"><?php echo $row->blood_grp; ?></option>
      <option value="O+"<?php  echo set_select('blool_group');?>>O+</option>
      <option value="A"<?php  echo set_select('blood_group','A'); ?>>A</option>
      <option value="B"<?php  echo set_select('blood_group','B'); ?>>B</option>
      <option value="O-"<?php  echo set_select('blood_group','O-'); ?>>-O</option>
    </select>
</div>
</div>
<div class="cell colspan3">
<label>Genotype:</label>
<div class="input-control full-size">
<select class="select" id="genotype">
          <option value="<?php echo $row->genotype; ?>"><?php echo $row->genotype; ?></option>
      <option value="AS"<?php  echo set_select('genotype','AS'); ?>>AS</option>
          <option value="AA"<?php  echo set_select('genotype','AA'); ?>>AA</option>
          <option value="AC"<?php  echo set_select('genotype','AC'); ?>>AC</option>
          <option value="SC" <?php  echo set_select('genotype','SC'); ?>>SC</option>
          <option value="SS"<?php  echo set_select('genotype','SS'); ?>>SS</option>
          </select>
</div>
</div>
</div>
<hr />
<h4 class="head_bg_1">Parent | Guardian Information</h4>

<div class="row flex-just-sb">
<div class="cell colspan5">
<label>Name:</label>
<div class="input-control text full-size">

<input type="text" id="parent_name" value="<?php echo $row->parent_name; ?>">
</div>
</div>
<div class="cell colspan3">
<label>Mobile Number:</label>
<div class="input-control text full-size">
<input type="text" id="phone" value="<?php echo $row->phone; ?>">
</div>
</div>
<div class="cell colspan3">
<label>Email:</label>
<div class="input-control text full-size">

<input type="text" id="email" value="<?php echo $row->email; ?>">

</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan12">
<label>Address:</label>
<div class="input-control text full-size">
<input type="text" id="address" value="<?php echo $row->address; ?>">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>City:</label>
<div class="input-control text full-size">
<input type="text" id="city" value="<?php echo $row->city; ?>">
</div>
</div>
<div class="cell colspan3">
<label>State of Residence:</label>
<div class="input-control full-size">
<select class="select" id="state">
      <option value="<?php echo $row->state; ?>"><?php echo $row->state; ?></option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
    <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
</div>
</div>
<div class="cell colspan3">
<label>Occupation:</label>
<div class="input-control text full-size">
<input type="text" id="occupation" value="<?php echo $row->occupation; ?>">
</div>
</div>
</div>
<div class="input-control text">
<input type="button" id="submit" value="Update" onclick="upStudentDetails()" class="button success loading-pulse lighten primary">
</div>
</div>
</div>

</div>


<?php }?>
</form>
</div>
</body>
</html>

<script>

function upStudentDetails()
{
	var studentid = $('#studentid').val();
	var surname = $('#surname').val();
	var fname = $('#fname').val();
	var othername = $('#othername').val();
	var dob = $('#dob').val();
	var gender = $('#gender').val();
	var house = $('#house').val();
	var date_admission = $('#date_admission').val();
	var last_school = $('#last_school').val();
	var last_class = $('#last_class').val();
	var state_of_origin = $('#state_of_origin').val();
	var nationality = $('#nationality').val();
	var religion = $('#religion').val();
	var blood_group = $('#blood_group').val();
	var genotype = $('#genotype').val();
	var parent_name = $('#parent_name').val();

	var occupation = $('#occupation').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var phone = $('#phone').val();
	var email = $('#email').val();
	var state = $('#state').val();
	
	
	console.log(surname);
	if(surname == "") {
		$('#fname_error').html('Surname field cannot be empty');
		swal("Error", "Surame field cannot be empty!", "error");
	} else if (fname == "") {
		$('#phone_error').html('The First Name No field is required');
		swal("Error", "Type Your First Name", "error");
	} else if (dob == "") {
		$('#cat_error').html('Select Date of Birth');
		swal("Error", "Date of Birth is Required", "error");
	} else if (gender == "") {
		$('#cat_error').html('Student Gender Is Required');
		swal("Error", "Select Gender", "error");
	} else if (house == "") {
		$('#cat_error').html('Select House e.g Blue, Red');
		swal("Error", "Select House", "error");
	} else if (state_of_origin == "") {
		$('#cat_error').html('Select State.');
		swal("Error", "Select State of Origin", "error");
	} else if (nationality == "") {
		$('#cat_error').html('Type Your Country');
		swal("Error", "Type Your Country", "error");
	} else if (religion == "") {
		$('#cat_error').html('Religion is Required');
		swal("Error", "Religion field is Required", "error");
	} else if (email == "") {
		$('#email_error').html('The Email field is required');
		swal("Error", "Type The New Email", "error");
	} else if (phone == "") {
		$('#class_error').html('Enter Phone Number');
		swal("Error", "Phone Number field is Required", "error");
	} else if (occupation == "") {
		$('#class_error').html('Fill in Parent Occupation');
		swal("Error", "Parent Occupation field is Required", "error");
	} else if (address == "") {
		$('#class_error').html('Address is Required');
		swal("Error", "Fill in Your Residential Address", "error");
	} else if (parent_name == "") {
		$('#arm_error').html('Parent name is required');
		swal("Error", "You Must Fill in The Parent Guardian Name", "error");
	} else {
	$.post("ajax_update_student_details",
	{
	studentid:studentid,
	surname:surname,
	fname:fname,
	othername:othername,
	dob:dob,
	gender:gender,
	house:house,
	date_admission:date_admission,
	last_school:last_school,
	last_class:last_class,
	state_of_origin:state_of_origin,
	nationality:nationality,
	religion:religion,
	blood_group:blood_group,
	genotype:genotype,
	parent_name:parent_name,
	occupation:occupation,
	address:address,
	city:city,
	phone:phone,
	email:email,
	state:state
	
	},
	function(data){
	//console.log(data);
	//window.alert(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("Student's Info Successfully Updated!");
	}
	});
}
}
</script>

<script type="text/JavaScript">
var fileSelect = document.getElementById("fileSelect"),
  fileElem = document.getElementById("pictureinput");

fileSelect.addEventListener("click", function (e) {
  if (fileElem) {
    fileElem.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picture').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#pictureinput").change(function(){
    readURL(this);
});


function uploadImage(id)
{  
    var formData = new FormData();
    var input = document.querySelector('input[type="file"]');
    file = input.files[0];
    formData.append("userfile", file);
    formData.append("student_id", id);
    progressBar = $('#progress')
    var xhr, provider;

    xhr = jQuery.ajaxSettings.xhr();
    if (xhr.upload) {
        xhr.upload.addEventListener('progress', function (e) {
            var pc = parseInt(100 - (e.loaded / e.total * 100));
            var pc1 = pc;
            if(pc1>pc2)
            {
              console.log(pc)
              progressBar.attr('data-value', pc)
              $('#progress .bar').css('width', pc+'%')
              $('#uploadprogress').text(pc+'%')
              var pc2 = pc1;
            }
            else{
              progressBar.attr('data-value', 100)
              $('#progress .bar').css('width', 100+'%')
              $('#uploadprogress').text(100+'%')
              pc2 = 0;
              return;
            }
        }, false);
    }   
    provider = function () {
        return xhr;
    };  
    $.ajax({
      xhr: provider,
      contentType: false,
      processData: false,
    beforeSend: function(xhr) {
            progressBar.attr('data-value', 1)
            $('#progress .bar').css('width', '1'+'%')

        },
    url: 'uploadStudentImage_Ajax',
    data: formData,
    type: 'POST',
    // THIS MUST BE DONE FOR FILE UPLOADING
    
    success: function(data)
    {
      if(data=="UPLOAD SUCCESSFUL")
      {
        swal('SUCCESS', data, 'success')
      }
      else
      {
        swal('ERROR', data, 'error')
      }
    }
    // ... Other options like success and etc
})
}

</script>