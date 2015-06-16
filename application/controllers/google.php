<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Google extends CI_Controller { 
    
    
    public function __construct() 

   { 
    parent::__construct(); 
    $this->config->load('google');
    
   require APPPATH .'third_party/src/Google_Client.php';
   require APPPATH .'third_party/src/contrib/Google_PlusService.php'; 
   $cache_path = $this->config->item('cache_path'); 
   
   $GLOBALS['apiConfig']['ioFileCache_directory'] = ($cache_path == '') ? APPPATH .'cache/' : $cache_path; 
   
   $this->client = new Google_Client(); 
   $this->client->setApplicationName($this->config->item('application_name', 'google'));

   $this->client->setClientId($this->config->item('client_id', 'google')); 
   $this->client->setClientSecret($this->config->item('client_secret', 'google'));
   
   $this->client->setRedirectUri($this->config->item('redirect_uri', 'google')); 
   $this->client->setDeveloperKey($this->config->item('api_key', 'google'));
   $this->oauth2 = new Google_PlusService($this->client); 
   
    } /** * Welcome index * * @access     public */
  public function index() { 
    $data['auth'] = $this->client->createAuthUrl(); 
    $this->load->view('google', $data); 
    }

  public function googleLoginSubmit() { 
    $this->input->get('code'); 
    $this->client->authenticate(); 
    $data1=$this->client->getAccessToken();
    $data['user'] = $this->oauth2->get(); 
    echo "<pre>"; print_r($data['user']); //$this->load->view('google', $data); 
    echo 'hi';
    
    } 
    
    }


?>