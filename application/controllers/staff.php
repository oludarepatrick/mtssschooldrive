<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
session_start();
class Staff extends CI_Controller{
	var $path_url;
	public function __construct(){
		parent::__construct();
		parse_str($_SERVER['QUERY_STRING'],$_GET);
		
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
		$this->load->model('staff_model/login_database');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="star">', '</div>');
		$this->form_validation->set_message('is_unique', 'The Username is taken, try another one');
		
	}
		
		
	public function index(){
	    
	    //$results = $this->login_database->getAll();
	   //echo "<pre>"; print_r($results); echo "</pre>";
	$data['schinfo']=$this->general_model->schoolinfo();
	//$data['query_class']=$this->general_model->getclasses();
		//$data['query_class_division']=$this->general_model->getclass_division();
	$this->load->view('staff/header', $data);
	//$this->load->view('staff/sidebar_staff');
	//$this->load->view('admin/dashboard', $data);
	$this->load->view('staff/login_form');
	$this->load->view('staff/footer');
	
}
public function staff_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('staff/header', $data);
$this->load->view('staff/staff_page');
$this->load->view('staff/footer');
}else{
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('staff/header', $data);
$this->load->view('staff/login_form');
$this->load->view('staff/footer');
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
if ($result != false) {
$session_data = array(
'username' => $result[0]->username,
'staff_id' => $result[0]->staff_id,
'email' => $result[0]->email,
'category'=> $result[0]->category,
);
$this->session->set_userdata('logged_in', $session_data);

/**checking access to login to cbt***/
$cbt_data=array(
    'name'=>$result[0]->name,
    'email'=>$result[0]->email,
    'password'=>$result[0]->password,
    'visible_password'=>$result[0]->password,
    'occupation'=>'Staff',
    'address'=>'Nil',
    'phone'=>$result[0]->phone,
    'is_admin'=>1
);

$cbtEmail=$result[0]->email;

$otherdb = $this->load->database('otherdb', TRUE);

/*`id`, `name`, `email`, `email_verified_at`, `password`, `visible_password`, `occupation`, `address`, `phone`, `is_admin`, `remember_token`, `created_at`, `updated_at`*/

$check_if_exist=$otherdb->query("SELECT * FROM users WHERE email='$cbtEmail'");

if($check_if_exist->num_rows()==0)
{
    $otherdb->insert('users', $cbt_data);
}

/**end access to cbt**/

$data['schinfo']=$this->general_model->schoolinfo();

	 
        $data['query_class']=$this->general_model->getclasses();
	$data['query_teacher']=$this->general_model->get_teachers();
	$data['query_class_division']=$this->general_model->getclass_division();
	$data['all_student']=$this->general_model->all_student();
	redirect('staff/dashboard');
}
} else {
$this->session->set_flashdata('warning', 'Invalid Username or Password!');
	$data['schinfo']=$this->general_model->schoolinfo();
redirect('staff');
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
/*$data['message_display'] = 'Successfully Logout';
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('staff/header', $data);
$this->load->view('staff/login_form', $data);*/
redirect('staff'); 
}
public function dashboard(){
	$schinfo = $this->db->query("SELECT * FROM schinfo");
	$schinfo = $schinfo->result();
	$session = $schinfo[0]->session;
	$term = $schinfo[0]->term;
	$session_data = $this->session->userdata('logged_in');
	$staff_id = $session_data['staff_id'];
	$category = $session_data['category'];
	$_class = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
	$_class = $_class->result();
	$class = $_class[0]->class;
	$class_division=$_class[0]->class_arm;
	if($category=="PRINCIPAL | HEADMASTER")
	{
		$students = $this->db->query("SELECT * FROM student WHERE session='$session' AND status='ACTIVE'");
	}
	else
	{
		$students = $this->db->query("SELECT * FROM student WHERE class='$class' AND session='$session' AND class_division='$class_division' AND status='ACTIVE'");
	}
	$students = $students->result();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_class']=$this->general_model->getclasses();
	$data['query_teacher']=$this->general_model->get_teachers();
		$data['query_class_division']=$this->general_model->getclass_division();
		$data['all_student']=$students;
	$this->load->view('staff/header', $data);
	$this->load->view('staff/sidebar_staff');
	$this->load->view('admin/dashboard', $data);
	$this->load->view('staff/footer');
	}
public function login()
{

	/*$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	if($this->form_validation->run()== false)
	{
		$this->load->view('app_login');
	}
	else
	{
		redirect('home', 'refresh');
	}*/
	$username = $_POST['user_login'];
	$password = $_POST['user_password'];
	$query = $this->general_model->get_by(array('username' =>"$username", 'password' => "$password"), NULL, TRUE);

	if($query->num_rows == 1)
	{
	$row = $query->row();
	$data = array(
				 // 'staff_id' => $row->staff_id,
				  'username' => $row->username,
				  'password' => $row->password
				  );
	//$this->session->set_userdata('username', $_POST['username']);
	$this->session->set_userdata($data);
	return true;
	}
}


public function check_database($password)
{
	$username = $this->input->post('username');
	$result = $this->general_model->login($username, $password);
	if($result)
	{
		$sess_array = array();
		foreach($result as $row)
		{
			$sess_array = array(
								'staff_id' =>$row->id,
								'username' =>$row->username
			                     );
						$this->session->set_userdata('logged_in',$sess_array);	
						}
						return true	;
						}
						else
						{
						$this->form_validation->set_message('check_database', 'Invalid Username or password');
						return false;
						}
						} 
						
	

