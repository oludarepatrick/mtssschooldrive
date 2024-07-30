<?php
class General_model extends MY_Model
{

    function __construct (){
        parent::__construct();
        $this->table_name = 'termscore';
        $this->primary_key = 'sn';
        $this->order_by = 'sn ASC';
    }
	public function getschinfo()
	{
		$query = $this->db->get('schinfo');
		return $query;
		
		}
public function get_admin_info($adminid)
	{
		$query = $this->db->get('adminend');
		return $query;
		
		}
public function get_teachers_info($staffid)
	{
$this->db->where('staff_id',$staffid);
		$query = $this->db->get('staff');
		return $query;
		
		}
		
	public function login($username, $password)
	{
		$this->db->select('staff_id, username, password');
		$this->db->from('staff');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()==1)
		{
		
		return $query->result();
		
		}
		else
		{
			return false;
		}
		
		}
		
	public function getclass_division()
	{
		$query = $this->db->get('class_division');
		return $query;
		
		}	
		
	
	public function getclasses()
	{
		$query = $this->db->query("SELECT * FROM classes");
	return $query;
		
	//$query = $this->db->get('classes');
	//$query = $this->db->get('class_division');
		//return $query;
		/*foreach ($query->result() as $row)
		{
			echo $row->companyname;
			echo $row->companyname;
			echo $row->phone1;
			echo $row->referenceno;
		}*/
	

	}
	public function getsubjects()
	{
		
		
	$query = $this->db->get('subject');
		return $query;
	}
	public function getteacher_subject($staff_id)
	{
	$query = $this->db->query("SELECT DISTINCT subject FROM staffsubj WHERE staff_id='$staff_id'");
	return $query;
	}
	
	public function all_student()
	{
		$query = $this->db->query("SELECT * FROM student");
		return $query;
	}
	
        public function get_all_student($session)
	{
		$query = $this->db->query("SELECT * FROM student WHERE session='$session'");
		return $query;
	}
	public function getubject_division($class, $class_division)
	{
		if ($class == 'JSS 1' || 'JSS 2' || 'JSS 3')
		{
			$query = $this->db->where("subject_division.jun_subject != ''");
			//$query = $this->db->select("SELECT jun_subject FROM subject_division WHERE jun_subject != ''")
			/*$query = $this->db->select('jun_subject');
			$query = $this->db->distinct();*/
			$query = $this->db->get('subject_division');
			return $query;
		}
		else if ($class_division == "science" || "Science" || "SCIENCE")
		{
			$this->db->select('science');
			$query = $this->db->get('subject_division');
			return $query;
		}
		else if ($class_division == "arts" || "Arts" || "ARTS")
		{
			$this->db->select('arts');
			$query = $this->db->get('subject_division');
			return $query;
		}
		else if ($class_division == "commercial" || "Commercial" || "COMMERCIAL")
		{
			$this->db->select('commercial');
			$query = $this->db->get('subject_division');
			return $query;
		}
		


		//$query = $this->db->where('');
	
	}
	
	public function gethouse()
	{
		//$this->db->select('customername, invoicedate, invoiceno');

		//$query = $this->db->get('receipt');
		//$query = $this->db->get('receipt');
		$query = $this->db->get('house');


		return $query;
	}
	/*public function getrec()
	{
		$query = $this->db->get('receipt');
		return $query;
		/*foreach ($query->result() as $row)
		{
			
			//echo $row->companyname;
			//echo $row->phone1;
			//echo $row->referenceno;
		}	
	}*/
	
	public function select($info /*$class, $classDiv*/){
        //$this->db_eschoolin->db_select();
		//this next line will query the second db using db_eschoolin
        //$query = $this->db_eschoolin->query("SELECT * FROM student, student_division WHERE student_division.class ='$class' AND student_division.class_division = '$classDiv' AND student.student_Id = student_division.student_Id");
/*		$query = $this->db->query("SELECT * FROM student, student_division WHERE student_division.class ='$class' AND student_division.class_division = '$classDiv' AND student.student_Id = student_division.student_Id");
		
		return $query;*/
		$query = $this->db->query("SELECT * FROM registration");
		
		return $query;
		
	}
	public function select_receipt($customername,  $invoiceno, $refrenceno)
	{
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername ='$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->where("receipt.customername ='$customername' AND receipt.invoiceno= '$invoiceno' OR receipt.referenceno='$refrenceno'");
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername = '$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->get('receipt');
	return $query;
	/*	if ($query->num_rows() > 0)
{
		foreach ($query->result() as $row)
		{
			
			echo $row->customername;
			echo $row->invoicedate;
			//echo $row->referenceno;
		}	
		//return $query;
	}}*/
}
public function select_student_result_id($classes, $class_arm, $term, $session, $studentid)
{
	$query = $this->db->where("(class ='$classes') AND (class_division ='$class_arm') AND (term ='$term') AND (session ='$session')  AND (student_id ='$studentid') AND (totalscore !=0)");
 	$query = $this->db->get('termscore');
    return $query;
}
public function select_student_result_all($class, $class_division, $term, $session)
{
/*
	$where_subject  = array('term' =>$term, 'class'=> $classes, 'class_division' =>$class_arm, 'session' => $session);
			$this->db->order_by('subject','ASC');
			$this->db->select('subject');
			$this->db->distinct();
		$query=	$this->db->get_where('termscore',$where_subject);*/
	
	$query = $this->db->query("SELECT GROUP_CONCAT(studentname), totalscore FROM termscore WHERE class ='$class' AND class_division ='$class_division' AND term ='$term' AND session ='$session' AND totalscore !=0 GROUP BY studentname, totalscore");
	$this->db->order_by('studentname', 'asc');	

    return $query;
}

