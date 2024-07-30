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
$staffid = ($this->session->userdata['logged_in']['staff_id']);
$email = ($this->session->userdata['logged_in']['email']);
$category = ($this->session->userdata['logged_in']['category']);
} else {
$this->session->set_flashdata('message', 'Please Login to use the application!');
            redirect('staff');

}
?>



    <?php 
switch($category) {
case "CLASS | SUBJECT TEACHER": ?>
<ul class="v-menu navy">
    <li class="menu-title"><?php echo "Welcome, ".$username." ".$staffid;?><hr /><?php echo $category; ?></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/dashboard"><span class="mif-home icon"></span>Dashboard</a></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staff_account_page"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span> Results</a>
            <ul class="d-menu" data-role="dropdown">
               <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_result_view"><span class="mif-keyboard icon"></span>View Mock Result</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_view"><span class="mif-keyboard icon"></span>View Result by Term</a></li>
                  <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_imputation"><span class="mif-keyboard icon"></span>Edit/Imputation</a></li>
                  <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_imputation"><span class="mif-keyboard icon"></span>Edit/Enter Mock Exam Scores</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/broadsheet"><span class="mif-keyboard icon"></span>Broadsheet</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span> Comments</a>
            <ul class="d-menu" data-role="dropdown">
               
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/insert_teacher_comment"><span class="mif-keyboard icon"></span>Teacher's Comment</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/skills_grading"><span class="mif-keyboard icon"></span>Skills Grading</a></li>
            </ul>
        </li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staffpages/staff" class="dropdown-toggle"><span class="mif-school icon"></span> Students</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/student_profile"><span class="mif-user icon"></span>Student Profile</a></li>
                 <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/edit_student_profile"><span class="mif-user icon"></span>Edit Student Data</a></li>
                
            </ul>
        </li>
         <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span>CBT</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="https://cbt5.schooldriveng.com/checkpoint/<?php echo base64_encode($email); ?>"><span class="mif-keyboard icon"></span>CBT Dashboard</a></li>
                <!--<li><a href="/index.php/cbt/init"><span class="mif-keyboard icon"></span>Create/Edit CBT CA</a></li>
                <li><a href="/index.php/cbt/init_exam"><span class="mif-keyboard icon"></span>Create/Edit CBT EXAM</a></li>
                <li><a href="/index.php/cbt/cbt_theory"><span class="mif-keyboard icon"></span>Create/Edit CBT THEORY</a></li>
                <li><a href="/index.php/cbt/view_sample_cbt_result"><span class="mif-keyboard icon"></span>View PRE-CBT Result</a></li>
                <li><a href="/index.php/cbt/view_cbt_result"><span class="mif-keyboard icon"></span>View CBT Result</a></li>
                <li><a href="/index.php/cbt/view_cbt_history_result"><span class="mif-keyboard icon"></span>View CBT History Result</a></li>
                <li><a href="/index.php/staff/cbt_comment"><span class="mif-keyboard icon"></span>CBT Comment</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/cbt_broadsheet"><span class="mif-keyboard icon"></span>CBT Broadsheet</a></li>
                -->
         </ul>
        </li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/view_lessonnote"><span class="mif-folder-special icon"></span> Lesson Notes</a></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staffpages/staff" class="dropdown-toggle"><span class="mif-my-location icon"></span> School Assets</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/timetable"><span class="mif-event-available icon"></span>Time Table</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/scheme"><span class="mif-keyboard icon"></span>Scheme of Work</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/general_upload"><span class="mif-folder-special icon"></span>General Uploads</a></li>
            </ul>
        </li>
       
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>

<?php break; ?>

<?php 
case "SUBJECT TEACHER":

?>
<ul class="v-menu navy">
    <li class="menu-title"><?php echo "Welcome, ".$username." ".$staffid;?><hr /><?php echo $category; ?></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/dashboard"><span class="mif-home icon fg-wine"></span>Dashboard</a></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staff_account_page"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span> Results</a>
            <ul class="d-menu" data-role="dropdown">
               <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_result_view"><span class="mif-keyboard icon"></span>View Mock Result</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_view"><span class="mif-home icon"></span>View Result by Term</a></li>
                  <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_imputation"><span class="mif-keyboard icon"></span>Edit/Enter Results</a></li>
                 <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_imputation"><span class="mif-keyboard icon"></span>Edit/Enter Mock Exam Scores</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/broadsheet"><span class="mif-keyboard icon"></span>Broadsheet</a></li>
            </ul>
        </li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/view_lessonnote"><span class="mif-folder-special icon"></span> Lesson Notes</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span>CBT</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="https://cbt5.schooldriveng.com/checkpoint/<?php echo base64_encode($email); ?>"><span class="mif-keyboard icon"></span>CBT Dashboard</a></li>
                <!--<li><a href="/index.php/cbt/init"><span class="mif-keyboard icon"></span>Create/Edit CBT CA</a></li>
                <li><a href="/index.php/cbt/init_exam"><span class="mif-keyboard icon"></span>Create/Edit CBT EXAM</a></li>
                <li><a href="/index.php/cbt/cbt_theory"><span class="mif-keyboard icon"></span>Create/Edit CBT THEORY</a></li>
                <li><a href="/index.php/cbt/view_sample_cbt_result"><span class="mif-keyboard icon"></span>View PRE-CBT Result</a></li>
                <li><a href="/index.php/cbt/view_cbt_result"><span class="mif-keyboard icon"></span>View CBT Result</a></li>
                <li><a href="/index.php/cbt/view_cbt_history_result"><span class="mif-keyboard icon"></span>View CBT History Result</a></li>
                <li><a href="/index.php/staff/cbt_comment"><span class="mif-keyboard icon"></span>CBT Comment</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/cbt_broadsheet"><span class="mif-keyboard icon"></span>CBT Broadsheet</a></li>
                -->
         </ul>
        </li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staffpages/staff" class="dropdown-toggle"><span class="mif-my-location icon"></span> School Assets</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/scheme"><span class="mif-folder-special icon"></span>Scheme of Work</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/general_upload"><span class="mif-folder-special icon"></span>General Uploads</a></li>
            </ul>
        </li>
       
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>
<?php break; ?>

<?php case "CLASS TEACHER": ?>
<ul class="v-menu navy">
    <li class="menu-title"><?php echo "Welcome, ".$username." ".$staffid;?><hr /><?php echo $category; ?></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/dashboard"><span class="mif-home icon fg-wine"></span>Dashboard</a></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staff_account_page"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span> Results</a>
            <ul class="d-menu" data-role="dropdown">
               <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_result_view"><span class="mif-keyboard icon"></span>View Mock Result</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_view"><span class="mif-keyboard icon"></span>View Result by Term</a></li>
                  <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_imputation"><span class="mif-keyboard icon"></span>Edit/Imputation</a></li>
                  <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_imputation"><span class="mif-keyboard icon"></span>Edit/Enter Mock Exam Scores</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/broadsheet"><span class="mif-keyboard icon"></span>Broadsheet</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span> Comments</a>
            <ul class="d-menu" data-role="dropdown">
               
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/insert_teacher_comment"><span class="mif-keyboard icon"></span>Teacher's Comment</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/skills_grading"><span class="mif-keyboard icon"></span>Skills Grading</a></li>
            </ul>
        </li>
        <li><a href="staffpages/staff" class="dropdown-toggle"><span class="mif-school icon"></span> Students</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/student_profile"><span class="mif-user icon"></span>Student Profile</a></li>
                 <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/edit_student_profile"><span class="mif-user icon"></span>Edit Student Data</a></li>
                
            </ul>
        </li>
        <li><a href="staffpages/staff" class="dropdown-toggle"><span class="mif-my-location icon"></span> School Assets</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/timetable"><span class="mif-event-available icon"></span>Time Table</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/general_upload"><span class="mif-folder-special icon"></span>General Uploads</a></li>
            </ul>
        </li>
       
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>
<?php break; ?>

<?php case "PRINCIPAL | HEADMASTER": ?>
<ul class="v-menu navy">
    <li class="menu-title"><?php echo "Welcome, ".$username." ".$staffid;?><hr /><?php echo $category; ?></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/dashboard"><span class="mif-home icon"></span>Dashboard</a></li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/staff_account_page"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span> Results</a>
            <ul class="d-menu" data-role="dropdown">
               <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/mock_result_view"><span class="mif-keyboard icon"></span>View Mock Result</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/result_view"><span class="mif-keyboard icon"></span>View Result by Term</a></li>
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/broadsheet"><span class="mif-keyboard icon"></span>Broadsheet</a></li>
            </ul>
        </li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-codepen icon"></span> Comments</a>
            <ul class="d-menu" data-role="dropdown">
               
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/insert_principal_comment"><span class="mif-keyboard icon"></span>Principal's Comment</a></li>
<li><a href="http://mtss.schooldrive.com.ng/index.php/staff/insert_principal_comment_mock"><span class="mif-keyboard icon"></span>Principal's Comment Mock</a></li>
            </ul>
        </li>
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/view_teacherslessonnote"><span class="mif-folder-special icon"></span> Lesson Notes</a></li>
        <li><a href="staffpages/staff" class="dropdown-toggle"><span class="mif-my-location icon"></span> School Assets</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/general_upload"><span class="mif-folder-special icon"></span>General Uploads</a></li>
            </ul>
        </li>
       
        <li><a href="http://mtss.schooldrive.com.ng/index.php/staff/logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>

<?php break; } ?>






