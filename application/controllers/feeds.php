<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feeds extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        //$this->load->model(array('madmin', 'mfeeds'));
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit','madmin'));
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
            $add_data['user_id'] = $this->input->post('user_id');
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
        $data['title']  = 'Feeds list';
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
    
    function delete_feeds_url()
    {
        $id = $this->input->post('id');
        $usd = $this->session->userdata('logged_user');
        
        $insrt_data['user_id']     = $usd['id'];
        $insrt_data['feeds_url_id']     = $id; 
        $insrt_data['deleted_date']     = date("Y-m-d H:i:s"); 
        $sql = $this->db->insert("deleted_feeds", $insrt_data);
        if($sql){
            echo '1';
        }else{
            echo "0";
        }
        exit;
    }
    
   function feedurl_popup()
    {
            $data['pitchit_details'] = $this->memail->get_pitchit_details_form_view_author();
        
           $data['feeds_list']          = $this->mfeeds->getAllFeeds();
           //$data['feeds_url']           = $this->mfeeds->getActiveFeedsUrlList( $usd['id'] );
           $data['feeds_url2']           = $this->mfeeds->getAllFeedsUrl();
           $data['feeds_url3']           = $this->mfeeds->getAllFeedsUrl_author();
           if(!empty($data['feeds_url2']))
           {
             $feed2 = $data['feeds_url2'];
           }
           else
           {
              $feed2 = '';
           }
           if(!empty($data['feeds_url3']))
           {
             $feed3 = $data['feeds_url3'];
           }
           else
           {
              $feed3 = '';
           }
           
           if($data['feeds_url2'] == '')
           {
           $data['feeds_url']           = $feed3;
           }
           if($data['feeds_url3'] == '')
           {
           $data['feeds_url']           = $feed2;
           }
           if(!empty($data['feeds_url2']) && !empty($data['feeds_url3']))
           {
           $data['feeds_url']           = array_merge($data['feeds_url2'],$data['feeds_url3']);
           }
       
            
            $this->load->view('ajax_search/ajax_feed_list_popup',$data);
            
            
            
        
    } 
    
    function feedurl_status_author()
    {
        $feed_id = $this->input->post('id');
        $usd = $this->session->userdata('logged_user');
        $feeds = $this->mfeeds->feedurl_status($usd['id'], $feed_id);
        
        if(is_array($feeds) && count($feeds) >0){
            $this->db->where('user_id', $usd['id']);
            $this->db->where('feeds_url_id', $feed_id);
            $sql = $this->db->delete('deleted_feeds');
        }else{
            $insrt_data['user_id']          = $usd['id'];
            $insrt_data['feeds_url_id']     = $feed_id; 
            $insrt_data['deleted_date']     = date("Y-m-d H:i:s"); 
            $sql = $this->db->insert("deleted_feeds", $insrt_data);
        }
        
       
            //echo '1';
            
            $data['pitchit_details'] = $this->memail->get_pitchit_details_form_view_author();
        
           $data['feeds_list']          = $this->mfeeds->getAllFeeds();
           //$data['feeds_url']           = $this->mfeeds->getActiveFeedsUrlList( $usd['id'] );
           $data['feeds_url2']           = $this->mfeeds->getAllFeedsUrl();
           $data['feeds_url3']           = $this->mfeeds->getAllFeedsUrl_author();
           if(!empty($data['feeds_url2']))
           {
             $feed2 = $data['feeds_url2'];
           }
           else
           {
              $feed2 = '';
           }
           if(!empty($data['feeds_url3']))
           {
             $feed3 = $data['feeds_url3'];
           }
           else
           {
              $feed3 = '';
           }
           
           if($data['feeds_url2'] == '')
           {
           $data['feeds_url']           = $feed3;
           }
           if($data['feeds_url3'] == '')
           {
           $data['feeds_url']           = $feed2;
           }
           if(!empty($data['feeds_url2']) && !empty($data['feeds_url3']))
           {
           $data['feeds_url']           = array_merge($data['feeds_url2'],$data['feeds_url3']);
           }
           //print_r($data['feeds_url']);die;
           
           //################feeds list portion################//
            $feeds_data = array();
            $feeds_array = array();
            $feeds = $this->mfeeds->getActiveFeedsUrlList($usd['id']);
            if(is_array($feeds) && count($feeds) >0){
                foreach($feeds as $feeds_list){
                    $json   = simplexml_load_file($feeds_list['feeds_url'], 'SimpleXMLElement', LIBXML_NOWARNING);
                    
                    if($json)
                    {
                    $image = $json->channel->image->title;
                    //echo $image;WSJ.com: US BusinessBBC News - UK 
                    //echo "<pre>".print_r( $json->channel->item )."</pre>";die;
                    //if(is_array($json->channel->item) && count($json->channel->item) >0){
                        foreach($json->channel->item as $row){
                            
                            $media  = $row->children('media', TRUE);
                            if ($media->content && $media->content->attributes()) {
                                $attrs = $media->content->attributes();
                                $feeds_array['image'] = '<img class="feed_image" src="'.$attrs['url'].'" alt="" height="30" width="30" />';
                            }else{
                                if($image == "PublishersWeekly.com"){
                                    $feeds_array['image'] = '<img style="height:30px;" src="http://www.publishersweekly.com/images/logo-trans.png" alt="" />';
                                }
                                elseif($image == "WSJ.com: US Business"){
                                    $feeds_array['image'] = '<img src="'.base_url().'images/wsj.png" alt="" />';
                                }
                                
                                else
                                {
                                   $feeds_array['image'] = substr($image,0,3); 
                                }
                                
                            }
                            
                            $feeds_array['guid'] = ($row->guid !="") ? $row->guid : "";
                            $feeds_array['description'] = ($row->description !="") ? $row->description : "";
                            $feeds_array['create_date'] = ($row->pubDate !="") ? $row->pubDate : "";
                            $feeds_array['title'] = ($row->title !="") ? $row->title : "";
                            $feeds_array['link'] = ($row->link !="") ? $row->link : "";
                            $feeds_array['type'] = "feeds";
                            $feeds_array['source_org'] = explode('.com',$json->channel->image->title);
                            $feeds_array['source'] = $feeds_array['source_org'][0];
                            array_push($feeds_data, $feeds_array);
                        }
                    }
                }
            }
            $data['feeds_details'] = $feeds_data;
            
            $this->load->view('ajax_search/ajax_feed_list_author',$data);
            
            
            
        
    }
    
    
    function feedurl_status_publisher()
    {
        $feed_id = $this->input->post('id');
        $usd = $this->session->userdata('logged_user');
        $feeds = $this->mfeeds->feedurl_status($usd['id'], $feed_id);
        
        if(is_array($feeds) && count($feeds) >0){
            $this->db->where('user_id', $usd['id']);
            $this->db->where('feeds_url_id', $feed_id);
            $sql = $this->db->delete('deleted_feeds');
        }else{
            $insrt_data['user_id']          = $usd['id'];
            $insrt_data['feeds_url_id']     = $feed_id; 
            $insrt_data['deleted_date']     = date("Y-m-d H:i:s"); 
            $sql = $this->db->insert("deleted_feeds", $insrt_data);
        }
        
       
            //echo '1';
            
           $data['pitchit_details'] = $this->memail->get_pitchit_details_form_view();
        
           $data['feeds_list']          = $this->mfeeds->getAllFeeds();
           //$data['feeds_url']           = $this->mfeeds->getActiveFeedsUrlList( $usd['id'] );
           $data['feeds_url2']           = $this->mfeeds->getAllFeedsUrl();
           $data['feeds_url3']           = $this->mfeeds->getAllFeedsUrl_author();
           if(!empty($data['feeds_url2']))
           {
             $feed2 = $data['feeds_url2'];
           }
           else
           {
              $feed2 = '';
           }
           if(!empty($data['feeds_url3']))
           {
             $feed3 = $data['feeds_url3'];
           }
           else
           {
              $feed3 = '';
           }
           
           if($data['feeds_url2'] == '')
           {
           $data['feeds_url']           = $feed3;
           }
           if($data['feeds_url3'] == '')
           {
           $data['feeds_url']           = $feed2;
           }
           if(!empty($data['feeds_url2']) && !empty($data['feeds_url3']))
           {
           $data['feeds_url']           = array_merge($data['feeds_url2'],$data['feeds_url3']);
           }
           //print_r($data['feeds_url']);die;
           
           //################feeds list portion################//
            $feeds_data = array();
            $feeds_array = array();
            $feeds = $this->mfeeds->getActiveFeedsUrlList($usd['id']);
            if(is_array($feeds) && count($feeds) >0){
                foreach($feeds as $feeds_list){
                    $json   = simplexml_load_file($feeds_list['feeds_url'], 'SimpleXMLElement', LIBXML_NOWARNING);
                    
                    if($json)
                    {
                    $image = $json->channel->image->title;
                    //echo $image;WSJ.com: US BusinessBBC News - UK 
                    //echo "<pre>".print_r( $json->channel->item )."</pre>";die;
                    //if(is_array($json->channel->item) && count($json->channel->item) >0){
                        foreach($json->channel->item as $row){
                            
                            $media  = $row->children('media', TRUE);
                            if ($media->content && $media->content->attributes()) {
                                $attrs = $media->content->attributes();
                                $feeds_array['image'] = '<img class="feed_image" src="'.$attrs['url'].'" alt="" height="30" width="30" />';
                            }else{
                                if($image == "PublishersWeekly.com"){
                                    $feeds_array['image'] = '<img style="height:30px;" src="http://www.publishersweekly.com/images/logo-trans.png" alt="" />';
                                }
                                elseif($image == "WSJ.com: US Business"){
                                    $feeds_array['image'] = '<img src="'.base_url().'images/wsj.png" alt="" />';
                                }
                                
                                else
                                {
                                   $feeds_array['image'] = substr($image,0,3); 
                                }
                                
                            }
                            
                            $feeds_array['guid'] = ($row->guid !="") ? $row->guid : "";
                            $feeds_array['description'] = ($row->description !="") ? $row->description : "";
                            $feeds_array['create_date'] = ($row->pubDate !="") ? $row->pubDate : "";
                            $feeds_array['title'] = ($row->title !="") ? $row->title : "";
                            $feeds_array['link'] = ($row->link !="") ? $row->link : "";
                            $feeds_array['type'] = "feeds";
                            $feeds_array['source_org'] = explode('.com',$json->channel->image->title);
                            $feeds_array['source'] = $feeds_array['source_org'][0];
                            array_push($feeds_data, $feeds_array);
                        }
                    }
                }
            }
            $data['feeds_details'] = $feeds_data;
            
            $this->load->view('ajax_search/ajax_feed_list_publisher',$data);
            
            
            
        
    }
    
   function feedurl_delete()
    {
        $feed_id = $this->input->post('id');
        $usd = $this->session->userdata('logged_user');
        //$feeds = $this->mfeeds->feedurl_status($usd['id'], $feed_id);
        $sql = $this->db->where('id',$feed_id)->where('user_id',$usd['id'])->delete('feeds_url');
      
        if($sql){
            echo '1';
        }else{
            echo "0";
        }
        exit;
    } 
    
  public function feed_add_author(){
    
    $usd = $this->session->userdata('logged_user');
    
        if($this->input->post())
        {
            $add_data['user_id'] = $this->input->post('user_id');
            $add_data['feeds_url'] = $this->input->post('feeds_url');
            $sql = $this->db->insert("feeds_url", $add_data);
            
            if($sql){
                
                if($usd['user_type'] == '1')
                {
                $this->session->set_flashdata('success','Feeds url Successfully added');
                redirect(base_url()."home/author");
                }
                if($usd['user_type'] == '2')
                {
                $this->session->set_flashdata('success','Feeds url Successfully added');
                redirect(base_url()."home/publisher");
                }
                
            }else{
                //$this->session->set_flashdata('error','There are some problem to add feeds url, please try again');
                //redirect(base_url()."feeds/add");
                
                if($usd['user_type'] == '1')
                {
                $this->session->set_flashdata('error','There are some problem to add feeds url, please try again');
                redirect(base_url()."home/author");
                }
                if($usd['user_type'] == '2')
                {
                $this->session->set_flashdata('error','There are some problem to add feeds url, please try again');
                redirect(base_url()."home/publisher");
                }
            }
            
        }else{
            //$data   = array();
            //$data['title']  = 'Add feeds url';
            //$this->load->view('admin/feeds/add',$data);
            
                if($usd['user_type'] == '1')
                {
                $this->session->set_flashdata('error','There are some problem to add feeds url, please try again');
                redirect(base_url()."home/author");
                }
                if($usd['user_type'] == '2')
                {
                $this->session->set_flashdata('error','There are some problem to add feeds url, please try again');
                redirect(base_url()."home/publisher");
                }
            
        }
    }  
    
          
}
