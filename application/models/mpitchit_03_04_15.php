<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mpitchit extends CI_Model
{
 
    function getPitchitList()
    {
        $rs  = $this->db->select('*')->get('pitch_master');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }        
        $rs->free_result();
        return $data;
    }
    
    function getPitchitListById( $id )
    {
        $data = array();
        $rs  = $this->db->select('*')->where("id", $id)->get('pitch_master');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        
        return $data;
    }
    
    function addpitchit()
    {
        $data   = array();
        
        $data['package_name'] = $this->input->post('package_name');
        $data['price'] = $this->input->post('price');
        $data['number'] = $this->input->post('number');
        $data['status'] = $this->input->post('active');
        $data['created_date'] = date("Y-m-d h:i:s");
        
        $this->db->insert('pitch_master', $data);
        return 1;
    }
    
    function editpitchit($id)
    {
        $data   = array();
        
        $data['package_name'] = $this->input->post('package_name');
        $data['price'] = $this->input->post('price');
        $data['number'] = $this->input->post('number');
        $data['status'] = $this->input->post('active');
        $data['created_date'] = date("Y-m-d h:i:s");
        
        $this->db->where('id',$id)->update('pitch_master', $data);
        return 1;
    }
    
    
}
