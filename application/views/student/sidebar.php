<?php

    ////////////////////////////////////////////////////////////
    $id = $this->session->userdata('userID');
    $user = $this->session->userdata('username');
    
    //echo $user, $id;
    //$this->load->library('database');
    $query = $this->db->get_where('student',array('student_id'=>$id,"username"=>$user))->row_array();
    
    
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
$studentid = ($this->session->userdata['logged_in']['student_id']);
$email = ($this->session->userdata['logged_in']['email']);
$category = ($this->session->userdata['logged_in']['category']);
} else {
$this->session->set_flashdata('message', 'Please Login to use the application!');
            redirect('student');

}
?>


    <ul class="v-menu navy">
        <li class="menu-title"><?php echo "Welcome, ".$username." ".$studentid;?><hr /><?php echo $category; ?></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/dashboard"><span class="mif-home icon fg-wine"></span>Dashboard</a></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/student_profile"><span class="mif-user icon"></span>My Account</a></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/student_profile_update"><span class="mif-user icon"></span>Update Profile</a></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/view_result"><span class="mif-school icon"></span> View Result</a></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/view_mock"><span class="mif-school icon"></span> View Mock Result</a></li>
        <li><a href="#" class="dropdown-toggle"><span class="mif-keyboard icon"></span>CBT</a>
            <ul class="d-menu" data-role="dropdown">
               <!--<li><a href="https://cbt.schooldriveng.com/checkpoint/<?php echo base64_encode($email); ?>"><span class="mif-school icon"></span>Take CBT Exam</a></li>-->
               <li><a href="https://mtss.schooldriveng.com/stud_dashboard/home/login/<?php echo base64_encode($email); ?>"><span class="mif-school icon"></span>Take CBT Exam</a></li>
               <li><a href="javascript:;" onClick="alert('page is under construction')"><span class="mif-school icon"></span>Take CBT Demo</a></li>
                <li><a href="http://mtss.schooldriveng.com/index.php/cbt/history"><span class="mif-keyboard icon"></span>View CBT Result</a></li>
            </ul>
        </li>

        <li><a href="http://mtss.schooldriveng.com/index.php/student/downloads"><span class="mif-school icon"></span> Downloads</a></li>
        <li><a href="http://mtss.schooldriveng.com/index.php/student/logout"><span class="mif-exit icon"></span>Logout</a></li>
</ul>