//Mickey
public function select_class_subject($class, $class_division, $term, $session)
{
	$query = $this->db->query("SELECT DISTINCT subject FROM termscore WHERE class ='$class' AND class_division='$class_division' AND term='$term' AND session='$session' AND totalscore!=''");
	return $query;
}

public function student_specific_result($studentname, $class, $class_division, $term, $session)
{
	$query = $this->db->query("SELECT DISTINCT subject FROM termscore WHERE studentname='$studentname' AND class ='$class' AND class_division='$class_division' AND term='$term' AND session='$session' AND totalscore!=''");
	return $query;
}

public function select_student_id($classes, $class_arm, $term, $session, $studentid)
{
$query = $this->db->where("(class ='$classes') AND (class_division ='$class_arm') AND (term ='$term') AND (session ='$session') AND (totalscore !=0)");
$this->db->select('student_id');

$query = $this->db->get('termscore');
}
public function studentnames()
{
	$query = $this->db->where("(class ='JSS')");
	$query = $this->db->get('student');

		return $query;
}
public function studentnames_delete()
{
	//$query = $this->db->where("(class ='JSS')");
	$query = $this->db->get('student');

		return $query;
}
public function studentnames_ss()
{
	$query = $this->db->where("(class ='SSS')");
	$query = $this->db->get('student');

		return $query;
}
public function student_pay()
{
	//$query = $this->db->where("(class ='JSS')");
	$query = $this->db->get('student_payment');

		return $query;
}
public function student_pay_ss()
{
	//$query = $this->db->where("(class ='SSS')");
	$query = $this->db->get('student_payment_ss');

		return $query;
}
public function getclass_teacher($classes,$class_arm)
{
	$query = $this->db->where("(class ='$classes') AND (class_arm ='$class_arm')");
	//$query = $this->db->where("(names ='$studname')");
	$query = $this->db->get('staff');
	/*foreach ($query->result() as $row)
		{
			
			//echo $row->class_supervised;
			//echo $row->tuition;
			//echo $row->referenceno;
		}*/
	return $query;
}
public function get_teachers()
{
	//$query = $this->db->get('staff');
	$query = $this->db->query("SELECT * FROM staff");
	
	return $query;
}
public function get_admin()
{
	//$query = $this->db->get('staff');
	$query = $this->db->query("SELECT * FROM adminend");
	
	return $query;
}
public function getteacher_byid($staffid)
{
	$query = $this->db->where("staff_id = '$staffid'");
	$query = $this->db->get('staff');
	
	return $query;
	
}
public function get_teachers2()
{
$query = $this->db->query("SELECT * FROM staff");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
      echo $row->staff_id;
      echo $row->name;
      echo $row->password;
   }
} 
	
	
	
}


public function get_grades()
{
	$query = $this->db->where("lower !=''");
	$query = $this->db->get('grade_junior');
	return $query;
}

public function recoverPass($username)
{
	$query = $this->db->where("student_id ='$username'");
	$query = $this->db->get('student');
	return $query;
}

