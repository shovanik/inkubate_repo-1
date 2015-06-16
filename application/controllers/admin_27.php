<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
	public function index()
	{
		$this->load->view('admin/login');
	}
   
   public function verify_login(){
        if($this->input->post(null)){
            if($this->madmin->verify_login()){
                redirect('admin/dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('msg', 'Either username or password is incorrect !');
                redirect('admin/', 'refresh');
            }
        }else{
            $this->session->set_flashdata('msg', 'Please login to continue !');
            redirect('admin/', 'refresh');
        }
    } 
    
  private function _check_logged_in(){
        if(!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('msg', 'Please login to continue !');
            redirect('admin/', 'refresh');
        }
    }  
    
  public function dashboard(){
        $this->_check_logged_in();                  #check the authenticity of the admin
        $data   = array();
        $data['title']  = 'Dashboard';
        $this->load->view('admin/dashboard',$data);
    }
    
 public function logout(){
        $this->session->sess_destroy();
        redirect('admin/', 'refresh');
    }     
    
 public function Demo(){
        $data   = array();
        $data['title']  = 'Demo';
        $this->load->view('admin/test_page',$data);
    }   
}
