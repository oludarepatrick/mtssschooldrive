<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
session_start();
class Student extends CI_Controller{
	var $path_url;
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('download');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('date');
		
		$this->load->helper(array('form', 'url'));
		$this->path_url ='./uploads/';
			$this->load->model('termscore_table');
		$this->load->model('general_model');
		$this->load->model('home_model');
		$this->load->library('session');

// Load database
		$this->load->model('student_model/login_database');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="star">', '</div>');
		$this->form_validation->set_message('is_unique', 'The Username is taken, try another one');
		
	}
		
		
	public function index()
	{
	$data['schinfo']=$this->general_model->schoolinfo();
	//$data['query_class']=$this->general_model->getclasses();
		//$data['query_class_division']=$this->general_model->getclass_division();
	$this->load->view('student/header', $data);
	
	//$this->load->view('admin/dashboard', $data);
	$this->load->view('student/login_form');
	$this->load->view('student/footer');
	
	}

	public function dashboard()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$email_update_check = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$email_update_check = $email_update_check->result();
		if($email_update_check[0]->update_email==0)
		{
			$data['show_update'] = 1;
		}
		$data['username'] = $username;
		$studentdetails = $this->general_model->getstudentclass($username)->result();
		$data['class'] = $studentdetails[0];
		$student = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$data['student'] = $student->result();
			$data['schinfo']=$this->general_model->schoolinfo();
			
			$userPic=base_url()."uploads/perm_upload/student/".$data['student'][0]->student_id.".jpg";
			
			$pathNm=@getimagesize($userPic);
			
			if(!empty($pathNm))
			{
			    $_SESSION['stud_pic']=$userPic;
			}
			else{
			    $_SESSION['stud_pic']=base_url()."stud_dashboard/public/img/mas.png";
			}
			
			
			
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/home',$userPic);
			$this->load->view('student/footer');
	}
	
		public function forgotPassword()
	{
	
			$this->load->view('student/forgotPass');
	}
	
	public function recover_Pass()
	{
	$username = $this->input->post('username');
	
	$recover = $this->db->query("SELECT * FROM student WHERE username='$username'");
	if($recover == FALSE){
	$data['schinfo']=$this->general_model->schoolinfo();	
	$data['message']="No Record Found For the Id";
		$this->load->view('student/header', $data);
		$this->load->view('student/sidebar');
		$this->forgotPassword($data);
			$this->load->view('student/footer');
		}
		else
		{
	
	$username = $this->input->post('username');
	$data['recoverPass']=$this->general_model->recoverPass($username);	
	$data['schinfo']=$this->general_model->schoolinfo();	
	$data['message']="";
		$this->load->view('student/header', $data);
		$this->load->view('student/sidebar');
		$this->forgotPassword($data);
		$this->load->view('student/recoverPass', $data);
			$this->load->view('student/footer');
	
	}
		
	}

public function checkAdminNo_Ajaxp()
	{
		$student_id = $this->input->post('student_id');
		$query = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
		if($query->num_rows()>0)
		{
			echo "Admission No is Valid";
		}
		else
		{
			echo "Admission No is not Valid, Pls check the No.";
		}
	}
	
	public function update_email()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
			$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
			$_student_id = $_student_id->result();
			$student_id = $_student_id[0]->student_id;
		$email = $this->input->post('email');
		$dob = $this->input->post('dob');
		$phone = $this->input->post('phone_number');
		$parent_name= $this->input->post('parent_name');
		$state= $this->input->post('state');
		
		
		$this->db->query("UPDATE student SET email='$email', dob='$dob', update_email='1', phone='$phone', state_of_origin='$state', parent_name='$parent_name' WHERE username='$username' AND student_id='$student_id'");
		redirect('/student/dashboard', 'refresh');
		
	}

	public function view_result()
	{
		if($this->input->post())
		{
			$session_data = $this->session->userdata('logged_in');
			$username= $session_data['username'];
			$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
			$_student_id = $_student_id->result();
			$student_id = $_student_id[0]->student_id;
			$term = $this->input->post('term');
			$session = $this->input->post('session');
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND term='$term' AND session='$session'");
			$result = $result->result();
			$class = $result[0]->class;
			$class_division = $result[0]->class_division;
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['result'] = $result;
			$data['result_details']=[$class, $class_division, $term, $session];
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/view_result');
				$this->load->view('student/footer');
		}
		else
		{
			$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/view_result');
				$this->load->view('student/footer');
		}
	}
