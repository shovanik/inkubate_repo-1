<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Twtest extends CI_Controller {

   
   
   public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
        $this->load->library('Common');
       
        
        
    }

	/* show link to connect to Twiiter */
	/*public function index() {
		$this->load->library('twconnect');

		echo '<p><a href="' . base_url() . 'twtest/redirect">Connect to Twitter</a></p>';
		echo '<p><a href="' . base_url() . 'twtest/clearsession">Clear session</a></p>';

		echo 'Session data:<br/><pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
	} */

	/* redirect to Twitter for authentication */
    
		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */    

/*	public function redirect() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twredirect('twtest/callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	} */

    public function index() {
    		
    		$this->load->library('twconnect');

    		$ok = $this->twconnect->twredirect('twtest/callback');
    
    		if (!$ok) {
    			echo 'Could not connect to Twitter. Refresh the page or try again later.';
    		}
    	} 


	/* return point from Twitter */
	/* you have to call $this->twconnect->twprocess_callback() here! */
	public function callback() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twprocess_callback();
        
        //echo '<pre/>'; print_r($ok);die;
		
		if ( $ok > 0 ) 
        { 
            
            $this->load->library('twconnect');
            $this->twconnect->twaccount_verify_credentials();
            
            $twit_user = $this->mhome->get_twit_user($this->twconnect->tw_user_info->id);
            
            if(count($twit_user) > 0){ 
             
            if($twit_user['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                if($twit_user['password'] == '')
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
                if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/publisher', 'refresh'); 
                        }
                //redirect('home/publisher', 'refresh');
                }
             }
             else if($twit_user['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                
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
             }
             else if($twit_user['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                if($twit_user['password'] == '')
                        {
                           redirect('profile/editProfile/'.$usd['id'], 'refresh');
                        }
                        else
                        {
                           redirect('home/publisher', 'refresh'); 
                        }
                //redirect('home/editor', 'refresh');
                }
             } 
             
            
           }
            else
             {
               redirect('twtest/userType'); 
             }  
           
          // redirect ('twtest/success'); 
             
        }
		else 
        {
            redirect ('twtest/failure');
        }
	}


	/* authentication successful */
	/* it should be a different function from callback */
	/* twconnect library should be re-loaded */
	/* but you can just call this function, not necessarily redirect to it */
	public function success() {
	   
		//echo 'Twitter connect succeded<br/>';
		//echo '<p><a href="' . base_url() . 'twtest/clearsession">Do it again!</a></p>';

		$this->load->library('twconnect');

		// saves Twitter user information to $this->twconnect->tw_user_info
		// twaccount_verify_credentials returns the same information
		$this->twconnect->twaccount_verify_credentials();

		echo 'Authenticated user info ("GET account/verify_credentials"):<br/><pre>';
		print_r($this->twconnect->tw_user_info); 
        //echo $this->twconnect->tw_user_info->id;
        echo '</pre>'; 
        
        //redirect(base_url().'home/userType/'.$this->twconnect->tw_user_info->id , 'refresh');
		
	}
    
    public function userType(){
        
       	$this->load->library('twconnect');
        $this->twconnect->twaccount_verify_credentials();
            
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mhome->social_register();
        
       if($this->session->userdata('logged_user')){ 
        //redirect('myhome/league', 'refresh');
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
        
        
        }else{
        $data['page']   = 'signUp';
        $data['title']  = 'The Inkubate - signUp';
        $data['social_id']  = $this->twconnect->tw_user_info->id;
        
        $total_name = explode(' ',$this->twconnect->tw_user_info->name);
        $source = explode('.',$this->twconnect->tw_user_info->status->source);
        
        $total_image = str_replace('normal','bigger',$this->twconnect->tw_user_info->profile_image_url);
        
        $data['social_firstname']  = $total_name[0];
        $data['social_lastname']  = $total_name[1];
        
        $data['social_source']  = $source[1];
        $data['social_image']  = $total_image;
        $data['social_ownid']  = $this->twconnect->tw_user_info->screen_name;
        
        $this->load->view('userType', $data);  
            
        }
    }


	/* authentication un-successful */
	public function failure() {

		/*echo '<p>Twitter connect failed</p>';
		echo '<p><a href="' . base_url() . 'twtest/clearsession">Try again!</a></p>'; */
        
        redirect('twtest/clearsession', 'refresh');
	}


	/* clear session */
	public function clearsession() {

		$this->session->sess_destroy();
        
        header('Location: '.base_url().'home/signUp');

      //print_r($this->session->all_userdata());
		//redirect(base_url().'home/logout','refresh');
        
        //session_start();
        //session_destroy(); //destroy the session
        //header("location:./");
        
	}

}