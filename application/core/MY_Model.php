<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
     /**
     * The database table to use.
     * @var string
     */
    public $table_name = '';
    
    /**
     * Primary key field
     * @var string
     */
    public $primary_key = '';
    
    /**
     * The filter that is used on the primary key. Since most primary keys are <a href="MY_Model.php"></a>
     * autoincrement integers, this defaults to intval. On non-integers, you would 
     * typically use something like xss_clean of htmlentities.
     * @var string
     */
    public $primaryFilter = 'intval'; // htmlentities for string keys
    
    /**
     * Order by fields. Default order for this model.
     * @var string
     */
    public $order_by = '';
    
    function __construct() {
        parent::__construct();
    }
    
	public function get_join_table($table2, $primary_key2, $left = FALSE, $right = FALSE){
		//$this->db->from($this->primary_key);
		$this->db->join($table2, $this->table_name.'.'.$primary_key2 .'='. $table2.'.'.$primary_key2);
		$this->get_assoc();
	}
     /**
     * Get one record, based on ID, or get all records. You can pass a single 
     * ID, an array of IDs, or no ID (in which case the  method will return 
     * all records)
     * 
     * If you request a single ID the result will be returned as an associative array:
     * array('id' => 1, 'title' => 'Some title')
     * In all other cases the result wil be returned as an array of arrays
     * array(array('id' => 1, 'title' => 'Some title'), array('id' => 2, 'title' => 'Some other title'))
     * 
     * Thanks to Zack Kitzmiller who suggested some improvements.
     * 
     * @param mixed $id An ID or an array of IDs (optional, default = FALSE)
     * @return array
     * @author Joost van Veen
     */
	 
	 /*
	 *get data based on the primary key (as id)
	 SQL - SELECT * FROM table_name (for all ids)
	 	 - SELECT * FROM table_name WHERE id = $id (for one id)
		 - SELECT * FROM table_name WHERE id = array(ids) (for more than one ids to be specified)
	 */
    public function get ($ids = FALSE){
        
        // Set flag - if we passed a single ID we should return a single record
        $single = $ids == FALSE || is_array($ids) ? FALSE : TRUE;
        
        // Limit results to one or more ids
        if ($ids !== FALSE) {
            
            // $ids should always be an array
            is_array($ids) || $ids = array($ids); 
            
            // Sanitize ids
            $filter = $this->primaryFilter;
            $ids = array_map($filter, $ids); 
            
            $this->db->where_in($this->primary_key, $ids);
        }
        
        // Set order by if it was not already set
        count($this->db->ar_orderby) || $this->db->order_by($this->table_name . '.' .$this->order_by);
        
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row_array' : 'result_array';
        return $this->db->get($this->table_name)->$method();
    }
    
    /**
     * Get records by one or more keys.
     * 
     * @param mixed $key can be a string, in which case the value is in $val. Can also ba a key => value pair array.
     * @param mixed $val The value for a set set $key
     * @param boolean $orwhere
     * @param boolean $single
     * @return void
     * @author Joost van Veen
     */
	 
	  /*
	  *get data using any field as a condition - it will always select all the fields
	  SQL - SELECT * FROM table_name WHERE table_field = 'value'(No condition)
	 	 - SELECT * FROM table_name WHERE table_field = 'value' OR table_field2 = 'value2' (OR)
		 - SELECT * FROM table_name WHERE table_field = 'value'  AND table_field2 = 'value2'(AND)
	 */
    
    public function get_by ($key, $val = FALSE, $orwhere = FALSE, $single = FALSE) {
        
        // Limit results
        if (!is_array($key)) {
            $this->db->where(htmlentities($key), htmlentities($val));
        }
        else {
            $key = array_map('htmlentities', $key); 
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            $this->db->$where_method($key);
        }
        
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row_array' : 'result_array';
        return $this->db->get($this->table_name)->$method();
    }
    
     /**
     * Get one or more records as a key=>value pair array.
     *
     * @param string $key_field The field that holds the key
     * @param string $value_field The field that holds the value
     * @param mixed $id An ID or an array of IDs (optional, default = FALSE)
     * @uses get
     * @return array
     * @author Joost van Veen
     */
	  /*
	  * to select specific fields based on the primary key (as id)
	 SQL - SELECT title FROM table_name (for all ids)
	 	 - SELECT title, username FROM table_name WHERE id = $id (for one id)
		 - SELECT title, username FROM table_name WHERE id = array(ids) (for more than one ids to be specified)
		 
		 $this->account->get_key_value('account_balance', 'account_balance', $_POST['account']);
		 
		 $fetch = $this->account->get_key_value('field_needed', 'field_needed', $id);
		 
		 output: echo $posts['first-post'] or $posts['post_title'] , $fetch['field_needed']; using return $result;
	*/
    public function get_key_value ($key_field, $value_field, $ids = FALSE){
        
        // Get records
        $this->db->select($key_field . ', ' . $value_field);
        $result = $this->get($ids);
        
        // Turn results into key=>value pair array.
        $data = array();
        if (count($result) > 0) {
            // if id is not set dont make result an array 
            if ($ids != FALSE && !is_array($ids)) {
                $result = array($result);
            }
            //to return record as an associative array using the value of the key_field e.g first-post in post app
            //foreach ($result as $row) {
                //$data[$row[$key_field]] = $row[$value_field];
           // }
        }
        //return $data;
        return $result;
    }
    
    /**
     * Return records as an associative array, where the key is the value of the 
     * first key for that record. Typical return array:
     * $return[18] = array(18 => array('id' => 18,'title' => 'Example record')
     * 
     * @param integer $id An ID or an array of IDs (optional, default = 0)
     * @uses get
     * @return array
     * @author Joost van Veen
	 *works exactly like get but returns associative array
	 SQL - SELECT * FROM table_name (for all ids)
	 	 - SELECT * FROM table_name WHERE id = $id (for one id)
		 - SELECT * FROM table_name WHERE id = array(ids) (for more than one ids to be specified)
     */ 
    public function get_assoc ($ids = FALSE){
        // Get records
        $result = $this->get($ids);
        
        // Turn results into an associative array.
        if ($ids != FALSE && !is_array($ids)) {
            $result = array($result);
        }
        $data = $this->to_assoc($result);
        
        return $data;
    }
    
    /**
     * Turn a multidimensional array into an associative array, where the index 
     * equals the value of the first index. 
     * 
     * Example output:
     * array(0 => array('pag_id' => 23, 'pag_title' => 'foo'))
     * becomes
     * array(23 => array('pag_id' => 23, 'pag_title' => 'foo'))
     * @param $array
     * @return array
     * @author Joost van Veen
     */
    public function to_assoc($result = array()){
        
        $data = array();
        if (count($result) > 0) {
            
            foreach ($result as $row) {
                $tmp = array_values(array_slice($row, 0, 1));
                $data[$tmp[0]] = $row;
            }
        }  

        return $data;
    }
    
    /**
     * Save or update a record.
     * 
     * @param array $data
     * @param mixed $id Optional
     * @return mixed The ID of the saved record
     * @author Joost van Veen
	 
	 *NB: this fxn can only update a record with id(primary key) as the condition
	 eg - update username where user_id = $id set $data
     */
    public function save($data, $id = FALSE, $batch = FALSE) {
        
        if ($id == FALSE) {
            // Insert batch(array of array for multiple items) or just ordinary insert
			if($batch == TRUE){
				// This is an insert_batch
            	
				$this->db->insert_batch($this->table_name, $data);
				
			}else{
				// This is an insert
				$this->db->set($data)->insert($this->table_name);
			}
        }
        else {
            
            // This is an update
            $filter = $this->primaryFilter;
            $this->db->set($data)->where($this->primary_key, $filter($id))->update($this->table_name);
        }
        
        // Return the ID
        return $id == FALSE ? $this->db->insert_id() : $id;
    }
    
    /**
     * Delete one or more records by ID
     * @param mixed $ids
     * @return void
     * @author Joost van Veen
     */
    public function delete($ids){
        
        $filter = $this->primaryFilter; 
        $ids = ! is_array($ids) ? array($ids) : $ids;
        
        foreach ($ids as $id) {
            $id = $filter($id);
            if ($id) {
                $this->db->where($this->primary_key, $id)->limit(1)->delete($this->table_name);
            }
        }
    }

    /**
     * Delete one or more records by another key than the ID
     * @param string $key
     * @param mixed $value
     * @return void
     * @author Joost van Veen
     */
    public function delete_by($key, $value){
        
        if (empty($key)) {
            return FALSE;
        }
        
        $this->db->where(htmlentities($key), htmlentities($value))->delete($this->table_name);
    }
}