public function view_mock()
	{
		if($this->input->post())
		{
			$session_data = $this->session->userdata('logged_in');
			$username= $session_data['username'];
			$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
			$_student_id = $_student_id->result();
			$student_id = $_student_id[0]->student_id;
			$term = $this->input->post('term');
			$session = $this->input->post('session');
			$result = $this->db->query("SELECT * FROM mock WHERE student_id='$student_id' AND term='$term' AND session='$session'");
			$result = $result->result();
			$class = $result[0]->class;
			$class_division = $result[0]->class_division;
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['result'] = $result;
			$data['result_details']=[$class, $class_division, $term, $session];
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/view_mock');
				$this->load->view('student/footer');
		}
		else
		{
			$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/view_mock');
				$this->load->view('student/footer');
		}
	}
	public function downloads()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$_student_id = $_student_id->result();
		$student_id = $_student_id[0]->student_id;
		$class = $_student_id[0]->class;
		$class_division = $_student_id[0]->class_division;
		$general_uploads[0] = $this->db->query("SELECT * FROM general_upload WHERE class='$class' AND class_division='$class_division'");
		$general_uploads[1] = $this->db->query("SELECT * FROM general_upload WHERE class='$class' AND class_division='ALL'");
		$general_uploads[2] = $this->db->query("SELECT * FROM general_upload WHERE class='ALL CLASSES'");
		$uploads = [];
		for($i=0;$i<count($general_uploads);$i++)
		{
			$do = $general_uploads[$i]->result();
			for($j=0;$j<count($do);$j++)
			{
				$uploads[] = $do; 
			}
		}

		$data['uploads'] = $uploads;
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('student/header', $data);
		$this->load->view('student/sidebar');
		$this->load->view('student/downloads');
			$this->load->view('student/footer');
	}

	public function user_login_process() 
	{
	    ob_start();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
		if(isset($this->session->userdata['logged_in'])){
		$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
		$this->load->view('student/home');
			$this->load->view('student/footer');
		}else{
		$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
		$this->load->view('student/login_form');
			$this->load->view('student/footer');
		}
		} else {
		$data = array(
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password')
		);
		$result = $this->login_database->login($data);
		if ($result == TRUE) {

		$username = $this->input->post('username');
		$result = $this->login_database->read_user_information($username);
		//echo "<pre>".print_r($result)."</pre>";
		if ($result != false) {
		$session_data = array(
		'username' => $this->input->post('username'),
		//'email' => $result[0]->email,
		);
		// Add user data in session
		
		//$session_data = $this->session->userdata('logged_in');
		
		/*if(empty($result[0]->email))
		{*/
		    //default email address
		    $new_email=strtolower($result[0]->username)."@driveschool.com.ng";
		/*}
		else{
		    $new_email=$result[0]->email;
		}*/
		
		$session_data = array(
		    'username' => $this->input->post('username'),
		    'email' => $new_email,
		    'student_id' => $result[0]->student_id,
		    'category' => 'student',
		    'stud_tbl_id'=>$result[0]->sn
		);
		$this->session->set_userdata('logged_in', $session_data);
		
		//$this->session->set_userdata('logged_in', $session_data);
		
		$new_phone=!empty($result[0]->phone)?$result[0]->phone:'09000000000';
		/**checking access to login to cbt***/
            $cbt_data=array(
                'name'=>$result[0]->surname.' '.$result[0]->firstname.' '.$result[0]->othername,
                'email'=>$new_email,
                'password'=>$result[0]->password,
                'visible_password'=>$result[0]->password,
                'occupation'=>'Student',
                'address'=>$result[0]->address,
                'phone'=>$new_phone,
                'is_admin'=>0,
                'stud_id'=>$result[0]->sn
            );
            
            
            //echo $result[0]->sn; exit();
            $otherdb = $this->load->database('otherdb', TRUE);
            
            
            $check_if_exist=$otherdb->query("SELECT * FROM users WHERE email='$new_email'");
            
            //echo $check_if_exist->num_rows();
            
            if($check_if_exist->num_rows()==0)
            {
                //echo "hello";
                $owk=$otherdb->insert('users', $cbt_data);
                
                if($owk)
                {
                   //echo $owk;
                   redirect('student/dashboard');
                }
            }
            else{
                //echo "Mash";
                redirect('student/dashboard');
            }
		
		    
		}
		} else {
		$this->session->set_flashdata('warning', 'Invalid Username or Password!');
	$data['schinfo']=$this->general_model->schoolinfo();
redirect('student');
				}
		}
	}

