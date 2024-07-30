<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
session_start();
$session_id='1';
$path="./uploads/";
class School_settings extends CI_Controller{
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
		$this->load->model('login_database');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="star">', '</div>');
		$this->form_validation->set_message('is_unique', 'The Username is taken, try another one');
		
	}

private function resize_image($file, $w, $h, $crop=FALSE) {
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		return $dst;
	}
		
		
	public function index(){
	$data['schinfo']=$this->general_model->schoolinfo();
	
	$this->load->view('admin/header', $data);
	
	$this->load->view('admin/login_form');
	$this->load->view('admin/footer');
	
}
public function user_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
if(isset($this->session->userdata['logged_in'])){
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/admin_page');
$this->load->view('admin/footer');
}else{
$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form');
$this->load->view('admin/footer');
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
'admin_id'=>$result[0]->admin_id,
);
// Add user data in session
$this->session->set_userdata('logged_in', $session_data);
	$data['schinfo']=$this->general_model->schoolinfo();
	 
$data['query_class']=$this->general_model->getclasses();
	$data['query_teacher']=$this->general_model->get_teachers();
		$data['query_class_division']=$this->general_model->getclass_division();
		$data['all_student']=$this->general_model->all_student();
	redirect('school_settings/dashboard');
}
} else {
$data = array(
'error_message' => 'Invalid Username or Password'
);
	$data['schinfo']=$this->general_model->schoolinfo();
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form', $data);
$this->load->view('admin/footer');
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
	$this->load->view('admin/header', $data);
$this->load->view('admin/login_form', $data);*/
redirect('school_settings'); 
}
public function dashboard(){
	$_session = $this->db->query("SELECT session FROM schinfo");
	$_session = $_session->result();
	$session = $_session[0]->session;
	$students = $this->db->query("SELECT * FROM student WHERE session='$session' AND status='ACTIVE'");
	$students = $students->result();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_class']=$this->general_model->getclasses();
	$data['query_teacher']=$this->general_model->get_teachers();
		$data['query_class_division']=$this->general_model->getclass_division();
		$data['all_student']=$students;
	$this->load->view('admin/header', $data);
	$this->load->view('admin/sidebar_new');
	$this->load->view('admin/dashboard', $data);
	$this->load->view('admin/footer');
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
						'message'=> "<img src='".$this->path_url."/".$data['file_name']."'  class='preview' width='200' height='200'>")));
						*/
						die(json_encode(array(
								'status'=>'success',
								'message'=> "<img src='".$this->path_url."/school_logo.".$ext."'  class='preview' width='110' height='150'>")));
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
	$this->load->view('admin/footer');
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
	$this->load->view('admin/footer');
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
		if($this->input->post()){
				$adminno = $this->input->post('adminno');
			$config['upload_path'] = './uploads/perm_upload/student';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size']	= '4069';
		$config['file_name'] = $adminno;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->session->set_flashdata('message', $error['error']);
			redirect('school_settings/student_registration');
		}
		else
		{		
			$img = $this->resize_image($config['upload_path'].'/'.$adminno.$this->upload->data()['file_ext'], 200, 200);	
			$data = $img;
			imagejpeg($img, $config['upload_path'].'/'.$adminno.$this->upload->data()['file_ext']);
			$surname = $this->input->post('surname');
			$fname = $this->input->post('fname');
			$othername = $this->input->post('othername');
			$gender = $this->input->post('gender');
			$class = $this->input->post('class');
			$class_arm = $this->input->post('class_arm');
			$term = $this->input->post('term');
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
			$parent_name = $this->input->post('initial');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state2 = $this->input->post('state2');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$occupation = $this->input->post('occupation');
						$status='ACTIVE';
			$_session = $this->db->query("SELECT * FROM schinfo");
			$_session = $_session->result();
			$session = $_session[0]->session;
			$data = array('upload_data' => $this->upload->data());
			$filename = $adminno.$data["upload_data"]['file_ext'];
			$filepath = "./uploads/lesson_note".$data["upload_data"]['orig_name'];
			$image_url = $filename = $data["upload_data"]['orig_name'];
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
										  'nationality'=>ucwords(trim($nationality)),
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
					  'genotype'=>trim($genotype),
					  'student_id'=>trim($adminno),
					  'parent_name'=>strtoupper(trim($parent_name)),
					  'phone'=>strtoupper(trim($phone)),
					  'email'=>strtoupper(trim($email)),
					  'occupation'=>strtoupper(trim($occupation)),
						'session'=>trim($session),
						'status'=>trim($status),
						'image_url'=>$data["upload_data"]['orig_name']
					  );
				$this->db->insert('student', $data1);
			$this->session->set_flashdata('message', 'Student registered Successfully!');
			redirect('school_settings/student_registration');
			
			}
		}
		else
		{
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['query_house']=$this->general_model->gethouse();
			$data['query_class']=$this->general_model->getclasses();
			$data['query_class_division']=$this->general_model->getclass_division();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar_new');
			$this->load->view('admin/student_registration',$data);
			$this->load->view('admin/footer');
		}
	}
	public function school_details()
	{
	
	if($this->input->post()){
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
					redirect('school_settings/school_details');	
					$this->session->set_flashdata('message', 'Information Updated Successful');
			}	
			else{
			$data['sucess']="";
				$data['schinfo']=$this->general_model->getschinfo();
				$data['schinfo']=$this->general_model->schoolinfo();
				$data['school_settings'] = $this->db->query("SELECT * FROM settings WHERE session='$schinfo->session' AND term='$schinfo->term'")->result()[0];
				$this->load->view('admin/header', $data);
				$this->load->view('admin/sidebar_new');
				$this->load->view('admin/schooldetailsform', $data);
				$this->load->view('admin/footer');
		//echo success;
		}
	}

	public function term_and_session_details () {
		if($this->input->post())
		{
			$resumption_date = $this->input->post('resume_date');
			$closing_date = $this->input->post('closing_date');
			$number_of_times_school_opened = $this->input->post('number_of_times_school_opened');
			$current_term_and_session = $this->db->query("SELECT * FROM schinfo")->result();
			$session = $current_term_and_session[0]->session;
			$term = $current_term_and_session[0]->term;
			//Update settings table
			$this->db->query("UPDATE settings SET resumption='$resumption_date', close='$closing_date', school_open='$number_of_times_school_opened' WHERE term='$term' AND session='$session'");
			$this->session->set_flashdata('message', 'Term and Session details updated successfully');
			redirect('school_settings/school_details');
		
		}
	}

	public function createNewTerm_Ajax()
	{
		$session = $this->input->post('session');
		$term = $this->input->post('term');
		$check = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");
		if($check->num_rows()>0)
		{
			echo "FAIL";
		}
		else
		{
			$query = $this->db->query("UPDATE schinfo SET session='$session', term='$term'");
			$query = $this->db->query("INSERT INTO settings (session, term) VALUES ('$session', '$term')");
			echo "SUCCESSFUL";
		}
	}

	public function staff_registration()
	{
$data['schinfo']=$this->general_model->schoolinfo();
	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_classes']=$this->general_model->getclasses();
		$data['query_subjects']=$this->general_model->getsubjects();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/staff_registration', $data);
		$this->load->view('admin/footer');
		
	}

		public function register_staff()
	{
		$surname= $this->input->post('surname');
		$fname= $this->input->post('fname');
		$username= $this->input->post('username');
		$phone= $this->input->post('phone');
		$email= $this->input->post('email');
		$staff_cat = $this->input->post('staff_cat');
		$password1 = $this->input->post('password');
		$password2 = $this->input->post('passconf');
		$name=$surname." ".$fname;
		$_session = $this->db->query("SELECT * FROM schinfo");
		$_session = $_session->result();
		$session = $_session[0]->session;
		$term = $_session[0]->term;
		$check = $this->db->query("SELECT * FROM staff WHERE username='$username' AND phone='$phone' AND email='$email'");
		if($check->num_rows()>0)
			{
				$this->session->set_flashdata('message', 'Staff has already been registered');
				redirect('school_settings/staff_registration');
			}
			else
			{
				switch ($staff_cat) {
					case "CLASS TEACHER":
					$class  = $this->input->post('classes');
					$class_division = $this->input->post('class_arm');
					$query = $this->db->query("INSERT INTO staff (name, username, password, email, phone, category, status, statuss, class, class_arm, term, session) VALUES ('$name', '$username', '$password1', '$email', '$phone', '$staff_cat', '1', 'ACTIVE', '$class', '$class_division', '$term', '$session')");
					$query = $this->db->query("SELECT staff_id FROM staff WHERE name='$name' AND username='$username' AND email='$email' AND phone='$phone'");
					$staff_id = $query->result();
					$staff_id = $staff_id[0]->staff_id;
					$this->session->set_flashdata('message', 'Staff has been registered. Staff ID is '.$staff_id);
					redirect('school_settings/staff_registration');
					break;
					case "PRINCIPAL | HEADMASTER":
					$query = $this->db->query("INSERT INTO staff (name, username, password, email, phone, category, status, statuss, term, session) VALUES ('$name', '$username', '$password1', '$email', '$phone', '$staff_cat', '1', 'ACTIVE', '$term', '$session')");
					$query = $this->db->query("SELECT staff_id FROM staff WHERE name='$name' AND username='$username' AND email='$email' AND phone='$phone'");
					$staff_id = $query->result();
					$staff_id = $staff_id[0]->staff_id;
					$this->session->set_flashdata('message', 'Staff has been registered. Staff ID is '.$staff_id);
					redirect('school_settings/staff_registration');
					break;
					case "CLASS | SUBJECT TEACHER":
					$class_supervised  = $this->input->post('classes');
					$class_division = $this->input->post('class_arm');
					$subject = $this->input->post('subject');
					$class = $this->input->post('class');
					$query = $this->db->query("INSERT INTO staff (name, username, password, email, phone, category, status, statuss, class, class_arm, term, session) VALUES ('$name', '$username', '$password1', '$email', '$phone', '$staff_cat', '1', 'ACTIVE', '$class_supervised', '$class_division', '$term', '$session')");
					$query = $this->db->query("SELECT staff_id FROM staff WHERE name='$name' AND username='$username' AND email='$email' AND phone='$phone'");
					$staff_id = $query->result();
					$staff_id = $staff_id[0]->staff_id;
					$j=0;
					foreach($class as $c)
					{
						for($i=0;$i<count($c);$i++)
						{
							if($c[$i]=="JSS 1"||"JSS 2"||"JSS 3")
							{
								$class_arm = "2_JUN";
							}
							else if($c[$i]=="SSS 1"||"SSS 2"||"SSS 3")
							{
								$class_arm = "2_SEN";
							}
							$query = $this->db->query("INSERT INTO staffsubj (staff_id, class_arm, class, subject) VALUES ('$staff_id', '$class_arm', '$c[$i]', '$subject[$j]')");

						}
						$j++;
					}
					$data['subject']=$subject;
					$data['class']=$class;
					$data['message']="STAFF REGISTERED";
					$this->session->set_flashdata('message', 'Staff has been registered. Staff ID is '.$staff_id);
					redirect('school_settings/staff_registration');
					break;
					case "SUBJECT TEACHER":
					$subject = $this->input->post('subject');
					$class = $this->input->post('class');
					$query = $this->db->query("INSERT INTO staff (name, username, password, email, phone, category, status, statuss, term, session) VALUES ('$name', '$username', '$password1', '$email', '$phone', '$staff_cat', '1', 'ACTIVE', '$term', '$session')");
					$query = $this->db->query("SELECT staff_id FROM staff WHERE name='$name' AND username='$username' AND email='$email' AND phone='$phone'");
					$staff_id = $query->result();
					$staff_id = $staff_id[0]->staff_id;
					$j=0;
					foreach($class as $c)
					{
						for($i=0;$i<count($c);$i++)
						{
							if($c[$i]=="JSS 1"||"JSS 2"||"JSS 3")
							{
								$class_arm = "2_JUN";
							}
							else if($c[$i]=="SSS 1"||"SSS 2"||"SSS 3")
							{
								$class_arm = "2_SEN";
							}
							$query = $this->db->query("INSERT INTO staffsubj (staff_id, class_arm, class, subject) VALUES ('$staff_id', '$class_arm', '$c[$i]', '$subject[$j]')");

						}
						$j++;
					}
					$data['subject']=$subject;
					$data['class']=$class;
					$data['message']="STAFF REGISTERED";
					$this->session->set_flashdata('message', 'Staff has been registered. Staff ID is '.$staff_id);
					redirect('school_settings/staff_registration');
					break;
				}

			}
	}
	public function comment_store()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/comment_form');
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
	}
	public function query_result_term()
	{
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_class']=$this->general_model->getclasses();
	$data['message']="";
		//$this->load->view('admin/header');
		//$this->load->view('admin/sidebar_new');
		$this->load->view('admin/result_term_query', $data);
		$this->load->view('admin/footer');
		
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
			$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
			$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
			$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
	
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
						echo "SUCCESS";
	}
	
	public function class_form()
	{
	
			//$data['message1'] = " Enter Class Before Saving!!!.";
						
		
		$data['query_class']=$this->general_model->getclasses();
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		$this->load->view('admin/footer');
	
	}

	public function getSchoolDetails_Ajax()
	{
		$query = $this->db->query("SELECT * FROM schinfo");
		$query = $query->result_array();
		echo(json_encode($query)); 
	}
	
	public function checkAdminNo_Ajax()
	{
		$student_id = $this->input->post('student_id');
		$query = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
		if($query->num_rows()>0)
		{
			echo "Admin No has been assigned to another student";
		}
		else
		{
			echo "Admin No is available";
		}
	}

	public function getClassesSubjects_Ajax()
	{
		$classes = $this->general_model->getclasses();
		$subjects = $this->general_model->getsubjects();
		$class_division = $this->general_model->getclass_division();
		$result[0] = $classes->result_array();
		$result[1] = $subjects->result_array();
		$result[2] = $class_division->result_array();
		echo(json_encode($result));
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
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
						
			$data['schinfo']=$this->general_model->schoolinfo();				
		$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		//$this->class_diventry();
		$this->load->view('admin/footer');
	
	}
	
	public function class_subject()
	{
	$this->form_validation->set_rules('subject', 'Class Subject', 'required');
	if ($this->form_validation->run() == FALSE)
		{
		$data['schinfo']=$this->general_model->schoolinfo();
		//$data['message'] = " Type Class Arm Before Submitting!!!.";
		$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('admin/header',$data);
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
						
		   $data['schinfo']=$this->general_model->schoolinfo();					
		$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('admin/header',$data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
				
						
		}else{
			redirect('result_management/admin/accounts/logout');
				
		}//Endif($this->user->is_login() == TRUE){
			
		
	}//ENDpublic function display_links(){

	 public function deleteGeneralUpload_Ajax()
        {
        	$id = $this->input->post('id');
        	$this->db->query("DELETE FROM general_upload WHERE id='$id'");
        	echo "Successfully Deleted";
        }
	public function general_upload()
	{
		$session_data = $this->session->userdata('logged_in');
		$category = $session_data['category'];
		$staff_id = $session_data['staff_id'];
		$staffid = $session_data['admin_id'];
		if($this->input->post())
		{
			$term = $this->input->post('term');
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$session = $this->input->post('session');
			$session_data = $this->session->userdata('logged_in');
			$staff_id = $session_data['staff_id'];
			$staff_details = $this->db->query("SELECT * FROM adminend WHERE admin_id='$staff_id'");
			$staff_details = $staff_details->result();
		
			$config['upload_path'] = './uploads/general_upload/';
			$config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg|gif|xlsx';
			$config['max_size']	= '6069';
			$config['file_name'] = $title;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('warning', $error['error']);
				redirect("school_settings/general_upload");
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$filename = $data["upload_data"]['orig_name'];
				$query = $this->db->query("INSERT INTO general_upload (staff_id,  term, class, session, filename, title, description) VALUES ('$staff_id', '$term','ALL CLASSES', '$session', '$filename', '$title', '$description')");
				$this->session->set_flashdata('message', 'Upload Successful');
				redirect("school_settings/general_upload");
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
				$class = $this->db->query("SELECT * FROM classes");
				$class_div = $this->db->query("SELECT division FROM class_division");
				$data['query_teacher']=$this->general_model->get_admin();
				$class_div = $class_div->result();
				$data['class_division'] = $class_div;
				$data['query_class']=$class;
				$data['query_subject']=$this->general_model->get_teachers_subject($staffid);
				$data['schinfo']=$this->general_model->schoolinfo();
				$data['teacher_note']=$this->general_model->get_teachers_note($staffid);
				$data['schinfo']=$this->general_model->schoolinfo();
			}

			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar_new', $data);
			$this->load->view('admin/general_upload', $data);
			$this->load->view('admin/footer');
		}
	}

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
		$this->load->view('admin/footer');
				}else{
					
					$data['error_msg']= "<div class='alert alert-error'>No staff infomation found<div>";
						$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/teachers_profile', $data);
		$this->load->view('admin/footer');
					
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
			$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
	}
	
	}