public function home()
{
	if($this->session->userdata('logged_in'))
	{
		$session_data = $this->session->userdata('logged_in');
		$data['username']= $session_data['username'];
		$this->load->view('home_view', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
}

public function do_upload()
{
	$config['upload_path']='./uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1024';
		$config['max_width']  = '200';
		$config['max_height']  = '200';
		$config['file_name']  = '';
		$config['overwrite']  = true;
$this->load->library('upload', $config);
$field_name = "userfile";
if ( !$this->upload->do_upload())
			{		
				die(json_encode(array( //,
						'status'=>'fail',
						'error' => $this->upload->display_errors()
						)));
			}else{	
			$data =  $this->upload->data();
				$config = array(
							
							'source_image'=>$data['full_path'],
							'maintain_ratio'=>true,
							'width'=> '150',
							'height'=>'150',
		
				);
				$this->load->library('image_lib', $config);
				if($data['image_width']> 150 || $data['image_height']> 150){
				$this->image_lib->resize();	
					}
					$image = explode('.',$data['file_name']);
				$ext = $image[1];
				$image_file = $data['file_name'];
					if (file_exists($data['full_path'])) {//$path_temp.'/'.$image_file
										$path_url ='./uploads/';
   						if(rename($path_url.'/'.$image_file, $path_url.'/school_logo'.".".$ext)){
							$url = 'uploads/school_logo'.".".$ext;
							
							$image_upload = array('logo_url' =>$url);
							
							$is_there = $this->db->get('schinfo');
							if($is_there->num_rows()>0){
								$this->db->update('schinfo',$image_upload);		
				
				/*die(json_encode(array(
						'filename'=>$data['file_name'],
						'filepath'=>$data['file_path'],
						'status'=>'success',
						'message'=> "<img src='staff/&quot;.$this-&gt;path_url.&quot;/&quot;.$data['file_name']."'  class='preview' width='200' height='200'>")));
						*/
						die(json_encode(array(
								'status'=>'success',
								'message'=> "<img src='staff/&quot;.$this-&gt;path_url.&quot;/school_logo.&quot;.$ext.&quot;'  class='preview' width='110' height='150'>")));
						}
						else{
								
								die(json_encode(array(
									'status'=>'fail',
									'error'=> "Operation Fail: You have to enter School Information before uploading"))
									);
										
							}
							}
							}
						
				$this->image_lib->clear();
				}
				}

		/*if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('staff/header');
	$this->load->view('staff/sidebar_staff');
			$this->load->view('school_logo', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}*/
	

public function insert_comment()
	{

	$data['message']='';
	$data['comments'] = $this->general_model->get_comment();
	$type = $this->input->post('comment_category');
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
	$this->load->view('admin/comment_form', $data);
	$this->load->view('staff/footer');
	switch($type){
			case "PRINCIPAL" : $comment = $this->input->post('comment');
		$data = array(
						'principal_comment'=>strtoupper(trim($comment))
						);
						$query = $this->db->get_where('comment_bank',array('principal_comment ='=>""));
						if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['comment_id'];
										$this->db->update('comment_bank',$data, array('comment_id'=>$id));
									}else{
						$this->db->insert('comment_bank', $data);
						
						$data['message'] = " Comment Inserted Successfully!!!.";
							//$this->load->view('admin/comment_form',$data);
							break;
		/*case "TEACHER" :$comment = $this->input->post('comment');
		$data = array(
						'teacher_comment'=>strtoupper(trim($comment))
						);
						$query = $this->db->get_where('comment_bank',array('teacher_comment ='=>""));
						if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['comment_id'];
										$this->db->update('comment_bank',$data, array('comment_id'=>$id));
									}else{
						$this->db->insert('comment_bank', $data);
						}
						$data['message'] = " Comment Inserted Successfully!!!.";
							//$this->load->view('staff/header');
							//$this->load->view('staff/sidebar_staff');
							//$this->load->view('admin/teachers_comment',$data);
							break;*/
				}
							
		}					
	}
	public function insert_teacher_comment()
	{
	$type = $this->input->post('comment_category');
	$comment = $this->input->post('comment');

	$data['message']='';
	$data['comments'] = $this->general_model->get_comment();
	$data['schinfo']=$this->general_model->schoolinfo();
	

	
	$this->load->view('staff/header', $data);
	$this->load->view('staff/sidebar_staff');
	$this->load->view('staff/teachers_comment', $data);
	$this->load->view('staff/footer');
							
	}
	
	public function student_registration()
	{
		if($this->form_validation->run('student_register') == FALSE){
		$data['sucess']="";
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_house']=$this->general_model->gethouse();
		$data['query_class']=$this->general_model->getclasses();
		$data['query_class_division']=$this->general_model->getclass_division();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/student_registration',$data);
		$this->load->view('staff/footer');
		}
		else
		{
			$surname = $this->input->post('surname');
			$fname = $this->input->post('fname');
			$othername = $this->input->post('othername');
			$gender = $this->input->post('gender');
			$class = $this->input->post('class');
			$class_arm = $this->input->post('class_arm');
			$term = $this->input->post('term');
			$adminno = $this->input->post('adminno');
			$house = $this->input->post('house');
			$date_admission = $this->input->post('date_admission');
			$last_school = $this->input->post('last_school');
			$last_class = $this->input->post('last_class');
			$dob = $this->input->post('dob');
			$state = $this->input->post('state');
			$nationality = $this->input->post('nationality');
			$religion = $this->input->post('religion');
			$blood_group = $this->input->post('blood_group');
			$genotype = $this->input->post('genotype');
			$parent_surname = $this->input->post('parent_surname');
			$initial = $this->input->post('initial');
			$title = $this->input->post('title');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state2 = $this->input->post('state2');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$occupation = $this->input->post('occupation');
		$data1= array(
					  'student_id'=>trim($adminno),
					  'surname'=>strtoupper(trim($surname)),
					  'firstname'=>strtoupper(trim($fname)),
					  'othername'=>strtoupper(trim($othername)),
					  'sex'=>strtoupper(trim($gender)),
					  'state'=>ucwords(trim($state)),
					  'state_of_origin'=>ucwords(trim($state2)),
					  'religion'=>strtoupper(trim($religion)),
					  'city'=>ucwords(trim($city)),
					  'dob'=>trim($dob),
					  'house'=>strtoupper(trim($house)),
					  'class'=>strtoupper(trim($class)),
					  'class_division'=>strtoupper(trim($class_arm)),
					  'address'=>ucwords(trim($address)),
					  'phone'=>trim($phone),
					  'blood_grp'=>trim($blood_group),
					  'date_admitted'=>trim($date_admission),
					  'last_school'=>ucwords(trim($last_school)),
					  'last_class'=>strtoupper(trim($last_class)),
					  'genotype'=>trim($genotype)
					  			  
					  );
					  $this->db->insert('parent', $data1);
		$data2= array(
					  'student_id'=>trim($adminno),
					  'parent_name'=>strtoupper(trim($parent_name)),
					  'phone'=>strtoupper(trim($phone)),
					  'email'=>strtoupper(trim($email)),
					  'occupation'=>strtoupper(trim($occupation))
					  );
		$this->db->insert('student', $data2);
	  $data['message'] = "Receipt Registered Successfully!!!.";
	  $data['query_house']=$this->general_model->gethouse();
		$data['query_class']=$this->general_model->getclasses();
		$data['query_class_division']=$this->general_model->getclass_division();
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/student_registration',$data);
		$this->load->view('staff/footer');
		}
	}

	public function school_details()
	{
	
	if($this->form_validation->run('registration') == FALSE){
	$data['sucess']="";
		$data['schinfo']=$this->general_model->getschinfo();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/schooldetailsform', $data);
		$this->load->view('staff/footer');
	}	
	else{
	$name = $this->input->post('schname');
	$schmotto = $this->input->post('schmotto');
	$address = $this->input->post('address');
	$postal = $this->input->post('postal');
	$email = $this->input->post('email');
	$website = $this->input->post('website');
	$phone = $this->input->post('phone');
	$schlevel = $this->input->post('schlevel');
	$junsenior = $this->input->post('junsenior');
	$data = array(
				'name'=>strtoupper(trim($name)),
				'slogan'=>strtoupper(trim($schmotto)),
				'address'=>ucwords(trim($address)),
				'postal_add'=>ucwords(trim($postal)),
				'email'=>strtolower(trim($email)),
				'web_add'=>strtolower(trim($website)),
				'phone'=>strtolower(trim($phone)),
				'level'=>(trim($schlevel)),
				'separate_ca_exam'=>trim($junsenior)
				);
				$this->db->update('schinfo', $data);
				$data['schinfo']=$this->general_model->getschinfo();
	  $data['sucess'] = "Settings Updated Successfully!";
	  $data['schinfo']=$this->general_model->schoolinfo();
	  $this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/schooldetailsform', $data);
		//echo success;
		$this->load->view('staff/footer');
	}
	}
	public function staff_registration()
	{
$data['schinfo']=$this->general_model->schoolinfo();
	if($this->form_validation->run('staff_registration') == FALSE){
	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_classes']=$this->general_model->getclasses();
		$data['query_subjects']=$this->general_model->getsubjects();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/staff_registration', $data);
		$this->load->view('staff/footer');
		}
		else
		{
			$surname= $this->input->post('surname');
			$fname= $this->input->post('fname');
			$username= $this->input->post('username');
			$phone= $this->input->post('phone');
			$email= $this->input->post('email');
			$staff_cat = $this->input->post('staff_cat');
			$classes = $this->input->post('classes');
		
		}
	}
	public function comment_store()
	{
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/comment_form');
		$this->load->view('staff/footer');
	}
	public function result_session()
	{
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['message']="";
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/result_session_query', $data);
		$this->load->view('staff/footer');
	}
	public function query_result_term()
	{
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_class']=$this->general_model->getclasses();
	$data['message']="";
		//$this->load->view('staff/header');
		//$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/result_term_query', $data);
		$this->load->view('staff/footer');
		
	}
	
	
	
	public function result_term()
	{
	$this->form_validation->set_rules('classes', 'Class', 'required');
	$this->form_validation->set_rules('class_arm', 'Class Arm', 'required');
	$this->form_validation->set_rules('class_arm', 'Term', 'required');
	$this->form_validation->set_rules('session', 'Academic Session', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['message']="No Record Found for The Selected Options, Try Again!!!";
		$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result'] = $this->general_model->select_student_result_all($classes, $class_arm, $term, $session);
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
			$this->query_result_term($data);
			$this->load->view('staff/footer');
		}
		else
		{
	$data['message']="";
	$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result1']= $this->general_model->select_student_id($classes, $class_arm, $term, $session, $studentid);
	//$data['query_result']= $this->general_model->select_student_result_id($classes, $class_arm, $term, $session, $studentid);
	
	$data['query_result'] = $this->general_model->select_student_result_all($classes, $class_arm, $term, $session);
	//$data['query_term'] = $this->general_model->select_class_broadsheet($classes, $class_arm, $term, $session);
		//$data['query_student']=$this->general_model->get_students($classes,$class_arm,$session);
		//$total = count($id);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_result_term();
		$this->load->view('admin/result_view', $data);
		$this->load->view('staff/footer');
		}
		}
	
	public function result_term2()
	{
	$this->form_validation->set_rules('classes', 'Class', 'required');
	$this->form_validation->set_rules('class_arm', 'Class Arm', 'required');
	$this->form_validation->set_rules('class_arm', 'Term', 'required');
	$this->form_validation->set_rules('session', 'Academic Session', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['message']="No Record Found for The Selected Options, Try Again!!!";
		$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result'] = $this->general_model->select_student_result_all($classes, $class_arm, $term, $session);
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
			$this->query_result_term($data);
			$this->load->view('staff/footer');
		}
		else
		{
	$data['message']="";
	$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result1']= $this->general_model->select_student_id($classes, $class_arm, $term, $session, $studentid);
	$data['query_result']= $this->general_model->select_student_result_id($classes, $class_arm, $term, $session, $studentid);
	//$data['query_result'] = $this->general_model->select_student_result_all($classes, $class_arm, $term, $session);
	//$data['query_term'] = $this->general_model->select_class_broadsheet($classes, $class_arm, $term, $session);
		//$data['query_student']=$this->general_model->get_students($classes,$class_arm,$session);
		//$total = count($id);
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
		$this->load->view('staff/footer');
		}
		}
	
	public function result_term1()
	{
	$this->form_validation->set_rules('classes', 'Class', 'required');
	$this->form_validation->set_rules('class_arm', 'Class Arm', 'required');
	$this->form_validation->set_rules('class_arm', 'Term', 'required');
	$this->form_validation->set_rules('session', 'Academic Session', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['message']="No Record Found for The Selected Options, Try Again!!!";
		$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result'] = $this->general_model->select_student_result_id($classes, $class_arm, $term, $session, $studentid);
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
			$this->query_result_term($data);
			$this->load->view('staff/footer');
		}
		else
		{
	$data['message']="";
	$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result'] = $this->general_model->select_student_result_id($classes, $class_arm, $term, $session,$studentid);
	//$data['query_term'] = $this->general_model->select_class_broadsheet($classes, $class_arm, $term, $session);
		//$data['query_student']=$this->general_model->get_students($classes,$class_arm,$session);
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
		$this->load->view('staff/footer');
		}
		if($this->input->post('all_students') && $this->input->post('all_students')=="ALL" ){
		$data['message']="";
	$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$studentid=$this->input->post('stud_id');
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_result'] = $this->general_model->select_student_result_all($classes, $class_arm, $term, $session);
	$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
		$this->load->view('staff/footer');
	
	/*else
	{
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->query_result_term();
		//$this->load->view('admin/result_breakdown', $data);
	}*/
	
	}
	}
	public function class_entry()
	{
		$this->load->view('admin/class_entry');
}
	public function ajax_class_form()
	{
	$class_entry = $this->input->post('enter_class');
		$data = array(
						'class'=>strtoupper(trim($class_entry))
						);
						$query = $this->db->get_where('classes',array('class ='=>""));
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('classes',$data, array('id'=>$id));
									}else{
						$this->db->insert('classes', $data);
						}
	}
	
	public function class_form()
	{
	
			//$data['message1'] = " Enter Class Before Saving!!!.";
						
		$data['query_subject']=$this->general_model->getsubjects();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		$this->load->view('staff/footer');
	
	}
	
	public function class_form1()
	{
	$this->form_validation->set_rules('enter_class', 'Class', 'required');
	if ($this->form_validation->run() == FALSE)
	{
			//$data['message1'] = " Enter Class Before Saving!!!.";
						
		$data['query_subject']=$this->general_model->getsubjects();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		$this->load->view('staff/footer');
	}
	else
	{
		
		$class_entry = $this->input->post('enter_class');
		$data = array(
						'class'=>strtoupper(trim($class_entry))
						);
						$query = $this->db->get_where('classes',array('class ='=>""));
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('classes',$data, array('id'=>$id));
									}else{
						$this->db->insert('classes', $data);
						}
						//$data['message1'] = " Class Inserted Successfully!!!.";
						
		$data['query_subject']=$this->general_model->getsubjects();				
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		//$this->class_entry();
		$this->load->view('staff/footer');
	}
	}
	public function class_diventry()
	{
		$this->load->view('admin/classdivision');
	}

	
	public function class_div_form()
	{
	
		$class_arm = $this->input->post('enter_classdiv');
		$data = array(
						'division'=>strtoupper(trim($class_arm))
						);
						$query = $this->db->get_where('class_division',array('division ='=>""));
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('class_division',$data, array('id'=>$id));
									}else{
						$this->db->insert('class_division', $data);
						}
						//$data['message'] = " Class Arm Inserted Successfully!!!.";
						
							
			$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		//$this->class_diventry();
		$this->load->view('staff/footer');
	
	}
	
	public function class_subject()
	{
	$this->form_validation->set_rules('subject', 'Class Subject', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		//$data['message'] = " Type Class Arm Before Submitting!!!.";
		$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		$this->load->view('staff/footer');
		
		}
		else
		{
		$class_subject = $this->input->post('subject');
		$data = array(
						'course'=>strtoupper(trim($class_subject))
						);
						$query = $this->db->get_where('subject',array('course ='=>""));
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('subject',$data, array('id'=>$id));
									}else{
						$this->db->insert('subject', $data);
						}
						//$data['message'] = " Class Arm Inserted Successfully!!!.";
						
							
		$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/class', $data);
		//$this->class_diventry();
		$this->load->view('staff/footer');
	}
	}
	public function term_session()
	{
		/*$this->form_validation->set_rules('session', 'Current Session', 'required');
		$this->form_validation->set_rules('term', 'Term', 'required');
		$this->form_validation->set_rules('result_type', 'Result Type', 'required');
		$this->form_validation->set_rules('input_type', 'Input Type', 'required');
		
		$session =$this->input->post('session');
		$term = $this->input->post('term');
		$result_type=$this->input->post('result_type');
		$input_type=$this->input->post('input_type');
		$data= array (
						'session'=>trim($session),
						'term'=>trim($term),
						'result_type'=>trim($result_type),
						'input_status'=>trim($input_type)
						);
						$this->db->insert('settings',$data)*/
						
	
	}
	
	public function paginate($total){
		
		
		$this->load->library('pagination');
		$config['base_url']= base_url()."school_settings/display_links";
		$config['total_rows']= $total;
		$config['per_page']= 15;
		//$config['use_page_numbers'] = TRUE;
		$config['display_pages'] = TRUE;
		$config['num_links'] = 10;
		$config["uri_segment"] = 3;
		
		
		$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
         
        $config['cur_tag_open'] = "<li class=active><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";
		$config['first_link'] = '&laquo;';//'First';
		$config['last_link'] ='&laquo;';// FALSE;//'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
				
		$this->pagination->initialize($config);
			
		
	}//ENDpublic function link (){
		
		
	public function display_links(){
		
		if($this->user_table->is_login() == TRUE){
				
			$data['message'] ="";
			$row =  $this->uri->segment(5,0);
			$result['query_teacher']=$this->general_model->get_teachers2($row);
			//$result = $this->staff_table->get_staff($row);		
			//$data['query'] = $result['result'];
				$data['query_teacher'] = $result['result'];
			$total = $result['count'];
			$this->paginate($total);					
			$data['links']=$this->pagination->create_links();	
					
			$data['heading'] = "Teachers Details";				
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/teachers_profile', $data);
		$this->load->view('staff/footer');		
						
		}else{
			redirect('result_management/admin/accounts/logout');
				
		}//Endif($this->user->is_login() == TRUE){
			
		
	}//ENDpublic function display_links(){

	
	
	public function teachers_profile()
	{
				//Retrieve registered users' data from database
				$result=$this->general_model->get_teachers2(0);
				//$result = $this->staff_table->get_staff(0);
				if($result){
					$data['message'] ="";
					//$data['query'] = $result['result'];
					$data['query_teacher'] = $result['result'];
					
					$total = $result['count'];
					$this->paginate($total);					
					$data['links']=$this->pagination->create_links();
					$data['heading'] = "Teachers Details";				
						$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/teachers_profile', $data);
		$this->load->view('staff/footer');
				}else{
					
					$data['error_msg']= "<div class='alert alert-error'>No staff infomation found<div>";
						$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/teachers_profile', $data);
		$this->load->view('staff/footer');
					
				}
				
			
//END public 
	
		/*$data['query_teacher']=$this->general_model->get_teachers();
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/teachers_profile', $data);*/
	}
	
	public function query_student_profile($data)
	{
	$data['message']="";
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('admin/student_profile_query', $data);
	}
	
	public function student_profile()
	{
	$this->form_validation->set_rules('classes', 'Class', 'required');
	$this->form_validation->set_rules('class_arm', 'Class Arm', 'required');
	$this->form_validation->set_rules('session', 'Academic Session', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['message']="No Record Found for The Selected Options, Try Again!!!";
		$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
		$data['query_student']=$this->general_model->get_students($classes,$class_arm,$session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
			$this->query_student_profile($data);
			$this->load->view('staff/footer');
		}
		else
		{
		$data['message']="";
	$classes=$this->input->post('classes');
	$class_arm=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
		$data['query_student']=$this->general_model->get_students($classes,$class_arm,$session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_student_profile($data);
		$this->load->view('admin/student_profile', $data);
		$this->load->view('staff/footer');
	}
	
	}
	
	public function class_broadsheet()
	{
	$this->form_validation->set_rules('classes', 'Class', 'required');
	$this->form_validation->set_rules('class_arm', 'Class Arm', 'required');
	$this->form_validation->set_rules('session', 'Academic Session', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['message']="No Record Found for The Selected Options, Try Again!!!";
		$class=$this->input->post('classes');
	$class_division=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$average_score="50";
	$session=$this->input->post('session');
	$data['query_sub_division']=$this->general_model->getubject_division();
		$data['query_student']=$this->general_model->get_students($class,$class_division,$session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
			$this->query_broadsheet($msg, FALSE);
			$this->load->view('staff/footer');
		}
		else
		{
		
$message="";
				//////////////////////////////////////////////////////
				//Posted data from query_form_result.php
				$class = $this->input->post('classes');
				$class_division = trim($this->input->post('class_division'));
				$term = $this->input->post('term');
				$session = $this->input->post('session');
				$class_arm_selected =$this->input->post('class_arm_selected');
				//////////////////////////////////////////////////////////
				$class_supervised =$class."/".$class_division."/".$class_arm_selected;
				$sql =  $this->db->get_where('staff',array('class_supervised'=>$class_supervised));
				if($sql->num_rows>0){
				
					$row = $sql->row_array();
					$form_teacher = $row['name'];
				}
				
				/**
				* GET THE MINIMUM AVERAGE SCORE FROM classes table
				*/
				$this->db->select('average_score');
				$ave_query = $this->db->get_where('classes',array('class'=>$class))->row_array();
				$average_score = $ave_query['average_score'];
				//////////////////////////////////////////////////////////////////////////////////////
				
				$set_session = array('class'=>$class,
							  'class_division'=>$class_division,
							  'term'=>$term,
							  'session'=>$session,
							  'average_score'=>$average_score,
							  );
				$this->session->set_userdata($set_session);
				
				/////////////////////////////////////////////////////////////////////////////////////
						
				$data = array('class'=>$class,
							  'class_division'=>$class_division,
							  'term'=>$term,
							  'session'=>$session,
							  'schinfo'=>$this->db->get('schinfo')->row_array(),
							  'average_score'=>$average_score,
							  'header'=> $class.' '. $class_division. ' BROADSHEET',
							  'user_status'=> 'admin',
							  );
				
				$array = array(	'term'=>$term,'class'=>$class,'class_division'=>$class_division,'session'=>$session,'totalscore != '=> 0);
				//$result = $this->termscore_table->get_termscore($array);
				$result = $this->general_model->get_termscore($array);
				if($result == FALSE){
					
					$err = array('src'=> 'asset/image/error.png', 'width'=> '24', 'height' => '24', 'class'=>'imag-error');
						$message ="<div class='err'>".img($err)." <span class='text-error'>Operation Failed:  NO
										 ". $term ." RESULTS  FOR ".$class. " ". $class_division." YET</span></div>";
						
						$msg = "<div class='alert alert-info'>SELECT OPTIONS TO VIEW CLASS BROADSHEET</div>".$message;
						$success = FALSE;
						$this->query_broadsheet($msg, FALSE);
					
				}else{
					$result = $this->termscore_table->broadsheet($class, $class_division, $term, $session, $average_score);
					$sub_result = $this->termscore_table->subject_title($term , $class, $class_division, $session);
					$data['table_sb'] = $sub_result['table'];
					$data['num']= $sub_result['num'];
					
					$data['table_res']=$result['table'];
					$data['staff']=$result['name'];
					$this->load->view('admin/view_broadsheet',$data);
				}
				}
				     
			 }// Endif($this->form_validation->run('staff' ) == FALSE){*/
			 
	
	
	public function query_broadsheet()
	{
	//$data['message']="";
		$sessions = $this->db->query("SELECT DISTINCT session FROM termscore");
		$data['sessions'] = $sessions->result();
	$data['query_schinfo']=$this->general_model->schoolinfo();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		//$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$this->load->view('admin/broadsheet_query', $data);
	}
	
	public function broadsheet()
	{
		if($this->input->post()){
	$class=$this->input->post('classes');
	$class_division=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$session=$this->input->post('session');
	$students = $this->db->query("SELECT DISTINCT student_id FROM termscore WHERE class='$class' AND class_division='$class_division' AND term='$term' AND totalscore!=0 AND session='$session'");
	$subjects = $this->db->query("SELECT DISTINCT subject FROM termscore WHERE class='$class' AND class_division='$class_division' AND totalscore!='0' AND subject!='' AND term='$term' AND session='$session' ORDER BY subject ASC");
	$students = $students->result();
	$i = 0;
	foreach($students as $student) {
		$result[$i] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND totalscore!='0' AND class='$class' AND class_division='$class_division'")->result();
		$i++;
	}
	$teachername = $this->db->query("SELECT * FROM staff WHERE class='$class' AND class_arm='$class_division'");
	$data['teachername'] = $teachername->result();
	$data['now'] = [$term, $session];
	$data['broadsheet'] = $result;
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['subjects'] = $subjects->result();
		//$this->load->view('staff/header',$data);
		//$this->load->view('admin/sidebar_new');
		//$this->query_broadsheet();
		$this->load->view('admin/view_broadsheet', $data);
	}
	else{
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header',$data);
		$this->load->view('admin/sidebar_new');
		$this->query_broadsheet();
		//$this->load->view('admin/view_broadsheet', $data);
		$this->load->view('staff/footer');
	}
	}

	public function query_edit_teachers()
	{
		$data['message']="";
		$data['get_teachers']=$this->general_model->get_teachers();
		$data['query_class']=$this->general_model->getclasses();
		$data['query_division']=$this->general_model->getclass_division();
		$this->load->view('admin/query_teachers', $data);
	}
	
	public function ajax_change_staff_details()
	{
	$staffid=$_POST['staffid'];
	$fname=$_POST['fname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$category=$_POST['category'];
	$classes=$_POST['classes'];
	$class_arm=$_POST['class_arm'];
	
	
	$data = array(
					'name'=>strtoupper(trim($fname)),
					'phone'=>trim($phone),
					'email'=>trim($email),
					//'category'=>trim($category),
					'class'=>strtoupper(trim($classes)),
					'class_arm'=>strtoupper(trim($class_arm))
					);
			
$this->db->where('staff_id', $staffid);
$this->db->update('staff', $data);

	echo "Staff Records Updated Successfully!";
	}
	
	public function edit_teachers()
	{
	$staffid = $this->input->post('teachers');
	$data['message']="";
	$data['query_teachers']=$this->general_model->getteacher_byid($staffid);
	$data['schinfo']=$this->general_model->schoolinfo();
	
	
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_edit_teachers();
		$this->load->view('admin/edit_teachers', $data);
		$this->load->view('staff/footer');
		
	}
	
	public function query_change_student_id()
	{
		$data['message']="";
		$this->load->view('admin/query_edit_student', $data);
	}
	public function ajax_change_student_id()
	{
	$old_id=$_POST['old_id'];
	$new_id=$_POST['new_id'];
	
	$data = array(
					'student_id'=>trim($new_id)
					);
			
$this->db->where('student_id', $old_id);
$this->db->update('student', $data);

	echo "Student Id Changed Successfully!";
	}
	public function change_student_id()
	{
	$stud_id = $this->input->post('stud_id');
	$data['message']="";
	$data['query_student']=$this->general_model->getstudent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();
	
	
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_change_student_id();
		$this->load->view('admin/change_student_id', $data);
		$this->load->view('staff/footer');
		
	}
	
	public function ajax_change_student_class()
	{
	$student_id=$_POST['student_id'];
	$oldclass_arm=$_POST['oldclass_arm'];
	$newclass_arm=$_POST['newclass_arm'];
	$oldclass=$_POST['oldclass'];
	$newclass=$_POST['newclass'];
	
	
	$data = array(
					'class'=>strtoupper(trim($newclass_arm)),
					'class_division'=>strtoupper(trim($$newclass))
					);
			
$this->db->where('student_id', $old_id);
$this->db->update('student', $data);

	echo "Student Id Changed Successfully!";
	}
	public function change_student_class()
	{
	$stud_id = $this->input->post('stud_id');
	$data['message']="";
	$data['query_student']=$this->general_model->getstudent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();
	
	
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_change_student_id();
		$this->load->view('admin/change_student_class_arm', $data);
		$this->load->view('staff/footer');
		
	}
	public function change_class_classarm()
	{
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/change_student_class_arm');
		$this->load->view('staff/footer');
	}
	
	public function view_lessonnote()
	{
	$data['query_teacher']=$this->general_model->get_teachers();
	$session_data = $this->session->userdata('logged_in');
	$staffid = $session_data['staff_id'];
	$class_div = $this->db->query("SELECT division FROM class_division");
	$class_div = $class_div->result();
	$data['class_division'] = $class_div;
	$data['query_class']=$this->general_model->get_teachers_class($staffid);
	$data['query_subject']=$this->general_model->get_teachers_subject($staffid);	
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['teacher_note']=$this->general_model->get_teachers_note($staffid);
	$data['message']="";
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('staff/lessonnote', $data);
		$this->load->view('staff/footer');
	}

	public function get_note($filename)
	{
		//$filepath = $this->db->query("SELECT filepath FROM lesson_note_uploads WHERE filename='$filename'");
		//$file = $filepath->result_array();
		//var_dump($file[0]["filepath"]);
		$data = file_get_contents("./uploads/lesson_note/".$filename); // Read the file's contents
		$name = $filename;
		force_download($name, $data); 
	}

	public function upload_lesson_note()
	{
		
		//$datestring = "Day: %d Month: %m Year: %Y - %h:%i %a";
		//$time = time();
		//$current_time =  mdate($datestring, $time);
		$now = time();
		$current_time = unix_to_human($now);
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session = $this->input->post('session');
		$class = $this->input->post('class');
	
		$config['upload_path'] = './uploads/lesson_note/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '4069';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('staff/test', $error);
		}
		else
		{			
			$data = array('upload_data' => $this->upload->data());
			$session_data = $this->session->userdata('logged_in');
			$teachername = $session_data['username'];
			$staffid = $session_data['staff_id'];
			$filename = $data["upload_data"]['orig_name'];
			$filepath = "./uploads/lesson_note".$data["upload_data"]['orig_name'];
			$data['query_class']=$this->general_model->get_teachers_class($staffid);
			$data['query_subject']=$this->general_model->get_teachers_subject($staffid);	
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['message'] = "Upload Successful";
			$data['teacher_note']=$this->general_model->get_teachers_note($staffid);
			$this->general_model->upload_lesson_note($session, $term, $subject, $current_time, $staffid, $filename, $filepath, $class, $teachername);
			$this->load->view('staff/header', $data);
			$this->load->view('staff/sidebar_staff');
			$this->load->view('staff/lessonnote', $data);
			$this->load->view('staff/footer');
			
		}
		//$this->general_model->upload_lesson_note($session, $term, $subject, $current_time);
		

	}
	
	public function grade()
	{
	//$data['query_teacher']=$this->general_model->get_teachers();
	$min = $this->input->post('min');
	$max = $this->input->post('max');
	$grades = $this->input->post('grades');
	$remarks = $this->input->post('remarks');
	$data = array(
				'lower'=>trim($min),
				'higher'=>trim($max),
				'grade'=>strtoupper(trim($grades)),
				'remark'=>strtoupper(trim($remarks))
				);
		/*	$query = $this->db->get_where('grade_junior');
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('grade_junior',$data, array('id'=>$id));
									}*/
				
	$this->db->insert('grade_junior', $data);

	$data['query_grades']=$this->general_model->get_grades();	
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/grade_settings');
		$this->load->view('admin/grade_view', $data);
		$this->load->view('staff/footer');
	}
	
	public function query_imputation()
	{
	
	//$data['message']="";
	$session_data = $this->session->userdata('logged_in');
	$teachername = $session_data['username'];
	$staffid = $session_data['staff_id'];


	$data['query_schinfo']=$this->general_model->schoolinfo();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_teacher_subject']=$this->general_model->getteacher_subject($staffid);
		$data['query_class']=$this->general_model->get_teachers_class($staffid);
		//$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		//$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/imputation_query', $data);
	}
	
	public function preschoolresult_imputation()
	{
	
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo");
		$session = $session->result();
		$session = $session[0]->session;
		$data['schinfo']=$this->general_model->schoolinfo();
		$presentterm = $this->db->query("SELECT term FROM schinfo")->result();
		$data['term'] = $term;
		$data['query_student'] = $this->general_model->select_student_impute($class, $class_arm, $subject, $term, $session);
		$data['message'] = $this->session->flashdata('message');
		$data['subject'] = $this->input->post('subject');
		
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		$this->query_imputation($data);
		$this->load->view('staff/enterpreschool_result', $data);
		$this->load->view('staff/footer');
	}

	public function enterpreschool_result()
	{

		$data['result'] = $this->input->post();
		$result = $this->input->post();
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$term = $this->input->post('term');
		foreach($result as $student)
		{
			$resultexists = $this->db->query("SELECT * FROM termscore WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[3]'");
			if($resultexists->num_rows()>0)
			{
				$totalscore = $student[1]+$student[2];
				$query = $this->db->query("UPDATE termscore SET ca='$student[1]', exam='$student[2]', totalscore='$totalscore' WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[3]'");
			}
			else
			{
				$names = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='$student[0]'");
		        $surname = $names->result();
		        $surname = $surname[0]->surname;
		        $firstname = $names->result();
		        $firstname = $firstname[0]->firstname;
		        $othername = $names->result();
		        $othername = $othername[0]->othername;
		        $name = $surname." ".$firstname." ".$othername;
		        $class = $this->db->query("SELECT class FROM student WHERE student_id='$student[0]'")->result();
				$class = $class[0]->class;
				$class_division = $this->db->query("SELECT class_division FROM student WHERE student_id='$student[0]'")->result();
				$class_division = $class_division[0]->class_division;
				$totalscore = $student[1]+$student[2];
				$query = $this->db->query("INSERT INTO termscore (studentname,student_id,term,class,class_division,subject,ca,exam,totalscore,session) VALUES ('$name','$student[0]','$term','$class','$class_division','$student[3]','$student[1]','$student[2]','$totalscore','$session')");

			}
			
		}
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$data['query_student']=$this->general_model->select_student_impute($class, $class_arm, $subject, $term, $session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_class']=$this->general_model->get_teachers_class($staffid);
		$data['message']="Records Updated Successfully!";
		//$this->load->view('staff/test', $data);
		//$this->load->view('staff/header', $data);
		//$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		//$this->query_imputation($data);
		//$this->load->view('staff/enter_score', $data);
		$this->session->set_flashdata('message', 'Records Updated Successfully');
		redirect("/staff/preschoolresult_imputation");

	}

	public function result_imputation()
	{
	    
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo");
		$session = $session->result();
		$session = $session[0]->session;
		$data['schinfo']=$this->general_model->schoolinfo();
		$presentterm = $this->db->query("SELECT term FROM schinfo")->result();
		$data['term'] = $term;
		$data['query_student'] = $this->general_model->select_student_impute($class, $class_arm, $subject, $term, $session);
		$data['message'] = $this->session->flashdata('message');
		$data['subject'] = $this->input->post('subject');
		
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		$this->query_imputation($data);
		$this->load->view('staff/enter_score', $data);
		$this->load->view('staff/footer');
	}

	public function enter_result()
	{

		$data['result'] = $this->input->post();
		$result = $this->input->post();
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$term = $this->input->post('term');
		foreach($result as $student)
		{
			$resultexists = $this->db->query("SELECT * FROM termscore WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[3]'");
			if($resultexists->num_rows()>0)
			{
				$totalscore = $student[1]+$student[2];
				$query = $this->db->query("UPDATE termscore SET ca='$student[1]', exam='$student[2]', totalscore='$totalscore' WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[3]'");
			}
			else
			{
				$names = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='$student[0]'");
		        $surname = $names->result();
		        $surname = $surname[0]->surname;
		        $firstname = $names->result();
		        $firstname = $firstname[0]->firstname;
		        $othername = $names->result();
		        $othername = $othername[0]->othername;
		        $name = $surname." ".$firstname." ".$othername;
		        $class = $this->db->query("SELECT class FROM student WHERE student_id='$student[0]'")->result();
				$class = $class[0]->class;
				$class_division = $this->db->query("SELECT class_division FROM student WHERE student_id='$student[0]'")->result();
				$class_division = $class_division[0]->class_division;
				$totalscore = $student[1]+$student[2];
				$query = $this->db->query("INSERT INTO termscore (studentname,student_id,term,class,class_division,subject,ca,exam,totalscore,session) VALUES ('$name','$student[0]','$term','$class','$class_division','$student[3]','$student[1]','$student[2]','$totalscore','$session')");

			}
			
		}
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$data['query_student']=$this->general_model->select_student_impute($class, $class_arm, $subject, $term, $session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_class']=$this->general_model->get_teachers_class($staffid);
		$data['message']="Records Updated Successfully!";
		//$this->load->view('staff/test', $data);
		//$this->load->view('staff/header', $data);
		//$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		//$this->query_imputation($data);
		//$this->load->view('staff/enter_score', $data);
		$this->session->set_flashdata('message', 'Records Updated Successfully');
		redirect("/staff/result_imputation");

	}
	public function query_edit_student()
	{
		$data['message']="";
		//$stud_id=$this->input->post('stud_id');
		
		$this->load->view('admin/query_edit_student', $data);
	}
	
	public function ajax_update_student_details()
	{
	
	
	$studentid=$_POST['studentid'];
	$surname=$_POST['surname'];
	$fname=$_POST['fname'];
	$othername=$_POST['othername'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$house=$_POST['house'];
	$date_admission=$_POST['date_admission'];
	$last_school=$_POST['last_school'];
	$last_class=$_POST['last_class'];
	$state_of_origin=$_POST['state_of_origin'];
	$nationality=$_POST['nationality'];
	$religion=$_POST['religion'];
	$blood_group=$_POST['blood_group'];
	$genotype=$_POST['genotype'];
	$parent_name=$_POST['parent_name'];
	$occupation=$_POST['occupation'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$state=$_POST['state'];
	
	
	
	$data = array(
					'surname'=>strtoupper(trim($surname)),
					'firstname'=>strtoupper(trim($fname)),
					'othername'=>strtoupper(trim($othername)),
					'sex'=>strtoupper(trim($gender)),
					'state'=>strtoupper(trim($state_of_origin)),
					'state_of_origin'=>strtoupper(trim($state)),
					'religion'=>strtoupper(trim($religion)),
					'city'=>strtoupper(trim($city)),
					'dob'=>trim($dob),
					'house'=>strtoupper(trim($house)),
					'date_admitted'=>trim($date_admission),
					'last_school'=>strtoupper(trim($last_school)),
					'last_class'=>strtoupper(trim($last_class)),
					'blood_grp'=>trim($blood_group),
					'genotype'=>strtoupper(trim($genotype)),
					'address'=>ucwords(trim($address)),
					'nationality'=>strtoupper(trim($nationality)),
					'email'=>strtolower(trim($email)),
					'phone'=>trim($phone),
					'occupation'=>strtoupper(trim($occupation)),
					'parent_name'=>strtoupper(trim($parent_name))
					);

									
			
$this->db->where('student_id', $studentid);
$this->db->update('student', $data);

	echo "Student Records Updated Successfully!";
	}
	public function edit_student_profile()
	{
		
	$stud_id=$this->input->post('stud_id');
	$result = $this->general_model->getstudent_byid($stud_id);
	if($result == FALSE){
	$data['query_parent']=$this->general_model->getparent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();	
	$data['message']="No Record Found For the Id";
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_edit_student($data);
		$this->load->view('staff/footer');
		}
		else
		{
	
	$stud_id=$this->input->post('stud_id');
	$data['query_student']=$this->general_model->getstudent_byid($stud_id);	
	$data['query_parent']=$this->general_model->getparent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();	
	$data['message']="";
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_edit_student();
		$this->load->view('admin/edit_student_data', $data);
		$this->load->view('staff/footer');
	
	}
	}
	
	public function schemeof_work()
	{
		$this->load->view('staff/header');
		$this->load->view('staff/sidebar_staff');
		$this->load->view('staff/footer');
	}
	
	public function timetable()
	{
		if($this->input->post())
		{
			$term = $this->input->post('term');
			$session = $this->input->post('session');
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$staff_details = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
			$staff_details = $staff_details->result();
			$class = $staff_details[0]->class;
			$class_division = $staff_details[0]->class_arm;
			$config['upload_path'] = './uploads/timetable/';
			$config['allowed_types'] = 'doc|docx|pdf';
			$config['max_size']	= '4069';
			$config['file_name'] = "timetable"."_".$session."_".$term."_".$class.$class_division;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('warning', $error['error']);
				redirect("staff/timetable");
			}
			else
			{			
				$data = array('upload_data' => $this->upload->data());
				$filename = $data["upload_data"]['orig_name'];
				$query = $this->db->query("INSERT INTO timetable (staff_id, class, term, session, filename, class_division) VALUES ('$staff_id', '$class', '$term', '$session', '$filename', '$class_division')");
				$this->session->set_flashdata('message', 'Upload Successful');
				redirect("staff/timetable");
			}
				
		}
		else
		{
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$timetable = $this->db->query("SELECT * FROM timetable WHERE staff_id='$staff_id'");
			$data['timetable'] = $timetable->result();
			$data['query_class']=$this->general_model->getclasses();
			$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('staff/header', $data);
			$this->load->view('staff/sidebar_staff');
			$this->load->view('staff/time_table', $data);
			$this->load->view('staff/footer');
		}
	}

	public function deleteTimetable_Ajax()
	{
		$id = $this->input->post('id');
		$query = $this->db->query("DELETE FROM timetable WHERE id='$id'");
		echo "TIME TABLE DELETED";
	}
	
	public function scheme()
	{
		if($this->input->post())
		{
			$schinfo = $this->db->query("SELECT * FROM schinfo LIMIT 1");
			$schinfo = $schinfo->result();
			$term = $schinfo[0]->term;
			$session = $schinfo[0]->session;	
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$staff_details = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
			$staff_details = $staff_details->result();
			$class = $staff_details[0]->class;
			$class_division = $staff_details[0]->class_arm;
			$config['upload_path'] = './uploads/scheme_of_work/';
			$config['allowed_types'] = 'doc|docx|pdf';
			$config['max_size']	= '4069';
			$config['file_name'] = "scheme_of_work"."_".$session."_".$term."_".$class;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('warning', $error['error']);
				redirect("staff/scheme");
			}
			else
			{			
				$data = array('upload_data' => $this->upload->data());
				$filename = $data["upload_data"]['orig_name'];
				$query = $this->db->query("INSERT INTO scheme (staff_id, class, term, session, filename, class_division) VALUES ('$staff_id', '$class', '$term', '$session', '$filename', '$class_division')");
				$this->session->set_flashdata('message', 'Upload Successful');
				redirect("staff/scheme");
			}
				
		}
		else
		{
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$scheme = $this->db->query("SELECT * FROM scheme WHERE staff_id='$staff_id'");
			$data['scheme'] = $scheme->result();
			$data['query_class']=$this->general_model->getclasses();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/scheme_ofwork', $data);
		$this->load->view('staff/footer');

		}

		}

	public function deleteScheme_Ajax()
	{
		$id = $this->input->post('id');
		$query = $this->db->query("DELETE FROM scheme WHERE id='$id'");
		echo "SCHEME DELETED";
	}
	
	public function theme()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/theme', $data);
		$this->load->view('staff/footer');
	}
	
	public function code_conduct()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/code_conduct', $data);
		$this->load->view('staff/footer');
	}
	public function data_table()
	{
	//$data['query_class']=$this->general_model->getclasses();
		$data['query_teacher']=$this->general_model->get_teachers();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/staff_details', $data);
		$this->load->view('staff/footer');
	}
	public function data_test()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/datatable_test', $data);
		$this->load->view('staff/footer');
	}
	
	public function query_result_comment()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		
		$this->load->view('staff/query_result_comment', $data);
	}
	
	public function result_comment()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['query_division']=$this->general_model->getclass_division();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_result_comment();
		$this->load->view('staff/result_comment', $data);
		$this->load->view('staff/footer');
	}
	
	public function query_skills()
	{
	

	//$data['query_class']=$this->general_model->get_class_teachers_class($staffid);
	//$data['query_class_division']=$this->general_model->get_class_teachers_class_division($staffid);
	//$data['schinfo']=$this->general_model->schoolinfo();
		
		$this->load->view('staff/query_skills_grading');
	}
	
	public function skills_grading()
	{
	if($this->input->post()) 
	{
	$class_arm = $this->input->post('class_arm');
	$class = $this->input->post('class');
	$term = $this->input->post('term');
	$students = $this->db->query("SELECT * FROM student WHERE class_division='$class_arm' AND class='$class' AND status='ACTIVE'");
	$session_data = $this->session->userdata('logged_in');
	$teachername = $session_data['username'];
	$staffid = $session_data['staff_id'];
	$data['students'] = $students;
	$data['query_class']=$this->general_model->get_class_teachers_class($staffid);
	$data['query_division']=$this->general_model->get_class_teachers_class_division($staffid);
	$data['posts'] = $this->input->post();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_skills();
		$this->load->view('admin/skills_grade', $data);
		$this->load->view('staff/footer');
	}
	else
	{
	$session_data = $this->session->userdata('logged_in');
	$teachername = $session_data['username'];
	$staffid = $session_data['staff_id'];
	$data['query_class']=$this->general_model->get_class_teachers_class($staffid);
	$data['query_division']=$this->general_model->get_class_teachers_class_division($staffid);
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		$this->query_skills();
		$this->load->view('admin/skills_grade', $data);
		$this->load->view('staff/footer');
	}
	}
	
	public function fillgrid(){
            $this->home_model->fillgrid();
        }


        public function create(){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == FALSE){
               echo'<div class="alert alert-danger">'.validation_errors().'</div>';
               exit;
            }
            else{
                $this->home_model->create();
            }
        }
        
        public function edit(){
            $id =  $this->uri->segment(3);
            $this->db->where('id',$id);
            $data['query'] = $this->db->get('curd');
            $data['id'] = $id;
            $this->load->view('edit', $data);
            }
            
        public function update(){
                $res['error']="";
                $res['success']="";
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('contact', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
                if ($this->form_validation->run() == FALSE){
                $res['error']='<div class="alert alert-danger">'.validation_errors().'</div>'; 
				$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
				$this->load->view('admin/home'); 
				$this->load->view('staff/footer');
                }           
            else{
                $data = array('name'=>  $this->input->post('name'),
                'email'=>$this->input->post('email'),
                'contact'=>$this->input->post('contact'),
                'facebook_link'=>$this->input->post('facebook'));
                $this->db->where('id', $this->input->post('hidden'));
                $this->db->update('curd', $data);
                $data['success'] = '<div class="alert alert-success">One record inserted Successfully</div>';
            }
            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
        }


        public function delete(){
            $id =  $this->input->POST('id');
            $this->db->where('id', $id);
            $this->db->delete('curd');
            echo'<div class="alert alert-success">One record deleted Successfully</div>';
            exit;
        }

        public function test() 
        {
        	//$item = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='0032'");
        	//$data['tin'] = $this->input->post('tin');
        	//$surname = $item->result();
        	//$surname = $surname[0];
        	//$data['surname'] = $surname[0]->surname;
        	//$result = $this->input->post();
			$data['query'] = $this->general_model->get_class_teachers_class(2);
			
        	$this->load->view('staff/test', $data);
        }

        //AJAX Requests//
        /*
         *	Functions for Handling Ajax Requests
         *	Go Here
         *
        */

        public function getStudent_Ajax()
        {
        	$student_id = $this->input->post('student_id');
        	$student = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
        	echo json_encode($student->result_array());
        }

        public function getNoteComment_Ajax()
        {
        	$id = $this->input->post('id');
        	$schinfo = $this->db->query("SELECT * FROM schinfo");
			$schinfo = $schinfo->result();
			$session = $schinfo[0]->session;
        	$timetable = $this->db->query("SELECT * FROM lesson_note_uploads WHERE session='$session' AND id='$id'");
        	$timetable = $timetable->result();
        	echo(json_encode($timetable));
        }

        public function insertNoteComment_Ajax()
        {
        	$id = $this->input->post('id');
        	$comment = $this->input->post('comment');
        	$status = $this->input->post('status');
        	$query = $this->db->query("UPDATE lesson_note_uploads SET comment='$comment', status='$status' WHERE id='$id'");
        	echo "COMMENT SUCCESSFUL";
        }

        public function getResults_Ajax()
        {
        	$term = $this->input->post('term');
        	$session = $this->input->post('session');
        	$class = $this->input->post('class');
        	$class_division = $this->input->post('class_division');
        	$students = $this->db->query("SELECT DISTINCT student_id FROM termscore WHERE term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'");
        	$students = $students->result();
        	foreach ($students as $student)
        	{
        		$result[] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'")->result_array();
        	} 
        	echo json_encode($result);
        }

        public function getSkillsGradeData_Ajax()
        {
        	$term = $this->input->post('term');
        	$student_id = $this->input->post('student_id');
        	$session = $this->db->query("SELECT session FROM schinfo")->result();
			$session = $session[0]->session;
        	$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND term='$term' AND session='$session'");
        	echo json_encode($skills->result_array());

        }

        public function StudentPhoto($student_id)
        {
        	$data = file_get_contents("./uploads/perm_upload/student/".$student_id.".jpg"); // Read the file's contents
			$name = "student.jpg";
			force_download($name, $data); 
        }



        public function submitSkillsGrade_Ajax()
        {
        	$student_id = $this->input->post('student_id');
        	$term = $this->input->post('term');
        	$session = $this->db->query("SELECT session FROM schinfo");
        	$session = $session->result();
			$session = $session[0]->session;
			$check = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND term='$term' AND session='$session'");
			$handwriting = $this->input->post('handwriting');
            $fluency = $this->input->post('fluency');
            $games = $this->input->post('games');
            $drawing = $this->input->post('drawing');
            $handling = $this->input->post('handling');
            $musical = $this->input->post('musical');
            $punctuality = $this->input->post('punctuality');
            $neatness = $this->input->post('neatness');
            $politeness = $this->input->post('politeness');
            $emotional = $this->input->post('emotional');
            $cooperation = $this->input->post('cooperation');
            $leadership = $this->input->post('leadership');
            $attitude = $this->input->post('attitude');
            $attentiveness = $this->input->post('attentiveness');
            $honesty = $this->input->post('honesty');
            $helping = $this->input->post('helping');
            $perseverance = $this->input->post('perseverance');
            $phy_health = $this->input->post('phy_health');
            $weight = $this->input->post('weight');
            $height = $this->input->post('height');
            $attendance = $this->input->post('attendance');
            $extra_curriculum = $this->input->post('extra_curriculum');
            $class = $this->input->post('class');
            $class_division = $this->input->post('class_division');
			if($check->num_rows()>0)
			{
				$query = $this->db->query("UPDATE behavioural_hw SET handwriting='$handwriting', games='$games', handling='$handling', fluency='$fluency', drawing='$drawing', musical='$musical', punctuality='$punctuality', neatness='$neatness', cooperation='$cooperation', leadership='$leadership', attitude='$attitude', attentiveness='$attentiveness', emotional='$emotional', politeness='$emotional', honesty='$honesty', helping='$helping', perseverance='$perseverance', phy_health='$phy_health', weight='$weight', height='$height', no_presents='$attendance', extra_curriculum='$extra_curriculum', student_id='$student_id', term='$term', session='$session', class='$class', class_division='$class_division' WHERE student_id='$student_id' AND term='$term' AND session='$session'");
			}
			else
			{
				$query = $this->db->query("INSERT INTO behavioural_hw (handwriting, games, handling, fluency, drawing, musical, punctuality, neatness, cooperation, leadership, attitude, attentiveness, emotional, politeness, honesty, helping, perseverance, phy_health, height, weight, no_presents, extra_curriculum, student_id, term, session, class, class_division) VALUES ('$handwriting', '$games', '$handling', '$fluency', '$drawing', '$musical', '$punctuality', '$neatness', '$cooperation', '$leadership', '$attitude', '$attentiveness', '$emotional', '$politeness', '$honesty', '$helping', '$perseverance', '$phy_health', '$height', '$weight', '$attendance', '$extra_curriculum', '$student_id', '$term', '$session', '$class', '$class_division')");
			}
			echo "SUCCESS";


        }

        public function getTeacherComments_Ajax()
        {

        	$query = $this->db->query("SELECT * FROM comment WHERE owner='teacher'");
        	echo json_encode($query->result_array());

        }

        public function getCommentOnStudentResult_Ajax()
        {
        	$student_id = $this->input->post('student_id');
        	$_schinfo = $this->db->query("SELECT * FROM schinfo");
        	$_schinfo = $_schinfo->result();
        	$term = $_schinfo[0]->term;
        	$session = $_schinfo[0]->session;
        	$_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND term='$term' AND session='$session'");
        	if($_comment->num_rows()>0){
	        	$_comment = $_comment->result();
	        	$comment = $_comment[0]->comment;
	        	echo(html_entity_decode($comment, ENT_QUOTES));
	        }
	        else
	        {
	        	echo('');
	        }
        }

        public function deleteNote_Ajax()
        {
        	$id = $this->input->post('id');
        	$this->db->query("DELETE FROM lesson_note_uploads WHERE id='$id'");
        	echo "Note Successfully Deleted";
        }

        public function updateComment_Ajax()
        {
        	$comment = $this->input->post('comment');
        	$id = $this->input->post('id');
        	$query = $this->db->query("UPDATE comment SET comment='$comment' WHERE id='$id'");
        	echo "Updated";
        }

        public function getClassTeacherStudents_Ajax()
        {
        	$session_data = $this->session->userdata('logged_in');
			$staffid = $session_data['staff_id'];
			$query = $this->general_model->get_class_teachers_class($staffid);
			$query = $query->result();
			$class = $query[0]->class;
			$class_div = $this->db->query("SELECT DISTINCT class_arm FROM staff WHERE staff_id='$staffid'");
			$class_arm = $class_div->result();
			$class_arm = $class_arm[0]->class_arm;
			$students = $this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_arm' AND status='ACTIVE'");
			echo json_encode($students->result_array());
        }

  
        public function submitClassTeacherComment_Ajax()
        {
        	$session_data = $this->session->userdata('logged_in');
			$staffid = $session_data['staff_id'];
        	$student_id = $this->input->post('student_id');
        	$class = $this->input->post('class');
        	$class_division = $this->input->post('class_division');
                $comment1 = $this->input->post('comment');
	        $comment=mysql_real_escape_string($comment1);
        	//$comment = htmlEntities($this->input->post('comment'), ENT_QUOTES);
        	$_session = $this->db->query("SELECT session FROM schinfo");
        	$session = $_session->result();
			$session = $session[0]->session;
			$_term = $this->db->query("SELECT term FROM schinfo");
			$term = $_term->result();
			$term = $term[0]->term;
        	$commentexists = $this->db->query("SELECT * FROM tea_comment WHERE term='$term' AND session='$session' AND class='$class' AND class_division='$class_division' AND student_id='$student_id'");
        	
        	if ($commentexists->num_rows()>0)
        	{
        		$query = $this->db->query("UPDATE tea_comment SET comment='$comment' WHERE student_id='$student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'");
        		echo "Comment Updated";
        	}
        	else
        	{
        		$query = $this->db->query("INSERT INTO tea_comment (student_id, class, class_division, term, staff_id, comment, session) VALUES ('$student_id', '$class', '$class_division', '$term', '$staffid', '$comment', '$session')");
        		echo "Commented";
        	}
        }

        public function getAllClasses_Ajax()
        {
        	$query = $this->db->query("SELECT class FROM classes;");
        	echo json_encode($query->result_array());
        }

        public function getAllClassDivisions_Ajax()
        {
        	$query = $this->db->query("SELECT division FROM class_division");
        	echo json_encode($query->result_array());
        }

        public function getSessions_Ajax()
        {
        	$query = $this->db->query("SELECT DISTINCT session FROM termscore");
        	echo json_encode($query->result_array());
        }

        public function createComment_Ajax()
        {
        	$comment = $this->input->post('comment');
        	$owner = $this->input->post('owner');
        	$query = $this->db->query("SELECT * FROM comment WHERE comment='$comment'");
        	if($query->num_rows()>0)
        	{
        		echo "exists";
        	}
        	else
        	{
	        	$query = $this->db->query("INSERT INTO comment (owner, comment) VALUES ('$owner', '$comment')");
	        	echo "Inserted";
        	}

        }

        public function deleteComment_Ajax()
        {
        	$id = $this->input->post('id');
        	$query = $this->db->query("DELETE FROM comment WHERE id='$id';");
        	echo "Deleted";
        }

        public function shiki()
        {
        	if($resultexists->num_rows()>0)
			{
				$query = $this->db->query("UPDATE termscore SET ca='$student[1]', exam='$student[2]' WHERE student_id='$student[0]' AND term='$term' AND session='$session'");
				echo "SUCCESS";

			}
			else
			{
				$names = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='$student[0]'");
		        $surname = $names->result();
		        $surname = $surname[0]->surname;
		        $firstname = $names->result();
		        $firstname = $firstname[0]->firstname;
		        $othername = $names->result();
		        $othername = $othername[0]->othername;
		        $class = $this->db->query("SELECT class FROM student WHERE student_id='$student[0]'")->result();
				$class = $class[0]->class;
				$class_division = $this->db->query("SELECT class_division FROM student WHERE student_id='$student[0]'")->result();
				$class_division = $class_division[0]->class_division;
				$query = $this->db->query("INSERT INTO termscore (studentname,student_id,term,class,class_division,subject,ca,exam,totalscore,session) VALUES ('$surname.$firstname.$othername','$student[0]','$term','$class','$class_division','$student[3]','$student[1]','$student[2]','$student[1]+$student[2]','$session')");
				echo "SUCCESS";

			}

        }

        public function result_view()
        {
	        if($this->input->post())
	        	{
	        	$class = $this->input->post('class');
	        	$class_division = $this->input->post('class_division');
	        	$term = $this->input->post('term');
	        	$session = $this->input->post('session');
	        	$students = $this->db->query("SELECT DISTINCT student_id FROM termscore WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
if($students->num_rows()>0) {
	        	$students = $students->result();
	        	$result;
	        	$i = 0;
	        	foreach($students as $student)
	        	{
	        	//	$result[$i] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'")->result();
	        	//	$i++;
	        		$result[$i] = $this->db->query("SELECT DISTINCT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'")->result();
	        
	        	    $i++;
	        	}
	        	$data['results']=$result;
	        	$data['result_details']=[$class, $class_division, $term, $session];
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/result_view', $data);
				$this->load->view('staff/footer');
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('staff/result_view');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/result_view', $data);
				$this->load->view('staff/footer');
			}
    }

public function preschoolresult_view()
        {
	        if($this->input->post())
	        	{
	        	$class = $this->input->post('class');
	        	$class_division = $this->input->post('class_division');
	        	$term = $this->input->post('term');
	        	$session = $this->input->post('session');
	        	$students = $this->db->query("SELECT DISTINCT student_id FROM termscore WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
if($students->num_rows()>0) {
	        	$students = $students->result();
	        	$result;
	        	$i = 0;
	        	foreach($students as $student)
	        	{
	        		$result[$i] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division'")->result();
	        		$i++;
	        	}
	        	$data['results']=$result;
	        	$data['result_details']=[$class, $class_division, $term, $session];
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/preschoolresult_view', $data);
				$this->load->view('staff/footer');
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('staff/preschoolresult_view');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/preschoolresult_view', $data);
				$this->load->view('staff/footer');
			}
    }

public function staff_account_page()
{
	$session_data = $this->session->userdata('logged_in');
	$staffid = $session_data['staff_id'];
	$data['query_class']=$this->general_model->get_teachers_info($staffid);
	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('admin/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/staff_editaccount', $data);
				$this->load->view('staff/footer');
}
public function AjaxStaff_Update()
{
	$staffid = $this->input->post('staffid');
	$names = $this->input->post('fname');
	$username = $this->input->post('username');
	$phone = $this->input->post('phone');
	$email = $this->input->post('email');
	
		$data = array(
						'name'=>strtoupper(trim($names)),
						'username'=>strtolower(trim($username)),
						'phone'=>trim($phone),
						'email'=>strtolower(trim($email))
						);
						$query = $this->db->where('staff_id', $staffid);
						$query = $this->db->update('staff', $data);
						echo "Staff Records Updated Successfully!";
}


   public function print_result()
    {
    	$student_id = $this->input->get('student_id');
    	$term = $this->input->get('term');
    	$session = $this->input->get('session');
    	$class = $this->input->get('class');
    	$class_division = $this->input->get('class_division');
    	$_staff_id = $this->db->query("SELECT * FROM tea_comment WHERE class='$class' AND class_division='$class_division' AND session='$session' AND term='$term'");
    	if($_staff_id->num_rows()>0)
    	{
    		$_staff_id = $_staff_id->result();
    		$staff_id = $_staff_id[0]->staff_id;
    	}
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
if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'AND totalscore!=0  AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			//$data['grading_break'] = $subject_break;
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
			$var=$scondCount= 0;
			foreach($subjects as $subject)
			{
				$r = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$result[$var] = $r->result()[0];
				$r1 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				if(!empty($r1->result()[0]->totalscore)){ $scondCount++; }
				$first_result[$var] = $r1->result()[0];
				$var++;
			}
			//echo "Total Second Count ".$scondCount;
    		$result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$first_result_s = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

    		$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

    		$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

    		$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
            
            //$avgDivisorCount=arry();
            $mts1=0;
    		foreach($result_s->result() as $r)
    		{
    			$get_scores = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='$r->subject'");
    			$class_average = $get_scores->result();
    			$i;
    			$ave=0;
    			//$avgDivisorCount[$mts1]=count($class_average);
    			for($i=0;$i<count($class_average);$i++)
    			{
    				$ave+=$class_average[$i]->totalscore;
    				
    				//echo $ave."<br/>";
    				
    			}
    			$mts1++;
    			
    			$average_score[]=$ave/count($class_average);
    			
    			//echo $ave."/".count($class_average)."<br/>";
    			
    			
    		}
            
    		if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			$data['subject_break'] = $subject_break->result();
			//$data['grading_break'] = $subject_break;
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
			$var = $scondCount = $thirdCount = 0;
			foreach($subjects as $subject)
			{
				$r = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				$result[$var] = $r->result()[0];
				$r1 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND totalscore!=0 AND class_division='$class_division' AND subject='$subject->subject' ORDER BY subject ASC");
				
				if(!empty($r1->result()[0]->totalscore)){ $scondCount++; }
				$first_result[$var] = $r1->result()[0];
				
				$r2 = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='SECOND TERM' AND session='$session' AND totalscore!='0' AND class_division='$class_division' AND subject='$subject->subject'  ORDER BY subject ASC");
				if(!empty($r2->result()[0]->totalscore)){ $thirdCount++; }
				
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
          if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			//$data['grading_break'] = $subject_break;
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
    
    public function printpreschool_result()
    {
    	$student_id = $this->input->get('student_id');
    	$term = $this->input->get('term');
    	$session = $this->input->get('session');
    	$class = $this->input->get('class');
    	$class_division = $this->input->get('class_division');
    	$_staff_id = $this->db->query("SELECT * FROM tea_comment WHERE class='$class' AND class_division='$class_division' AND session='$session' AND term='$term'");
    	if($_staff_id->num_rows()>0)
    	{
    		$_staff_id = $_staff_id->result();
    		$staff_id = $_staff_id[0]->staff_id;
    	}
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
if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'AND totalscore!=0  AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			$data['grading_break'] = $subject_break;
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
    		$this->load->view('staff/print_preschoolresult_firstterm', $data);
    		
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

    		if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			$data['subject_break'] = $subject_break->result();
			$data['grading_break'] = $subject_break;
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
    		$this->load->view('staff/print_preschoolresult_secondterm', $data);
    		
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
          if ($session >='2016/2017' && preg_match("/\bBASIC\b/i", $class))
			{
			$subject_break = $this->db->query("SELECT * FROM subject_breakdown");
			}
			else{
				$subject_break = $this->db->query("SELECT * FROM subject_no");
			}
    		
    		$tezz = $this->db->query("SELECT studentname, student_id, term, class, class_division, subject, ca, exam, totalscore, session  FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 AND subject='COMPUTER'");
    		$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND status='ACTIVE'")->result());
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
			$data['grading_break'] = $subject_break;
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
    		$this->load->view('staff/print_preschoolresult_thirdterm', $data);
    		
    		break;
    		default:
    		echo $term.$session.$class.$class_division.$student_id;

    	}
    }
    
public function view_teacherslessonnote()
    {
    	$curr_session = $this->db->query("SELECT session, term FROM schinfo");
    	$curr_session = $curr_session->result();
    	$sess = $curr_session[0]->session;
    	$term = $curr_session[0]->term;

    	$query = $this->db->query("SELECT * FROM lesson_note_uploads WHERE session='$sess' ORDER BY class ASC");
    	$data['notes'] = $query->result();
    	$data['schinfo']=$this->general_model->schoolinfo();
    	$this->load->view('staff/header', $data);
    	$this->load->view('staff/sidebar_staff', $data);
    	$this->load->view('staff/mark_lesson_note', $data);
    	$this->load->view('staff/footer');
    }

    public function general_upload()
    {
    	$session_data = $this->session->userdata('logged_in');
		$category = $session_data['category'];
		$staff_id = $session_data['staff_id'];
		$staffid = $session_data['staff_id'];
    	if($this->input->post())
    	{
    		$term = $this->input->post('term');
    		$title = $this->input->post('title');
    		$description = $this->input->post('description');
			$session = $this->input->post('session');
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$staff_details = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
			$staff_details = $staff_details->result();
			$class = $this->input->post('class');
			$class_division = $this->input->post('class_division');
			$config['upload_path'] = './uploads/general_upload/';
			$config['allowed_types'] = 'doc|docx|pdf|jpeg|PNG|jpg|JPG|JPEG|xsl';
			//$config['allowed_types'] = 'doc|docx|pdf|jpeg|PNG|jpg|JPG|JPEG|xsl|audio/mp3|audio/mp4|video/3gp|audio/wav|audio/wma|audio/3ga|audio/3GPP|audio/aac|audio/m4a|audio/opus|audio/amr';
		
			$config['max_size']	= '10069';
			$config['file_name'] = $title;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('warning', $error['error']);
				redirect("staff/general_upload");
			}
			else
			{			
				$data = array('upload_data' => $this->upload->data());
				$filename = $data["upload_data"]['orig_name'];
				$query = $this->db->query("INSERT INTO general_upload (staff_id, class, term, session, filename, title, description) VALUES ('$staff_id', '$class', '$term', '$session', '$filename', '$title', '$description')");
				$this->session->set_flashdata('message', 'Upload Successful');
				redirect("staff/general_upload");
			}
    	}
    	else
    	{
    		$uploads = $this->db->query("SELECT * FROM general_upload WHERE staff_id='$staff_id'");
			$uploads = $uploads->result();
			$data['uploads'] = $uploads;
    		if($category=="PRINCIPAL | HEADMASTER")
			{
				$class_div = $this->db->query("SELECT division FROM class_division");
				$class_div = $class_div->result();

				$class = $this->db->query("SELECT class FROM classes");
				$data['schinfo']=$this->general_model->schoolinfo();
	    		$data['class_division'] = $class_div;
				$data['query_class']=$class;
			}
			else
			{
				//$class = $this->db->query("SELECT class FROM staff WHERE staff_id='$staff_id'");
$class = $this->db->query("SELECT class FROM classes");

				$class_div = $this->db->query("SELECT division FROM class_division");
		    	$data['query_teacher']=$this->general_model->get_teachers();
				$class_div = $class_div->result();
	    		$data['class_division'] = $class_div;
				$data['query_class']=$class;
				$data['query_subject']=$this->general_model->get_teachers_subject($staffid);	
				$data['schinfo']=$this->general_model->schoolinfo();
				$data['teacher_note']=$this->general_model->get_teachers_note($staffid);
	    		$data['schinfo']=$this->general_model->schoolinfo();
    		}

    		$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/general_upload', $data);
	    	$this->load->view('staff/footer');
    	}
    }

    public function deleteGeneralUpload_Ajax()
        {
        	$id = $this->input->post('id');
        	$this->db->query("DELETE FROM general_upload WHERE id='$id'");
        	echo "Successfully Deleted";
        }

    public function insert_principal_comment()
    {
    	if($this->input->post())
    	{
    		$class = $this->input->post('class');
    		$term = $this->input->post('term');
    		$class_division = $this->input->post('class_division');
    		$session = $this->input->post('session');
    		$students = $this->db->query("SELECT DISTINCT student_id, studentname FROM termscore WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
    		$students = $students->result();
    		$sessions = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$sessions = $sessions->result();
    		$data['sessions'] = $sessions;
    		$data['session'] = $this->input->post('session');
    		$data['term'] = $term;
    		$data['class_division'] = $class_division;
    		$data['class'] = $class;
    		$data['students'] = $students;
    		$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principal_comment', $data);
	    	$this->load->view('staff/footer');
    	}
    	else
	    {
	    	$session = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$session = $session->result();
    		$data['sessions'] = $session;
	    	$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principal_comment', $data);
	    	$this->load->view('staff/footer');
	    }
    }

    public function getPrincipalComment_Ajax()
    {
    	$student_id = $this->input->post('student_id');
    	$term = $this->input->post('term');
    	$session = $this->input->post('session');
    	$class = $this->input->post('class');
    	$class_division = $this->input->post('class_division');
    	$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
    	$student_details = $student_details->result();
    	$query = $this->db->query("SELECT comment FROM principal_comment WHERE student_id='$student_id' AND term='$term' AND session='$session' AND class_division='$class_division'");
    	$comment = $query->result();
    	$result = [$comment, $student_details];
    	echo(json_encode($result));
    }

    public function insertPrincipalComment_Ajax()
    {
    	$session_data = $this->session->userdata('logged_in');
		$staff_id = $session_data['staff_id'];
    	$student_id = $this->input->post('student_id');
    	$comment = $this->input->post('comment');
	//$comment=mysql_real_escape_string($comment1);
    	$term = $this->input->post('term');
    	$session = $this->input->post('session');
    	$class = $this->input->post('class');
    	$class_division = $this->input->post('class_division');
    	$check = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND session='$session' AND class='$class' AND class_division='$class_division' AND term='$term'");
    	if($check->num_rows()>0)
    	{
   			$query = $this->db->query("UPDATE principal_comment SET comment='$comment' WHERE student_id='$student_id' AND class='$class' AND session='$session' AND class_division='$class_division' AND term='$term'"); 
   			echo "COMMENT UPDATED!";		
    	}
    	else
    	{
    		$query = $this->db->query("INSERT INTO principal_comment (student_id,term,class,class_division,session,comment,staff_id) VALUES ('$student_id','$term','$class','$class_division','$session','$comment','$staff_id')");
    		echo "COMMENT APPENDED!";
    	}
    }

    
    /*public function print_ca()
		{
			$student_id = $this->input->get('student_id');
			$term = $this->input->get('term');
			$session = $this->input->get('session');
			$class = $this->input->get('class');
			$class_division = $this->input->get('class_division');
			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' ORDER BY subject ASC");
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['result']=$result->result();

            $grading = $this->db->query("SELECT * FROM grade_junior");

             $data['grading'] = $grading->result();
            $key_rating = $this->db->query("SELECT * FROM key_rating");
            $data['key_rating'] = $key_rating->result();

			$this->load->view('staff/print_ca', $data);
		}*/
		
	    public function print_ca()
		{
			$student_id = $this->input->get('student_id');
			$term = $this->input->get('term');
			$session = $this->input->get('session');
			$class = $this->input->get('class');
			$class_division = $this->input->get('class_division');
			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND ca!='0' AND totalscore!='0' ORDER BY subject ASC");
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
		
public function insert_principal_comment_mock()
    {
    	if($this->input->post())
    	{
    		$class = $this->input->post('class');
    		$term = $this->input->post('term');
    		$class_division = $this->input->post('class_division');
    		$session = $this->input->post('session');
    		$students = $this->db->query("SELECT DISTINCT student_id, studentname FROM mock WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
    		//var_dump($_POST);
    		//return;
    		$students = $students->result();
    		$sessions = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$sessions = $sessions->result();
    		$data['sessions'] = $sessions;
    		$data['session'] = $this->input->post('session');
    		$data['term'] = $term;
    		$data['class_division'] = $class_division;
    		$data['class'] = $class;
    		$data['students'] = $students;
    		$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principal_comment_mock', $data);
    	}
    	else
	    {
	    	$session = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$session = $session->result();
    		$data['sessions'] = $session;
	    	$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principal_comment_mock', $data);
	    }
    }
		
		
		public function cbt_comment()
	{
	$type = $this->input->post('comment_category');
	$comment = $this->input->post('comment');

	$data['message']='';
	$data['comments'] = $this->general_model->get_comment();
	$data['schinfo']=$this->general_model->schoolinfo();
	

	
	$this->load->view('staff/header', $data);
	$this->load->view('staff/sidebar_staff');
	$this->load->view('staff/cbt_comment', $data);
	$this->load->view('staff/footer');
							
	}
	
	public function submitClassTeacherCBTComment_Ajax()
        {
        	$session_data = $this->session->userdata('logged_in');
			$staffid = $session_data['staff_id'];
        	$student_id = $this->input->post('student_id');
        	$class = $this->input->post('class');
        	$class_division = $this->input->post('class_division');
        	$CBT = "CBT";
            $comment1 = $this->input->post('comment');
	        $comment=mysql_real_escape_string($comment1);
        	//$comment = htmlEntities($this->input->post('comment'), ENT_QUOTES);
        	$_session = $this->db->query("SELECT session FROM schinfo");
        	$session = $_session->result();
			$session = $session[0]->session;
			$_term = $this->db->query("SELECT term FROM schinfo");
			$term = $_term->result();
			$term = $term[0]->term;
        	$commentexists = $this->db->query("SELECT * FROM tea_comment WHERE term='$term' AND session='$session' AND cbt='$CBT' AND class='$class' AND class_division='$class_division' AND student_id='$student_id'");
        	
        	if ($commentexists->num_rows()>0)
        	{
        		$query = $this->db->query("UPDATE tea_comment SET comment='$comment' WHERE student_id='$student_id' AND term='$term' AND session='$session' AND cbt='$CBT' AND class='$class' AND class_division='$class_division'");
        		echo "Comment Updated";
        	}
        	else
        	{
        		$query = $this->db->query("INSERT INTO tea_comment (student_id, class, class_division, term, cbt, staff_id, comment, session) VALUES ('$student_id', '$class', '$class_division', '$term', '$CBT', '$staffid', '$comment', '$session')");
        		echo "Commented";
        	}
        }
        
    public function getCommentOnCBTResult_Ajax()
        {
        	$student_id = $this->input->post('student_id');
        	$_schinfo = $this->db->query("SELECT * FROM schinfo");
        	$_schinfo = $_schinfo->result();
        	$term = $_schinfo[0]->term;
        	$session = $_schinfo[0]->session;
        	$_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND term='$term' AND cbt='CBT' AND session='$session'");
        	if($_comment->num_rows()>0){
	        	$_comment = $_comment->result();
	        	$comment = $_comment[0]->comment;
	        	echo(html_entity_decode($comment, ENT_QUOTES));
	        }
	        else
	        {
	        	echo('');
	        }
        }
        
     public function insert_principal_comment_CBT()
    {
    	if($this->input->post())
    	{
    		$class = $this->input->post('class');
    		$term = $this->input->post('term');
    		$class_division = $this->input->post('class_division');
    		$session = $this->input->post('session');
    		$students = $this->db->query("SELECT DISTINCT student_id, studentname FROM termscore WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
    		$students = $students->result();
    		$sessions = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$sessions = $sessions->result();
    		$data['sessions'] = $sessions;
    		$data['session'] = $this->input->post('session');
    		$data['term'] = $term;
    		$data['class_division'] = $class_division;
    		$data['class'] = $class;
    		$data['students'] = $students;
    		$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principalCommentCBT', $data);
	    	$this->load->view('staff/footer');
    	}
    	else
	    {
	    	$session = $this->db->query("SELECT DISTINCT session FROM termscore");
    		$session = $session->result();
    		$data['sessions'] = $session;
	    	$data['query_division']=$this->general_model->getclass_division();
	    	$data['query_class']=$this->general_model->getclasses();
	    	$data['schinfo']=$this->general_model->schoolinfo();
	    	$this->load->view('staff/header', $data);
	    	$this->load->view('staff/sidebar_staff', $data);
	    	$this->load->view('staff/principalCommentCBT', $data);
	    	$this->load->view('staff/footer');
	    }
    }
    
     public function getPrincipalCommentCBT_Ajax()
    {
    	$student_id = $this->input->post('student_id');
    	$term = $this->input->post('term');
    	$session = $this->input->post('session');
    	$class = $this->input->post('class');
    	$class_division = $this->input->post('class_division');
    	$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
    	$student_details = $student_details->result();
    	$query = $this->db->query("SELECT comment FROM principal_comment WHERE student_id='$student_id' AND term='$term' AND cbt='CBT' AND session='$session' AND class_division='$class_division'");
    	$comment = $query->result();
    	$result = [$comment, $student_details];
    	echo(json_encode($result));
    }
    
     public function insertPrincipalCommentCBT_Ajax()
    {
    	$session_data = $this->session->userdata('logged_in');
		$staff_id = $session_data['staff_id'];
    	$student_id = $this->input->post('student_id');
    	$comment1 = $this->input->post('comment');
	    $comment=mysql_real_escape_string($comment1);
    	$term = $this->input->post('term');
    	$CBT = "CBT";
    	$session = $this->input->post('session');
    	$class = $this->input->post('class');
    	$class_division = $this->input->post('class_division');
    	$check = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND session='$session' AND class='$class' AND class_division='$class_division' AND term='$term' AND cbt='CBT'");
    	if($check->num_rows()>0)
    	{
   			$query = $this->db->query("UPDATE principal_comment SET comment='$comment' WHERE student_id='$student_id' AND class='$class' AND session='$session' AND class_division='$class_division' AND term='$term' AND cbt='CBT'"); 
   			echo "COMMENT UPDATED!";		
    	}
    	else
    	{
    		$query = $this->db->query("INSERT INTO principal_comment (student_id,term,cbt,class,class_division,session,comment,staff_id) VALUES ('$student_id','$term','$CBT', '$class','$class_division','$session','$comment','$staff_id')");
    		echo "COMMENT APPENDED!";
    	}
    }
    
    public function print_cbt()
		{
			$student_id = $this->input->get('student_id');
			$term = $this->input->get('term');
			$session = $this->input->get('session');
			$class = $this->input->get('class');
			$class_division = $this->input->get('class_division');
			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND ca1!='0' ORDER BY subject ASC");
			$teacher_comment = $this->db->query("SELECT * FROM tea_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND cbt='CBT' AND session='$session' AND class_division='$class_division'");
    		$principal_comment = $this->db->query("SELECT * FROM principal_comment WHERE student_id='$student_id' AND class='$class' AND term='$term' AND cbt='CBT' AND session='$session' AND class_division='$class_division'");
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['result']=$result->result();

            $grading = $this->db->query("SELECT * FROM cbt_grading");

             $data['grading'] = $grading->result();
            $key_rating = $this->db->query("SELECT * FROM key_rating");
            $data['key_rating'] = $key_rating->result();
            $data['teacher_comment']=$teacher_comment->result();
    		$data['principal_comment']=$principal_comment->result();

			$this->load->view('staff/print_cbt', $data);
			
			/* if (preg_match("/\b2018/2019\b/i", $session))
    		{
    			$this->load->view('staff/print_cbt', $data);
    		}	 
    			else
    		{
    			$this->load->view('staff/print_cbt', $data);
    		}*/
		}
		
		public function query_mock_imputation()
	{

	//$data['message']="";
	$session_data = $this->session->userdata('logged_in');
	$teachername = $session_data['username'];
	$staffid = $session_data['staff_id'];


	$data['query_schinfo']=$this->general_model->schoolinfo();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_teacher_subject']=$this->general_model->getteacher_subject($staffid);
		$data['query_class']=$this->general_model->get_teachers_class($staffid);
		//$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		//$this->load->view('staff/sidebar_staff');
		$this->load->view('admin/imputation_query', $data);
	}
public function mock_imputation()
	{

		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo");
		$session = $session->result();
		$session = $session[0]->session;
		$data['schinfo']=$this->general_model->schoolinfo();
		$presentterm = $this->db->query("SELECT term FROM schinfo")->result();
		$data['term'] = $presentterm[0]->term;
		$data['query_student'] = $this->general_model->select_student_impute_mock($class, $class_arm, $subject, $term, $session);
		$data['message'] = $this->session->flashdata('message');
		$data['subject'] = $this->input->post('subject');

		$this->load->view('staff/header', $data);
		$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		$this->query_mock_imputation($data);
		$this->load->view('staff/enter_mock', $data);
		
		$this->load->view('staff/footer');
	}
	
	public function enter_mock()
	{

		$data['result'] = $this->input->post();
		$result = $this->input->post();
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$term = $this->db->query("SELECT term FROM schinfo")->result();
		$term = $term[0]->term;
		foreach($result as $student)
		{
			$resultexists = $this->db->query("SELECT * FROM mock WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[2]'");
			if($resultexists->num_rows()>0)
			{
				$totalscore = $student[1];
				$query = $this->db->query("UPDATE mock SET  exam='$totalscore' WHERE student_id='$student[0]' AND term='$term' AND session='$session' AND subject='$student[2]'");
			}
			else
			{
				$names = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='$student[0]'");
		        $surname = $names->result();
		        $surname = $surname[0]->surname;
		        $firstname = $names->result();
		        $firstname = $firstname[0]->firstname;
		        $othername = $names->result();
		        $othername = $othername[0]->othername;
		        $name = $surname." ".$firstname." ".$othername;
		        $class = $this->db->query("SELECT class FROM student WHERE student_id='$student[0]'")->result();
				$class = $class[0]->class;
				$class_division = $this->db->query("SELECT class_division FROM student WHERE student_id='$student[0]'")->result();
				$class_division = $class_division[0]->class_division;
				$totalscore = $student[1];
				$query = $this->db->query("INSERT INTO mock (studentname,student_id,term,class,class_division,subject,exam,session) VALUES ('$name','$student[0]','$term','$class','$class_division','$student[2]','$student[1]','$session')");

			}

		}
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$subject = $this->input->post('subject');
		$term = $this->input->post('term');
		$session_data = $this->session->userdata('logged_in');
		$teachername = $session_data['username'];
		$staffid = $session_data['staff_id'];
		//$session = $this->db->query("SELECT session FROM student WHERE username='$username'")->result();
		//$session = $session[0]->session;
		$session = $this->db->query("SELECT session FROM schinfo")->result();
		$session = $session[0]->session;
		$data['query_student']=$this->general_model->select_student_impute_mock($class, $class_arm, $subject, $term, $session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_class']=$this->general_model->get_teachers_class($staffid);
		$data['message']="Records Updated Successfully!";
		//$this->load->view('staff/test', $data);
		//$this->load->view('staff/header', $data);
		//$this->load->view('staff/sidebar_staff');
		//$this->load->view('admin/right_sidebar');
		//$this->query_imputation($data);
		//$this->load->view('staff/enter_mock', $data);
		$this->session->set_flashdata('message', 'Records Updated Successfully');
		redirect("/staff/mock_imputation");

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
					redirect('staff/mock_result_view');
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
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/mock_result_view', $data);
				$this->load->view('staff/footer');
			}else {
			$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
			redirect('staff/mock_result_view');
			$this->load->view('staff/footer');
			}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/mock_result_view', $data);
				$this->load->view('staff/footer');
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
}