// Logout from admin page
public function logout() {

// Removing session data
$sess_array = array(
'username' => ''
);
$this->session->unset_userdata('logged_in', $sess_array);
$data['message_display'] = 'Successfully Logout';
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('student/header', $data);
$this->load->view('student/login_form', $data);
	$this->load->view('student/footer');
}

	public function gettimetable()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$class = $this->db->query("SELECT class FROM student WHERE username='$username'")->result();
		$class = $class[0]->class;
		$classdivision = $this->db->query("SELECT class_division FROM student WHERE username='$username'")->result();
		$classdivision = $classdivision[0]->class_division;
		$_term = $this->db->query("SELECT * FROM schinfo");
		$_term = $_term->result();
		$term = $_term[0]->term;
		$session = $_term[0]->session;
		$filename = $this->db->query("SELECT filename FROM timetable WHERE class='$class' AND session='$session' AND class_division='$classdivision' AND term='$term'");
		if(!$filename->num_rows()>0)
		{
			echo "TIMETABLE NOT YET UPLOADED!";
			return;
		}
		$filename = $filename->result();
		$filename = $filename[0]->filename;
		$data = file_get_contents("./uploads/timetable/".$filename); // Read the file's contents
		$name = $filename;
		//var_dump($filename);
		force_download($name, $data); 
		
	}

	public function getschemeofwork()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$class = $this->db->query("SELECT class FROM student WHERE username='$username'")->result();
		$class = $class[0]->class;
		$classdivision = $this->db->query("SELECT class_division FROM student WHERE username='$username'")->result();
		$classdivision = $classdivision[0]->class_division;
		$_schinfo = $this->db->query("SELECT * FROM schinfo");
		$_term = $_schinfo->result();
		$term = $_term[0]->term;
		$session = $_term[0]->session;
		$_filename = $this->db->query("SELECT filename FROM scheme WHERE class='$class' AND session='$session' AND class_division='$classdivision' AND term='$term'");
		if(!$_filename->num_rows()>0)
		{
			echo "SCHEME OF WORK NOT YET UPLOADED!";
			return;
		}
		$_filename = $_filename->result();
		$filename = $_filename[0]->filename;
		$data = file_get_contents("./uploads/scheme_of_work/".$filename); // Read the file's contents
		$name = $filename;
		//var_dump($filename);
		force_download($name, $data); 
		
	}

	public function student_profile()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$studentdetails = $this->db->query("SELECT * FROM student WHERE username='$username'")->result();
		$data['studentdetails'] = $studentdetails;
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['studentdetails']=$data['studentdetails'][0];
		$this->load->view('student/header', $data);
		$this->load->view('student/sidebar');
		$this->load->view('student/profile', $data);
			$this->load->view('student/footer');
	}

	public function getResultSessions_Ajax()
	{
		$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$_student_id = $_student_id->result();
		$student_id = $_student_id[0]->student_id;
		$_sessions = $this->db->query("SELECT DISTINCT session FROM termscore WHERE student_id='$student_id'");
		$_sessions = $_sessions->result_array();
		echo json_encode($_sessions);
	}

	public function print_ca()
		{
			$student_id = $this->input->get('student_id');
			$term = $this->input->get('term');
			$session = $this->input->get('session');
			$class = $this->input->get('class');
			$class_division = $this->input->get('class_division');
			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND ca!=0 AND totalscore!=0 ORDER BY subject ASC");
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['result']=$result->result();
 //var_dump($result);
            $mock_date = $this->db->query("SELECT * FROM mock_date WHERE term='$term' AND session='$session'");
	//$data['teachername'] = $teachername->result();
	$data['mock_date'] = $mock_date->result();

           if (preg_match("/\bJSS\b/i", $class))
    		{
    			$grading = $this->db->query("SELECT * FROM mid_grade_junior");
    		}	else if(preg_match("/\bSSS\b/i", $class)) {
    			$grading = $this->db->query("SELECT * FROM mid_grade");
    		} 
    			else
    		{
    			$grading = $this->db->query("SELECT * FROM mid_grade");
				
    		}

             $data['grading'] = $grading->result();
            $key_rating = $this->db->query("SELECT * FROM key_rating");
            $data['key_rating'] = $key_rating->result();

			$this->load->view('staff/print_ca', $data);
		}
   public function print_result()
    {
    	$student_id = $this->input->get('student_id');
    	$term = $this->input->get('term');
    	$session = $this->input->get('session');
    	$class = $this->input->get('class');
    	$class_division = $this->input->get('class_division');
    	$_staff_id = $this->db->query("SELECT * FROM tea_comment WHERE class='$class' AND class_division='$class_division' AND session='$session' AND term='$term'");
    	$_staff_id = $_staff_id->result();
    	$staff_id = $_staff_id[0]->staff_id;
    	$teachername = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
    	$_staff_id = $this->db->query("SELECT * FROM principal_comment WHERE class='$class' AND class_division='$class_division' AND session='$session' AND term='$term'");
    	$_staff_id = $_staff_id->result();
    	$staff_id = $_staff_id[0]->staff_id;
    	$principalname = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
	$data['teachername'] = $teachername->result();
	$data['principalname'] = $principalname->result();
    	switch ($term) {
    		case "FIRST TERM":

    		$result = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

    		$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

    		
    		$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

    		foreach($result->result() as $r)
    		{
    			$get_scores = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!='0' AND subject='$r->subject'");
    			$class_average = $get_scores->result();
    			$i;
    			$ave=0;
    			for($i=0;$i<count($class_average);$i++)
    			{
    				$ave+=$class_average[$i]->totalscore;
    			}
    			$average_score[]=$ave/count($class_average);
    		}

    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'AND totalscore!=0  AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division'")->result());
    		$teacher_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
    		$principal_comment = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
if (preg_match("/\bJSS\b/i", $class))
    		{
    			$grading = $this->db->query("SELECT * FROM grade_junior");
    		}	else if(preg_match("/\bSSS\b/i", $class)) {
    			$grading = $this->db->query("SELECT * FROM grade");
    		} 
    			else
    		{
    			$grading = $this->db->query("SELECT * FROM grade");
    		}
    		$key_rating = $this->db->query("SELECT * FROM key_rating");
    		$data['key_rating'] = $key_rating->result();
    		$data['num_in_class']=$numberinclass;
    		$data['grading'] = $grading->result();
            $data['grading_break'] = $grading;
    		$data['skills_row'] = $skills->num_rows();
    		$data['session']=$session;
    		$data['skills']=$skills->result();
    		$data['student_details']=$student_details->result();
    		$data['tezz']=$tezz;
    		$data['school_settings']=$school_settings->result();
    		$data['teacher_comment']=$teacher_comment->result();
    		$data['principal_comment']=$principal_comment->result();
    		$data['term']=$term;
    		$data['class']=$class;
    		$data['result']=$result->result();
    		$data['average_score']=$average_score;
    		$data['schinfo']=$this->general_model->schoolinfo();
    		$this->load->view('staff/print_result_jun_firstterm', $data);
    		
    		break;
    		case "SECOND TERM":
$no_of_terms = $this->db->query("SELECT DISTINCT term FROM termscore WHERE student_id='$student_id' AND session='$session' AND class='$class' AND term!='THIRD TERM'");
$terms = $no_of_terms->result();
$terms = count($terms);
			$subjects = $this->db->query("SELECT DISTINCT subject FROM termscore WHERE student_id='$student_id' AND term='$term' AND session='$session' AND totalscore!=0");
			$subjects = $subjects->result();
			$var = 0;
			foreach($subjects as $subject)
			{
				$r = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$result[$var] = $r->result()[0];
				$r1 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$first_result[$var] = $r1->result()[0];
				$var++;
			}
    		$result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$first_result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

    		$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

    		$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

    		foreach($result_s->result() as $r)
    		{
    			$get_scores = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='$r->subject'");
    			$class_average = $get_scores->result();
    			$i;
    			$ave=0;
    			for($i=0;$i<count($class_average);$i++)
    			{
    				$ave+=$class_average[$i]->totalscore;
    			}
    			$average_score[]=$ave/count($class_average);
    		}

    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division'")->result());
    		$teacher_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
    		$principal_comment = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
    		if (preg_match("/\bJSS\b/i", $class))
    		{
    			$grading = $this->db->query("SELECT * FROM grade_junior");
    		}	else if(preg_match("/\bSSS\b/i", $class)) {
    			$grading = $this->db->query("SELECT * FROM grade");
    		} 
    			else
    		{
    			$grading = $this->db->query("SELECT * FROM grade");
    		}
    		$key_rating = $this->db->query("SELECT * FROM key_rating");
            $data['num_of_terms'] = $terms;
    		$data['key_rating'] = $key_rating->result();
    		$data['num_in_class']=$numberinclass;
    		$data['grading'] = $grading->result();
            $data['grading_break'] = $grading;
    		$data['session']=$session;
    		$data['first_result']=$first_result;
    		$data['skills']=$skills->result();
    		$data['skills_row'] = $skills->num_rows();
    		$data['student_details']=$student_details->result();
    		$data['tezz']=$tezz;
    		$data['school_settings']=$school_settings->result();
    		$data['teacher_comment']=$teacher_comment->result();
    		$data['principal_comment']=$principal_comment->result();
    		$data['term']=$term;
    		$data['class']=$class;
    		$data['result']=$result;
    		$data['average_score']=$average_score;
    		$data['schinfo']=$this->general_model->schoolinfo();
    		$this->load->view('staff/print_result_jun_secondterm', $data);
    		
    		break;
    		case "THIRD TERM":
$no_of_terms = $this->db->query("SELECT DISTINCT term FROM termscore WHERE student_id='$student_id' AND session='$session' AND class='$class'");
$terms = $no_of_terms->result();
$terms = count($terms);
			$subjects = $this->db->query("SELECT DISTINCT subject FROM termscore WHERE student_id='$student_id' AND term='$term' AND session='$session' AND totalscore!=0 ORDER BY subject ASC");
			$subjects = $subjects->result();
			$var = 0;
			foreach($subjects as $subject)
			{
				$r = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$result[$var] = $r->result()[0];
				$r1 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$first_result[$var] = $r1->result()[0];
				$r2 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='SECOND TERM' AND session='$session' AND totalscore!='0' AND class_division='$class_division' AND subject='$subject->subject'  ORDER BY subject ASC");
				$second_result[$var] = $r2->result()[0];
				$var++;
			}
    		$result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$first_result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division'  ORDER BY subject ASC");

    		$second_result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='SECOND TERM' AND session='$session' AND totalscore!='0' AND class_division='$class_division'  ORDER BY subject ASC");
	
    		$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

    		$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

    		$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

    		foreach($result_s->result() as $r)
    		{
    			$get_scores = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$r->subject'");
    			$class_average = $get_scores->result();
    			$i;
    			$ave=0;
    			for($i=0;$i<count($class_average);$i++)
    			{
    				$ave+=$class_average[$i]->totalscore;
    			}
    			$average_score[]=$ave/count($class_average);
    		}

    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division'")->result());
    		$teacher_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
    		$principal_comment = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");
    		if (preg_match("/\bJSS\b/i", $class))
    		{
    			$grading = $this->db->query("SELECT * FROM grade_junior");
    		}	else if(preg_match("/\bSSS\b/i", $class)) {
    			$grading = $this->db->query("SELECT * FROM grade");
    		} 
    			else
    		{
    			$grading = $this->db->query("SELECT * FROM grade");
    		}
    		$key_rating = $this->db->query("SELECT * FROM key_rating");
$data['num_of_terms'] = $terms;
    		$data['key_rating'] = $key_rating->result();
    		$data['num_in_class']=$numberinclass;
    		$data['grading'] = $grading->result();
            $data['grading_break'] = $grading;
    		$data['session']=$session;
    		$data['first_result']=$first_result;
    		$data['second_result']=$second_result;
    		$data['skills']=$skills->result();
    		$data['skills_row'] = $skills->num_rows();
    		$data['student_details']=$student_details->result();
    		$data['tezz']=$tezz;
    		$data['school_settings']=$school_settings->result();
    		$data['teacher_comment']=$teacher_comment->result();
    		$data['principal_comment']=$principal_comment->result();
    		$data['term']=$term;
    		$data['class']=$class;
    		$data['result']=$result;
    		$data['average_score']=$average_score;
    		$data['schinfo']=$this->general_model->schoolinfo();
    		$this->load->view('staff/print_result_jun_thirdterm', $data);
    		
    		break;
    		default:
    		echo $term.$session.$class.$class_division.$student_id;

    	}
    }