public function student_school_fees()
	{

		
	$_session = $this->db->query("SELECT session FROM schinfo");
	$_session = $_session->result();
	$session = $_session[0]->session;
		$data['all_student']=$this->general_model->get_all_student($session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_fees', $data);
		$this->load->view('admin/footer');
	}
	 public function confirm_payment_status()
 {
	$id= $this->input->post('id');
	$status= $this->input->post('status');
	
	$i = 0;

	foreach($id as $i)
	{
		$status= $this->input->post('status');
		$data = array(
					'payment_status'=>trim($status)
					);
		$this->db->where('student_id', $i);
		$this->db->update('student', $data);
		$i++;
	}
	  
	 redirect('school_settings/student_school_fees');
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
			$this->load->view('admin/footer');
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
	$teachername = $this->db->query("SELECT * FROM staff WHERE class='$class' AND class_arm='$class_division' AND statuss='ACTIVE'");
	$data['teachername'] = $teachername->result();
	$data['now'] = [$term, $session];
	$data['broadsheet'] = $result;
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['subjects'] = $subjects->result();
		//$this->load->view('staff/header',$data);
		//$this->load->view('admin/sidebar_new');
		//$this->query_broadsheet();
		$this->load->view('admin/view_broadsheet', $data);
		$this->load->view('admin/footer');
	}
	else{
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('staff/header',$data);
		$this->load->view('admin/sidebar_new');
		$this->query_broadsheet();
		//$this->load->view('admin/view_broadsheet', $data);
		$this->load->view('admin/footer');
	}
	}
	public function showscores(){
	   $class=$this->input->post('classes');
	   $term=$this->input->post('term');
	   $session=$this->input->post('session');
	   $data['query_scores'] = $this->model->getscore($class,$term,    $session);

	   // create array to hold the new organized data;
	   $list = array();
	   // list['scores'] will hold the student scores;
	   // list['students']  = will hold the student names
	   // list['subjects'] =  will hold the subjects names

	  // loop throught the result 
	  foreach ($query_scores->result() as $row){
		 $list['scores'][$row->student_id][$row->subject_id] = $row->scores;
		 $list['students'][$row->student_id]= $row->student_name;
		 $list['subjects'][$row->subject_id]= $row->subject_name;
	  }

	  $this->load->view('scoresheet', $list);
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
		$this->load->view('admin/footer');
		
	}
	
	   public function change_student_class()
	{
	$stud_id = $this->input->post('stud_id');
	$data['message']="";
	$data['query_student']=$this->general_model->getstudent_byid($stud_id);
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_class']=$this->general_model->getclasses();
	$data['query_division']=$this->general_model->getclass_division();
	
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_change_student_id();
		$this->load->view('admin/change_student_class_arm', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function ajax_change_student_class()
	{
	$student_id=$_POST['student_id'];
	$oldclass_arm=$_POST['oldclass_arm'];
	$newclass_arm=$_POST['newclass_arm'];
	$oldclass=$_POST['oldclass'];
	$newclass=$_POST['newclass'];
	$oldsess=$_POST['old_session'];
	$newsess=$_POST['new_session'];
	
	
	$data = array(
					'class'=>strtoupper(trim($newclass)),
					'class_division'=>strtoupper(trim($newclass_arm)),
					'session'=>strtoupper(trim($newsess))
					);
			
$this->db->where('student_id', $student_id);
$this->db->update('student', $data);

	echo "Student Class/Class Arm Changed Successfully!";
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
    $new_phone=$_POST['new_phone'];
	
	$data1 = array(
					'student_id'=>trim($new_id),
					'phone'=>trim($new_phone)
					);
	$data = array(
					'student_id'=>trim($new_id)
					);
			
$this->db->where('student_id', $old_id);
$this->db->update('student', $data1);

$this->db->where('student_id', $old_id);
$this->db->update('termscore', $data);

$this->db->where('student_id', $old_id);
$this->db->update('principal_comment', $data);

$this->db->where('student_id', $old_id);
$this->db->update('pin', $data);

$this->db->where('student_id', $old_id);
$this->db->update('tea_comment', $data);

$this->db->where('student_id', $old_id);
$this->db->update('behavioural_hw', $data);

	echo "Student Id Changed Successfully!";
	}


public function Ajax_deleteclass()
{
	$id = $this->input->post('id');
	 $this->db->where('id', $id);
		  $this->db->delete('classes');
		echo "SUCCESS";		  
}
public function Ajax_deleteclassArm()
{
	$id = $this->input->post('id');
	 $this->db->where('id', $id);
		  $this->db->delete('class_division');
		echo "SUCCESS";		  
}
public function Ajax_deleteSubject()
{
	$id = $this->input->post('id');
	 $this->db->where('s_n', $id);
		  $this->db->delete('subject');
		echo "SUCCESS";		  
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
		$this->load->view('admin/footer');
	}
	
	
	
	public function change_class_classarm()
	{
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/change_class_arm');
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->query_edit_student($data);
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
	
	}
	}
	
	public function schemeof_work()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/footer');
	}
	
	public function timetable()
	{
	$_session = $this->db->query("SELECT session FROM schinfo");
	$_session = $_session->result();
	$session = $_session[0]->session;
	$timetable = $this->db->query("SELECT * FROM timetable WHERE session='$session'");
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['timetable'] = $timetable->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/time_table', $data);
		$this->load->view('admin/footer');
	}
	
	public function scheme()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/scheme_ofwork', $data);
		$this->load->view('admin/footer');
	}
	
	public function theme()
	{
	$data['message']="";
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_teacher']=$this->general_model->get_teachers();
	$session_data = $this->session->userdata('logged_in');
	$staffid = $session_data['admin_id'];
	$data['query_class']=$this->general_model->get_teachers_class($staffid);
	//$data['teacher_theme']=$this->general_model->get_theme($staffid);
		$data['teacher_theme'] = $this->db->query("SELECT * FROM theme WHERE admin_id='$staffid'");
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/theme', $data);
		$this->load->view('admin/footer');
	}
	public function get_theme($filename)
	{
		//$filepath = $this->db->query("SELECT filepath FROM lesson_note_uploads WHERE filename='$filename'");
		//$file = $filepath->result_array();
		//var_dump($file[0]["filepath"]);
		$data = file_get_contents("./uploads/theme/".$filename); // Read the file's contents
		$name = $filename;
		force_download($name, $data); 
	}

	public function upload_theme()
	{
		
		$now = time();
		$current_time = unix_to_human($now);
		$term = $this->input->post('term');
		$session = $this->input->post('session');

	
		$config['upload_path'] = './uploads/theme/';
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
			$staffid = $session_data['admin_id'];
			$filename = $data["upload_data"]['orig_name'];
			$filepath = "./uploads/theme".$data["upload_data"]['orig_name'];
			$data['query_class']=$this->general_model->get_teachers_class($staffid);
			$data['query_subject']=$this->general_model->get_teachers_subject($staffid);	
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['message'] = "Upload Successful";
			//$data['teacher_theme']=$this->general_model->get_theme($staffid);
						$data['teacher_theme'] = $this->db->query("SELECT * FROM theme WHERE admin_id='$staffid'");
			$this->general_model->upload_theme($session, $term, $current_time, $staffid, $filename, $filepath, $teachername);
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar_new');
			$this->load->view('admin/theme', $data);
			$this->load->view('admin/footer');
			
		}
		//$this->general_model->upload_lesson_note($session, $term, $subject, $current_time);
		

	}
	public function code_conduct()
	{
	$data['message']="";
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
	$data['query_teacher']=$this->general_model->get_teachers();
	$session_data = $this->session->userdata('logged_in');
	$staffid = $session_data['admin_id'];
	$data['query_class']=$this->general_model->get_teachers_class($staffid);
	$data['teacher_code_conduct']=$this->general_model->get_code_conduct($staffid);
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/code_conduct', $data);
		$this->load->view('admin/footer');
	}
	public function get_code_conduct($filename)
	{
		$data = file_get_contents("./uploads/code_conduct/".$filename); // Read the file's contents
		$name = $filename;
		force_download($name, $data); 
	}

	public function upload_code_conduct()
	{
		
		$now = time();
		$current_time = unix_to_human($now);
		$term = $this->input->post('term');
		$session = $this->input->post('session');

	
		$config['upload_path'] = './uploads/code_conduct/';
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
			$staffid = $session_data['admin_id'];
			$filename = $data["upload_data"]['orig_name'];
			$filepath = "./uploads/code_conduct".$data["upload_data"]['orig_name'];
			$data['query_class']=$this->general_model->get_teachers_class($staffid);
			$data['query_subject']=$this->general_model->get_teachers_subject($staffid);	
			$data['schinfo']=$this->general_model->schoolinfo();
			$data['message'] = "Upload Successful";
			$data['teacher_code_conduct']=$this->general_model->get_code_conduct($staffid);
			$this->general_model->upload_code_conduct($session, $term, $current_time, $staffid, $filename, $filepath, $teachername);
			$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar_new');
			$this->load->view('admin/code_conduct', $data);
			$this->load->view('admin/footer');
			
		}
		//$this->general_model->upload_lesson_note($session, $term, $subject, $current_time);
		

	}
	
	public function staff_details()
	{
	//$data['query_class']=$this->general_model->getclasses();
		$data['query_teacher']=$this->general_model->get_teachers();
		$data['schinfo']=$this->general_model->schoolinfo();
		$subjects=$this->db->query("SELECT course FROM subject");
		$class = $this->db->query("SELECT class FROM classes");
		$data['class']=$class->result();
		$data['subjects']=$subjects->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/staff_details', $data);
		$this->load->view('admin/footer');
	}
	

	 public function confirm_staff_status()
 {
    $_session = $this->db->query("SELECT session FROM schinfo");
	$_session = $_session->result();
	$session = $_session[0]->session;
	$_term = $this->db->query("SELECT term FROM schinfo");
	$_term = $_term->result();
	$term = $_term[0]->term;
	
	$id= $this->input->post('id');
	$status= $this->input->post('status');
	
	$i = 0;

	foreach($id as $i)
	{
		$status= $this->input->post('status');
		$data = array(
					'statuss'=>trim($status),
					'session'=>trim($session),
					'term'=>trim($term)
					);
		$this->db->where('staff_id', $i);
		$this->db->update('staff', $data);
		$i++;
	}
	  
	 redirect('school_settings/staff_details');
 }
	
	
	public function data_test()
	{
	$data['query_class']=$this->general_model->getclasses();
	$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/datatable_test', $data);
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
		$this->load->view('admin/footer');
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
				$this->load->view('admin/footer');
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
public function admin_account_page()
{
	$session_data = $this->session->userdata('logged_in');
	$adminid = $session_data['admin_id'];
	$data['query_admin']=$this->general_model->get_admin_info($adminid);
	$data['schinfo']=$this->general_model->schoolinfo();
				$this->load->view('admin/header', $data);
				$this->load->view('admin/sidebar_new');
				$this->load->view('admin/admin_editaccount', $data);
				$this->load->view('admin/footer');
}
public function AjaxAdmin_Update()
{
	$adminid = $this->input->post('adminid');
	$names = $this->input->post('fname');
	$username = $this->input->post('username');
	$phone = $this->input->post('phone');
	$email = $this->input->post('email');
	
		$data = array(
						'name'=>strtoupper(trim($names)),
						'username'=>strtolower(trim($username)),
						'phone_no'=>trim($phone),
						'email'=>strtolower(trim($email))
						);
						$query = $this->db->where('admin_id', $adminid);
						$query = $this->db->update('adminend', $data);
						echo "Admin Records Updated Successfully!";
}
	
	public function Ajaxclass_div_form()
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
						
					echo "SUCCESS";		
			/*$data['query_subject']=$this->general_model->getsubjects();	
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_class']=$this->general_model->getclasses();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/class', $data);*/
		//$this->class_diventry();
	
	}
	public function Ajaxsubject_form()
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
						echo "SUCCESS";
	}
