<?php
class Entrance_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
        $this->table_name = 'entrances';
        $this->primary_key = 'id';
        $this->order_by = 'id ASC';
    }
}