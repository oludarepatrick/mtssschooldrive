<meta name="viewport" content="width=device-width, initial-scale=0.1">
<style type="text/css">
	.panel .content p {
		color: #AE1818;
	}

    .content {
        padding: 5%;
    }



#overlay {
  position: fixed;
  display: none;
  border:2px solid black;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(1,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
.overlay .closebtn {
        position: absolute;
        top: 10px;
        border:1px solid black;
        right: 45px;
        width: 50%;
        height: 50%;
        background: red;
        font-size: 150px;}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 16px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
<div class="m-content">
<div id="overlay" onclick="off()">
  <div id="text">
      <a href="javascript:void(0)" class="closebtn" onclick="off()">&times;</a>
      <h3>WELCOME TO MOUNTAIN-TOP SECONDARY SCHOOL PORTAL.</h3>
      <p>Kindly ensure to read this instruction carefully before proceeding.</p>
  <p>FOR THOSE IN JSS 3 AND SSS 3, PLEASE CLICK ON VIEW MOCK RESULT TO CHECK YOUR RESULT.</p>
  <p>IF YOU ARE IN JSS 1, JSS 2, SSS 1 & SSS 2, CLICK ON VIEW RESULT TO CHECK YOUR RESULT.</p>
 
  <p>Feel free to contact us ON WHATSAPP 09014562186 if you have any issue.</p>
  <p>We are proud of your success/accomplishment so far and the MOUNTAIN-TOP SCHOOLS CELEBRATE YOU!!!.</p>
  <p>CLICK ON THIS INSTRUCTION OR CLOSE BUTTON TO CLOSE ME.</p>

  </div>
  
</div>
<div class="flex-grid">
<div class="row">
<table class="table striped border">
<tr>
    <?php 
        //$strImg = ltrim($student[0]->image_url, '/');
        $imageURL=base_url()."uploads/perm_upload/student/".$student[0]->student_id.".jpg";
        $pathNm=@getimagesize($imageURL);
		
		$noImg=0;	
		if(!empty($pathNm) and !empty($student[0]->dob) and !empty($student[0]->parent_name) and !empty($student[0]->email) and !empty($student[0]->phone) and !empty($student[0]->state_of_origin1))
		{
		   $noImg=1; 
		
		
    ?>
<td colspan="2"><img src="<?php echo $imageURL; ?>" style="width:200px; height:150px"></td>
</tr>
<tr>
<td>NAME: </td>
<td><?php echo $student[0]->surname." ".$student[0]->firstname." ".$student[0]->othername; ?></td>
</tr>
<tr>
<td>ADMISSION NUMBER: </td>
<td><?php echo $student[0]->student_id; ?></td>
</tr>
<tr>
<td>CLASS: </td>
<td><?php echo $student[0]->class." ".$student[0]->class_division; ?></td>
</tr>
<tr>
<td>GENDER: </td>
<td><?php echo $student[0]->sex; ?></td>
</tr>
<tr>
<td>STATE OF ORIGIN: </td>
<td><?php echo $student[0]->state_of_origin; ?></td>
</tr>
<tr>
<td>NATIONALITY: </td>
<td><?php echo $student[0]->nationality; ?>Nigeria</td>
</tr>
<tr>
<td>DATE OF BIRTH: </td>
<td><?php echo $student[0]->dob; ?></td>
</tr>
<tr>
<td>HOUSE: </td>
<td><?php echo $student[0]->house; ?></td>
</tr>
<?php }else{ //var_dump($student[0]); ?>
    
    
    <tr><td style="width:70%">
    <form method="post" action="update_email">
    <table style="width:100%">    
    <tr>
        <td style='width:40%'>Email: </td>
        <td><input type="email" class="input-control" required="required" value="<?php echo $student[0]->email; ?>" name="email"></td>
    </tr>
    <tr>
        <td>Phone Number: </td>
        <td><input type="number" class="input-control" required="required" value="<?php echo $student[0]->phone; ?>" name="phone_number"></td>
    </tr>
    <tr>
        <td>Date of birth:</td>
        <td>
            <div class="input-control text" data-role="datepicker" data-format="dd/mm/yyyy">
            
              
            <input type="text" required="required" name="dob" value="<?php echo $student[0]->dob; ?>">
            <button class="button"><span class="mif-calendar"></span></button>
        </td>
    </tr>
  
    
    <tr>
        <td>Parent Full Name: </td>
        <td><input type="text" class="input-control" required="required" name="parent_name" value="<?php echo $student[0]->parent_name; ?>"></td>
    </tr>
    
    <tr>
        <td>State of Origin:</td>
        <td>
            <select class="select-control" id="state" name="state">
                  <option value="<?php echo $student[0]->state_of_origin; ?>"><?php echo $student[0]->state_of_origin; ?></option>
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
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Update Changes" class="input-control button success loading-pulse lighten primary"/>
        </td>
    </tr>
    
    </table>
    </form>
     </td>
     <td valign="top">
         
         
	  <div class="panel-heading">Student's Passport</div>
	  <div class='flex-grid'>
        	<div class='row'>
        		<div class='cell colspan7'>
        			<img id='picture' style="width:150px; height:150px" src="<?php echo $imageURL; ?>"><br/>
        			<input type="file" name='userfile' id="pictureinput" accept="image/*" style="display:none">
        			<button class='button mini-button info' id="fileSelect">Choose Image</button>
        			<button type='button' class='button success mini-button' id="" onclick="uploadImage('<?php echo $student[0]->student_id; ?>')">Start Upload</button>
        			
        			<p>Upload progress: </p>
        			<div id='progress' data-role="progress" class="progress" data-color='red' data-value="0" data-color="bg-red"></div><span id='uploadprogress'>0%</span>
        		</div>
        		
        		
        	</div>
        </div>
     

     </td>
     </tr>
     
    
   
<?php } ?>
</table>
</div>
<?php
	//if($show_update)
	if(empty($student[0]->dob))
	{
?>
<!--
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <h1>UPDATE EMAIL AND DATE OF BIRTH</h1>
  <form method="post" action="update_email">
  <div>
      <div class="input-control text">
  <label>Email: </label>
  <input type="email" required="required" name="email">
      </div>
      <div class="input-control text">
  <label>Phone Number: </label>
  <input type="number" required="required" name="phone_number">
      </div>
      <div class="input-control text" data-role="datepicker" data-format="dd/mm/yyyy">
  <label>Date of birth: </label>
  
    <input type="text" required="required" name="dob">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
<br>
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <button type="submit" class="remodal-confirm">OK</button>
</form>
  
</div>-->

<?php } ?>
<script>
$(function() {
    console.log( "ready!" );
    var inst = $('[data-remodal-id=modal]').remodal();
    inst.open();
});

document.addEventListener('DOMContentLoaded', on());
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
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
            
            
            //$('#picture').setAttribute('style', 'width:50px;');
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