/*public function ajax_class_form()
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
						echo "Class Created Successfully!";
	}*/
	public function Ajax_school_details()
{
$schname = $this->input->post('schname');
$schmotto = $this->input->post('schmotto');
$address = $this->input->post('address');
$postal = $this->input->post('postal');
$email = $this->input->post('email');
$website = $this->input->post('website');
$phone = $this->input->post('phone');
		$data = array(
						'name'=>strtoupper(trim($schname)),
						'slogan'=>strtoupper(trim($schmotto)),
						'address'=>ucwords(trim($address)),
						'phone'=>trim($phone),
						'web_add'=>strtolower(trim($website)),
						'postal_add'=>strtolower(trim($postal)),
						'email'=>strtolower(trim($email))
						);
						$query = $this->db->get_where('schinfo',array('name !='=>""));
			if($query->num_rows()>0){
										$row = $query->row_array();
										$id = $row['id'];
										$this->db->update('schinfo',$data, array('id'=>$id));
									}//else{
						//$this->db->insert('schinfo', $data);
						//}
						//$data['message'] = " Class Arm Inserted Successfully!!!.";
						
					echo "School Settings Updated Successfully";	
}
	
		public function delete(){
			$id =  $this->input->POST('id');
			$this->db->where('id', $id);
			$this->db->delete('curd');
			echo'<div class="alert alert-success">One record deleted Successfully</div>';
			exit;
		}

		public function test(){
			$query = $this->db->query("SELECT staff_id FROM staff WHERE username='adeze'");
					$staff_id = $query->result();
					$data['staff_id'] = $staff_id;
					$this->load->view('staff/test', $data);
		}
