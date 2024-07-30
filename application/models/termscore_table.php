<?php
class Termscore_table extends MY_Model
{

    function __construct (){
        parent::__construct();
        $this->table_name = 'termscore';
        $this->primary_key = 'student_id';
        $this->order_by = 'student_id ASC';
    }

public function is_receipt_exist($where){

	$result = $this->db->get_where('receipt',$where);
	if($result->num_rows()>0){
		
		return TRUE;
	}else{
		return FALSE;	
			
	}
}

}
