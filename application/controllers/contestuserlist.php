<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContestUserList extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Contest Users';
        $this->load->view('admin/contestuserlist/index',$data);
    }   
}