public function student_login_details()
	{
		$_session = $this->db->query("SELECT session FROM schinfo");
	$_session = $_session->result();
	$session = $_session[0]->session;
		$data['query_teacher']=$this->db->query("SELECT * FROM student WHERE session='$session'");
		$data['schinfo']=$this->general_model->schoolinfo();
		$subjects=$this->db->query("SELECT course FROM subject");
		$class = $this->db->query("SELECT class FROM classes");
		$data['class']=$class->result();
		$data['subjects']=$subjects->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_login_details', $data);
		$this->load->view('admin/footer');
	}

public function getStudentDetails_Ajax()
        {
        	$student_id = $this->input->post('student_id');
			
        	$staff_regular = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");
        	$staff_subj = $this->db->query("SELECT * FROM staffsubj WHERE staff_id='10'");
        	$classes = $this->db->query("SELECT class FROM classes");
        	$class_division = $this->db->query("SELECT division FROM class_division");
        	$result[0] = $staff_regular->result_array();
        	/*if($staff_subj->num_rows()>0)
        	{
        	$result[1] = $staff_subj->result_array();
        	}
        	else
        	{
        		$result[1] = "nil";
        	}*/
			$result[1] = $staff_subj->result_array();
        	$result[2] = $classes->result_array();
        	$result[3] = $class_division->result_array();
        	echo json_encode($result);
        }
	 public function updateStudentDetails_Ajax()
        {
        	$student_id = $this->input->post('student_id');
			$name = $this->input->post('name');
        	$firstname = $this->input->post('firstname');
        	$phone = $this->input->post('phonenumber');
        	$dob = $this->input->post('dob');
        	$username = $this->input->post('username');
        	$password = $this->input->post('password');
        	
        	//$check = $this->db->query("SELECT * FROM staff WHERE class='$class' AND class_arm='$class_division' AND staff_id!='$staff_id'");
        	//if($check->num_rows()>0)
        	//{
        	//	echo "Class already has a class teacher";
        	//}
        	//else
        	//{
        	$query = $this->db->query("UPDATE student SET surname='$name', firstname='$firstname', phone='$phone', username='$username', password='$password', dob='$dob' WHERE student_id='$student_id'");
        	echo "SUCCESSFUL";
        	//}
        	
        }
 public function deleteStudent_Ajax()
        {
        	$student_id = $this->input->post('student_id');
        	$query = $this->db->query("DELETE FROM student WHERE student_id='$student_id'");
        	echo "SUCCESSFUL";
        }
