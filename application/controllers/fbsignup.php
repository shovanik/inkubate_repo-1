<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fbsignup extends CI_Controller {

	public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
        $this->load->library('Common');
       
        
        
    }
	public function index(){

		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
                
               //echo '<pre/>'; print_r($data['user_profile']);
               
               //$twit_user = $this->mhome->get_twit_user($data['user_profile']['id']);
         
              
        
            $data['page']   = 'signUp';
            $data['title']  = 'The Inkubate - signUp';
            $data['social_id']  = $data['user_profile']['id'];
            
            //$total_name = explode(' ',$data['user_profile']['name']);
           
            $data['social_firstname']  = $data['user_profile']['first_name'];
            $data['social_lastname']  = $data['user_profile']['last_name'];
            
            $data['social_source']  = 'facebook';
            $data['social_image']  = $data['user_profile']['id'];
            $data['social_ownid']  = $data['user_profile']['id'];
            
            $this->load->view('userType_facebook', $data);     
           
                
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }

        /*if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('fblogin/index'), 
                'scope' => array("email") // permissions here
            ));
        } */
        
        

	}
    
    public function facebook_user()
    {
        
            
                if($this->input->post(null)){
                
                $this->mhome->social_register();
                
               if($this->session->userdata('logged_user')){ 
                
                $usd = $this->session->userdata('logged_user');
                
                if($usd['user_type'] == '1')
                 {
                    redirect('home/author', 'refresh');
                 }
                 else if($usd['user_type'] == '2')
                 {
                    redirect('home/publisher', 'refresh');
                 }
                 else if($usd['user_type'] == '3')
                 {
                    redirect('home/agent', 'refresh');
                 }
                 else
                 {
                    redirect('home/editor', 'refresh');
                 }   
                }
                
                
            }
    }

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        $this->session->sess_destroy();
        
        $this->facebook->setAccessToken('');
        
        redirect('welcome/login');
    }

}

