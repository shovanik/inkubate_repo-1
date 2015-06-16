<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Tags';
        $this->load->view('admin/tags/index',$data);
    }
  
  public function editTags(){   
        
        if($this->input->post())
        {
            $this->mnews->updateNews();
            $this->session->set_flashdata('msg','Tags Successfully updated');
            redirect('tags/','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Edit Tags';
            //$data['id']    = $this->uri->segment(3);
            //$data['News']  = $this->mnews->getNewsName();
            //$data['project_type'] = $this->mnews->get_all_project_type();
           
            $this->load->view('admin/tags/editTags',$data);
        }
        
    }     
}
