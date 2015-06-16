<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboardnews extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin','mnews'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Dashboard News';
        $data['news']  = $this->mnews->getNewsName();
        $this->load->view('admin/dashboard_news/index',$data);
    } 
    
   public function editDashboardNews(){   
        
        if($this->input->post())
        {
            $this->mnews->updateNews();
            $this->session->set_flashdata('msg','News Successfully updated');
            redirect('dashboardnews/','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Edit Dashboard News';
            //$data['id']    = $this->uri->segment(3);
            $data['news']  = $this->mnews->getNewsName();
            //$data['project_type'] = $this->mnews->get_all_project_type();
           
            $this->load->view('admin/dashboard_news/editDashboardNews',$data);
        }
        
    }   
}
