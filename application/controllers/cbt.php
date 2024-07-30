<?php
    class Cbt extends CI_Controller{
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

          public function init()
          {
              $_schinfo = $this->db->query("SELECT * FROM schinfo");
              $_term = $_schinfo->result();
              $term = $_term[0]->term;
              $session = $_term[0]->session;
              $session_data = $this->session->userdata('logged_in');
              $staff_id = $session_data['staff_id'];
              $exams = $this->db->query("SELECT * FROM cbt_exams WHERE staff_id='$staff_id' AND term='$term'AND session='$session'");
              $teacher_class = $this->db->query("SELECT DISTINCT class FROM staffsubj WHERE staff_id='$staff_id'");
              $teacher_subject = $this->db->query("SELECT DISTINCT subject FROM staffsubj WHERE staff_id='$staff_id'");
              $data['classes'] = $teacher_class->result();
              $data['subjects'] = $teacher_subject->result();
              $data['exams'] = $exams->result();
              $data['schinfo']=$this->general_model->schoolinfo();
              $this->load->view('staff/header', $data);
              $this->load->view('staff/sidebar_staff');
              $this->load->view('staff/cbt_init');
              //$this->load->view('admin/footer');
          }

          public function create()
          {
              $session_data = $this->session->userdata('logged_in');
              $staff_id = $session_data['staff_id'];
              $subject = strtoupper($this->input->post('subject'));
              $class = strtoupper($this->input->post('class'));
              $term = $this->input->post('term');
              $_session = $this->db->query("SELECT session FROM schinfo");
          	  $_session = $_session->result();
          	  $session = $_session[0]->session;
              $check = $this->db->query("SELECT * FROM cbt_exams WHERE subject='$subject' AND class='$class' AND term='$term' AND session='$session'");
              if($check->num_rows()>0)
              {
                  echo("Exam already exists");
              }
              else
              {
                  $query = $this->db->query("INSERT INTO cbt_exams (class, subject, session, staff_id, term) VALUES('$class', '$subject', '$session', '$staff_id', '$term')");
                  echo("Exam Created Successfully");
              }
          }

          public function edit()
          {
              $exam_id = $this->uri->segment(3, 0);
              $data['schinfo']=$this->general_model->schoolinfo();
              $questions = $this->db->query("SELECT * FROM cbt_questions WHERE exam_id='$exam_id'");
              $data['questions']  = $questions->result();
              $this->load->view('staff/header', $data);
              $this->load->view('staff/sidebar_staff');
              $this->load->view('staff/cbt_edit');
          }

          public function submit()
          {
              $date = date('d-m-y h:i:a');
              $exam_id = $this->input->post('exam_id');
              $exam = $this->input->post('exam');
              $check = $this->db->query("SELECT * FROM cbt_questions WHERE exam_id='$exam_id'");
              if($check->num_rows()>0)
              {
                  $data = ['question' => $exam, 'updated_at' => $date];
                  $where = "exam_id = '$exam_id'";
                  $str = $this->db->update_string('cbt_questions', $data, $where);
                  $this->db->query($str);
              }
              else
              {
                  $data = array('exam_id' => $exam_id, 'question' => $exam, 'created_at' => $date, 'updated_at' => $date);
                  $str = $this->db->insert_string('cbt_questions', $data);
                  $this->db->query($str);
              }
              echo "true";
          }

          public function exam_options()
          {
              $exam_id = $this->input->post("exam_id");
              $query = $this->db->query("SELECT * FROM cbt_exams WHERE id='$exam_id'");
              echo json_encode($query->result());
          }

          public function update_exam()
          {
              $class = strtoupper($this->input->post('class'));
              $subject = strtoupper($this->input->post('subject'));
              $term = $this->input->post('term');
              $time = $this->input->post('time');
              $exam_id = $this->input->post('exam_id');
              $visibility = $this->input->post('visibility');
              $data = ['class' => $class, 'subject' => $subject, 'term'=>$term, 'time'=>$time, 'visible'=>$visibility];
              $where = "id = '$exam_id'";
              $str = $this->db->update_string('cbt_exams', $data, $where);
              $this->db->query($str);
              echo "true";
          }

          public function view_exams()
          {
              $session_data = $this->session->userdata('logged_in');
              $username= $session_data['username'];
              $class = $this->db->query("SELECT class FROM student WHERE username='$username'")->result();
              $_schinfo = $this->db->query("SELECT * FROM schinfo");
              $_term = $_schinfo->result();
              $term = $_term[0]->term;
              $session = $_term[0]->session;
              $class = $class[0]->class;
              $exams = $this->db->query("SELECT * FROM cbt_exams WHERE class='$class' AND term='$term' AND session='$session' AND visible='1'");
              $data['exams']  = $exams->result();
              $studentdetails = $this->db->query("SELECT * FROM student WHERE username='$username'")->result();
              $data['studentdetails'] = $studentdetails;
              $data['schinfo']=$this->general_model->schoolinfo();
              $data['studentdetails']=$data['studentdetails'][0];
              $this->load->view('student/header', $data);
              $this->load->view('student/sidebar');
              $this->load->view('student/cbt', $data);
          }

          public function take_exam()
          {
            $session_data = $this->session->userdata('logged_in');
              $username= $session_data['username'];
            $exam_id = $this->uri->segment(3, 0);
            $history = $this->db->query("SELECT * FROM cbt_history WHERE username='$username' AND exam_id='$exam_id'")->result();
            if(count($history)>0)
            {
            	echo "You cannot take this exam a second time";
            	die();
            }
            $exam = $this->db->query("SELECT * FROM cbt_questions WHERE exam_id='$exam_id'");
            $exam_options = $this->db->query("SELECT * FROM cbt_exams WHERE id='$exam_id'");
            $studentdetails = $this->db->query("SELECT * FROM student WHERE username='$username'")->result();
            $data['exam_options'] = $exam_options->result();
            $data['questions']  =   $exam->result();
              $data['studentdetails'] = $studentdetails;
              $data['schinfo']=$this->general_model->schoolinfo();
              $data['studentdetails']=$data['studentdetails'][0];
              $this->load->view('student/header', $data);
              $this->load->view('student/sidebar');
              $this->load->view('student/cbt_exam', $data);

          }
          
public function jamb_student_submit()
          {
          	$session = $this->db->query("SELECT * FROM schinfo")->result();
          	//echo var_dump($session);
          	$term = $session[0]->term;
		$session = $session[0]->session;
		$subject = $this->input->post('subject');
          	$session_data = $this->session->userdata('logged_in');
		$username= $session_data['username'];
		$_student_id = $this->db->query("SELECT * FROM student WHERE username='$username'");
		$_student_id = $_student_id->result();
		$student_id = $_student_id[0]->student_id;
		$names = $this->db->query("SELECT surname, firstname, othername FROM student WHERE student_id='$student_id'");
	        $surname = $names->result();
	        $surname = $surname[0]->surname;
	        $firstname = $names->result();
	        $firstname = $firstname[0]->firstname;
	        $othername = $names->result();
	        $othername = $othername[0]->othername;
	        $name = $surname." ".$firstname." ".$othername;
	        $class = $this->db->query("SELECT class FROM student WHERE student_id='$student_id'")->result();
		$class = $class[0]->class;
		$class_division = $this->db->query("SELECT class_division FROM student WHERE student_id='$student_id'")->result();
		$class_division = $class_division[0]->class_division;
		$totalscore = $student[1]+$student[2];
            $question = json_decode($this->input->post('exam'));
            //echo json_encode($question);
            $exam_id = $this->input->post('exam_id');
            $exam = $this->db->query("SELECT * FROM cbt_questions WHERE exam_id='$exam_id'")->result();
            $exam = json_decode($exam[0]->question);
            // echo var_dump($exam);
            // die();
            $score = 0;
            foreach($question as $key=>$q)
            {
              $opt = json_decode($q->correct_option);
              if($q->correct_option==$exam[$key]->correct_option)
              {
                $score+=2;
              }
            }
            $historycheck = $this->db->query("SELECT * FROM cbt_history WHERE username='$username' AND exam_id='$exam_id' AND term='$term' AND name='$name' AND session='$session' AND subject='$subject' AND score='$score'")->result();
            $termscoecheck = $this->db->query("SELECT * FROM termscore WHERE student_id='$student_id' AND term='$term' AND session='$session' AND subject='$subject' AND ca!='0' ")->result();
            if(count($historycheck)>0)
            {
               echo "You cannot submit this exam a second time";
            	die();
            }
            
            $query = $this->db->query("INSERT INTO termscore (studentname,student_id,term,class,class_division,subject,ca,session) VALUES ('$name','$student_id','$term','$class','$class_division','$subject','$score', '$session')");
            
            $this->db->query("INSERT INTO cbt_history (exam_id, username, student_id,name,term,class,class_division,subject,session, score) VALUES ('$exam_id', '$username','$student_id','$name','$term','$class','$class_division','$subject', '$session','$score')");
            echo $score;
            
            
          }
          
          
          public function history()
          {
          	$session_data = $this->session->userdata('logged_in');
              $username= $session_data['username'];
          	$history = $this->db->query("SELECT * FROM cbt_history WHERE username='$username'")->result();
              $data['schinfo']=$this->general_model->schoolinfo();
              $data['history']=$history;
              $this->load->view('student/header', $data);
              $this->load->view('student/sidebar');
              $this->load->view('student/cbt_history', $data);
          }
        
        //cbt result view
        
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

        
         public function view_cbt_result()
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
	        		$result[$i] = $this->db->query("SELECT * FROM termscore WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division' AND ca1!='0' ")->result();
	        		$i++;
	        	}
	        	$data['results']=$result;
	        	$data['result_details']=[$class, $class_division, $term, $session];
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/cbt_result_view', $data);
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('cbt/view_cbt_result');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/cbt_result_view', $data);
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
	}
	
	public function deleteCbtScore_Ajax()
        {
        	$id = $this->input->post('id');
        	$query = $this->db->query("DELETE FROM termscore WHERE id='$id'");
        	echo "SUCCESSFUL";
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
		
		public function cbt_theory()
          {
              $session_data = $this->session->userdata('logged_in');
              $staff_id = $session_data['staff_id'];
              $exams = $this->db->query("SELECT * FROM cbt_theory WHERE staff_id='$staff_id'");
              $teacher_class = $this->db->query("SELECT DISTINCT class FROM staffsubj WHERE staff_id='$staff_id'");
              $teacher_subject = $this->db->query("SELECT DISTINCT subject FROM staffsubj WHERE staff_id='$staff_id'");
              $data['classes'] = $teacher_class->result();
              $data['subjects'] = $teacher_subject->result();
              $data['exams'] = $exams->result();
              $data['schinfo']=$this->general_model->schoolinfo();
              $this->load->view('staff/header', $data);
              $this->load->view('staff/sidebar_staff');
              $this->load->view('staff/cbt_theory');
              //$this->load->view('admin/footer');
          }
          
    public function create_theory()
          {
              $session_data = $this->session->userdata('logged_in');
              $staff_id = $session_data['staff_id'];
              $subject = strtoupper($this->input->post('subject'));
              $class = strtoupper($this->input->post('class'));
              $term = $this->input->post('term');
              $_session = $this->db->query("SELECT session FROM schinfo");
          	  $_session = $_session->result();
          	  $session = $_session[0]->session;
              $check = $this->db->query("SELECT * FROM cbt_theory WHERE subject='$subject' AND class='$class' AND term='$term' AND session='$session'");
              if($check->num_rows()>0)
              {
                  echo("Theory Exam already exists");
              }
              else
              {
                  $query = $this->db->query("INSERT INTO cbt_theory (class, subject, session, staff_id, term) VALUES('$class', '$subject', '$session', '$staff_id', '$term')");
                  echo("Theory Exam Created Successfully");
              }
          }
          
    public function theory_exam_options()
          {
              $exam_id = $this->input->post("exam_id");
              $query = $this->db->query("SELECT * FROM cbt_theory WHERE id='$exam_id'");
              echo json_encode($query->result());
          }
          
     public function update_theory()
          {
              $class = strtoupper($this->input->post('class'));
              $subject = strtoupper($this->input->post('subject'));
              $term = $this->input->post('term');
              $time = $this->input->post('time');
              $exam_id = $this->input->post('exam_id');
              $visibility = $this->input->post('visibility');
              $data = ['class' => $class, 'subject' => $subject, 'term'=>$term, 'time'=>$time, 'visible'=>$visibility];
              $where = "id = '$exam_id'";
              $str = $this->db->update_string('cbt_theory', $data, $where);
              $this->db->query($str);
              echo "true";
          }
          
    public function edit_theory()
          {
              $exam_id = $this->uri->segment(3, 0);
              $data['schinfo']=$this->general_model->schoolinfo();
              $questions = $this->db->query("SELECT * FROM cbt_theory_questions WHERE exam_id='$exam_id'");
              $data['questions']  = $questions->result();
              $this->load->view('staff/header', $data);
              $this->load->view('staff/sidebar_staff');
              $this->load->view('staff/cbt_theory_edit');
          }
          
           public function view_sample_cbt_result()
        {
	        $schinfo = $this->db->query("SELECT * FROM schinfo");
	$schinfo = $schinfo->result();
	$session = $schinfo[0]->session;
	$term = $schinfo[0]->term;
	$session_data = $this->session->userdata('logged_in');
	        	$students = $this->db->query("SELECT * FROM cbt_history");
if($students->num_rows()>0) {
	        	$students = $students->result();
	        	
	        	$data['all_result']=$students;
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/cbt_sample_result_view', $data);

				
			}
    }
    
public function view_cbt_history_result()
        {
	        if($this->input->post())
	        	{
	        	$class = $this->input->post('class');
	        	$class_division = $this->input->post('class_division');
	        	$term = $this->input->post('term');
	        	$session = $this->input->post('session');
	        	$students = $this->db->query("SELECT DISTINCT student_id FROM cbt_history WHERE class='$class' AND class_division='$class_division' AND term='$term' AND session='$session'");
if($students->num_rows()>0) {
	        	$students = $students->result();
	        	$result;
	        	$i = 0;
	        	foreach($students as $student)
	        	{
	        		$result[$i] = $this->db->query("SELECT * FROM cbt_history WHERE student_id='$student->student_id' AND term='$term' AND session='$session' AND class='$class' AND class_division='$class_division' ")->result();
	        		$i++;
	        	}
	        	$data['results']=$result;
	        	$data['result_details']=[$class, $class_division, $term, $session];
	        	$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/cbt_historyresult_view', $data);
}else {
$this->session->set_flashdata('warning', 'Result not available for '.$class.$class_division.' '.$term.','.$session);
redirect('cbt/cbt_historyresult_view');
}
			}
			else
			{
				$data['schinfo']=$this->general_model->schoolinfo();
	        	$this->load->view('staff/header', $data);
				$this->load->view('staff/sidebar_staff');
				$this->load->view('staff/cbt_historyresult_view', $data);
			}
    }

public function deleteCbtHistoryScore_Ajax()
        {
        	
        	$subid = $this->input->post('id');
        	$query = $this->db->query("DELETE FROM cbt_history WHERE id='$subid'");
        	echo "SUCCESSFUL";
        }
    
    }