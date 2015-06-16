<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Googleplus_login extends CI_Controller {

   /* function __construct() {
        parent::__construct();
        $this->load->helper('url');
    } */

 public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
        $this->load->library('Common');
      
    }
   
     
    function signup_googleplus()
    {
        $data   = array();
        $arr = array();
        $twit_user_email = $this->mhome->get_twit_user_byemail($this->input->post('email'));
              
             // $arr['email'] = $this->input->post('email'); 
               
              if(($twit_user_email['email'] == $this->input->post('email')) && ($twit_user_email['social_source'] != 'googleplus'))
              {
                //$this->load->view('email_exist',$arr);
                //echo 'hi';
              if($twit_user_email['count'] > 0){ 
                
             //$twit_user_pass_blank = $this->mhome->get_twit_user_pass_blank($this->input->post('id'));   
             
            if($twit_user_email['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/author', 'refresh');
               
                
                
                if($twit_user_email['password'] == '')
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '1';
                }
                
               } 
                 
                
             }
             else if($twit_user_email['user_type'] == '2')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/publisher', 'refresh');
                
               
                    if($twit_user_email['password'] == '')
                    {
                       echo '19@'.$usd['id'];
                    }
                    else
                    {
                       echo '2';
                    }
                
               
                }
                 
                 
             }
             else if($twit_user_email['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/agent', 'refresh');
               
                if($twit_user_email['password'] == '')
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '3';
                }
                
               
               
                }
                  
                 
             }
             else if($twit_user_email['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/editor', 'refresh');
                
                
                if($twit_user_email['password'] == '')
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '4';
                }
                
               
                
                } 
                
             } 
             
            
           }
                
      } 
              
    else {
                
       $twit_user = $this->mhome->get_google_user($this->input->post('id'));
            
           //echo  $this->input->post('id');
           //echo $twit_user['count'];
            if($twit_user['count'] > 0){ 
                
             $twit_user_pass_blank = $this->mhome->get_twit_user_pass_blank($this->input->post('id'));   
             
            if($twit_user['user_type'] == '1')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/author', 'refresh');
               
                
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '1';
                }
                
               } 
                 
                
             }
             else if($twit_user['user_type'] == '2')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/publisher', 'refresh');
                
               
                    if($twit_user_pass_blank['count'] > 0)
                    {
                       echo '19@'.$usd['id'];
                    }
                    else
                    {
                       echo '2';
                    }
                
               
                }
                 
                 
             }
             else if($twit_user['user_type'] == '3')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/agent', 'refresh');
               
                if($twit_user_pass_blank['count'] > 0)
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '3';
                }
                
               
               
                }
                  
                 
             }
             else if($twit_user['user_type'] == '4')
             {
                if($this->session->userdata('logged_user')){
                $usd = $this->session->userdata('logged_user');
                //redirect('home/editor', 'refresh');
                
                
                if($twit_user_pass_blank['count'] > 0)
                {
                   echo '19@'.$usd['id'];
                }
                else
                {
                   echo '4';
                }
                
               
                
                } 
                
             } 
             
            
           }
            else
             {
              
                $data['social_id'] = $this->input->post('id');
                $data['social_firstname'] = $this->input->post('given_name');
                $data['social_lastname'] = $this->input->post('family_name');
                $data['social_source'] = 'googleplus';
                $data['social_image'] = $this->input->post('picture');
                $data['social_ownid'] = $this->input->post('id');
                $data['social_email'] = $this->input->post('email');
                
                $this->load->view('userType_googleplus',$data); 
                 
             }
             
         }    
         
    }
    
    public function googleplus_user()
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
   

}