public function getStaffDetails_Ajax()
		{
			$staff_id = $this->input->post('staff_id');
			$staff_regular = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id'");
			$staff_subj = $this->db->query("SELECT * FROM staffsubj WHERE staff_id='$staff_id'");
			$classes = $this->db->query("SELECT class FROM classes");
			$class_division = $this->db->query("SELECT division FROM class_division");
			$result[0] = $staff_regular->result_array();
			if($staff_subj->num_rows()>0)
			{
			$result[1] = $staff_subj->result_array();
			}
			else
			{
				$result[1] = "nil";
			}
			$result[2] = $classes->result_array();
			$result[3] = $class_division->result_array();
			echo json_encode($result);
		}

		public function updateStaffDetails_Ajax()
		{
			$name = $this->input->post('name');
			$class = $this->input->post('class');
			$class_division = $this->input->post('class_division');
			$email = $this->input->post('email');
			$phonenumber = $this->input->post('phonenumber');
			$staff_id = $this->input->post('staff_id');
			$staff_cat = $this->input->post('staff_cat');
			//$check = $this->db->query("SELECT * FROM staff WHERE class='$class' AND class_arm='$class_division' AND staff_id!='$staff_id'");
			//if($check->num_rows()>0)
			//{
			//	echo "Class already has a class teacher";
			//}
			//else
			//{
			$query = $this->db->query("UPDATE staff SET name='$name', class='$class', class_arm='$class_division', email='$email', phone='$phonenumber', category='$staff_cat' WHERE staff_id='$staff_id'");
			echo "SUCCESSFUL";
			//}
			//if($staff_cat=="CLASS TEACHER"||"PRINCIPAL | HEADMASTER")
			//{
				//$query = $this->db->query("DELETE FROM staffsubj WHERE staff_id='$staff_id';");
			//}
		}

		public function deleteStaffSubject_Ajax()
		{
			$id = $this->input->post('id');
			$query = $this->db->query("DELETE FROM staffsubj WHERE id='$id';");
			echo "SUCCESSFUL";
		}
 public function deleteStaff_Ajax()
        {
        	$staff_id = $this->input->post('staff_id');
        	$query = $this->db->query("DELETE FROM staff WHERE staff_id='$staff_id'");
        	echo "SUCCESSFUL";
        }

		public function addStaffSubject_Ajax()
		{
			$staff_id = $this->input->post('id');
			$subject = $this->input->post('subject');
			$class = $this->input->post('class');
			//$check = $this->db->query("SELECT * FROM staffsubj WHERE subject='$subject' AND class='$class'");
			//if($check->num_rows()>0)
			//{
			//	echo "SUBJECT ALREADY EXISTS";
			//}
			//else
			//{
				$query = $this->db->query("INSERT INTO staffsubj (staff_id, class, class_arm, subject) VALUES ('$staff_id', '$class', '2_JUN', '$subject')");
				echo "SUCCESSFUL";
			//}
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
					$result[$i] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division' and totalscore!=0")->result();
					$i++;
				}
				$data['results']=$result;
				$data['result_details']=[$class, $class_division, $term, $session];
				$data['schinfo']=$this->general_model->schoolinfo();
				$this->load->view('admin/header', $data);
				$this->load->view('admin/sidebar_new');
				$this->load->view('staff/result_view', $data);
				$this->load->view('admin/footer');
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('staff/result_view');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
				$this->load->view('admin/header', $data);
				$this->load->view('admin/sidebar_new');
				$this->load->view('staff/result_view', $data);
				$this->load->view('admin/footer');
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
		
		public function print_ca()
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

 //var_dump($result);
            $mock_date = $this->db->query("SELECT * FROM mock_date WHERE term='$term' AND session='$session'");
	//$data['teachername'] = $teachername->result();
	$data['mock_date'] = $mock_date->result();
            $grading = $this->db->query("SELECT * FROM grade_junior");

             $data['grading'] = $grading->result();
            $key_rating = $this->db->query("SELECT * FROM key_rating");
            $data['key_rating'] = $key_rating->result();

			$this->load->view('staff/print_ca', $data);
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
				$this->load->view('admin/footer');
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('school_settings/preschoolresult_view');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/result_view', $data);
				$this->load->view('admin/footer');
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
		$teachername = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id' AND status='ACTIVE'");
		$_staff_id = $this->db->query("SELECT * FROM principal_comment WHERE class='$class' AND class_division='$class_division' AND session='$session' AND term='$term'");
		$_staff_id = $_staff_id->result();
		$staff_id = $_staff_id[0]->staff_id;
		$principalname = $this->db->query("SELECT * FROM staff WHERE staff_id='$staff_id' AND status='ACTIVE'");
	$data['teachername'] = $teachername->result();
	$data['principalname'] = $principalname->result();
		switch ($term) {
			case "FIRST TERM":
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 ORDER BY subject ASC");

			$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

			$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

			
			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

			foreach($result->result() as $r)
			{
				$get_scores = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 AND subject='$r->subject'");
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
			$tezz = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' and totalscore!=0 AND class_division='$class_division' AND subject='COMPUTER'");
			$numberinclass = count($this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_division' AND  status='ACTIVE'")->result());
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
			$data['subject_break'] = $subject_break->result();
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
$no_of_terms = $this->db->query("SELECT DISTINCT term FROM termscore WHERE student_id='$student_id' AND session='$session' and totalscore!=0 AND class='$class' AND term!='THIRD TERM'");
$terms = $no_of_terms->result();
$terms = count($terms);
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 ORDER BY subject ASC");

			$first_result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' and totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

			$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

			$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

			foreach($result->result() as $r)
			{
				$get_scores = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 AND subject='$r->subject'");
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
			$tezz = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND subject='COMPUTER'");
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
			$data['session']=$session;
			$data['first_result']=$first_result->result();
			$data['subject_break'] = $subject_break->result();
	    //	$data['grading_break'] = $subject_break;
			$data['skills']=$skills->result();
			$data['skills_row'] = $skills->num_rows();
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
			$this->load->view('staff/print_result_jun_secondterm', $data);
			
			break;
			case "THIRD TERM":
/*$no_of_terms = $this->db->query("SELECT DISTINCT term FROM termscore WHERE student_id='$student_id' AND session='$session' and totalscore!=0 AND class='$class'");
$terms = $no_of_terms->result();
$terms = count($terms);
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' and totalscore!=0 AND session='$session' AND class_division='$class_division' ORDER BY subject ASC");

			$first_result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' and totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");

			$second_result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='SECOND TERM' AND session='$session' and totalscore!=0 AND class_division='$class_division' ORDER BY subject ASC");
	
			$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

			$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

			foreach($result->result() as $r)
			{
				$get_scores = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 AND subject='$r->subject'");
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
			$tezz = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' and totalscore!=0 AND subject='COMPUTER'");
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
			$data['first_result']=$first_result->result();
			$data['second_result']=$second_result->result();
			$data['skills']=$skills->result();
			$data['skills_row'] = $skills->num_rows();
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
			$this->load->view('staff/print_result_jun_thirdterm', $data);
			
			break;
			default:
			echo $term.$session.$class.$class_division.$student_id;*/
				$no_of_terms = $this->db->query("SELECT DISTINCT term FROM termscore WHERE student_id='$student_id' AND session='$session' AND class='$class'");
$terms = $no_of_terms->result();
$terms = count($terms);
			$result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND totalscore!=0 ORDER BY subject ASC");

			$first_result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='FIRST TERM' AND session='$session' AND class_division='$class_division' AND totalscore!=0 ORDER BY subject ASC");

			$second_result = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND class='$class' AND term='SECOND TERM' AND session='$session' AND class_division='$class_division' AND totalscore!=0 ORDER BY subject ASC");
	
			$skills = $this->db->query("SELECT * FROM behavioural_hw WHERE student_id='$student_id' AND class='$class' AND term='$term' AND session='$session' AND class_division='$class_division'");

			$school_settings = $this->db->query("SELECT * FROM settings WHERE term='$term' AND session='$session'");

			$student_details = $this->db->query("SELECT * FROM student WHERE student_id='$student_id'");

			foreach($result->result() as $r)
			{
				$get_scores = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND subject='$r->subject'");
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
			$tezz = $this->db->query("SELECT * FROM termscore WHERE class='$class' AND term='$term' AND session='$session' AND class_division='$class_division' AND subject='COMPUTER'");
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
	    //	$data['grading_break'] = $subject_break;
			$data['session']=$session;
			$data['first_result']=$first_result->result();
			$data['second_result']=$second_result->result();
			$data['skills']=$skills->result();
			$data['skills_row'] = $skills->num_rows();
			$data['student_details']=$student_details->result();
			$data['tezz']=$tezz;
			$data['school_settings']=$school_settings->result();
			$data['teacher_comment']=$teacher_comment->result();
			$data['principal_comment']=$principal_comment->result();
			$data['term']=$term;
			$data['class']=$class;
			$data['result']=$result->result();
			$data['average_score']=$average_score;
		//	$data['schinfo']=$this->general_model->schoolinfo();
			
			
			$data['schinfo']=$this->general_model->schoolinfo();
			$this->load->view('staff/print_result_jun_thirdterm', $data);
			
			break;
			default:
			echo $term.$session.$class.$class_division.$student_id;

		}
	}
	public function uploadStudentImage_Ajax()
	{
		$student_id = $this->input->post('student_id');
			$config['upload_path'] = './uploads/perm_upload/student';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$config['max_size']	= '4069';
			$config['file_name'] = $student_id;
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				echo "An error occured!";
			}
			else
			{			
				$data = array('upload_data' => $this->upload->data());
				$filename = $student_id.$data["upload_data"]['file_ext'];
				$img_url = '/upload/perm_upload/student/'.$filename;
				$query = $this->db->query("UPDATE student SET image_url='$img_url' WHERE student_id='$student_id'");
				echo "UPLOAD SUCCESSFUL";
			}
	}
public function student_status_set()
	{

		$_session = $this->db->query("SELECT session FROM schinfo");
			$_session = $_session->result();
			$session = $_session[0]->session;
		$data['all_student']=$this->general_model->get_all_student($session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_status', $data);
		$this->load->view('admin/footer');
	}
	 public function confirm_student_status()
 {
	$id= $this->input->post('id');
	$status= $this->input->post('status');
	
	$i = 0;

	foreach($id as $i)
	{
		$status= $this->input->post('status');
		$data = array(
					'status'=>trim($status)
					);
		$this->db->where('student_id', $i);
		$this->db->update('student', $data);
		$i++;
	}
	  
	 redirect('school_settings/student_status_set');
 }
public function promotion()
	{
	
				$_session = $this->db->query("SELECT session FROM schinfo");
			$_session = $_session->result();
			$session = $_session[0]->session;
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_classes']=$this->general_model->getclasses();
		$data['all_student']=$this->general_model->get_all_student($session);
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/student_promotion', $data);
		$this->load->view('admin/footer');
	}
	 public function confirm_promotion()
 {
     	$_term = $this->db->query("SELECT term FROM schinfo");
			$_term = $_term->result();
			$term = $_term[0]->term;
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_classes']=$this->general_model->getclasses();
	$id= $this->input->post('id');
	$class= $this->input->post('classes');
	$class_arm= $this->input->post('class_arm');
	$session= $this->input->post('session');
	$i = 0;

	foreach($id as $i)
	{
		$class= $this->input->post('classes');
		$class_arm= $this->input->post('class_arm');
		//$term="FIRST TERM";
		$session= $this->input->post('session');
		$data = array(
					'class'=>trim(strtoupper($class)),
					'class_division'=>trim(strtoupper($class_arm)),
										'session'=>trim($session)
					);
		$this->db->where('student_id', $i);
		$this->db->update('student', $data);
		$this->db->query("UPDATE termscore SET class='$class', class_division='$class_arm' WHERE student_id='$i' AND term='$term' AND session='$session'");
		$this->db->query("UPDATE cbt_history SET class='$class', class_division='$class_arm' WHERE student_id='$i' AND term='$term' AND session='$session'");

		$i++;
	}
	  
	 redirect('school_settings/promotion');
 }
public function non_active_student()
{ 
	
		
		$data['query_division']=$this->general_model->getclass_division();
		$data['query_classes']=$this->general_model->getclasses();
		$data['all_student']=$this->db->query("SELECT * FROM student WHERE session='2019/2020'");
		$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_new');
		$this->load->view('admin/non_active_student', $data);
		$this->load->view('admin/footer');
}
 public function activate_student()
 {
	$data['query_division']=$this->general_model->getclass_division();
	$data['query_classes']=$this->general_model->getclasses();
	$id= $this->input->post('id');
	$class= $this->input->post('classes');
	$class_arm= $this->input->post('class_arm');
	$session= $this->input->post('session');
	$status= $this->input->post('status');
	
	$i = 0;

	foreach($id as $i)
	{
		$class= $this->input->post('classes');
		$class_arm= $this->input->post('class_arm');
		$session= $this->input->post('session');
		$status= $this->input->post('status');
		$data = array(
					'class'=>trim(strtoupper($class)),
					'class_division'=>trim(strtoupper($class_arm)),
					'session'=>trim($session),
					'status'=>trim(strtoupper($status))
					);
		$this->db->where('student_id', $i);
		$this->db->update('student', $data);
		$i++;
	}
	  
	 redirect('school_settings/non_active_student');
 }
 public function result_notification()
	{
		$sessions  = $this->db->query("SELECT * FROM settings");
		$data['sessions'] = $sessions->result();
			$data['query_division']=$this->general_model->getclass_division();
			$data['query_class']=$this->general_model->getclasses();
			$data['schinfo']=$this->general_model->schoolinfo();
		$this->load->view('admin/header', $data);
			$this->load->view('admin/sidebar_new', $data);
			$this->load->view('admin/result_notification', $data);
			$this->load->view('admin/footer');
	}
	
	public function send_result_notification()
	{
		$session = $this->input->post('session');
		$term = $this->input->post('term');
		$class = $this->input->post('class');
		$class_division = $this->input->post('class_division');
		
		$students = $this->db->query("SELECT * FROM student WHERE status='ACTIVE' AND class='$class' AND class_division='$class_division' AND session='$session'");
		$count = $count = count($students->result());
		$students = $students->result();
		$to = '';
		$subject = 'Result Notification';
		$from = 'no-reply@schooldriveng.com';
		 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .= '<h2 style="color:#ddd;">Result Notification!</h2>';
		$message .= '<p style="color:#000;font-size:18px;">This is to inform you that this term\'s result for your ward is now available online.</p>';
		$message .= '<p style="color:#000;font-size:18px;">Log in to the student portal using the credentials given to you to view the result.</p>';
		$message .= '</body></html>';
		 
		// Sending email

		$encoded_url = array(
			'option'=>'com_spc',
			'comm'=>'spc_api',
			'username'=>'michaelwilli',
			'password'=>'oshosanya1997',
			'sender'=>'MountnTop',
			'recipient'=>'',
			'message'=>'This is to inform you that your wards RESULT, NEWSLETTER, CBT for this term is now avaible on the school portal.'
		);
		foreach($students as $s)
		{
			$encoded_url['recipient']=$s->phone;
			$to = $s->email;
			mail($to, $subject, $message, $headers);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, 
				'https://netbulksms.com/index.php?'.http_build_query($encoded_url)
			);
			$content = curl_exec($ch);
		}
		
		
		$this->db->query("UPDATE settings SET result_notification=1 WHERE term='$term' AND session='$session'");
		echo "Notification sent successfully to ".$count." students";
		return;
	}

}