public function getstudent_byid($stud_id)
{
	$query = $this->db->where("student_id ='$stud_id'");
	//$query = $this->db->where("parent.student_id='$stud_id'");
	
	$query = $this->db->get('student');
	//$query = $this->db->get('parent');
	
	return $query;
}
public function getparent_byid($stud_id)
{
	$query = $this->db->where("student_id ='$stud_id'");
	//$query = $this->db->where("parent.student_id='$stud_id'");
	
	$query = $this->db->get('parent');
	//$query = $this->db->get('parent');
	
	return $query;
}



public function select_student_impute($class, $class_arm, $subject, $term, $session)
{
	//$query = $this->db->where("(class ='$class') AND (class_division ='$class_arm')");
	//$query = $this->db->where("(names ='$studname')");
	//$query = $this->db->get('student');
		/*$query = $this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_arm' LEFT JOIN termscore ON student.student_id=termscore.student_id;");*/
		/*$query = $this->db->query("SELECT * FROM ((SELECT studentname, status, firstname, surname, othername, termscore.student_id, termscore.class, termscore.class_division, subject, exam, termscore.term, termscore.session, termscore.ca FROM student LEFT JOIN termscore ON student.student_id=termscore.student_id) c) WHERE c.class='$class' AND c.class_division='$class_arm' AND c.status='ACTIVE' AND c.subject='$subject' AND c.term='$term' AND c.session='$session';");*/
		
/*$query = $this->db->query("SELECT * FROM ((SELECT studentname, firstname, surname, othername, student.student_id, student.class, student.class_division, subject, exam, a.term, student.session, a.ca FROM student LEFT JOIN (SELECT * FROM termscore WHERE subject='$subject' AND class='$class' and class_division='$class_arm' AND term='$term' AND session='$session') a ON student.student_id=a.student_id) c) WHERE c.class='$class' AND c.class_division='$class_arm' AND c.session='$session'");*/

    $query = $this->db->query("
        SELECT 
            studentname, 
            firstname, 
            surname, 
            othername, 
            student.student_id, 
            student.class, 
            student.class_division, 
            subject, 
            exam, 
            a.term, 
            student.session, 
            a.ca
        FROM 
            student
        LEFT JOIN 
            (
                SELECT * 
                FROM 
                    termscore
                WHERE 
                    subject='$subject' 
                    AND class='$class' 
                    AND class_division='$class_arm' 
                    AND term='$term' 
                    AND session='$session'
            ) a
        ON 
            student.student_id=a.student_id
        WHERE 
            student.class='$class' 
            AND student.class_division='$class_arm' 
            AND student.session='$session'
    ");


		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			$query = $this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_arm' AND status='ACTIVE' AND session='$session'");
			return $query;
		}
	
}

public function select_student_impute_mock($class, $class_arm, $subject, $term, $session)
{
$query = $this->db->query("SELECT * FROM ((SELECT studentname, firstname, surname, othername, student.student_id, student.class, student.class_division, subject, exam, a.term, student.session, a.ca FROM student LEFT JOIN (SELECT * FROM mock WHERE subject='$subject' AND class='$class' and class_division='$class_arm' AND term='$term' AND session='$session') a ON student.student_id=a.student_id) c) WHERE c.class='$class' AND c.class_division='$class_arm' AND c.session='$session'");
	
		//$query = $this->db->query("SELECT * FROM ((SELECT firstname, surname, othername, studentname, mock.student_id, mock.class, mock.class_division, subject, totalscore, mock.term, mock.session FROM student LEFT JOIN mock ON student.student_id=mock.student_id) c) WHERE c.class='$class' AND c.status='ACTIVE' AND c.class_division='$class_arm' AND c.subject='$subject' AND c.term='$term' AND c.session='$session';");
		if($query->num_rows()>0)
		{
			return $query;
		}
		else
		{
			$query = $this->db->query("SELECT * FROM student WHERE class='$class' AND class_division='$class_arm' AND session='$session' AND status='ACTIVE' ORDER BY surname ASC");
			return $query;
		}
	
}

