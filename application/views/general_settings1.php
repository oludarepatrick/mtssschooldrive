<style>
#tabs{ 
	width:100%;
	margin-top:30px;
	font-size:80%;
	padding:0px;
	padding: 0px; 
    background: none; 
    border-width: 0px; 
		
	}
#tabs li{
	padding-left:0;
	padding-right:0;
	}
#tabs .ui-tabs-nav { 
    padding-left: 0px; 
    background: transparent; 
    border-width: 0px 0px 1px 0px; 
    -moz-border-radius: 0px; 
    -webkit-border-radius: 0px; 
    border-radius: 0px; 
} 
#tabs .ui-tabs-panel { 
    /*background: #f5f3e5 url(http://code.jquery.com/ui/1.8.23/themes/south-street/images/ui-bg_highlight-hard_100_f5f3e5_1x100.png) repeat-x scroll 50% top; */
    border-width: 0px 1px 1px 1px; 
}
	
	
#selectable .ui-selecting {
        background: #ccc;
    }
#selectable .ui-selected {
        background: #999;
    }
label {display:inline;}
label.error {color: red; padding-left: .5em; vertical-align: middle; }

.cancel li label {
		padding-left: 0px  !important;
		width: 100% !important;
}

.ui-datepicker {
	font-size:80%;
}
.imgdiv{
	left:30%;
	top:3px !important;
	border:1px solid #E3E3E3;
	background-color: #F4F4F4;
	width:220px !important;
	padding:3px;
	position:relative;
	right:5px;
	top:-15px;
	text-align:center ;
	
	
	}
	.progress { position:relative; width:100%; border: 1px solid #ddd; padding:0px; border-radius: 3px; left:0px; top:0px ; margin-bottom:5px;  height:30px}
	.bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
	.percent { position:absolute; display:inline-block; top:-10px !important; left:45%; }
	#delete_seal{ width:100% !important; height:100% !important}


</style>
<!--------------------------------------- <div id="settings_border">   ------------------------------------------------------->
<?php  $calendar = array('src'=> 'asset/image/calendar.gif');?>

<div id="middle-column2"> 



<div id="settings_border">

<div class="success_msg"></div>

<!--<div id="menu_heading">-->
<?php echo form_open('general_settings');?>
<?php 

 //include 'c:\wamp\www\eschoolin\application\views\utilities\settings_links.php';
 if($load_top_links){
 	$this->load->view('utilities/settings_links');
 }
 $alert = array('src' => 'asset/image/alert.png' );

 ?>
<!--<div id="menu_heading">-->

<div class="hd_title"> GENERAL SETTINGS</div>
<!---------------------------------------------------------------------------------------------------------------------------------
													DIV TABS
 ---------------------------------------------------------------------------------------------------------------------------------->
<div id="tabs">
    <ul>
        <li><a href="#tab_menu1"><span>Company Info</span></a></li>
        
        
    </ul>
    
<!----------------------------------------------- ------------------------------------------------------------------------------
													SCHOINFO FORM   
 -------------------------------------------------------------------------------------------------------------------------------->    
<div id="tab_menu1">
<form  id="infoForm" method="post" action=""  enctype="multipart/form-data">
<ul id="setting_style">
	<li>
    	<div></div>
    </li>
    <li>
    	<div>
    	  <label for="schoolname">Company Name</label>
    	</div>
        <input type="text" name="compname"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->name;} ?>" />
        <input type="hidden" class="input" value="schinfo" name="schinfoForm" /><!-- this is ti set the AjaxPost data on controller-->
    </li>
    <li>
    	<div><label for="slogan">Company Slogan</label></div>
        <input type="text" name="slogan"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
    <li>
    	<div>
    	  <label for="address">Company Address</label>
    	</div>
        <input type="text" name="address"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->address;}?>" />
    </li>
    <li>
    	<div><label for="postal">Postal Address</label></div>
        <input type="text" name="postal"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->postal_add;}?>" />
    </li>
	 <li>
    	<div><label for="phone">Phone 1</label></div>
        <input type="text" name="phone1" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
    
	 <li>
    	<div><label for="phone">Phone 2</label></div>
        <input type="text" name="phone2" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 <li>
    	<div><label for="phone">Phone 3</label></div>
        <input type="text" name="phone3" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	
    <li>
    	<div><label for="email">Email 1</label></div>
        <input type="text" name="email1" class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->email;}?>" />
    </li>
	<li>
    	<div><label for="email">Email 2</label></div>
        <input type="text" name="email2" class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->email;}?>" />
    </li>
    <li>
    	<div><label for="web_add">Web Address</label></div>
        <input type="text" name="site"  class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo  $schinfo->web_add;}?>"/>
    </li>
   <li>
    	<div>
    	  <label for="schoolname">Bank Account Name</label>
    	</div>
        <input type="text" name="accountname"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->name;} ?>" />
        <input type="hidden" class="input" value="schinfo" name="schinfoForm" /><!-- this is ti set the AjaxPost data on controller-->
    </li>
	 <li>
    	<div><label for="slogan">Reference No</label></div>
        <input type="text" name="refrence" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 
	 <li>
    	<div><label for="slogan">Bank 1</label></div>
        <input type="text" name="bank1"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
	 <li>
    	<div><label for="slogan">Account Number 1</label></div>
        <input type="text" name="account1" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 <li>
    	<div><label for="slogan">Bank 2</label></div>
        <input type="text" name="bank2"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
	 <li>
    	<div><label for="slogan">Account Number 2</label></div>
        <input type="text" name="account2" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 <li>
    	<div><label for="slogan">Bank 3</label></div>
        <input type="text" name="bank3"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
	 <li>
    	<div><label for="slogan">Account Number 3</label></div>
        <input type="text" name="account3" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 <li>
    	<div><label for="slogan">Bank 4</label></div>
        <input type="text" name="bank4"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
	 <li>
    	<div><label for="slogan">Account Number 4</label></div>
        <input type="text" name="account4" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
	 <li>
    	<div><label for="slogan">Bank 5</label></div>
        <input type="text" name="bank5"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
	 <li>
    	<div><label for="slogan">Account Number 5</label></div>
        <input type="text" name="bank5" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
   
    
    <li>
   <div><input type="submit" name="save" value="Save"/></div>
    </li>
   
 </ul> 
 
