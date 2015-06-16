<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail'));
        $this->load->helper(array('url','form'));
       
    }
    
  public function index(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Profile';
        $data['user_bio'] = $this->mprofile->get_user_bio();
        //print_r($data['user_bio']);die;
        $data['work_count'] = $this->mprofile->get_user_work_count();
        $data['user_photo'] = $this->mprofile->get_user_photo();
        $data['user_work_details']  = $this->memail->get_user_work_details();
        //$data['user_web_link'] = $this->mprofile->get_user_web_link();
        $this->load->view('profile/index',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
  public function editProfile(){   
        
        if($this->input->post())
        {
            $this->mprofile->updateProfile();
            $this->session->set_flashdata('msg','Profile Successfully updated');
            redirect('profile/','refresh');
        }
        else
        {
            if($this->session->userdata('logged_user')){
            $data   = array();
            $data['title']  = 'Edit Profile';
            //$data['id']    = $this->uri->segment(3);
            $data['work_count'] = $this->mprofile->get_user_work_count();
            $data['user_bio'] = $this->mprofile->get_user_bio($this->uri->segment(3));
            $data['user_photo'] = $this->mprofile->get_user_photo();
            $data['user_work_details']  = $this->memail->get_user_work_details();
            
            $this->load->view('profile/editProfile',$data);
         }
        else{
            redirect('home/login', 'refresh');
        }
        }
        
    } 
}
