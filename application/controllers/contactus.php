<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactus extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'ContactUs';
        $this->load->view('admin/contactus/index',$data);
    } 
    
   public function editContactus(){   
        
        if($this->input->post())
        {
            $this->mnews->updateNews();
            $this->session->set_flashdata('msg','ContactUs Successfully updated');
            redirect('contactus/','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Edit ContactUs';
            //$data['id']    = $this->uri->segment(3);
            //$data['News']  = $this->mnews->getNewsName();
            //$data['project_type'] = $this->mnews->get_all_project_type();
           
            $this->load->view('admin/contactus/editContactus',$data);
        }
        
    }    
}
