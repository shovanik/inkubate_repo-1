<?php
session_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
   
//define('API_KEY','75wyu5jl7pbozx');
//define('API_SECRET','6ggqRz6HXJa4CwEi');
//define('REDIRECT_URI','http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
//define('SCOPE','r_fullprofile r_emailaddress');

//session_name('linkedin');
//session_start();

class Linkedin_signup extends CI_Controller {


 public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
        $this->load->library('Common');
        $this->config->load('linkedin');
       
        
        
    }
   
    function index() {
     
       if (isset($_GET['error'])) {
    // LinkedIn returned an error
    print $_GET['error'] . ': ' . $_GET['error_description'];
    exit;
} elseif (isset($_GET['code'])) {
    // User authorized your application
    if ($_SESSION['state'] == $_GET['state']) {
        // Get token so you can make API calls
        $this->getAccessToken();
    } else {
        // CSRF attack? Or did you mix up your states?
        exit;
    }
} else { 
    if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
        // Token has expired, clear the state
        $_SESSION = array();
    }
    if (empty($_SESSION['access_token'])) {
        // Start authorization process
       $this->getAuthorizationCode();
    }
}
 
// Congratulations! You have a valid token. Now fetch your profile 
$user = $this->fetch('GET', '/v1/people/~:(id,firstName,lastName,headline,picture-url,email-address,skills,public-profile-url)');

//print $user;

//print "hi $user->id $user->headline.";
/*echo $this->config->item('REDIRECT_URI');
print "Hello $user->firstName $user->lastName.";

echo "<pre>";var_dump($user);
echo "</pre>";

exit; */

$twit_user_email = $this->mhome->get_twit_user_byemail($user->emailAddress);
               
              if(($twit_user_email['email'] == $user->emailAddress) && ($twit_user_email['social_source'] != 'linkedin'))
              {
                $this->load->view('email_exist');
              } 
              
    else {
        
$twit_user = $this->mhome->get_twit_user($user->id);
          
         
             
            if(count($twit_user) > 0){ 
             
             
             $twit_user_pass_blank = $this->mhome->get_twit_user_pass_blank($user->id);
             
             //echo $twit_user_pass_blank['count'];die;
             //echo 'hi'.$twit_user['password'].'hello';die;
             
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
                       redirect('home/agent', 'refresh'); 
                    }
                    
                    
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
                       redirect('home/editor', 'refresh'); 
                    }
                    
                    }
                 }
             
            
           }
            else
             {
               
                $data['page']   = 'signUp';
                $data['title']  = 'The Inkubate - signUp';
                $data['social_id']  = $user->id;
               
                $data['social_firstname']  = $user->firstName;
                $data['social_lastname']  = $user->lastName;
                
                $data['social_source']  = 'linkedin';
                $data['social_image']  = $user->pictureUrl;
                $data['social_ownid']  = $user->id;
                $data['social_email']  = $user->emailAddress;
                
                $this->load->view('userType_linkedin', $data);  
              
          
          }
          
       }   

    }
    
    
  public function linkedin_user()
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
                           redirect('home/agent', 'refresh'); 
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
                           redirect('home/editor', 'refresh'); 
                        }
                   // redirect('home/editor', 'refresh');
                 }   
                }
                
                
            }
    }  

public function getAuthorizationCode() {
    $params = array(
        'response_type' => 'code',
        'client_id' => $this->config->item('API_KEY'),
        'scope' => $this->config->item('SCOPE'),
        'state' => uniqid('', true), // unique long string
        'redirect_uri' => $this->config->item('REDIRECT_URI')
    );
 
    // Authentication request
    $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
     
    // Needed to identify request when it returns to us
    $_SESSION['state'] = $params['state'];
 
    // Redirect user to authenticate
    header("Location: $url");
    exit;
}
     
public function getAccessToken() {
    $params = array(
        'grant_type' => 'authorization_code',
        'client_id' => $this->config->item('API_KEY'),
        'client_secret' => $this->config->item('API_SECRET'),
        'code' => $_GET['code'],
        'redirect_uri' => $this->config->item('REDIRECT_URI')
    );
     
    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
     
    // Tell streams to make a POST request
    $context = stream_context_create(
        array('http' => 
            array('method' => 'POST',
            )
        )
    );
 
    // Retrieve access token information
    $response = file_get_contents($url, false, $context);
 
    // Native PHP object, please
    $token = json_decode($response);
 
    // Store access token and expiration time
    $_SESSION['access_token'] = $token->access_token; // guard this! 
    $_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
    $_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
     
    return true;
}
 
public function fetch($method, $resource, $body = '') {
    //print $_SESSION['access_token'];
 $params = array();
    $opts = array(
        'http'=>array(
            'method' => $method,
            'header' => "Authorization: Bearer " . $_SESSION['access_token'] . "\r\n" . "x-li-format: json\r\n"
        )
    );
 
    // Need to use HTTPS
    $url = 'https://api.linkedin.com' . $resource;
 
    // Append query parameters (if there are any)
    if (count($params)) { $url .= '?' . http_build_query($params); }
 
    // Tell streams to make a (GET, POST, PUT, or DELETE) request
    // And use OAuth 2 access token as Authorization
    $context = stream_context_create($opts);
 
    // Hocus Pocus
    $response = file_get_contents($url, false, $context);
 
    // Native PHP object, please
    return json_decode($response);
    
      
}
  
    
}