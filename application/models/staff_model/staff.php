<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
session_start();
class Staff extends CI_Controller{
	var $path_url;
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('url');
		
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
	$data['schinfo']=$this->general_model->schoolinfo();
	//$data['query_class']=$this->general_model->getclasses();
		//$data['query_class_division']=$this->general_model->getclass_division();
	$this->load->view('admin/header', $data);
	//$this->load->view('admin/sidebar_new');
	//$this->load->view('admin/dashboard', $data);
	$this->load->view('staff/login_form');
	
}
public function user_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/admin_page');
}else{
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form');
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
'email' => $result[0]->email,
);
// Add user data in session
$this->session->set_userdata('logged_in', $session_data);
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
	$this->load->view('admin/sidebar_new');
	$this->load->view('admin/admin_page');
}
} else {
$data = array(
'error_message' => 'Invalid Username or Password'
);
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form', $data);
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
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form', $data);
}
public function dashboard(){
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_class']=$this->general_model->getclasses();
		$data['query_class_division']=$this->general_model->getclass_division();
	$this->load->view('admin/header', $data);
	$this->load->view('admin/sidebar_new');
	$this->load->view('admin/dashboard', $data);
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
						'message'=> "<img src='../../controllers/staff/".$this->path_url."/".$data['file_name']."'  class='preview' width='200' height='200'>")));
						*/
						die(json_encode(array(
								'status'=>'success',
								'message'=> "<img src='../../controllers/staff/".$this->path_url."/school_logo.".$ext."'  class='preview' width='110' height='150'>")));
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
			$this->load->view('admin/header');
	$this->load->view('admin/sidebar_new');
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
	$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
	$this->load->view('admin/comment_form', $data);
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
							//$this->load->view('admin/header');
							//$this->load->view('admin/sidebar_new');
							//$this->load->view('admin/teachers_comment',$data);
							break;*/
				}
							
		}					
	}
	public function insert_teacher_comment()
	{
	$data['message']='';
	$data['comments'] = $this->general_model->get_comment();
	$data['schinfo']=$this->general_model->schoolinfo();
	$type = $this->input->post('comment_category');
	$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
	$this->load->view('admin/teachers_comment', $data);
	switch($type){
	
		case "TEACHER" :$comment = $this->input->post('comment');
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
						
						$data['message'] = " Comment Inserted Successfully!!!.";
							//$this->load->view('admin/header');
							//$this->load->view('admin/sidebar_new');
							//$this->load->view('admin/teachers_comment',$data);
							break;
				}
							}
							
	}
	
	public function student_registration()
	{
		if($this->form_validation->run('student_register') == FALSE){
		$data['sucess']="";
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_house']=$this->general_model->gethouse();
		$data['query_class']=$this->general_model->getclasses();
		$data['query_class_division']=$this->general_model->getclass_division();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_registration',$data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_registration',$data);
		}
	}

	public function school_details()
	{
	
	if($this->form_validation->run('registration') == FALSE){
	$data['sucess']="";
		$data['schinfo']=$this->general_model->getschinfo();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/schooldetailsform', $data);
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
	  $this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/schooldetailsform', $data);
		//echo success;
	}
	}
	public function staff_registration()
	{
$data['schinfo']=$this->general_model->schoolinfo();
	if($this->form_validation->run('staff_registration') == FALSE){
	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_classes']=$this->general_model->getclasses();
		$data['query_subjects']=$this->general_model->getsubjects();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/staff_registration', $data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/comment_form');
	}
	public function result_session()
	{
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['message']="";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/result_session_query', $data);
	}
	public function query_result_term()
	{
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_class']=$this->general_model->getclasses();
	$data['message']="";
		//$this->load->view('admin/header');
		//$this->load->view('admin/sidebar_new');
		$this->load->view('admin/result_term_query', $data);
		
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
			$this->query_result_term($data);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_result_term();
		$this->load->view('admin/result_view', $data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
			$this->query_result_term($data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
			$this->query_result_term($data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
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
	$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->query_result_term();
		$this->load->view('admin/result_breakdown', $data);
	
	/*else
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
	
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		//$this->class_entry();
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		//$this->class_diventry();
	
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		//$this->class_diventry();
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/teachers_profile', $data);
				
						
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
						$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/teachers_profile', $data);
				}else{
					
					$data['error_msg']= "<div class='alert alert-error'>No staff infomation found<div>";
						$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/teachers_profile', $data);
					
				}
				
			
//END public 
	
		/*$data['query_teacher']=$this->general_model->get_teachers();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
			$this->query_student_profile($data);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_student_profile($data);
		$this->load->view('admin/student_profile', $data);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
			$this->query_broadsheet($msg, FALSE);
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
			 
	
	
	public function query_broadsheet($msg, $success)
	{
	$data['message'] = $msg;								
	$data['success'] = $success;
	//$data['message']="";
	$data['query_schinfo']=$this->general_model->schoolinfo();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		//$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$this->load->view('admin/broadsheet_query', $data);
	}
	
	public function broadsheet()
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
			$this->query_student_profile($data);
		}
		else
		{
		$data['message']="";
	$class=$this->input->post('classes');
	$class_division=$this->input->post('class_arm');
	$term=$this->input->post('term');
	$average_score="";
	$session=$this->input->post('session');
	$data['query_sub_division']=$this->general_model->getubject_division();
	$data['query_division']=$this->general_model->getclass_division();
	$data['get_teacher']=$this->general_model->getclass_teacher($class, $class_division);
		$data['query_class']=$this->general_model->getclasses();
		$data['query_schinfo']=$this->general_model->schoolinfo();
	$data['query_broadsheet'] = $this->general_model->select_class_broadsheet($class, $class_division, $term, $session, $average_score);
	$data['query_term'] = $this->general_model->select_class_broadsheet($class, $class_division, $term, $session,$average_score);
		$data['query_student']=$this->general_model->get_students($class,$class_division,$session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar_new');
		$this->query_broadsheet();
		$this->load->view('admin/view_broadsheet', $data);
	
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
	
	
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_edit_teachers();
		$this->load->view('admin/edit_teachers', $data);
		
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
	
	
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_change_student_id();
		$this->load->view('admin/change_student_id', $data);
		
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
	
	public function change_class_classarm()
	{
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/change_class_arm');
	}
	
	public function view_lessonnote()
	{
	$data['query_teacher']=$this->general_model->get_teachers();
	$data['query_subject']=$this->general_model->getsubjects();	
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/lessonnote', $data);
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
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/grade_settings');
		$this->load->view('admin/grade_view', $data);
	}
	
	public function query_imputation()
	{
	
	//$data['message']="";
	$data['query_schinfo']=$this->general_model->schoolinfo();
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		//$data['get_teacher']=$this->general_model->getclass_teacher($classes, $class_arm);
		$this->load->view('admin/imputation_query', $data);
	}
	
	public function result_imputation()
	{
		$class=$this->input->post('classes');
		$class_arm=$this->input->post('class_arm');
		$data['schinfo']=$this->general_model->schoolinfo();
		$data['query_student']=$this->general_model->select_student_impute($class, $class_arm);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/right_sidebar');
		$this->query_imputation();
		$this->load->view('staff/enter_score', $data);
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
	$initial=$_POST['initial'];
	$title=$_POST['title'];
	$occupation=$_POST['occupation'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$state=$_POST['state'];
	$nationality=$_POST['nationality'];
	$parent_name = $title. " " .$initial;
	
	
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
					'address'=>(trim($address)),
					'phone'=>trim($phone),
					'nationality'=>strtoupper(trim($nationality))
					);
					
				$data2= array(
									'email'=>trim($email),
									'phone'=>trim($phone),
									'occupation'=>strtoupper(trim($occupation)),
									'parent_name'=>strtoupper(trim($parent_name))
									);
			
$this->db->where('student_id', $studentid);
$this->db->update('student', $data);
$this->db->where('student_id', $studentid);
$this->db->update('parent', $data2);

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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_edit_student($data);
		}
		else
		{
	
	$stud_id=$this->input->post('stud_id');
	$data['query_student']=$this->general_model->getstudent_byid($stud_id);	
	$data['query_parent']=$this->general_model->getparent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();	
	$data['message']="";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_edit_student();
		$this->load->view('admin/edit_student_data', $data);
	
	}
	}
	
	public function schemeof_work()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
	}
	
	public function timetable()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/time_table', $data);
	}
	
	public function scheme()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/scheme_ofwork', $data);
	}
	
	public function theme()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/theme', $data);
	}
	
	public function code_conduct()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/code_conduct', $data);
	}
	public function data_table()
	{
	//$data['query_class']=$this->general_model->getclasses();
		$data['query_teacher']=$this->general_model->get_teachers();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/staff_details', $data);
	}
	public function data_test()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/datatable_test', $data);
	}
	
	public function query_result_comment()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		
		$this->load->view('admin/query_result_comment', $data);
	}
	
	public function result_comment()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['query_division']=$this->general_model->getclass_division();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_result_comment();
		$this->load->view('admin/result_comment', $data);
	}
	
	public function query_skills()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		
		$this->load->view('admin/query_result_comment', $data);
	}
	
	public function skills_grading()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['query_division']=$this->general_model->getclass_division();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_skills();
		$this->load->view('admin/skills_grade', $data);
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
				$this->load->view('admin/home');   
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
}