</form>
</div>
<!--END<div id="tab_menu1">-->
<!-------------------------------------------------------------------------------------------------------------------------------
 														END SCHOINFO FORM          
 -------------------------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------------------------------------------------------------------------------------
														TERM/SESSION FORM  
---------------------------------------------------------------------------------------------------------------------------------->

   
  
<!--------- END MODAL DIALOG BOX FOR CONFIRMATION OF A DELETE ACTION ----------------------------------->




<script>

$(document).ready(function($){

		//Activate click event on tab navigation		
		$( "#tabs" ).tabs({ event: "click" });
		
		//Add css to even list
		$('ol#setting_style li:even').addClass('even');
		
		//Activate Date jquery plugins
		$( "#datepicker, #datepicker2" ).datepicker({ changeMonth: true, changeYear: true });
		
		//Hide the Success Message div
		$("div.success_msg").css('visibility', 'hidden');
		
		$("li#ca-exam").hide();
		$("select#level").click(function(){
				
			if($('select#level option:selected').val()== 2)
			{
				$("li#ca-exam").fadeIn(3000);
				//var e= $("select#cat option:selected").val();
				//alert(e);
			}else{
				
				$("li#ca-exam").fadeOut('slow');
			}
		});	
			

===================================================================================================================================
													UPLOAD SCRIPT
===================================================================================================================================
		$("#photoimg").filestyle({
		buttonText': "Upload School Logo",
		classButton': "btn btn-block btn-primary",
		classInput': "input-large"
		});
		$(":file").filestyle('clear');
		
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
						 
		$('#photoimg').bind('change', function(){ 
			
			$("#imageform").ajaxForm({
				
				 target: '#upload',
				 url : '<?php echo base_url();?>'+'index.php/result_management/admin/upload/school_logo',
				 dataType : 'json',
							 
				 beforeSend: function() {
							status.empty();
							var percentVal = '0%';
							bar.width(percentVal)
							percent.html(percentVal);
				},
				uploadProgress: function(event, position, total, percentComplete) {
							var percentVal = percentComplete + '%';
							bar.width(percentVal)
							percent.html(percentVal);
				},
				error : function(data){
						alert(data.error);
					},
				success: function(data) {
						if(data.status =='success'){
													
							var percentVal = '100%';
							bar.width(percentVal)
							percent.html(percentVal);
							
							$("div#upload").html(data.message)
							$('#filename').val(data.filename)
							$('filepath').val(data.filepath)
							alert(data.error)
						}//ENDif(data.status =='fail'){
				},
				complete: function(xhr) {
					status.html(xhr.responseText);
					alert(xhr.responseText);
					
				}
			}).submit();
										
		});
			
			
			
			
			
===================================================================================================================================
													UPLOAD STAMP SCRIPT 
===================================================================================================================================
		$("#stampimg").filestyle({
		buttonText': "Upload School Seal/Stamp",
		classButton': "btn btn-block btn-primary",
		classInput': "input-large"
		});
		$(":file").filestyle('clear');
		
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
						 
		$('#stampimg').bind('change', function(){ 
			
			$("#stampform").ajaxForm({
				
				 target: '#stampupload',
				 url : '<?php echo base_url();?>'+'index.php/result_management/admin/upload/school_stamp_seal',
				 dataType : 'json',
							 
				 beforeSend: function() {
							status.empty();
							var percentVal = '0%';
							bar.width(percentVal)
							percent.html(percentVal);
				},
				uploadProgress: function(event, position, total, percentComplete) {
							var percentVal = percentComplete + '%';
							bar.width(percentVal)
							percent.html(percentVal);
				},
				error : function(data){
						alert(data.error);
					},*/
				success: function(data) {
						//if(data.status =='success'){
													
							var percentVal = '100%';
							bar.width(percentVal)
							percent.html(percentVal);
							
							$("div#stampupload").html(data.message)
							//$('#filename').val(data.filename)
							//$('filepath').val(data.filepath)
							//alert(data.error)
						//}//ENDif(data.status =='fail'){
				},
				complete: function(xhr) {
					//status.html(xhr.responseText);
					alert(xhr.responseText);
					
				}
			}).submit();
										
		});
			
			$('#dialog').dialog({
            autoOpen: false,
            width: 300,
            modal: true,
            resizable: false,
            buttons:{
						"Continue": function() {
													//Use Ajax to delete klass from the database
													//alert("id = "+ klass.id + " value = "+ klass.value + " title  = "+ klass.title);
													$.post('<?php echo base_url();?>'+'index.php/result_management/admin/general_settings/delete_seal' ,{action:'delete'},
													function(data){
														
															alert(data)
															
														
														});
													$(this).dialog("close");
													},
                		"Cancel": function() { $(this).dialog("close");}
            		}// buttons:{
    });	//END $('#dialog').dialog({	
	
	
	$('#delete_seal').click(function(){
			$('#dialog').dialog('open');
		 		
	});//$('#delete_seal').click(function(){
			
			
			
			

------------------------------------------------------------------------------------------------------------------------------
										FORM VALIDATION ON GENERAL SETTINGS
--------------------------------------------------------------------------------------------------------------------------------
		
		Prevent default submit of all the forms to be validated 
		jQuery.validator.setDefaults({
			debug: true,
		});
		Sets the validation rules for phone number(US)
		
		jQuery.validator.addMethod("phone_contact", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, ""); 
			return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^[0-9]{11}$/);}, "Please specify a valid GSM phone number");
			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////  SCHINFO JQUERY VALIDATION  //////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
		jQuery validation for Schinfo Form	
		$("#infoForm").validate({
			
			errorElement : "label",
			
			set the rules for the fields
			rules : {
				compname: {
					 required:true
				},
				slogan:{
					
				},
				address:{
					required:true
				},
				postal:{
					
				},
				email1:{
					email:true
				},
				site:{
					url:true
				},
				phone1:{
					required:true,
					number:true,
					phone_contact :true
				},
				url:{
					url:true
				},
				level:{
					required:true
				},
				ca_exam:{
					
				}
			},
			set the customize error messages
			messages : {
				compname: {
					required:"Please enter the school name",
				},
				address:{
					required:"School Address is not yet entered",
				},
				email1:{
					email:"Enter a valid email address like name@domain.com",
				},
				web_add:{
					url:"Enter a valid url like http://www.domain.com",
				},
				phone1:{
					required:"Please Enter a valid Phone Contact ",
					number:"The Phone contact is invalid",
				},
				level:{
					required:"Please select the school level",
				},
				ca_exam:{
					required:"Please, indicate if you run separate CAs/Exam Scores for Junior and Senior Classes",
				}
			},
			set actions for form submission
			submitHandler: function(form) {
				
				captures the submitted form data and format them in key/value pairs
				var data = $("form#infoForm input,form#infoForm select").serializeArray();
				
				data.each(function(index) {
    			  alert(index + ': '+ $(this).attr('name') + ' ==  ' + $(this).val());
				});
				
				call Ajax Post metthod
				$.post('<?php echo base_url();?>'+'index.php/result_management/admin/general_settings/ajax_settings', data, function(json){
					if (json.status == "fail") {
						
					}else if (json.status == "success") {
					Display success message to user	
						$("div.success_msg").css('visibility', 'visible').fadeIn(3000,function(){
							$(this).text(json.message);
							}).delay(2000).fadeOut(3000);
					}else{alert("Nothing Happened");}
				},"json"); //$.post	 
			 
			}//end submitHandler: function(form) {
								
		});//End jQuery validation for Schinfo Form
		
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////   END SCHINFO FORM JQUERY VALIDATION  ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		$("#save1").click(function () {
			alert();
            if ($("form#infoForm").valid()) {
				    $("div#message").addClass('success_msg').fadeIn(3000,function(){$(this).text('Data Successifully Saved');}).fadeOut(3000).removeClass('success_msg');
                    return false;  // do not submit form
            }
            });
		
	});



	$('#save1').click(function() {
				//alert('isaac');

			var data = $("input.save,input.input,select.select").serializeArray();  //form#info:input, form#info:select
	
			$.post($("form#info").attr('action'), data, function(json){
				
				if (json.status == "fail") {
					alert(json.message);
				}else if (json.status == "success") {
					//alert(json.message);
				$("div.success_msg").css('visibility', 'visible').fadeIn(3000,function(){$(this).text(json.message);}).fadeOut(3000);	
					
				}else{alert("Nothing Happened");}
			},"json"); //"json"

	});	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////  TERM_SESSION JQUERY VALIDATION     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
		Term_session Jquery Validation
		$("#termForm").validate({
			Set rules for form fields
			rules : {
				current_term:{
					required:true
				},
				session:{
					required:true
				},
				result_type:{
					required:true					
				},
				input_status:{
					required:true					
				}
			},
			Set customized error message
			messages : {
				current_term:{
					required:"Please select Current Term"
				},
				session:{
					required:"Please select Current Academic Session"
				},
				result_type:{
					required:"Please select Result Type"					
				},
				input_status:{
					required:"Please select  Term for Result Input"					
				}
			},
			Set actions for form submission
		 	submitHandler: function(form) {
			 
			Iterate the form fields and display input values
			var d =$('form#termForm select.select, form#termForm input.input');
			$(d).each(function(index) {
    			alert(index + ': ' + $(this).val());
			});
			
				capture and format form input values into key/value pairs
				var data = $("form#termForm input, form#termForm select").serializeArray(); 
					
				Call Ajax Post method
				$.post( '<?php echo base_url();?>'+'index.php/result_management/admin/general_settings/ajax_settings', data, function(json){ 
				
					if (json.status == "fail") {
						alert(json.message);
					}else if (json.status == "success") {
					Display success msg to user
						$("div.success_msg").css('visibility', 'visible').fadeIn(3000,function(){
							$(this).text(json.message);
							}).delay(2000).fadeOut(3000);	
					}else{alert("Nothing Happened");}
				},"json"); //"json"	 
			 
		 	}//END submitHandler: function(form) {
										
		});// EndTerm_session Jquery Validation
		
