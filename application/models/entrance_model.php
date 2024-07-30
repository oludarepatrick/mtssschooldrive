<?php
class General_model extends MY_Model
{

    function __construct (){
        parent::__construct();
        $this->table_name = 'termscore';
        $this->primary_key = 'sn';
        $this->order_by = 'sn ASC';
    }
}