public function get_termscore($array){
		$this->db->order_by('studentname', 'asc');
		$this->db->distinct();
		$query = $this->db->get_where('termscore',$array);
		$flag = FALSE;	
			//print_r($query->result_array());
			if($query->num_rows()>0){
				foreach($query->result_array()  as  $row ){
					
					$id = $row['student_id'];
					$query_status = $this->db->get_where('student_status',array('student_id'=>$id,'class'=>$array['class'],'class_division'=>$array['class_division'],'term'=>$array['term'],'session'=>$array['session']));
					
					if($query_status->num_rows()>0){
						//Do not add students 
											
					}else{
						$result[] = array(
									'student_id'=>$row['student_id'],
									'studentname'=>$row['studentname'],
									'term'=>$row['term'],
									'class'=>$row['class'],
									'class_division'=>$row['class_division'],
									'subject'=>$row['subject'],
									'ca1'=>$row['ca1'],
									'ca2'=>$row['ca2'],
									'ca3'=>$row['ca3'],
									'ca4'=>$row['ca4'],
									'ca5'=>$row['ca5'],
									'ca6'=>$row['ca6'],
									'ca'=>$row['ca'],
									'exam'=>$row['exam'],
									'totalscore'=>$row['totalscore'],
									'session'=>$row['session']
						);
						
						$flag = TRUE;
					
					}//if($query_status->num_rows()>0){
				}//foreach($query->result_array()  as  $row ){
				
				if($flag == TRUE){return $result;}else{ return FALSE;}
			}else{
				return FALSE;
			}//if($query->num_rows()>0){
						
		}
