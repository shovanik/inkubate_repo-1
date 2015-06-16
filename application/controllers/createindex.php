<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateIndex extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Create Index';
        $this->load->view('admin/createindex/index',$data);
    }   
}
