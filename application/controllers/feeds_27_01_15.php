<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feeds extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin', 'mfeeds'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
    public function index(){
        $data   = array();
        $data['title']  = 'feeds url list';
        $data['countfeedsurl']  = $this->mfeeds->countFeedsUrlList();
        $data['feedsurl_list']  = $this->mfeeds->getFeedsUrlList();
        $this->load->view('admin/feeds/index',$data);
    }
   
   
   function test()
   {
        $feed = file_get_contents("http://online.wsj.com/xml/rss/3_7014.xml");
        $json = new SimpleXmlElement($feed);
        //$json= simplexml_load_file('http://online.wsj.com/xml/rss/3_7014.xml');
        //$obj = json_decode($json);
        $data['title'] = $json->channel->title;
        $data['details'] = $json->channel->item;
        
        $content = $data['details']->children('media', true)->content->attributes();
        echo $content->url;
        
        echo "<pre>".print_r( $content )."</pre>";die;
        $this->load->view("feeds/index", $data);
        
   }
   
    public function add(){
        if($this->input->post())
        {
            $add_data['feeds_url'] = $this->input->post('feeds_url');
            $sql = $this->db->insert("feeds_url", $add_data);
            if($sql){
                $this->session->set_flashdata('success','Feeds url Successfully added');
                redirect(base_url()."feeds/index");
            }else{
                $this->session->set_flashdata('error','There are ome problem to add feeds url, please try again');
                redirect(base_url()."feeds/add");
            }
        }else{
            $data   = array();
            $data['title']  = 'Add feeds url';
            $this->load->view('admin/feeds/add',$data);
        }
    }
    
    public function edit(){
        
        if($this->input->post())
        {
            $id = $this->input->post('id');
            $edit_data['feeds_url'] = $this->input->post('feeds_url');
            $sql = $this->db->where("id", $id)->update("feeds_url", $edit_data);
            if($sql){
                $this->session->set_flashdata('success','Feeds url Successfully updated');
                redirect(base_url()."feeds/index");
            }else{
                $this->session->set_flashdata('error','There are ome problem to update feeds url, please try again');
                redirect(base_url()."feeds/edit/".$id);
            }
        }else{
            $id = $this->uri->segment(3);
            $data   = array();
            $data['title']  = 'Update feeds url';
            $data['details'] =  $this->mfeeds->getFeedsUrlById( $id );
            $this->load->view('admin/feeds/edit',$data);
        }
    }
    
    public function feeds_list()
    {
        $feedsurl_list  = $this->mfeeds->getFeedsUrlList();
        $json= simplexml_load_file($feedsurl_list[0]['feeds_url']);
        //$obj = json_decode($json);
        $data['title']  = 'feeds list';
        //$data['title'] = $json->channel->title;
        $data['details'] = $json->channel->item;
        
        //echo "<pre>".print_r( $data['details'] )."</pre>";die;
        $this->load->view("admin/feeds/feeds_list", $data);
    }
    
    function add_feeds()
    {
        $feeds_aray = $this->input->post('feeds_array');
        foreach($feeds_aray as $row){
            $guid = $row['guid'];
            $feeds_guid = $this->mfeeds->getFeedsByGuid($guid);
            
            if($feeds_guid != "$guid"){
                $add_data['guid']   = $row['guid'];
                $add_data['title']  = $row['title'];
                $add_data['desc']   = $row['desc'];
                $add_data['link']   = $row['link'];
                $add_data['date']   = date("Y-m-d H:i:s", strtotime($row['date']));
                $sql = $this->db->insert("feeds", $add_data);
            }
            
        }
        echo 1;
        
        //echo "<pre>".print_r( $feeds_aray )."</pre>";die;
    }
    
          
}
