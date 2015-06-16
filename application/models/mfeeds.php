<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mfeeds extends CI_Model
{
 
    function getFeedsUrlList()
    {
        $rs  = $this->db->select('*')->get('feeds_url');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }        
        $rs->free_result();
        return $data;
    }
    
    function countFeedsUrlList()
    {
        $rs  = $this->db->select('count(*) count')->get('feeds_url');
        $data   = $rs->row_array();
        return $data['count'];
    }
    
    function getFeedsByTitle($title)
    {
        $rs  = $this->db->select('title')->where('title', "$title")->get('feeds');
        //echo $this->db->last_query();
        $data   = $rs->row_array();
        if(isset($data['title']) && $data['title'] != ""){
            $title = $data['title'];
        }else{
            $title = "";
        }
        return $title;die;
    }
    
    function getFeedsByLink($link)
    {
        //$title = "'".$title."'";
        $rs  = $this->db->select('link')->where('link', "$link")->get('feeds');
        //echo $this->db->last_query();
        $data   = $rs->row_array();
        if(isset($data['link']) && $data['link'] != ""){
            $link = $data['link'];
        }else{
            $link = "";
        }
        return $link;die;
        //return $data['title'];
    }
    function getFeedsByGuid($guid)
    {
        $rs  = $this->db->select('guid')->where('guid', "$guid")->get('feeds');
        //echo $this->db->last_query();
        $data   = $rs->row_array();
        if(isset($data['guid']) && $data['guid'] != ""){
            $link = $data['guid'];
        }else{
            $link = "";
        }
        return $link;die;
    }
    
    function getFeedsUrlById( $id )
    {
        $data = array();
        $rs  = $this->db->select('*')->where("id", $id)->get('feeds_url');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        
        return $data;
    }
    
    function getAllFeeds()
    {
        $rs  = $this->db->select('*')->get('feeds');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }        
        return $data;
    }
    
    function getAllFeedsUrl()
    {
        $rs  = $this->db->select('*')->where('user_id','1')->get('feeds_url');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            return $data;
        }        
        
    }
    
    function getAllFeedsUrl_author()
    {
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('*')->where('user_id',$usd['id'])->get('feeds_url');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            return $data;
        }        
        
    }
    
    
    function getFeedsUrlByUserid($user_id)
    {
        $array = array();
        $qry  = $this->db->select('feeds_url_id')->where("user_id", $user_id)->get('deleted_feeds')->result_array();
        //echo $this->db->last_query();die;
        foreach($qry as $row){
            $array[] = $row['feeds_url_id'];
        } 
        return $array; 
    }
    
    function getActiveFeedsUrlList($user_id)
    {
        $data = array();
        $array  = $this->getFeedsUrlByUserid( $user_id );
        $names = array('1', $user_id);
        if(is_array($array) && count($array) >0){
            $rs  = $this->db->select('*')->where_not_in("id", $array)->where_in('user_id', $names)->get('feeds_url');
        }else{
            $rs  = $this->db->select('*')->where_in('user_id', $names)->get('feeds_url');
        }
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        } 
        //echo $this->db->last_query();die;       
        return $data;
    }
    
    function showAllFeedsUrl($user_id)
    {
        $data = array();
        $array  = $this->getFeedsUrlByUserid( $user_id );
        if(is_array($array) && count($array) >0){
            $rs  = $this->db->select('*')->where_not_in("id", $array)->get('feeds_url');
        }else{
            $rs  = $this->db->select('*')->get('feeds_url');
        }
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        } 
        //echo $this->db->last_query();die;       
        return $data;
    }
    
    function feedurl_status($user_id, $feed_id)
    {
        $data = array();
        $rs  = $this->db->select('*')->where("user_id", $user_id)->where("feeds_url_id", $feed_id)->get('deleted_feeds');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        return $data;
    }
    
    
    
}
