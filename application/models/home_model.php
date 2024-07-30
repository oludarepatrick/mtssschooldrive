<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
    
    public function fillgrid(){
        $this->db->order_by("id", "desc"); 
        $data = $this->db->get('curd');
        foreach ($data->result() as $row){
            $edit = base_url().'home/edit/';
            $delete = base_url().'home/delete/';
            echo "<tr>
                        <td>$row->name</td>
                        <td>$row->email</td>
                        <td>$row->contact</td>
                        <td>$row->facebook_link</td>
                        <td>$row->created</td>
                        <td><a href='$edit' data-id='$row->id' class='btnedit' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='$delete' data-id='$row->id' class='btndelete' title='delete'><i class='glyphicon glyphicon-remove'></i></a></td>    
                    </tr>";
            
        }
        exit;
    }

    public function create(){
        $data = array('name'=>  $this->input->post('name'),
                'email'=>$this->input->post('email'),
                'contact'=>$this->input->post('contact'),
                'facebook_link'=>$this->input->post('facebook'),
                'created'=>date('d/m/y'));
            $this->db->insert('curd', $data);
            echo'<div class="alert alert-success">One record inserted Successfully</div>';
            exit;
    }
   
   private function edit(){}
   
   private function delete(){}
    
    
}

?>
