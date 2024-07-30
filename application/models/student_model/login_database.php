<?php

Class Login_database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "username =" . "'" . $data['username'] . "'";
$this->db->select('*');
$this->db->from('student');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('staff', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($data) {
$username = $data['username'];
$password = $data['password'];
$query = $this->db->query("SELECT * FROM student WHERE username='$username' AND password='$password'");
if($query->num_rows()>0)
{
return true;
}
else
{
return false;
}
//$condition = "surname  =" . "'" . $data['username'] . "' AND " . "student_id=" . "'" . $data['password'] . "'";
//$this->db->select('*');
//$this->db->from('student');
//$this->db->where($condition);
//$this->db->limit(1);
//$query = $this->db->get();

//if ($query->num_rows() == 1) {
//return true;
//} else {
//return false;
//}
}

// Read data from database to show data in admin page
public function read_user_information($username) {
$paid="PAID";
//$condition = "username =" . "'" . $username . "' 'AND.' payment_status =" . "'" .$paid. "'";
//$condition = "username =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('student');
$this->db->where("username = '$username' AND payment_status='$paid'");
$this->db->limit(1);
$query = $this->db->get();


if ($query->num_rows() == 1) {
return $query->result();
} else {
//return false;
echo "<h4 class='message_bg_1'>oops! ACCESS DENIED. Please contact the SCHOOL ADMIN.</h4><br/>";
echo anchor('student', 'Click here to go Back');
}
}

}

?>
