
<style>
#dialog_upload_staff{  font-size: 80%;}

.imgdiv2{
	border:1px solid #E3E3E3;
	background-color: #F4F4F4;
	width:220px !important;
	padding:3px;
	position:relative;
	
	
	}
	.progress2 { position:relative; width:100%; border: 1px solid #ddd; padding:0px; border-radius: 3px; left:0px; top:0px ; margin-bottom:5px;  height:30px}
	.bar2 { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
	.percent2{ position:absolute; display:inline-block; top:3px !important; left:45%; }


</style>

<?php

	////////////////////////////////////////////////////////////
	$id = $this->session->userdata('userID');
	$user = $this->session->userdata('username');
	
	//echo $user, $id;
	//$this->load->library('database');
	$query = $this->db->get_where('adminend',array('admin_id'=>$id,"username"=>$user))->row_array();
	
	
	///////////////////////////////////////////////////////////////////////////////////
	
	$passport_url = $query['passport_url'];
	$profile_image =  array('src'=>$passport_url, 'width' =>'95%', 'height'=>'150', 'class'=>'img-polaroid');
	//$user_signature =  array('src'=>$signature_url, 'width'=>'120', 'height'=>'40', 'class'=>'img-polaroid');
	$name = $query['name'];
	$email = $query['email'];
	$cat = $query['category'];
	
	$staff_id = $query['admin_id'];
	$rel = array('rel'=>'lightbox', 'title'=>$name);
	//$signature_url = base_url().$signature_url;
	$passport_url = base_url().$passport_url;
	
		
		//echo $cat;
	if($cat == 0){ $category = "Administrator";}
	if($cat == 1){ $category = "Supervisor Admin";}
	if($cat == 2){ $category = "System Admin";}
	if($cat == 3){ $category = "Director/Proprietress";}
	if($cat == 4){ $category = "Principal";}		
	if($cat == 5){ $category = "VP Admin";}
	if($cat == 6){ $category = "VP Academy";}
	if($cat == 7){ $category = "Secretary";}
	if($cat == 8){ $category = "Accountant/P.R.O";}
	
	
	$cat = $this->session->userdata('cat');
	echo link_tag('asset/styles.css');
	
?>
<div id="sidemenu_container">

 <div id="user-profile">
         <div id ='staff_sidebar-name-bgrd'>
            <?php echo "<span class='staff_sidebar-cat'>". $category. "<span>"; ?>
        </div>
        <div class="staff_sidebar-center">
       		 <?php if($query['passport_url'] ==''){echo "<div class=avatar></div>";}else{  echo anchor($passport_url, img($profile_image),$rel) ;}?>
        </div>
    </div>

<nav>
<ul id="navigate">
<li class="direct"><?php echo anchor('result_management/admin/dashboard', 'Dashboard')?> </li>
<li class="direct"><?php echo anchor('result_management/admin/my_account', 'My Account')?> </li>
<li><a href="#">Registration</a>
	<ul>
   
<?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
						echo "<li>".anchor('result_management/admin/admin_user', 'Administrators'). "</li>";
		break;
		case 'admin_1':echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
						echo "<li>".anchor('result_management/admin/admin_user', 'Administrators'). "</li>";
		break;
		case 'admin_2': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
						
		break;
		case 'admin_3': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
						echo "<li>".anchor('result_management/admin/admin_user', 'Administrators'). "</li>";

		break;
		case 'admin_4': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
		break;
		case 'admin_5':	echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
				
		break;
		case 'admin_6': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
		break;
		case 'admin_7': echo "<li>".anchor('result_management/admin/staff', 'Staff'). "</li>";
						echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
		break;
		case 'admin_8': echo "<li>". anchor('result_management/admin/student', 'Students'). "</li>";
			}
            ?>
     </ul>
 </li>
 <li><a href="#">Users</a>
	<ul>
    
    <?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/admin_user/admin_users_list', 'Admin Profile'). "</li>";
						
		break;
		case 'admin_1':echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/admin_user/admin_users_list', 'Admin Profile'). "</li>";
						
		break;
		case 'admin_2': echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
												
		break;
		case 'admin_3': echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						
		break;
		case 'admin_4': echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						
		break;
		case 'admin_5':	echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						
				
		break;
		case 'admin_6': echo "<li>".anchor('result_management/admin/users', 'Teachers Profile'). "</li>";
						
		break;
		case 'admin_7': "";
		break;
		case 'admin_8':  ""; 
			}
            ?>
  
        </ul>
 </li>
