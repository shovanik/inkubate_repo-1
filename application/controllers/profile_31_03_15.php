<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
    
  public function index(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Profile';$this->load->helper('download');
        $data['show_edit']  = "Yes";
        $limit=4;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'home/author/';
        $config['total_rows']     = $this->memail->getCountWorks();
        $config['per_page']       = $limit;
        $config['uri_segment']    = 3;
        $config['next_link']        = '';
        $config['next_tag_open']    = '<span class="nextPage">';
        $config['next_tag_close']   = '</span>';
        $config['prev_link']        = 'Prev';
        $config['prev_tag_open']    = '<span class="prevPage">';
        $config['prev_tag_close']   = '</span>';
        $config['cur_tag_open']     = '<span class="active_page">';
        $config['cur_tag_close']    = '</span>';
         $config['first_link'] = '';
        $config['last_link'] = '';
        $config['display_pages']    = FALSE;
        $this->pagination->initialize($config);
        
        
        $data['user_bio'] = $this->mprofile->get_user_bio();
        //print_r($data['user_bio']);die;
        $data['user_contact'] = $this->mprofile->get_user_iscontact();
        $data['work_count'] = $this->mprofile->get_user_work_count();
        $data['user_photo'] = $this->mprofile->get_user_photo();
        $data['user_work_details']  = $this->memail->get_user_work_details($this->uri->segment(3),$limit);
        $data['work_type_details']  = $this->mwork->get_work_type_details();
        //$data['user_web_link'] = $this->mprofile->get_user_web_link();
        $this->load->view('profile/index',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
    public function cat_details()
	{
	  
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mprofile->delete_cat_details($this->input->post('id')); 
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
            $data['user_contact'] = $this->mprofile->get_user_iscontact();
            $data['user_photo'] = $this->mprofile->get_user_photo();
            $data['user_work_details']  = $this->memail->get_user_work_details();
            //$data['fiction_details']  = $this->mwork->fiction_details(1);
            $data['work_type_details']  = $this->mwork->get_work_type_details();
            
            $this->load->view('profile/editProfile',$data);
         }
        else{
            redirect('home/login', 'refresh');
        }
        }
        
    } 
}
