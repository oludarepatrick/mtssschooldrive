<?php

    ////////////////////////////////////////////////////////////
    $id = $this->session->userdata('userID');
    $user = $this->session->userdata('username');
    
    //echo $user, $id;
    //$this->load->library('database');
    $query = $this->db->get_where('adminend',array('admin_id'=>$id,"username"=>$user))->row_array();
    
    
    ///////////////////////////////////////////////////////////////////////////////////
    
    //$passport_url = $query['passport_url'];
    //$profile_image =  array('src'=>$passport_url, 'width' =>'95%', 'height'=>'150', 'class'=>'img-polaroid');
    //$user_signature =  array('src'=>$signature_url, 'width'=>'120', 'height'=>'40', 'class'=>'img-polaroid');
    /*$name = $query['name'];
    $email = $query['email'];
    $cat = $query['category'];
    
    $staff_id = $query['admin_id'];*/
    //$rel = array('rel'=>'lightbox', 'title'=>$name);
    //$signature_url = base_url().$signature_url;
    //$passport_url = base_url().$passport_url;
    
        
      
    
?>
<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
} else {
$this->session->set_flashdata('message', 'Please Login to use the application!');
            redirect('school_settings');
}
?>


    <ul class="v-menu navy">
        <li class="menu-title"><?php echo "Welcome, ".$username;?></li>
        <li><a href="dashboard"><span class="mif-home icon"></span>Dashboard</a></li>
        <li><a href="admin_account_page"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-school icon"></span> Registration</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="staff_registration"><span class="mif-user icon"></span>Staff</a></li>
                <li><a href="student_registration"><span class="mif-school icon"></span>Students</a></li>
                
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-user icon"></span> Teachers</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="staff_details"><span class="mif-user icon"></span>Teacher's Profile</a></li>
				<li><a href="edit_teachers"><span class="mif-user icon"></span>Edit Teacher's Profile</a></li>
				
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span> Results</a>
            <ul class="d-menu" data-role="dropdown">
                
                <li><a href="result_view"><span class="mif-keyboard icon"></span>View Result by Term</a></li>
                <li><a href="result_notification"><span class="mif-keyboard icon"></span>Send Result Notification</a></li>
                <li><a href="broadsheet"><span class="mif-keyboard icon"></span>Broadsheet</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span> Comments</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="insert_comment"><span class="mif-keyboard icon"></span>Principal's Comment</a></li>
                <li><a href="insert_teacher_comment"><span class="mif-keyboard icon"></span>Teacher's Comment</a></li>
				
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-user icon"></span> Students</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="student_login_details"><span class="mif-user icon"></span>Student Login Details</a></li>
                <li><a href="student_status_set"><span class="mif-user icon"></span>Student Status</a></li>
                <li><a href="promotion"><span class="mif-user icon"></span>Student Promotion</a></li>
                <li><a href="student_school_fees"><span class="mif-user icon"></span>School Fees</a></li>
                <li><a href="student_profile"><span class="mif-user icon"></span>Student Profile</a></li>
		<li><a href="edit_student_profile"><span class="mif-user icon"></span>Edit Student Data</a></li>
                <li><a href="change_student_id"><span class="mif-user icon"></span>Change ID</a></li>
                <li><a href="change_student_class"><span class="mif-user icon"></span>Change Student Class/Arm</a></li>
                <li><a href="non_active_student"><span class="mif-folder icon"></span>View Non-Active Student</a></li>
            </ul>
        </li>
        <li><a href="view_lessonnote"><span class="mif-folder-special icon"></span> Lesson Notes</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-my-location icon"></span> School Assets</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="timetable"><span class="mif-event-available icon"></span>Time Table</a></li>
                <li><a href="scheme"><span class="mif-home icon"></span>Scheme of Work</a></li>
                <li><a href="theme"><span class="mif-home icon"></span>Theme</a></li>
                 <li><a href="code_conduct"><span class="mif-home icon"></span>Code of Conduct</a></li>
                 <li><a href="general_upload"><span class="mif-home icon"></span>General Upload</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-tools icon"></span> Settings</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="school_details"><span class="mif-keyboard icon"></span>General</a></li>
                <li><a href="class_form"><span class="mif-keyboard icon"></span>Class/Subject</a></li>
                <li><a href="grade"><span class="mif-keyboard icon"></span>Grading</a></li>
                
            </ul>
        </li>
        <li><a href="logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>

