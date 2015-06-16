<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InformationRequest extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Information Requests';
        $this->load->view('admin/informationrequest/index',$data);
    }   
}