<li><a href="#">Reports</a>
	<ul>
    <?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
		break;
		case 'admin_1':	echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
		break;
		case 'admin_2': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
						
		break;
		case 'admin_3': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";

		break;
		case 'admin_4': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
		break;
		case 'admin_5':	echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
				
		break;
		case 'admin_6': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
		break;
		case 'admin_7': echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
		break;
		case 'admin_8':echo "<li>".anchor('result_management/admin/view_by_session', 'View Result By Session'). "</li>";
						echo "<li>".anchor('result_management/admin/view_result', 'View Result by Term'). "</li>";
						echo "<li>".anchor('result_management/admin/broadsheet', 'Broadsheet'). "</li>";
			}
            ?>
   
    </ul>
</li>

<li><a  href="#">Comments</a>
	<ul>
    
    <?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
		break;
		case 'admin_1':	echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
		break;
		case 'admin_2': echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
						
		break;
		case 'admin_3': echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
		break;
		case 'admin_4': echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
				
		break;
		case 'admin_5':	echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>". anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
				
		break;
		case 'admin_6': echo "<li>".anchor('result_management/admin/edit_comments', 'Edit Staff Comments'). "</li>";
						echo "<li>".anchor('result_management/admin/comment_bank', 'Create Comment Bank'). "</li>";
						
		break;
		case 'admin_7': '';
		break;
		case 'admin_8':'';
			}
            ?>
      	 
    </ul>
</li>
<li><a href="#">Students</a>
	<ul>
    
     
    <?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
		break;
		case 'admin_1':	echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
		break;
		case 'admin_2': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
						
		break;
		case 'admin_3': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>". anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
		break;
		case 'admin_4': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>". anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
				
		break;
		case 'admin_5':	echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
				
		break;
		case 'admin_6': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						echo "<li>".anchor('result_management/admin/student_promotion', 'Student Promotion'). "</li>";
						echo "<li>".anchor('result_management/admin/student_streaming', 'Streaming'). "</li>";
						
		break;
		case 'admin_7': echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						;
		break;
		case 'admin_8':	echo "<li>".anchor('result_management/admin/student_in_category', 'Student by Category'). "</li>";
						echo "<li>".anchor('result_management/admin/student_profile', 'Student Profile'). "</li>";
						;
			}
            ?>
   
    </ul>
</li>
 <?php
 
	switch($cat){
		case 'admin_0': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_1': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_2': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_3': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_4': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_5': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		case 'admin_6': echo "<li class='direct'>" .anchor('result_management/admin/teacher_lesson_notes', 'Teachers Lesson Notes'). "</li>";
		break;
		
			}
	?>
    

 <?php 	switch($cat){ 
		case ($cat == 'admin_0' || $cat== 'admin_1' || $cat == 'admin_2'): ?>
						<li><a href="#">Settings</a>
						<ul>
						<li><?php echo anchor('result_management/admin/general_settings', 'General Settings');?></li>
						<li><?php echo anchor('result_management/admin/class_subject_settings', 'Class/Subject Settings');?></li>
						<li><?php echo anchor('result_management/admin/grade_settings', 'Grading Settings');?></li>
						 <li><?php echo anchor('result_management/admin/average_scores_settings', 'Min. Pass Mark Settings');?></li>
						<li><?php echo anchor('result_management/admin/result_template_settings', 'Result Template');?></li>
						
						</ul>
					
					</li><?php
		break;
		
		}
     ?>

<li><a href="#">School Utilities</a>
	<ul>
    
     <?php 
	switch($cat){
		
		case 'admin_0': echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/database', 'Database Backup'). "</li>";
						echo "<li>".anchor('result_management/admin/generate_pin', 'Pin Code'). "</li>";
						
						
						
		break;
		case 'admin_1':	//echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/database', 'Database Backup'). "</li>";
		break;
		case 'admin_2': //echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						
						
		break;
		case 'admin_3': //echo "<li>".anchor('result_management/admin/view_timetable', 'View Timetable'). "</li>";
						//echo "<li>". anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						
		break;
		case 'admin_4': //echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						//echo "<li>". anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
				
		break;
		case 'admin_5':	//echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						
				
		break;
		case 'admin_6': //echo "<li>".anchor('result_management/admin/timetable', 'Generate Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/result_sms', 'Send Results SMS'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
						
		break;
		case 'admin_7': //echo "<li>".anchor('result_management/admin/view_timetable', 'View Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
		break;
		case 'admin_8':	//echo "<li>".anchor('result_management/admin/view_timetable', 'View Timetable'). "</li>";
						//echo "<li>".anchor('result_management/admin/attendance', 'Attendance'). "</li>";
						echo "<li>".anchor('result_management/admin/public_notice', 'Public Notice'). "</li>";
						echo "<li>".anchor('result_management/admin/sms_broadcast', 'Send SMS'). "</li>";
			}
            ?> 
    </ul>

