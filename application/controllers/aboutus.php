<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'AboutUs';
        $this->load->view('admin/aboutus/index',$data);
    } 
    
   public function editAboutus(){   
        
        if($this->input->post())
        {
            $this->mnews->updateNews();
            $this->session->set_flashdata('msg','AboutUs Successfully updated');
            redirect('aboutus/','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Edit AboutUs';
            //$data['id']    = $this->uri->segment(3);
            //$data['News']  = $this->mnews->getNewsName();
            //$data['project_type'] = $this->mnews->get_all_project_type();
           
            $this->load->view('admin/aboutus/editAboutus',$data);
        }
        
    }   
}
