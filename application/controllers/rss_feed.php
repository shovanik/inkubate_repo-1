<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss_feed extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mfeeds'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
   
   
   function index1()
   {
        $json= simplexml_load_file('http://feeds.bbci.co.uk/news/england/rss.xml');
        //$json = str_replace('<media:', '<', $json);
        //$json = str_replace('</media:', '</', $json);
        //$rss = simplexml_load_string($feed);
        //$json= simplexml_load_file('http://publishersweekly.com/pw/feeds/recent/index.xml');
        //$obj = json_decode($json);
        //$data['title'] = $json->channel->title;
        $data['details'] = $json->channel->item;
        foreach ($json->channel->item as $item)
        {
            $thumbAttr = $item->media;

            echo $thumbAttr;
        }
        //die;
        echo "<pre>".print_r( $json );die;
        $this->load->view("rss_feed", $data);
        
   }
   
   function index()
   {
        $json = simplexml_load_file('http://online.wsj.com/xml/rss/3_7014.xml');
        print_r($json);die;
        //echo $json->channel->item[3]->children('media',TRUE)->content->attributes()->url;
        foreach ($json->channel->item as $item)
        {
            //$media  = $item->children('media', TRUE)->content->attributes();
            $media  = $item->children('media', TRUE);
            //$attrs = $media->group->player->attributes();
            if ($media->content && $media->content->attributes()) {
                $attrs = $media->content->attributes();
                echo $attrs['url']."<br>";
            }

        }
        
       
       
   }
   
   function feeds()
   {
        $data = array();
        $feeds = $this->mfeeds->getFeedsUrlList();
        $i  = 0;
        foreach($feeds as $feeds_list){
            $json= simplexml_load_file($feeds_list['feeds_url']);
            $data[$i]['details'] = $json->channel->item;
            $i++;
        }
                
        echo "<pre>".print_r( $data )."</pre>";die;
        $this->load->view("rss_feed", $data);
        
   }
     
          
}
