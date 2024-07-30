<div class="limiter">
<div class="remodal" data-remodal-id="modal">
  	<button data-remodal-action="close" class="remodal-close"></button>
<label>Session: </label><input type="text" id="session">
<select id="term">
	<option value="">SELECT TERM</option>
	<option value="FIRST TERM">FIRST TERM</option>
	<option value="SECOND TERM">SECOND TERM</option>
	<option value="THIRD TERM">THIRD TERM</option>
</select>
<br /><br />
<button type="button" class="button small-button success" onclick='createTerm()'>Submit</button>

</div>
</div>


<body>
<div class="m-content">
  <div class="tabcontrol" data-role="tabcontrol">
  <ul class="tabs">
        <li><a href="#frame1">School Details</a></li>
        <li><a href="#frame2">Term | Session</a></li>
		<li><a href="#frame3">School Logo</a></li>
		<li><a href="#frame4">School Calender</a></li>
    </ul>
    <div class="frames">
<div class="frame" id="frame1">
<div class="flex-grid">
<form id="form1" name="form1" method="post" action="">
	<?php
    foreach ($schinfo->result() as $row){
    ?>
<h4 class="head_bg_2"> SCHOOL DETAILS </h4>
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<div class="row">

<div class="cell colspan5"><p>School Name:</p></div>
<div class="cell colspan7">
<h6 class="tx-red" id="schnameErr"><?php echo form_error('schname');?></h6>
		<div class="input-control text full-size">
		<input type="hidden" id="id" name="id" value="<?php echo $row->id;?>"/>
        <input id="schname" name="schname" readonly="readonly" type="text" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->name;} ?>" />
		</div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>School Motto: </p></div>
<div class="cell colspan7">
<h6 class="tx-red" id="schmottoErr"><?php echo form_error('schmotto');?></h6>
	<div class="input-control text full-size">
    <input name="schmotto" id="schmotto" type="text" readonly="readonly" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->slogan;} ?>" />
	</div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Address:</p></div>
<div class="cell colspan7">
<h6 class="tx-red" id="addressErr"><?php echo form_error('address');?></h6>
	<div class="input-control textarea full-size">
	  <textarea id="address" readonly="readonly" name="address"><?php if(empty($row)){ echo " "; }else{ echo $row->address;} ?></textarea>
  </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Postal Address: </p></div>
<div class="cell colspan7">
	<div class="input-control textarea full-size">
    <textarea id="postal" readonly="readonly" name="postal"><?php if(empty($row)){ echo " "; }else{ echo $row->postal_add;} ?></textarea>
  </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Email</p></div>
<div class="cell colspan7">
<h6 class="tx-red" id="emailErr"><?php echo form_error('email');?></h6>
		<div class="input-control text full-size">
        <input id="email" readonly="readonly" name="email" type="text" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->email;} ?>" />
    </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Website</p></div>
<div class="cell colspan7">
	  <div class="input-control text full-size">
	  <input id="website" readonly="readonly" name="website" type="text"  size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->web_add;} ?>" />
  </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Phone Number: </p></div>
<div class="cell colspan7">
<h6 class="tx-red" id="phoneErr"><?php echo form_error('phone');?></h6>
	  <div class="input-control text full-size">
	  <input id="phone" readonly="readonly" name="phone" type="text"  size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->phone;} ?>" />
    </div>
</div>
</div>

<div class="row">
<div class="cell colspan5">
       
</div>
</div>
</form>
</div>
</div>
<div class="frame" id="frame2">
<div class="flex-grid">
<form id="form2" name="form2" method="post" action="">
<h4 class="head_bg_2">TERM AND SESSION SETTING </h4>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>CURRENT SESSION: </label>
<div class="input-control full-size">
        <select name="session" class="select">
        <option>SELECT SESSION</option>
      	<option value="2010/2011">2010/2011</option>
		<option value="2011/2012">2011/2012</option>
		<option value="2012/2013">2012/2013</option>
		<option value="2013/2014">2013/2014</option>
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

<div class="cell colspan3">
<label>CURRENT TERM: </label>
<div class="input-control full-size">
    <select name="term" class="select">
        <option value="">SELECT TERM</option>
      	<option value="FIRST TERM">FIRST TERM</option>
		<option value="SECOND TERM">SECOND TERM</option>
		<option value="THIRD TERM">THIRD TERM</option>
		</select>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>RESULT INPUT TYPE:</label>
<div class="input-control full-size">
      <select name="result_type" class="select">
        <option>SELECT TYPE</option>
        <option value="CA">CA</option>
        <option value="EXAM">EXAM</option>
        <option value="BOTH">BOTH</option>
      </select>
</div>
</div>

<div class="cell colspan3">
<label>TERM FOR RESULT INPUT:</label>
<div class="input-control full-size">
<select name="input_term" class="select full-size">
        <option value="">SELECT TERM</option>
      	<option value="FIRST TERM">FIRST TERM</option>
		<option value="SECOND TERM">SECOND TERM</option>
		<option value="THIRD TERM">THIRD TERM</option>
		<option value="ALL TERMS">ALL TERMS</option>
		</select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">    
        <input type="button" name="submit" value="Save" class="button success loading-pulse lighten primary" onClick="upTermSession">
</div>
</div>
</form>
</div>
</div>