//////////////////////////////////////////////  END TERM_SESSION JQUERY VALIDATION    /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
	
	
	$("div.success_msg").css('visibility', 'hidden');
	
	$("form#term").submit(function(){
		return false;
	});
	
	$("#save2").click(function(){
									
				$.ajax({
				type: 	"POST",
				url:	$("form#term").attr('action'),
				data:	$("input.input,select.select").serializeArray(),
				datatype:"json",
				success: function(json){
				$("div.success_msg").css('visibility', 'visible').fadeIn(3000, function(){$(this).text(json.message);}).fadeOut(3000);									
				}
 			});
						
	});//$("input.select").click(funtion(){
	

		
//////////////////////////////////////////////  CALENDAR FORM JQUERY VALIDATION    /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
	
		Calendar From Jquery Validation
		$("form#calendar").validate({
			set rules
			rules : {
				resumption:{
					required:true
				},
			closing:{
					required:true
				}
			},
			Customize error msgs
			messages : {
				resumption:{
					required:"Please enter valid resumption date"
				},
				closing:{
					required:"Please enter valid closing date"
				}
			},
			set form submission actions
		 	submitHandler: function(form) {
						
				Captures and format form inputs
				var data = $("form#calendar input").serializeArray();
				data.each(function(index) {
    			  alert(index + ': '+ $(this).attr('name') + ' ==  ' + $(this).val());
				});
				Call Ajax Post method
				$.post( '<?php echo base_url();?>'+'index.php/result_management/admin/general_settings/ajax_settings', data, function(json){
			
					if (json.status == "fail") {
						alert(json.message);
					}else if (json.status == "success") {
						alert();
					 Displays success message	
						$("div.success_msg").css('visibility', 'visible').fadeIn(5000,function(){
							$(this).text(json.message);
							}).delay(2000).fadeOut(7000);
					}else{alert("Nothing Happened");}
				},"json"); //"json"	 
			 
			 }//endsubmitHandler: function(form) {
								
		});//END calendar form validation
			
//////////////////////////////////////////////  END CALENDAR FORM JQUERY VALIDATION    /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			

});//end$(document).ready(function($){
</script>