public function sign_up()
	{
	if($this->input->post()){
	        $student_id= $this->input->post('adminno');
			$pincode= $this->input->post('pincode');
			$username= $this->input->post('username');
			$password= $this->input->post('password');
			$data2=array(
						'username'=>trim($username),
						'password'=>trim($password)
						);
		$this->db->where('student_id', $student_id);
		$this->db->update('student', $data2);	 	  
						  
			$data1=array(
						'student_id'=>trim($student_id),
						'username'=>trim($username),
						'password'=>trim($password)
					 	  );
		$this->db->where('student_id', $student_id);
		$this->db->update('pin', $data1);
		$this->session->set_flashdata('message', 'Username and Password Successfully Created. Please Login with your new Username and Password');	
		redirect('student');
		}
		else
		{  
		$data['schinfo']=$this->general_model->schoolinfo();
		//$data['studentdetails']=$data['studentdetails'][0];
		$this->load->view('student/header', $data);
		$this->load->view('student/create_new_logindetails', $data);
			$this->load->view('student/footer');
	}
	}
        public function activate_pinform()
       {
         $this->session->set_userdata('my_id', $session_data);
		
		$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
			$this->load->view('student/activate_pin_form', $data);
        }
		public function activate_pin()
	{
		
		$student_id= $this->input->post('adminno');
		$pincode= $this->input->post('pincode');
		$result = $this->db->query("SELECT * FROM pin WHERE pincodes='$pincode'");
    	
    	if($result->num_rows()<0)
		{
			$data = $result->result();
			$student_id= $this->input->post('adminno');
			$pincode= $this->input->post('pincode');
			$data1=array(
						'student_id'=>trim($student_id)
					 
					  );
				$this->db->where('pincodes', $pincode);
				$this->db->update('pin', $data1);
			$session_data = array(
		'student_id' => $this->input->post('student_id'),
		//'email' => $result[0]->email,
		);
		// Add user data in session
		$this->session->set_userdata('my_id', $session_data);
		
		//Check if student has username and password
		$student = $this->db->query("SELECT * FROM student where student_id='$student_id' AND username!='' AND password!=''");
		if($student->num_rows() > 0) {
			$this->session->set_flashdata('message', 'You have been activated, you can now log in using your username and password');
			redirect('student');
		}
		
		$data['schinfo']=$this->general_model->schoolinfo();
			//$this->load->view('student/header', $data);
			//$this->load->view('student/create_new_logindetails', $data);
		redirect('student/sign_up');
		}
		else
		{
		$this->session->set_flashdata('message', 'Pincode Does not Exist, Check and Try Again!');
		//$data = array('error_message' => 'Invalid Pincode');
			$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('student/header', $data);
			$this->load->view('student/activate_pin_form', $data);
				$this->load->view('student/footer');
		}
		
}

