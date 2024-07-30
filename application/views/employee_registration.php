<style>
.ui-datepicker {
	font-size:90.5%;
}
#dialog{  font-size: 60%;}
#reqerror{color:#FF0000;}
legend{ font-size:16px; color:#09F;}
.bgrd{ border:1px solid #C9C9C9;background-color: #F1F1F1;}
.imgdiv{
	border:1px solid #E3E3E3;
	background-color: #F4F4F4;
	width:220px;
	padding:3px;
	float:right;
	position:relative;
	right:5px;
	top:4px;
	text-align:center ;
}
	.progress { position:relative; width:100%; border: 1px solid #ddd; padding:0px; border-radius: 3px; left:0px; top:0px ; margin-bottom:5px;  height:30px}
	.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
	.percent { position:absolute; display:inline-block; top:3px; left:48%; }
#conta{
	display:block;
	width:100%;
	
}

#tab_form{
	float:left;
	margin-top:-10px;
	
	}
fieldset{background-color: #F8F8F8}

</style>





<!--mainbody-->

 <div id="border_1j" class="bgrdu">
  <?php echo $message; ?>    
       

    
  
  
  
           
    <?php 
	 
	 	$css = array('id'=> 'form');
	 	echo form_open_multipart('receipt/employee_registration', $css);
		$star = array( 'src'=> 'asset/images/star.gif');
		$alert = array('src' => 'asset/image/alert.png','height'=>'50', 'width'=>'50' );
		  
		  
	 
	 ?>      
 
 <fieldset >
   <legend>Employee Data </legend>
 <table width="70%" align="center"  cellspacing="2" cellpadding="2">
 <tr>
  <td colspan="5" ><div class="req" align="right">REQUIRED<label id="reqerror">*</label>&nbsp;&nbsp;<?php //echo img($star);?></div></td>
  </tr>
  
  
    <tr>
    <td>Surname<label id="reqerror">*<?php echo form_error('lastname');?></label></td>
    <td>&nbsp;</td>
    <td>First Name<label id="reqerror">*<?php echo form_error('firstname');?></label></td>
    <td>&nbsp;</td>
    <td>Middle Name</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="star"><input type="text" name="lastname"  class="input3" value="<?php  echo set_value('lastname');?>"/>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="star"><input type="text" name="firstname"   class="input3" value="<?php  echo set_value('firstname');?>"/>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="star"><input type="text" name="midname"  class="input3"  value="<?php  echo set_value('midname');?>"/>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    
      
    <tr>
    <td>Department<label id="reqerror">*<?php echo form_error('department');?></label></td>
    <td>&nbsp;</td>
    <td>Sex<label id="reqerror">*<?php echo form_error('sex');?></label></td>
    <td>&nbsp;</td>
    <td>Date of Employment<label id="reqerror">*<?php echo  form_error('date_admitted');?></label></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td class="star">
    <select name="department"  class="star">
     		<option value=""<?php echo set_select('department', '', TRUE); ?>>--SELECT--</option>
   			<option value="Account"<?php  echo set_select('department','Account') ?>>Account</option>
			<option value="Marketing"<?php  echo set_select('department','Marketing') ?>>Marketing</option>
			<option value="Human Resources"<?php  echo set_select('department','Human Resources') ?>>Human Resources</option>
			<option value="Transport"<?php  echo set_select('department','Transport') ?>>Transport</option>
			<option value="Engineering"<?php  echo set_select('department','Engineering') ?>>Engineering</option>
			<option value="Admin"<?php  echo set_select('department','Admin') ?>>Admin</option>
			<option value="Production"<?php  echo set_select('department','Production') ?>>Production</option>
			<option value="Security"<?php  echo set_select('department','Security') ?>>Security</option>
    	</select>&nbsp;    </td>
    <td>&nbsp;</td>
    <td class="star"><select name="sex" id="textfield" class="">
    				<option value=""<?php  echo set_select('sex', '', TRUE); ?>>--SELECT--</option>
    				<option value="Male"<?php  echo set_select('sex','Male') ?>>Male</option>
                    <option value="Female"<?php  echo set_select('sex','Female') ?>>Female</option>
                    </select>&nbsp;     </td>
    
    <td>&nbsp;</td>										
    <td class="star"><input type="text" name="date_admitted" class="input3" id="datepicker2" placeholder="dd/mm/yyyy"  value="<?php echo set_value('date_admitted');?>"  /></td>
    <td>&nbsp;</td>
  </tr>  
<tr>
    <td>Date of Birth<label id="reqerror">*<?php echo  form_error('dob');?></label></td>
    <td>&nbsp;</td>
    <td>State of Origin<label id="reqerror">*<?php echo form_error('state');?></label></td>
    <td>&nbsp;</td>
    <td>Nationality<label id="reqerror">*<?php echo form_error('nationality');?></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="star"><input type="text" name="dob" id="datepicker" class="input3" value="<?php echo set_value('dob');?>"  /></td>
    <td>&nbsp;</td>
    <td class="star"><select name="state" class="star" >
      <option value=""<?php echo set_select('state', '', TRUE); ?>>--SELECT--</option>
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
</select>&nbsp;</td>
    <td>&nbsp;</td>

    <td class="star"><input type="text" class="input3" name="nationality" value="<?php  echo set_value('nationality');?>"/>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    
   <tr>
     <td>Address <label id="reqerror">*<?php echo form_error('address');?></label></td>
     <td>&nbsp;</td>
     <td>City <label id="reqerror">*<?php echo form_error('city');?></label></td>
     <td>&nbsp;</td>
     <td>State <label id="reqerror">*<?php echo form_error('state1');?></label></td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td class="star"><label>
       <textarea name="address" id="address" cols="20" rows="2"><?php  echo set_value('address');?>
 </textarea>
       </label>
       &nbsp;</td>
     <td>&nbsp;</td>
     <td  valign="top" class="star"><input type="text" name="city" class="input3" value="<?php  echo set_value('city');?>"/>
       &nbsp;</td>
     <td>&nbsp;</td>
     <td valign="top" class="star"><select name="state1" class="" >
         <option value=""<?php echo set_select('state1', '', TRUE); ?>>--SELECT--</option>
         <option value="Abia"<?php  echo set_select('state1', 'Abia'); ?>>Abia</option>
         <option  value="Abuja"<?php  echo set_select('state1', 'Abuja'); ?>>Abuja</option>
         <option  value="Adamawa"<?php  echo set_select('state1', 'Adamawa'); ?>>Adamawa</option>
         <option value="AkwaIbom"<?php  echo set_select('state1', 'AkwaIbom'); ?>>AkwaIbom</option>
         <option  value="Anambra"<?php  echo set_select('state1', 'Anambra'); ?>>Anambra</option>
         <option  value="Bauchi"<?php  echo set_select('state1', 'Bauchi'); ?>>Bauchi</option>
         <option  value="Bayelsa"<?php  echo set_select('state1', 'Bayelsa'); ?>>Bayelsa</option>
         <option  value="Benue"<?php  echo set_select('state1', 'Benue'); ?>>Benue</option>
         <option  value="Borno"<?php  echo set_select('state1', 'Borno'); ?>>Borno</option>
         <option  value="CrossRiver"<?php  echo set_select('state1', 'CrossRiver'); ?>>CrossRiver</option>
         <option  value="Delta"<?php  echo set_select('state1', 'Delta'); ?>>Delta</option>
         <option  value="Ebonyi"<?php  echo set_select('state1', 'Ebonyi'); ?>>Ebonyi</option>
         <option  value="Edo"<?php   echo set_select('state1', 'Edo'); ?>>Edo</option>
         <option  value="Ekiti"<?php  echo set_select('state1', 'Ekiti'); ?>>Ekiti</option>
         <option  value="Enugu"<?php  echo set_select('state1', 'Enugu'); ?>>Enugu</option>
         <option  value="Gombe"<?php  echo set_select('state1', 'Gombe'); ?>>Gombe</option>
         <option  value="Imo"<?php  echo set_select('state1', 'Imo'); ?>>Imo</option>
         <option  value="Jigawa"<?php  echo set_select('state1', 'Jigawa'); ?>>Jigawa</option>
         <option  value="Kaduna"<?php  echo set_select('state1', 'Kaduna'); ?>>Kaduna</option>
         <option  value="Kano"<?php  echo set_select('state1', 'Kano'); ?>>Kano</option>
         <option  value="Katsina"<?php  echo set_select('state1', 'Katsina'); ?>>Katsina</option>
         <option  value="Kebbi"<?php  echo set_select('state1', 'Kebbi'); ?>>Kebbi</option>
         <option  value="Kogi"<?php  echo set_select('state1', 'Kogi'); ?>>Kogi</option>
         <option  value="Kwara"<?php  echo set_select('state1', 'Kwara'); ?>>Kwara</option>
         <option  value="Lagos"<?php  echo set_select('state1', 'Lagos'); ?>>Lagos</option>
         <option  value="Nassarawa"<?php  echo set_select('state1', 'Nassarawa'); ?>>Nassarawa</option>
         <option  value="Niger"<?php  echo set_select('state1', 'Niger'); ?>>Niger</option>
         <option  value="Ogun"<?php  echo set_select('state1', 'Ogun'); ?>>Ogun</option>
         <option  value="Ondo"<?php  echo set_select('state1', 'Ondo'); ?>>Ondo</option>
         <option  value="Osun"<?php   echo set_select('state1', 'Osun'); ?>>Osun</option>
         <option  value="Oyo"<?php  echo set_select('state1', 'Oyo'); ?>>Oyo</option>
         <option  value="Plateau"<?php   echo set_select('state1', 'Plateau'); ?>>Plateau</option>
         <option  value="Rivers"<?php  echo set_select('state1', 'Rivers'); ?>>Rivers</option>
         <option  value="Sokoto"<?php  echo set_select('state1', 'Sokoto'); ?>>Sokoto</option>
         <option  value="Taraba"<?php  echo set_select('state1', 'Taraba'); ?>>Taraba</option>
         <option  value="Yobe"<?php  echo set_select('state1', 'Yobe'); ?>>Yobe</option>
         <option  value="Zamfara"<?php  echo set_select('state1', 'Zamfara'); ?>>Zamfara</option>
       </select>
       &nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td>Email<label id="reqerror">*<?php echo form_error('email');?></label></td>
     <td>&nbsp;</td>
     <td>Telephone No<label id="reqerror">*<?php echo form_error('phone');?></label></td>
     <td>&nbsp;</td>
     <td>Position<label id="reqerror">*<?php echo form_error('position');?></label></td>
   </tr>
   <tr>
     <td  valign="top" class="star"><input name="email" class="input3" value="<?php  echo set_value('email')?>" />
       &nbsp; </td>
     <td>&nbsp;</td>
     <td valign="top" class="star"><input name="phone" class="input3" value="<?php  echo set_value('phone')?>" />
       &nbsp; </td>
     <td>&nbsp;</td>
     <td><input name="position" class="input3" value="<?php  echo set_value('position')?>" />
       &nbsp;</td>
   </tr>
   <tr>
   
     <td>Bank Name<label id="reqerror">*<?php //echo form_error('bankname');?></label></td>
   <td>&nbsp;</td>
     <td>Account No<label id="reqerror">*<?php //echo form_error('position');?></label></td>
	 <td>&nbsp;</td>
   </tr>
   <tr>
   <td  valign="top" class="star"><input name="bankname" class="input3" value="<?php  //echo set_value('email')?>" />
       &nbsp; </td>
     <td>&nbsp;</td>
     <td valign="top" class="star"><input name="accountno" class="input3" value="<?php  //echo set_value('phone')?>" />
       &nbsp; </td>
     <td>&nbsp;</td>
   </tr>
  <tr>
  <td>Organisation <label id="reqerror">*<?php echo form_error('organisation');?></label></td>
  <td></td>
  <td>Location <label id="reqerror">*<?php echo form_error('location');?></label></td>
  <td></td>
  <td>Post Address 
    <label id="reqerror">*<?php echo form_error('postadd');?></label></td>
  </tr>
   <tr>
   <td><input name="organisation" class="input3" value="<?php  echo set_value('organisation')?>" /></td>
   <td></td>
   <td><input name="location" class="input3" value="<?php  echo set_value('location')?>" /></td>
   <td></td>
   <td><textarea name="postadd" class="input3" value="<?php  echo set_value('postadd')?>" cols="20" rows="2"></textarea></td>
   </tr>
   <tr>
     <td colspan="5" align="right"><input name="submit"   id="submit" class="btn btn-primary" type="submit"  />
       &nbsp;&nbsp;&nbsp;&nbsp;</td>
   </tr>
 </table>
 </fieldset>


<!-- <div id="border_1" class="bgrd"> -->


<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--<div id="middle-column">-->








<!--mainbody-->

<script type="text/javascript" >
$(document).ready(function($){
	$( "#tabs" ).tabs();//this create a tab for you and den u have to set something in the html part my-code6.html
	  $( "input[type=submit], a, button" )//this create a button for u. u have to set something in the html part my-code6.html
      .button()
      .click(function( event ) {
        //event.preventDefault();
      
  });
			/*
			function preventDefault(e) {
				e.preventDefault();
			}
			//$("form").bind("submit", preventDefault);
				$('form#form').submit( function(){

        			 ev.preventDefault();
					 return false;

  				});
				//later you decide you want to submit
				//$('form#form').unbind('submit').submit()
				// later, now switching back
				//$("form#form").unbind("submit", preventDefault);
				// alert('true')
				//location.reload();
				/*$('form#form').submit( function(){
									
				return true;
				alert('true')
										
				});*/
			
		function preventDefault(e) {
					if (event.currentTarget.allowDefault) {
						return;
					}
					e.preventDefault();
				}	
				
				
	$('input#submit').click(function(){
		
			var uploadfile = $('.filestyle').val();
			if(uploadfile == ""){
				
				$("form#form").bind("submit", preventDefault);
				$('#dialog').dialog('open');			
			}else{
				
				$("form#form").get(0).allowDefault = true;
				
			}
	});
		
	//Jquery ui dialog box option setting		
		$('#dialog').dialog({
				autoOpen: false,
				width: 300,
				modal: true,
				resizable: false,
				buttons:{
							"Continue": function() { 
														$("form#form").get(0).allowDefault = true;
														$(this).dialog("close");
													
														},
							"Cancel": function() { $(this).dialog("close");}
						}// buttons:{
							
		});	//END $('#dialog').dialog({	*/	
		
		
		
//////////////////////////////////////////////////////////////////////////////////////////	
	$(":file").filestyle({
		buttonText: "Upload Image",
		classButton: "btn btn-block btn-primary",
		classInput: "input-large"
	});
	/*$(":file").filestyle('clear');*/
///////////////////////////////////////////////////////////////////////////////////////////	
$( "#datepicker, #datepicker2" ).datepicker({ 
		changeMonth: true, 
		changeYear: true,
		//minDate: new Date(, 1 - 1, 1),
		appendText: "(dd/mm/yyyy)" ,
		dateFormat: 'dd/mm/yy',
		yearRange: '1980:2100',
		
		 });
		 
///////////////////////////////////////////////////////////////////////////////////////////////

		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		$('#upload').addClass('add_avatar');
						 
		$('#photoimg').bind('change', function()   
		{ 
			
		$("#imageform").ajaxForm({
			
			 target: '#upload',
			 url : 'upload',
			 dataType : 'json',
			 			 
			 beforeSend: function() {
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
				$('#upload').addClass('add_avatar');
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			success: function(data) {
				
				
				if(data.status =='success'){
						//alert(data.error);
					
						var percentVal = '100%';
						bar.width(percentVal)
						percent.html(percentVal);
						
						$("div#upload").html(data.message)
						$('#filename').val(data.filename)
						$('filepath').val(data.filepath)
						//alert(data.error)
						$('#upload').removeClass('add_avatar');
					}
								
			},
			complete: function(xhr) {
					//status.html(xhr.responseText);
					alert(xhr.responseText);
					
				}

			 
			 
			}).submit();
			/*submit(function() { 
			// submit the form 
			$(this).ajaxSubmit(); 
			// return false to prevent normal browser submit and page navigation 
				return false; 
			});*/
			
			function appendImage(data){
					if(data.status =='fail'){
						alert(data.error);
					}else{
						
						$("div#upload").html(data.message)
						$('#filename').val(data.filename)
						$('filepath').val(data.filepath)
						//alert(data.error)
						
					}
				}
				
		
				
			});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		
	
});


</script>

