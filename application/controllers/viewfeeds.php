<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewfeeds extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mwork','mprofile','mbookshelf','memail'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
   
   
   function index()
   {
        $json= simplexml_load_file('http://online.wsj.com/xml/rss/3_7014.xml');
        //$obj = json_decode($json);
        $data['title'] = $json->channel->title;
        $data['details'] = $json->channel->item;
        
        //echo "<pre>".print_r( $data['details'] )."</pre>";die;
        $this->load->view("feeds/index", $data);
        
   }
     
          
}