public function checkAdminNo_Ajax()
	{
		$student_id = $this->input->post('student_id');
		$query = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
		if($query->num_rows()>0)
		{
			echo "Admission No is Valid";
		}
		else
		{
			echo "Admission No is not Valid, Pls check the No.";
		}
	}
	public function checkAdminNoActivation_Ajax()
	{
		$student_id = $this->input->post('student_id');
		$query = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
		if($query->num_rows()>0)
		{
			echo "Admission No is Valid";
		}
		else
		{
			echo "No Student Exist for this Admission No.";
		}
	}
	
public function checkUsername_Ajax()
	{
		$username = $this->input->post('username');
		$query = $this->db->query("SELECT * FROM student WHERE username='$username'");
		if($query->num_rows()>0)
		{
			echo "Username Already Exist, Choose Another One";
		}
		else
		{
			echo "Username is available";
		}
	}

public function mock_result_view()
        {
	        if($this->input->post())
	        	{
	        	$class = $this->input->post('class');
	        	$class_division = $this->input->post('class_division');
	        	$term = $this->input->post('term');
	        	$session = $this->input->post('session');
	        	$result_check = $this->db->query("SELECT * FROM mock WHERE class='$class'");
	        	if($result_check->num_rows==0)
	        	{
	        		$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
					redirect('student/mock_result_view');
					return;
	        	}
	        	$students = $this->db->query("SELECT DISTINCT student_id FROM mock WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
if($students->num_rows()>0) {
	        	$students = $students->result();
	        	$result;
	        	$i = 0;
	        	foreach($students as $student)
	        	{
	        		$result[$i] = $this->db->query("SELECT * FROM mock WHERE student_id='$student->student_id' AND session='$session' AND class='$class' AND term='$term' AND class_division='$class_division'")->result();
	        		$i++;
	        	}
	        	$data['results']=$result;
	        	$data['result_details']=[$class, $class_division, $term, $session];
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('student/sidebar');
				$this->load->view('student/view_mock', $data);
					$this->load->view('student/footer');
			}else {
			$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
			redirect('student/mock_result_view');
			}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('student/sidebar');
				$this->load->view('student/view_mock', $data);
					$this->load->view('student/footer');
			}
    }
    public function print_mock_result()
    {
    	$student_id = $this->input->get('student_id');
    	$session = $this->input->get('session');
    	$class = $this->input->get('class');
    	$class_division = $this->input->get('class_division');
        $term = $this->input->get('term');
    	$schinfo = $this->db->query("SELECT term FROM schinfo")->result();
    	//$term = $schinfo[0]->term;
    	$_staff_id = $this->db->query("SELECT * FROM tea_comment WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session' ORDER BY term LIMIT 1");
    	$_staff_id = $_staff_id->result();
    	$staff_id = $_staff_id[0]->staff_id;
    	$teachername = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
    	$_staff_id = $this->db->query("SELECT * FROM principal_comment WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
    	$_staff_id = $_staff_id->result();
    	$staff_id = $_staff_id[0]->staff_id;
    	$principalname = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
	$data['teachername'] = $teachername->result();
	$data['principalname'] = $principalname->result();
    $result = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, exam, session  FROM mock WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND exam!=0 AND class_division='$class_division' ORDER BY subject ASC");

            $school_settings = $this->db->query("SELECT * FROM settings WHERE session='$session'");


            $student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
            //var_dump($result);

            foreach($result->result() as $r)
            {
                $get_scores = $this->db->query("SELECT * FROM mock WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND exam!='0' AND subject='$r->subject'");
                $class_average = $get_scores->result();
                $i;
                $ave=0;
                for($i=0;$i<count($class_average);$i++)
                {
                    $ave+=$class_average[$i]->totalscore;
                }
                $average_score[]=$ave/count($class_average);
            }


            //$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'AND totalscore!=0  AND subject='COMPUTER'");
            $numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division'")->result());
            $teacher_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND class='$class' AND session='$session' AND term='$term' AND class_division='$class_division' ORDER BY term LIMIT 1");
            $principal_comment = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND class='$class' AND session='$session' AND term='$term' AND class_division='$class_division' ORDER BY term LIMIT 1");
if (preg_match("/\bJSS\b/i", $class))
            {
                $grading = $this->db->query("SELECT * FROM grade_junior");
            }   else if(preg_match("/\bSSS\b/i", $class)) {
                $grading = $this->db->query("SELECT * FROM grade");
            }
                else
            {
                $grading = $this->db->query("SELECT * FROM grade");
            }
            $key_rating = $this->db->query("SELECT * FROM key_rating");
            $date_sign = $this->db->query("SELECT * FROM mock_date WHERE term='$term' AND session='$session'");
            $data['date_sign'] = $date_sign->result();
            $data['key_rating'] = $key_rating->result();
            $data['num_in_class']=$numberinclass;
            $data['grading'] = $grading->result();
            $data['session']=$session;
            $data['student_details']=$student_details->result();
            $data['tezz']=$tezz;
            $data['school_settings']=$school_settings->result();
            $data['teacher_comment']=$teacher_comment->result();
            $data['principal_comment']=$principal_comment->result();
            $data['term']=$term;
            $data['class']=$class;
            $data['result']=$result->result();
            $data['average_score']=$average_score;
            $data['schinfo']=$this->general_model->schoolinfo();
            $this->load->view('staff/print_mock_result_jun', $data);

}
public function getSessionsMock_Ajax()
        {
        	$query = $this->db->query("SELECT DISTINCT session FROM mock");
        	echo json_encode($query->result_array());
        }
public function getTermMock_Ajax()
        {
        	$query = $this->db->query("SELECT DISTINCT term FROM mock");
        	echo json_encode($query->result_array());
        }
        
        /**image Upload**/
        public function uploadStudentImage_Ajax()
	{
		$student_id = $this->input->post('student_id');
			$config['upload_path'] = './uploads/perm_upload/student';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size']	= '4069';
			$config['file_name'] = $student_id;
			$config['width'] = 150;
			$config['height'] = 150;
			$config['overwrite'] = TRUE;
		
			$this->load->library('upload', $config);
            
			if (!$this->upload->do_upload())
			{
				//echo "An error occured!";
				echo $this->upload->display_errors();
			}
			else
			{	
			    $data = array('upload_data' => $this->upload->data());
			    
			    //var_dump($data);
			    
			    $myFileType=strtolower($data["upload_data"]['file_ext']);
			    if($myFileType !='.jpg' and $myFileType !='.jpeg')
			    {
			        echo "Inavlid File Type, (file type must be jpg)";
			    }
			    else{
				
				$this->resizeImage($data["upload_data"]['file_name']);
				
				$filename = $student_id.$myFileType;
				$img_url = '/uploads/perm_upload/student/'.$filename;
				
				$query = $this->db->query("UPDATE student SET image_url='$img_url' WHERE student_id='$student_id'");
				
				echo "UPLOAD SUCCESSFUL";
				//echo "count ".$this->db->affected_rows();
				
			    }
			}
	}
	
	/*image resizer**/
	public function resizeImage($filename)
	{
		//$source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
		//$target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
		$source_path = './uploads/perm_upload/student/' . $filename;
		$target_path = './uploads/perm_upload/student/thumbnail/';
		
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '_thumb',
			'width' => 150,
			'height' => 150

		);


		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
		
		$this->image_lib->clear();
	}
	/******image resizer end**/
	
	public function student_profile_update()
	{
	    $session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$email_update_check = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$email_update_check = $email_update_check->result();
		if($email_update_check[0]->update_email==0)
		{
			$data['show_update'] = 1;
		}
		$data['username'] = $username;
		$studentdetails = $this->general_model->getstudentclass($username)->result();
		$data['class'] = $studentdetails[0];
		$student = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$data['student'] = $student->result();
			$data['schinfo']=$this->general_model->schoolinfo();
			
			$userPic=base_url()."uploads/perm_upload/student/".$data['student'][0]->student_id.".jpg";
			
			$pathNm=@getimagesize($userPic);
			
			if(!empty($pathNm))
			{
			    $_SESSION['stud_pic']=$userPic;
			}
			else{
			    $_SESSION['stud_pic']=base_url()."stud_dashboard/public/img/mas.png";
			}
			
			
			
			$this->load->view('student/header', $data);
			$this->load->view('student/sidebar');
			$this->load->view('student/profile_update');
			$this->load->view('student/footer');
	}
}