<div class="frame" id="frame3">
<div class="flex-grid">
<form action="ajaximage" id="imageform" method="post" enctype="multipart/form-data" name="school_logo" id="form3">
<h4 class="head_bg_2">SCHOOL LOGO </h4> 
<div class="row">
<div class="cell colspan5"><p>UPLOAD SCHOOL LOGO: </p></div>
<div class="cell colspan5">


   <div class="image-container bordered handing image-format-hd">
   <div class="frame">
   <img id="thumbnil" src="" alt="image" />
   <?php //echo img(array('src'=>'uploads/school_logo.png', 'width'=>300, 'heigth'=>50))?>
   </div>
	</div>
    <div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload School Logo Size: 200:180" name="photoimg" id="photoimg" size="20" accept="image/*" onChange="showMyImage(this)">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>

</div>
</div>
<div class="row">
<div class="cell colspan5">
       <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
<div id="preview">
</div>
</div>
</div>
<div class="frame" id="frame4">
<div class="flex-grid">
<form id="form4" name="form4" method="post" action="term_and_session_details">
<div class="row">
<div class="cell colspan3">
<p><b>Current Session: </b><span id='curr_session'><?php $r=$schinfo->result(); echo $r[0]->session; ?></span></p>

</div>
<div class="cell colspan3">
<p><b>Current Term: </b><span id='curr_term'><?php $r=$schinfo->result(); echo $r[0]->term; ?></span></p>

</div>
</div>
<div class="row">
<div class="cell colspan3">
<button type='button' class='button small-button success' onclick='newTerm()'>New Term</button>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan5">
<label>Number of times school opened</label>
<div class="input-control text full-size">
    <input name="number_of_times_school_opened" type="number" value="<?php echo $school_settings->school_open; ?>">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan5">
<label>School Resumption Date</label>
<div class="input-control text full-size">
    <input name="resume_date" type="date" value="<?php echo $school_settings->resumption; ?>">
    
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan5">
<label> School Closing Date</label>
<div class="input-control text full-size">
    <input name="closing_date" type="date" value="<?php echo $school_settings->close; ?>">
    
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
</div>
</div>
</body>

<?php }?>
<!--<link rel="stylesheet" href="<?php //echo base_url();?>asset/css/metro.css" />
<script src='<?php //echo base_url();?>asset/js/metro.js'></script>-->


<script>
function upSchDetails()
{
	var schname = $('#schname').val();
	var schmotto = $('#schmotto').val();
	var address = $('#address').val();
	var postal = $('#postal').val();
	var email = $('#email').val();
	var website = $('#website').val();
	var phone = $('#phone').val();
	var id = $('#id').val();
	//var schlevel = $('#schlevel').val();
	//var junsenior = $('#junsenior').val();
	console.log(id)
	if(schname == "") {
		$('#schnameErr').html('The name field is required');
		swal("Error", "The name field is required", "error");
	} else if (schmotto == "") {
		$('#schmottoErr').html('The Motto field is required');
		swal("Error", "The Motto field is required", "error");
	} else if (address == "") {
		$('#addressErr').html('The Address Field is required');
		swal("Error", "The Address field is required", "error");
	} else if (email == "") {
		$('#emailErr').html('The Email field is required');
		swal("Error", "The Email field is required", "error");
	} else if (phone == "") {
		$('phoneErr').html('The Phone Number field is required')
		swal("Error", "The Phone Number field is required", "error");
	} else {
	$.post("Ajax_school_details",
	{
		schname: schname,
		schmotto: schmotto,
		address: address,
		postal: postal,
		email: email,
		website: website,
		phone: phone,
		//schlevel: schlevel,
		//junsenior: junsenior
	},
	function(data){
	//console.log(data);
	//window.alert(data);
	swal(data);
	if(data == "SUCCESS")
	{

		swal("School Info Updated Successfully!");
	}
	});
}
}
</script>


<script>
function newTerm()
{
	var inst = $('[data-remodal-id=modal]').remodal();
	inst.open()
}

function createTerm()
{
	var session = $('#session').val();
	var term = $('#term').val();
	if(session=="")
	{
		swal("ERROR", "Session Field can not be empty", "error");
	}
	else if(term=="")
	{
		swal("ERROR", "Please select a term", "error")
	}
	else
	{
		swal({   
                title: "Procced?",   
                text: "Are you sure you want to continue?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: false
            }, function()
            {$("#spinner").css({"display":"block", "background-attachment":"fixed"})
				$.post("createNewTerm_Ajax",
		        {
		            session: session,
		            term: term
		        },
		        function(data){
		        	if(data=="SUCCESSFUL")
		        	{
		        		$("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        		swal("SUCCESS", "Term has been added", "success");
		        	}
		        	else
		        	{
		        		$("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        		swal("Error", "Term and Session already exist", "error"); 
		        	}

		        })
		        $.post("getSchoolDetails_Ajax",
		        {
		        	check: 1
		        },
		        function(data){
		        	var schinfo = JSON.parse(data)
		        	$('#curr_session').text(schinfo[0].session)
		        	$('#curr_term').text(schinfo[0].term)

		        })
			})
	}
}

function showMyImage(fileInput){
var files = fileInput.files;
for(var i=0;i<files.length;i++)
{
var file = files[i];
var imageType = /image.*/;
if(!file.type.match(imageType)){
continue;
}
var img=document.getElementById("thumbnil");
img.file = file;
var reader = new FileReader();
reader.onload=(function(almg){
return function(e){
almg.src = e.target.result;
};
})(img);
reader.readAsDataURL(file);
}
}
</script>