public function select_class_broadsheet12($class, $class_division, $term, $session, $average_score)
{
	$l = 1;
	$table_res = "";  $postab = "";  $score1 ="";
	//$term = strtoupper($term);//convert the term to uppercase - for the case structure below
	
	switch($term){
		case "FIRST TERM": 
		$sql = "SELECT * FROM student_division, student, average WHERE student_division.class = '$class' AND student_division.class_division = '$class_division'  AND student_division.session ='$session' AND student_division.student_id = student.student_id AND student_division.student_id = average.student_id AND average.session = '$session' AND average.firstterm_tag ='A' ORDER BY average.firsttermave DESC";
		break;
		case "SECOND TERM":
		$sql = "SELECT * FROM student_division, student, average WHERE student_division.class = '$class' AND student_division.class_division = '$class_division'  AND student_division.session ='$session' AND student_division.student_id = student.student_id AND student_division.student_id = average.student_id AND average.session = '$session' AND average.secondterm_tag ='A' ORDER BY average.secondtermave DESC";
		break;
		case "THIRD TERM":
		$sql = "SELECT * FROM student_division,student, average WHERE student_division.class = '$class' AND student_division.class_division = '$class_division'  AND student_division.session ='$session' AND student_division.student_id = student.student_id AND student_division.student_id = average.student_id AND average.session = '$session' AND average.thirdterm_tag ='A' ORDER BY average.average DESC";
		break;

		}//ENDswitch($term){

	$query = $this->db->query($sql) or die('cant query class_division, average and student'.mysql_error());
		
	//echo $query->num_rows();
	if( $query->num_rows() >0 ){
	
		foreach($query->result_array() as $index=> $data){
			
			$sn = $index + 1;
			 $student_id = $data['student_id'];
			
		
			switch($term){
				case "FIRST TERM": $total = $data['firsttermtotal'];
									$average = $data['firsttermave'];
									
				break;
				case "SECOND TERM": $total = $data['secondtermtotal'];
									$average = $data['secondtermave'];
				break;
				case "THIRD TERM": $third_total = $data['thirdtermtotal'];
									$third_average = $data['thirdtermave'];
									$total = $data['cummulative_total'];
									$average = $data['average'];
				break;
								
			}//ENDswitch(){
				
				
			/**
			*	COMPARE STUDENT'S AVERAGE SCORE WITH THE MIN AVERAGE SCORE FOR PROMOTION
			*/
			if($average >= $average_score ){
					$remark = "<div class=pass1>PASS</div>";
					$css_class = 'class="pass_row"';
				
			}else{
					$remark = "<div class='fail_red'>FAIL</div>";
					$css_class = 'class="fail_row"';
			}
	
			$table_res .= "<tr $css_class id=".$data['student_id'].$class_division.">
			<td class=score>$sn</td>
			<td class=subjects>".$data['surname']." ".$data['firstname']."</td>
			<td class=subjects>".$data['student_id']."</td>";
			
			$where_subject  = array('term' =>$term, 'class'=> $class, 'class_division' =>$class_division, 'session' => $session);
			$this->db->order_by('subject','ASC');
			$this->db->select('subject');
			$this->db->distinct();
			$subject_array = $this->db->get_where('termscore',$where_subject);
			if( $subject_array->num_rows() >0 ){
				foreach($subject_array->result_array() as $rows){
					
				
					$subject = $rows['subject'];
					
					$where_termscore  = array('student_id' =>$student_id, 'subject'=>$subject, 'term' =>$term, 'class'=> $class, 'class_division' =>$class_division, 'session' => $session);
					$query_termscore = $this->db->get_where('termscore', $where_termscore);
					if( $query_termscore->num_rows() >0 ){
						
						$line = $query_termscore->row_array();
						$subject = strtoupper($line['subject']);
						$totalscore= $line['totalscore'];
																		
						if($totalscore == 0 || $totalscore == '' || $totalscore ==" " ){
							 $table_res .= "<td>&nbsp;</td>";
						}else{
							 
							 $table_res .= "<td class=score>$totalscore</td>";	
						}//if($totalscore != 0){
					
					}else{
						
						 $table_res .= "<td>&nbsp;</td>";
					
					}//ENDif( $query_termscore->num_rows() >0 ){
				
				}//END foreach($query_termscore->result_array() as $rows){
			
				$table_res .= "
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td class=score>$total</td>
								<td class=score>$average</td>";
			
			
			}//END if( $subject_array->num_rows() >0 ){
			switch($term){
				case "FIRST TERM": 
				$sqlpos = "SELECT * FROM  average WHERE class = '$class' AND class_division = '$class_division'  AND firstterm_tag = 'A' AND session ='$session' ORDER BY firsttermave DESC";
				break;
				case "SECOND TERM":
				$sqlpos = "SELECT * FROM  average WHERE class = '$class' AND class_division = '$class_division'  AND secondterm_tag = 'A' AND session ='$session' ORDER BY secondtermave DESC";
				break;
				case "THIRD TERM":
				$sqlpos = "SELECT * FROM  average WHERE class = '$class' AND class_division = '$class_division'  AND thirdterm_tag = 'A' AND session ='$session' ORDER BY average DESC";
				break;
		
				}//ENDswitch($term){

			$result_pos = $this->db->query($sqlpos);
		
				//echo $result_pos->num_rows();
				foreach($result_pos->result_array() as $index_no => $value ){
					//----------------------------------------POSITIONING--------------------------------------------------//	
						$pos = ++$index_no;
						
						$posend = substr($pos, -1,1);
						
						//echo $value['student_id']."  , ";
						/*student with same tot al score must have the 
						same position, while the normal positioning 
						goes underneath for those who are having different scores
						*/
						// to compare the preceeding student's score with the next student's score
						switch($term){
							case "FIRST TERM": 
												$score =  $value['firsttermave'];
							break;
							case "SECOND TERM": 
												$score =  $value['secondtermave'];
							break;
							case "THIRD TERM": 
												$score =  $value['average'];
							break;
									
						}//ENDswitch(){
												
						if($score == $score1){
							$pos = $realpos;
							$posend = substr($pos, -1,1);
						}//if($score == $score1){
								
					if($student_id == $value['student_id']){
							
						if($posend == 1 || $posend == 2 || $posend == 3){
						
							switch($posend){
								case "1":
								if($pos == 11){
									$postab =  "$pos"."th";
								}else{
									$postab = "$pos"."st";		
								}
								break;
								case "2":
								if($pos == 12){
									$postab =  "$pos"."th";
								}else{
									$postab = "$pos"."nd";
								}
								break;
								
								case "3":
								if($pos == 13){
									$postab =  "$pos"."th";
								}else{
									$postab = "$pos"."rd";
								}
								break;
							}//switch($pos){	
						}else{
							$postab =  "$pos"."th";
						}//if($posend == 1 || 2 || 3){	
						
							
					}//if($student_id == $fetcha->student_id){
				
					// to keep the preceeding student's score and position
					$score1 = $score;
					$realpos = $pos;
				
				}//ENDforeach($result_pos->result_array() as $index_no => $value ){
		//--------------------------------------------------END POSITIONING------------------------------//
		$table_res .= "<td class=score>$postab</td>
        <td>$remark</td>
      	</tr>";
		
		//echo "<br> <br>";
		}//ENDforeach($query->result_array() as $data){
	}		
}

