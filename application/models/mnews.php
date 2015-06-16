<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mnews extends CI_Model
{
 
    function getNewsName()
    {
        $data = array();
        $rs  = $this->db->select('*')->where('id','1')->get('content');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        $rs->free_result();
        
        return $data;
    }
    
    function getNewsName_author()
    {
        $data = array();
        $rs  = $this->db->select('*')->where('id','1')->where('status','1')->get('content');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        $rs->free_result();
        
        return $data;
    }
    
    function updateNews()
    {
        $data = array();
        $data['content'] = $this->input->post('content');
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['status'] = $this->input->post('active');
        
        //$this->db->insert('content',$data);
        $this->db->where('id','1')->update('content',$data);
		   
    }
    
    
}
