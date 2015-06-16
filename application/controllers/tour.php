<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Tour';
        $this->load->view('admin/tour/index',$data);
    } 
    
  public function editTour(){   
        
        if($this->input->post())
        {
            $this->mnews->updateNews();
            $this->session->set_flashdata('msg','Tour Successfully updated');
            redirect('tour/','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Edit Tour';
            //$data['id']    = $this->uri->segment(3);
            //$data['News']  = $this->mnews->getNewsName();
            //$data['project_type'] = $this->mnews->get_all_project_type();
           
            $this->load->view('admin/tour/editTour',$data);
        }
        
    }    
}
