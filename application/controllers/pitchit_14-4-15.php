<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pitchit extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin', 'mpitchit'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
   
    public function pitchAdd(){
        if($this->input->post())
        {
            //$add_data['feeds_url'] = $this->input->post('feeds_url');
            //$sql = $this->db->insert("feeds_url", $add_data);
            $sql = $this->mpitchit->addpitchit();
            if($sql == 1){
                $this->session->set_flashdata('success','Pitchits Successfully added');
                redirect(base_url()."pitchit/pitchDetails");
            }else{
                $this->session->set_flashdata('error','There are ome problem to add Pitchits, please try again');
                redirect(base_url()."pitchit/pitchDetails");
            }
        }else{
            $data   = array();
            $data['title']  = 'Add Pitchits!';
            $this->load->view('admin/pitchit/add',$data);
        }
    }
    
   public function pitchDetails(){
        $data   = array();
        $data['title']  = 'Pitchit package list';
        $data['pitchitlist']  = $this->mpitchit->getPitchitList();
        //$data['feedsurl_list']  = $this->mpitchit->getFeedsUrlList();
        $this->load->view('admin/pitchit/index',$data);
    }
    
    public function edit(){
        
        if($this->input->post())
        {
            $id = $this->input->post('id');
            
            $sql = $this->mpitchit->editpitchit($id);
            
            
            if($sql == '1'){
                $this->session->set_flashdata('success','Pitchits Successfully updated');
                redirect(base_url()."pitchit/pitchDetails");
            }else{
                $this->session->set_flashdata('error','There are ome problem to update Pitchits, please try again');
                redirect(base_url()."pitchit/edit/".$id);
            }
        }else{
            $id = $this->uri->segment(3);
            $data   = array();
            $data['title']  = 'Update Pitchit Package';
            $data['details'] =  $this->mpitchit->getPitchitListById( $id );
            $this->load->view('admin/pitchit/edit',$data);
        }
    }

    function changeRank()
    {
        $data['rank'] = $this->input->post('rank');
        $pit_id = $this->input->post('pit_id');
        $sql = $this->db->where("pit_id", $pit_id)->update("work_pitchits", $data);
        if($sql){
            echo '1';
        }else{
            echo '0';
        }
    }  
          
}