public function select_class_broadsheet($classes, $class_arm, $term, $session)
{
	//$sql = "SELECT DISTINCT subject, class_division FROM  student_division WHERE  student_division.student_id = '$student_id' AND student_division.session = '$session' ORDER BY session ASC";
$query = $this->db->query("SELECT DISTINCT studentname, student_id, session FROM termscore WHERE class='$classes' AND class_division='$class_arm' AND term='$term' AND session='$session' 
	");
	//$query = $this->db->where("(class ='$classes') AND (class_division ='$class_arm') AND (term ='$term') AND (session ='$session')");
	//$query = $this->db->where("(names ='$studname')");
	//$query = $this->db->get('termscore');
	/*foreach ($query->result() as $row)
		{
			
			echo $row->names;
			echo $row->tuition;
			//echo $row->referenceno;
		}*/

	return $query;
}

public function select_result() 
{
	$query = $this->db->query("SELECT studentname, subject, ca, exam FROM termscore WHERE class ='$classes' AND class_division='$class_arm' AND term='$term' AND session='$session'");
	return $query;
}

public function query_term_broadsheet($classes, $class_arm, $term, $session)
{
	//$sql = "SELECT DISTINCT subject, class_division FROM  student_division WHERE  student_division.student_id = '$student_id' AND student_division.session = '$session' ORDER BY session ASC";
$query = $this->db->query("SELECT DISTINCT subject, student_id, studentname, totalscore, term, session FROM termscore WHERE class='$classes' AND class_division='$class_arm' AND term='$term' AND session='$session' ORDER BY session ASC" );
	//$query = $this->db->where("(class ='$classes') AND (class_division ='$class_arm') AND (term ='$term') AND (session ='$session')");
	//$query = $this->db->where("(names ='$studname')");
	//$query = $this->db->get('termscore');
	/*foreach ($query->result() as $row)
		{
			
			echo $row->names;
			echo $row->tuition;
			//echo $row->referenceno;
		}*/
	return $query;
}

public function getsubject_division()
{
	$query = $this->db->query("SELECT jun_subject from subject_division");
//$this->db->distinct();
//$this->db->get('table');
return $query;
}
public function select_average($classes)
{
	$query = $this->db->where("classes.class ='$classes'");//("payroll.emp_id ='$empid'");
	
	$query = $this->db->get('classes');

		return $query;
}


public function schoolinfo()
{
	$query = $this->db->get('schinfo');

		return $query;
}

public function sum_payment($month, $year)
{
$this->db->where('month', $month); 
$this->db->where('year', $year); 
	$this->db->select_sum('netpay');
	$query = $this->db->get('payroll_motop');

		return $query;
}


public function sum_pay()
{
 
 
	$this->db->select_sum('netpay');
	$query = $this->db->get('payroll');

		return $query;
}
public function sum_pay2($month, $year)
{
$this->db->where('month', $month); 
$this->db->where('year', $year); 
	$this->db->select_sum('netpay');
	$query = $this->db->get('payroll');

		return $query;
}

public function payroll_motop()
{
	$query = $this->db->get('payroll_motop');

		return $query;
}

public function update_payroll($empid)
{
	$query = $this->db->where("payroll.emp_id ='$empid'");
	$query = $this->db->update('payroll');
	return $query;
}
public function select_payroll($empname, $month, $year)
{
	$query = $this->db->where("(names ='$empname') AND (month ='$month') AND (year ='$year')");
	$query = $this->db->get('payroll');
	return $query;
}
/*public function select_all_payroll($month, $year)
{
	$query = $this->db->where("(month ='$month') AND (year ='$year')");
	//$query = $this->db->where("(names ='$studname')");
	$query = $this->db->get('payroll_motop');
	
	return $query;
}*/
public function select_all_payroll($month, $year)
{
	$query = $this->db->where("(month ='$month') AND (year ='$year')");
	//$query = $this->db->where("(names ='$studname')");
	$query = $this->db->get('payroll');
	
	return $query;
}
public function select_payroll_motop($empname, $month, $year)
{
	$query = $this->db->where("(names ='$empname') AND (month ='$month') AND (year ='$year')");
	$query = $this->db->get('payroll_motop');
	return $query;
}
public function select_staff($empname)
{
	$query = $this->db->where("employee.names ='$empname'");
	$query = $this->db->get('employee');
	return $query;
}
public function select_student($studname)
{
	$query = $this->db->where("student.names ='$studname'");
	$query = $this->db->get('student');
	return $query;
}
public function select_emprecords($staffname)
{
	$query = $this->db->where("employee.names ='$staffname'");
	$query = $this->db->get('employee');
	return $query;
}
public function select_payslip($staffname,$date, $year)
	{
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername ='$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->where("(names ='$staffname') AND (month ='$date') AND (year ='$year')");
		//$query = $this->db->where("payroll.month ='$date'");
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername = '$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->get('payroll');
		
	return $query;
	}
public function location($staffname)
	{
		$query = $this->db->where("names = '$staffname'");
		$query = $this->db->get('employee');
		return $query;
	}
	public function select_payslip_motop($staffname,$date, $year)
	{
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername ='$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->where("(names ='$staffname') AND (month ='$date') AND (year ='$year')");
		//$query = $this->db->where("payroll.month ='$date'");
		//$query = $this->db->query("SELECT * FROM receipt WHERE receipt.customername = '$customername' AND receipt.invoiceno = '$invoiceno'");
		$query = $this->db->get('payroll_motop');
		
	return $query;
	}
	
	public function get_result()
	{
	
		$query = $this->db->where("(student_id = '0038') AND (term= 'THIRD TERM')");
		$query = $this->db->get('termscore');
		return $query;
	}
	public function get_rec($array){

	$result = $this->db->get_where('receipt',$array);
	if($result->num_rows()>0){
		
		return TRUE;
	}else{
		return FALSE;	
			
	}
}
public function get_students($classes, $class_arm, $session)
	{
	
		$query = $this->db->where("(class = '$classes') AND (class_division= '$class_arm') AND (session = '$session')");
		$query = $this->db->get('student');
		return $query;
	}
public function get_records()
	{
	
		$query = $this->db->where("(class = 'JSS 1') AND (class_division= 'A')");
		$query = $this->db->get('student');
		return $query;
	}
	public function save_scores()
	{
		$this->db->update_batch('mytable', $data, 'title');
	}
	public function get_comment()
	{
		$query = $this->db->where("principal_comment !=''");
		$query = $this->db->get('comment_bank');
		return $query;
	}
	
	//Mickey
	public function upload_lesson_note($session, $term, $subject, $current_time, $staffid, $filename, $filepath, $class, $teachername)
	{
		$data = array(
               'session' => $session,
               'term' => $term,
               'uploaded_at' => $current_time,
               'subject' => $subject,
               'staff_id' => $staffid,
               'filename' => $filename,
               'filepath' => $filepath,
               'class' => $class,
               'teacher_name' => $teachername,
            );

		$this->db->insert('lesson_note_uploads', $data); 
		/*$data->session   = $session; // please read the below note
        $data->term = $term;
        $data->uploaded_at = $current_time;
        $data->subject = $subject;
        $data->staff_id = $staffid
        $data->filename = $filename;
        $data->filepath = $filepath;
        $data->class = $class;
        $data->teachername = $teachername;
        $this->db->insert('lesson_note_uploads', $this);*/

	}

	public function get_teachers_note($staffid)
	{
		$query = $this->db->query("SELECT * FROM lesson_note_uploads WHERE staff_id='$staffid' ORDER BY term");
		return $query;
	}
	//endMickey
	public function get_teachers_class($staffid)
	{
		$query = $this->db->query("SELECT DISTINCT class FROM staffsubj WHERE staff_id='$staffid'");
		return $query;
	}

	public function get_class_teachers_class($staffid)
	{
		$query = $this->db->query("SELECT DISTINCT class FROM staff WHERE staff_id='$staffid'");
		return $query;
	}

	public function get_class_teachers_class_division($staffid)
	{
		$query = $this->db->query("SELECT DISTINCT class_arm FROM staff WHERE staff_id='$staffid'");
		return $query;
	}

	public function get_teachers_subject($staffid)
	{
		$query = $this->db->query("SELECT DISTINCT subject FROM staffsubj WHERE staff_id='$staffid'");
		return $query;
	}

	public function getstudentclass($username)
	{
		$query = $this->db->query("SELECT class, class_division FROM student WHERE username='$username'");
		return $query;
	}

	public function getresult($limit, $page, $class, $term, $session, $class_division)
	{
		
	        	return $result[$page-1];
	}
}