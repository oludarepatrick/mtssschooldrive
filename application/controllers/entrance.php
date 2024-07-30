<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Entrance extends CI_Controller
    {
    	public function __construct()
    	{
    		parent::__construct();
    		$this->load->helper('html');
    		$this->load->helper('form');
    		//$this->load->model('entrance_model');
    // 		$this->load->model('company');
    		$this->load->helper('url');
    		$this->load->library('session');
    	//	$this->load->helper('pdf_helper');
    		$this->load->library('form_validation');
    		//$this->load->library('email');
    		$this->load->library('zeptomail_library');
    		$this->load->library('pagination');
    		$this->form_validation->set_error_delimiters('<div class="err">', '</div>');
    
    	}
	
    	public function index()
    	{
    	    $data['report']="";
        	$this->load->view('entrance/form', $data);
    	}
    	
    	public function create_account()
    	{
    	    $email=$this->input->post('email');
    	    $password=$this->input->post('password');
    	    $cPassword=$this->input->post('cpassword');
    	    $uuid=uniqid();
    	    $date=date('Y-m-d');
    	    
    	    if(empty($email) || empty($password) || empty($cPassword))
    	    {
    	        redirect('entrance/errorpage/1');
    	    }
    	    
    	    if($password != $cPassword)
    	    {
    	        redirect('entrance/errorpage/2');
    	    }
    	    
    	    
    	    $this->db->where('email', $email);
            $query = $this->db->get('entrances');
    	    
    	    if($query->num_rows() > 0)
    	    {
    	        redirect('entrance/errorpage/3');
    	    }
    	    
    	    $appno = $this->generate_application_number();
    	    
    	    $data = array(
                'uuid' => $uuid,
                'appno'=> $appno,
                'email' => $email,
                'password'=>$password,
                'created_at'=>$date
            );
    
            $this->db->insert('entrances', $data);
            if ($this->db->affected_rows() == 0) 
            {
                redirect('entrance/errorpage/4');
            } 
    	    
    	    $subject="MTSS Account Verification";
    	    $link="https://mtss.schooldriveng.com/index.php/entrance/verify/".$uuid;
    	    $message="<h2>Hi $email !</h2><p>Please lick on below link to verify your email<br>".$link."</p><p><br/><br/>Leverpay Team.</p>";
    	    
    	    $msg=$this->zeptomail_library->sendmail($email,$subject,$message);
    	    
    	    redirect('entrance/success/12895051102');
            
    	}
        public function success($val)
    	{
    	    
    	    $data['report']=$val;
    	    $this->load->view('entrance/success_page', $data);
        }
        
        public function verify($uuid)
        {
            $this->db->where('uuid', $uuid);
            $this->db->where('status', 1);
            $query = $this->db->get('entrances');
    	    
    	    if($query->num_rows() == 0)
    	    {
    	        echo "<h1 align='center'>The Link is Invalid or Expired</h1>";
    	        exit();
    	    }
    	    $this->db->where('uuid', $uuid);
            $this->db->update('entrances', array('status' => 2));
            
            
    	    redirect('entrance/success/10975053162');
        
        }
        
        public function login()
        {
            $data['report']="";
        	$this->load->view('entrance/login', $data);
        }
        
        public function login_exec()
        {
            $email=$this->input->post('email');
    	    $password=$this->input->post('password');
    	    
    	    $this->db->where('email', $email);
    	    $this->db->where('password', $password);
            $query = $this->db->get('entrances');
    	    
    	    if($query->num_rows() == 0)
    	    {
    	        redirect('entrance/errorpage/5');
    	    }
    	    $record = $query->row();
    	    $uuid = $record->uuid;
    	    $status = $record->status;
    	    //echo $record->email;
    	    if($status==1)
    	    {
    	        redirect('entrance/errorpage/6');
    	    }
    	    elseif($status==2)
    	    {
    	        redirect('entrance/registration/'.$uuid);
    	    }
    	    else{
        	    if($status==3 || $status==4)
        	    {
        	        redirect('entrance/dashboard/'.$uuid);
        	    }
    	    }
    	    
        }
        public function registration($uuid)
        {
            if(!empty($uuid))
            {
                $this->db->where('uuid', $uuid);
                $query = $this->db->get('entrances');
                
                if($query->num_rows() > 0)
    	        {
        	        $data['record'] = $query->row();
            	    $this->load->view('entrance/register', $data);
    	        }
    	        else{
    	           redirect('entrance/errorpage/5'); 
    	        }
            }
            else{
                redirect('entrance/errorpage/5');
            }
        }
        
        public function regExec()
        {
    	    if(empty($this->input->post('sname')) || empty($this->input->post('fname')) || empty($this->input->post('gender')) || empty($this->input->post('dob'))  || empty($this->input->post('nationality')) || empty($this->input->post('state')) || empty($this->input->post('lga'))
    	    || empty($this->input->post('religion')) || empty($this->input->post('denomination')) || empty($this->input->post('address')) || empty($this->input->post('lastclass')) || empty($this->input->post('newclass')) || empty($this->input->post('classarm')) || empty($this->input->post('lastschool')) || empty($this->input->post('fathername')) || empty($this->input->post('mothername')) || empty($this->input->post('officeaddress')) || empty($this->input->post('phone')) || empty($this->input->post('uuid')))
    	    {
    	        echo "<script>alert('All fields mark with red asterisk are required')</script>";
    	        redirect('entrance/registration/'.$uuid);
    	    }
    	    
    	    $sname=$this->input->post('sname');
    	    $fname=$this->input->post('fname');
    	    $oname=$this->input->post('oname');
    	    $gender=$this->input->post('gender');
    	    $dob=$this->input->post('dob');
    	    $nationality=$this->input->post('nationality');
    	    $state=$this->input->post('state');
    	    $lga=$this->input->post('lga');
    	    $religion=$this->input->post('religion');
    	    $denomination=$this->input->post('denomination');
    	    $address=$this->input->post('address');
    	    $lastclass=$this->input->post('lastclass');
    	    $newclass=$this->input->post('newclass');
    	    
    	    $classarm=$this->input->post('classarm');
    	    $lastschool=$this->input->post('lastschool');
    	    $fathername=$this->input->post('fathername');
    	    $mothername=$this->input->post('mothername');
    	    $guardian=$this->input->post('guardian');
    	    
    	    $officeaddress=$this->input->post('officeaddress');
    	    $phone=$this->input->post('phone');
    	    $email=$this->input->post('email');
    	    $uuid=$this->input->post('uuid');
    	    $oldStatus=$this->input->post('oldstatus');
    	    
    	    // Begin transaction
            $this->db->trans_start();
    	    
    	    $this->db->where('uuid', $uuid);
            $udateRecord=$this->db->update('entrances', 
                array(
                    'sname' => $sname,
                    'fname' => $fname,
                    'oname' => $oname,
                    'gender' => $gender,
                    'dob' => $dob,
                    'nationality' => $nationality,
                    'state' => $state,
                    'lga' => $lga,
                    'religion'=>$religion,
                    'denomination'=>$denomination,
                    'address'=>$address,
                    'lastclass'=>$lastclass,
                    'newclass'=>$newclass,
                    'classarm'=>$classarm,
                    'lastschool'=>$lastschool,
                    'fathername'=>$fathername,
                    'mothername'=>$mothername,
                    'guardian'=>$guardian,
                    'officeaddress'=>$officeaddress,
                    'phone'=>$phone,
                    'status'=> 3
                )
            );
            
            $this->db->where('uuid', $uuid);
            $query1 = $this->db->get('entrances');
            
            $getAppno=$query1->row();
            
            $student_id = "LVMTSS".(date('y')+1).$getAppno->appno;
            $username = $getAppno->email;
            $password = $getAppno->password;
            
            //$status=($getAppno->status==4)?'PAID':'PENDING';
            
            $this->db->where('status', 1);
            $query3 = $this->db->get('schinfo');
            $getSes=$query3->row();
            
            $session=$getSes->session;
            
            $data2 = array(
                'student_id' => $student_id,
                'surname' => $sname,
                'firstname' => $fname,
                'othername' => $oname,
                'sex' => $gender,
                'state' => $state,
                'nationality' => $nationality,
                'state_of_origin' => $state,
                'religion' => $religion,
                'city' => $lga,
                'dob' => $dob,
                'house' => '-',
                'class' => $newclass,
                'class_division' => $classarm,
                'address' => $address,
                'phone' => $phone,
                'blood_grp' => '-',
                'photo' => '-',
                'thumb_url' => '-',
                'image_url' => '-',
                'username' => $username,
                'password' => $password,
                'status' => 'ACTIVE',
                'session' => $session,
                'last_school' => $lastschool,
                'last_class' => $lastclass,
                'parent_name' => $fathername,
                'payment_status' => 'PAID',
                'entrance_status' => 'entrance',
                'email' => $username
            );
            
            $this->db->where('student_id', $student_id);
            $query2 = $this->db->get('student');
            
            if($query2->num_rows()==0)
            {
                $this->db->insert('student', $data2);
            }
            else{
                $this->db->where('student_id', $student_id);
                $udateRecord=$this->db->update('student', $data2);
            }
            // Commit transaction
            $this->db->trans_complete();
            
            // Check if transaction was successful
            if ($this->db->trans_status() === FALSE) {
                
            } else {
                if($oldStatus==2)
                {
                    $subject="MTSS Entrance Exam Login Details";
            	    $link="https://mtss.schooldriveng.com/";
            	    $message="<h2>Hi ".$sname." ".$fname." ".$oname."  !</h2><p>Below is your login details for MTSS entrance examination</p><p>URL: ".$link."</p><p>Username: $username</p><p>Password: $password</p><p><br/><br/>Leverpay Team.</p>";
            	    
            	    $msg=$this->zeptomail_library->sendmail($username,$subject,$message);
    	    
                }
                // Transaction successful, redirect
                redirect('entrance/dashboard/'.$uuid);
            }


        }
        
        public function dashboard($uuid)
        {
            $this->db->where('uuid', $uuid);
            $query = $this->db->get('entrances');
    	    
    	    if($query->num_rows() == 0)
    	    {
    	        redirect('entrance/errorpage/5');
    	    }
    	    $data['record'] = $query->row();
    	  
    	    
            $this->load->view('entrance/vdashboard',$data);
        }
        
        public function errorpage($val)
    	{
    	    if($val==5 || $val==6)
    	    {
    	        $data['report']=($val==5?"Invalid Username or Password":"Email verification is required");
    	        $this->load->view('entrance/login', $data);
    	    }
    	    else{
        	    if($val==1)
        	    {
        	        $data['report']="All fields are required";
        	    }else if($val==2){
        	        $data['report']="Passwords does not match";
        	    }else if($val==3){
        	        $data['report']="Email address already exist";
        	    }else{ 
        	       $data['report']=="Transaction Failed, try again latter";
        	    }
                $this->load->view('entrance/form', $data);
    	    }
    	}
        	
        public function success_essage()
        {
            $this->load->view('success_page');
        }
            
        public function generate_application_number()
        {
            $this->db->select_max('appno');
            $query = $this->db->get('entrances');
            $result = $query->row();
    
            // Increment the highest application number
            $next_appno = ($result->appno) ? $result->appno + 1 : 1;
    
            // Format the application number (e.g., 001, 002, etc.)
            $formatted_appno = sprintf('%03d', $next_appno);
    
            return $formatted_appno;
        }
    }