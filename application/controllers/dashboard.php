<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mbookshelf','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->library('Common');
    }
    
    function savePitchit()
    {
    	$data = array();
    	$pit_id = $this->input->post('pit_id');
    	$data['pitchit'] = $this->input->post('pitchit');
    	$sql = $this->db->where("pit_id", $pit_id)->update("work_pitchits", $data);
    	if($sql){
    		$value = $data['pitchit'];
    	}else{
    		$value = '0';
    	}
    	echo $value;
    }     
    
    function deletePitchit()
    {
    	$pit_id = $this->input->post('pit_id');
    	$wid = $this->input->post('wid');
    	$sql = $this->db->where("pit_id", $pit_id)->delete("work_pitchits_saved");
    	if($sql){
    		//echo $this->db->last_query();die;
    		$this->db->where("id", $wid)->delete("works");
    		$value = '1';
    	}else{
    		$value = '0';
    	}
    	echo $value;
    }
    
     function deletePitchit_publisher()
    {
    	$pit_id = $this->input->post('pit_id');
    	$wid = $this->input->post('wid');
    	$sql = $this->db->where("pit_id", $pit_id)->delete("work_pitchits_saved");
    	if($sql){
    		//echo $this->db->last_query();die;
    		//$this->db->where("id", $wid)->delete("works");
    		$value = '1';
    	}else{
    		$value = '0';
    	}
    	echo $value;
    }    
     
}
