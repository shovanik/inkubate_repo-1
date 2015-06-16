<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invitation extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Create an Invitation';
        $this->load->view('admin/invitation/index',$data);
    }   
}
