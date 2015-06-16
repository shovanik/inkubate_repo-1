<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fblogin extends CI_Controller {

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

       $arr = array();
		$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		$user = $this->facebook->getUser();
        //echo 'htyt'.$usd['id'];
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
                $arr['email'] = $data['user_profile']['email'];
               //echo '<pre/>'; print_r($data['user_profile']);die;
               
               $twit_user_email = $this->mhome->get_twit_user_byemail($data['user_profile']['email']);
               
              if(($twit_user_email['email'] == $data['user_profile']['email']) && ($twit_user_email['social_source'] != 'facebook'))
              {
                
                //echo 'htyt'.$usd['id'];
                //echo 'hertty';
                //echo $twit_user_email['count'];
                //$this->load->view('email_exist', $arr);
              if($twit_user_email['count'] > 0){
                
              //$twit_user_pass_blank = $this->mhome->get_twit_user_pass_blank($data['user_profile']['id']);  
             
             if($twit_user_email['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_email['password'] == '')
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/author', 'refresh'); 
                }
                
                
                }
             }
             else if($twit_user_email['user_type'] == '2')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                //echo count($twit_user_pass_blank);die;
                
                if($twit_user_email['password'] == '')
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/publisher', 'refresh'); 
                }
                
                
                }
             }
             else if($twit_user_email['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_email['password'] == '')
                {
                    //echo 'hello';
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   // echo 'hi';
                   redirect('home/publisher', 'refresh'); 
                }
                
               
                }
             }
             else if($twit_user_email['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_email['password'] == '')
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/publisher', 'refresh'); 
                }
                
                
                }
             } 
             
            
           } 
                
        } 
              
            else {  
               
            $twit_user = $this->mhome->get_twit_user($data['user_profile']['id']);
            
            if(count($twit_user) > 0){
                
              $twit_user_pass_blank = $this->mhome->get_twit_user_pass_blank($data['user_profile']['id']);  
             
            if($twit_user['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/author', 'refresh'); 
                }
                
                
                }
             }
             else if($twit_user['user_type'] == '2')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                //echo count($twit_user_pass_blank);die;
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/publisher', 'refresh'); 
                }
                
                
                }
             }
             else if($twit_user['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/publisher', 'refresh'); 
                }
                
               
                }
             }
             else if($twit_user['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   redirect('profile/editProfile/'.$usd['id'], 'refresh');
                }
                else
                {
                   redirect('home/publisher', 'refresh'); 
                }
                
                
                }
             } 
             
            
           }
            
           
            else
            {
              
                
                $data['page']   = 'signUp';
                $data['title']  = 'The Inkubate - signUp';
                $data['social_id']  = $data['user_profile']['id'];
                
                //$total_name = explode(' ',$data['user_profile']['name']);
               
                $data['social_firstname']  = $data['user_profile']['first_name'];
                $data['social_lastname']  = $data['user_profile']['last_name'];
                
                $data['social_source']  = 'facebook';
                $data['social_image']  = $data['user_profile']['id'];
                $data['social_ownid']  = $data['user_profile']['id'];
                $data['social_email']  = $data['user_profile']['email'];
                
                $this->load->view('userType_facebook', $data); 
            }
            
          }      
           
                
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('fblogin/index'), 
                'cancel_url' => site_url('home/signUp'),
                'scope' => array("email") // permissions here
            ));
            
            if(isset($_REQUEST['error'])) {
         header('Location: '.base_url().'home/signUp');
         }
        }
        
        
           /* 
            $twit_user = $this->mhome->get_twit_user($data['user_profile']['id']);
            
            if(count($twit_user) > 0){ 
             
            if($twit_user['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                redirect('home/author', 'refresh');
                }
             }
             else if($twit_user['user_type'] == '2')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                redirect('home/publisher', 'refresh');
                }
             }
             else if($twit_user['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                redirect('home/agent', 'refresh');
                }
             }
             else if($twit_user['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                redirect('home/editor', 'refresh');
                }
             } 
             
            
           }
            else
             {
              
        
            $data['page']   = 'signUp';
            $data['title']  = 'The Inkubate - signUp';
            $data['social_id']  = $data['user_profile']['id'];
            
            $total_name = explode(' ',$data['user_profile']['name']);
           
            $data['social_firstname']  = $total_name[0];
            $data['social_lastname']  = $total_name[1];
            
            $data['social_source']  = 'facebook';
            $data['social_image']  = $data['user_profile']['id'];
            $data['social_ownid']  = $data['user_profile']['id'];
            
            $this->load->view('userType_facebook', $data);     
           } */
        //$this->load->view('fblogin',$data);
        

	}
    
    public function facebook_user()
    {
        
            
                if($this->input->post(null)){
                
                $this->mhome->social_register();
                
               if($this->session->userdata('logged_user')){ 
                
                $usd = $this->session->userdata('logged_user');
                
                $twit_user = $this->mhome->get_twit_user($this->input->post('social_id'));
          
                
                if($usd['user_type'] == '1')
                 {
                    if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/author', 'refresh'); 
                        }
                    
                    //redirect('home/author', 'refresh');
                 }
                 else if($usd['user_type'] == '2')
                 {
                    if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/publisher', 'refresh'); 
                        }
                    
                    
                 }
                 else if($usd['user_type'] == '3')
                 {
                    if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/publisher', 'refresh'); 
                        }
                    //redirect('home/agent', 'refresh');
                 }
                 else
                 {
                    if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/publisher', 'refresh'); 
                        }
                   // redirect('home/editor', 'refresh');
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