</li>
 <?php
 
	switch($cat){
		case 'admin_0': echo "<li class='direct'>" .anchor_popup('http://localhost/author_secondary?author=true&uid=$user', 'Author'). "</li>";
		break;
		case 'admin_7': echo "<li class='direct'>" .anchor_popup('http://localhost/author_secondary?author=true&uid=$user', 'Author'). "</li>";
		break;
		case 'admin_8': echo "<li class='direct'>" .anchor_popup('http://localhost/author_secondary?author=true&uid=$user', 'Author'). "</li>";
		break;
	}
	?>
    

<li class="direct"><?php echo anchor('result_management/admin/accounts/logout', 'Log Out');?>

</li>
</ul>

</nav>
</div>

<!--=========================================================================================================================
								UPLOAD STUDENT IMAGE 

=============================================================================================================================-->

<div id="dialog_upload_staff" title="Upload New Image">
<form id="imageform2" method="post" enctype="multipart/form-data" >

       <div class="imgdiv2">
             <div id="upload"></div> 
            	 <div class="progress2">
                	<div class="bar2"></div >
                	<div class="percent2">0%</div >
                 	<!--/*<div id="status"></div>*/-->
             	</div>
			<input type="file" class="filestyle" name="userfile" id="photoimg2" data-buttonText= "Upload Passport" data-input="true"  data-classButton="btn btn-block btn-primary" data-classInput="input-large"  > 
         </div>
 
</form>
</div> 

<script  type="text/javascript" src="<?php echo base_url();?>asset/bootstrap/js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" > 
$(document).ready(function(){
  $("#navigate > li > a").on("click", function(e){
	  //alert("You click me");
	
		
    if($(this).parent().has("ul") && $(this).parent().hasClass("direct")== false) {
      e.preventDefault();
    }
	
	
    if(!$(this).hasClass("open")) {
		
		//alert($(this).hasClass("open"));
      // hide any open menus and remove all other classes
	  // $("#navigate li ul").slideDown(500);
      $("#navigate li ul").slideUp(500);
      $("#navigate li a").removeClass("open");
      
      // open our new menu and add the open class
      $(this).next("ul").slideDown(500);
      $(this).addClass("open");
    }
    
    else if($(this).hasClass("open")) {
      $(this).removeClass("open");
      $(this).next("ul").slideUp(350);
    }
  });
  
   
  			 
/*===============================================================================================================================
										IMAGE UPLOADS

=================================================================================================================================*/
		 //Jquery ui dialog box option setting		
		$('#dialog_upload_staff').dialog({
				autoOpen: false,
				width: 260,
				height: 400,
				modal: true,
				resizable: false,
				buttons:{
							"Send Image": function() {
														if($('#photoimg2').val() == ''){
															
																alert('You have not uploaded an image')
															
															}else{
															
															location.reload()
														}
														//Use Ajax to delete klass from the database
														//alert("id = "+ klass.id + " value = "+ klass.value + " title  = "+ klass.title);
														//$.post( '<?php echo base_url();?>index.php/result_management/admin/student_profile/delete_record',{id:record.id},
														//function(data){record.row.fadeOut('slow').remove();});
														$(this).dialog("close");
														//location.reload();
														},
							"Cancel": function() { $(this).dialog("close");}
						}// buttons:{
							
		});	//END $('#dialog').dialog({	*/
		 
		  $('.avatar').click(function(){
			
			//Open initailized dialog box
			$('#dialog_upload_staff').dialog('open');
		 	
				 					
		});//$('span.del').click(function(){
		
 
		/* $(":file").filestyle({
				'buttonText': "Upload Passport",
				'classButton': "btn btn-block btn-primary",
				'classInput': "input-large"
		});
		$(":file").filestyle('clear');*/
	
		var bar = $('.bar2');
		var percent = $('.percent2');
		var status = $('#status2');
		$('#upload').addClass('add_avatar');						 
		
		$('#photoimg2').bind('change', function(){ 
		
			//alert($('#imageform').val());
			
			$("form#imageform2").ajaxForm({
				
				 target: '#upload2',
				 url : "<?php echo base_url();?>index.php/result_management/admin/upload/staff_passport_upload?staff_id="+<?php echo $id ?>,
			
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
						//if(data.status =='success'){ 
													
							var percentVal = '100%';
							bar.width(percentVal)
							percent.html(percentVal);
							
							$("div#upload").html(data.message)
							$('#upload').removeClass('add_avatar');
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
		 		 
});
</script>
