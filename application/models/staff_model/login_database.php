<?php

Class Login_database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "username =" . "'" . $data['username'] . "'";
$this->db->select('*');
$this->db->from('staff');
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

$condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "' AND status=1";
$this->db->select('*');
$this->db->from('staff');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}


public function getAll() {

$this->db->select('*');
$this->db->from('staff');
$query = $this->db->get();

return $query->result();
}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "username =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('staff');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

}

?>
