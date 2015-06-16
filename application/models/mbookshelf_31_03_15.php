<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mbookshelf extends CI_Model
{

  public function addBookShelves(){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $bkself = $this->input->post('bookshelf');
        
        if($bkself != '')
        {
        $data['user_id'] = $usd['id'];
        $data['name'] = $this->input->post('bookshelf');
        
        $data['protected'] = '1';
        $data['default_list'] = '1';
        
        $data['create_date']    = date("Y-m-d h:i:s");
        $data['modified_date']    = date("Y-m-d h:i:s");
        
        $this->db->insert('bookshelfs', $data);
        //echo $this->db->last_query();die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
      
       
    }
    
  public function addSavedSearch($id){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $bkself = $this->input->post('save_search');
        
        if($bkself != '')
        {
        $data['user_id'] = $usd['id'];
        $data['search_form_id'] = $id;
        $data['saved_search_name'] = $this->input->post('save_search');
        
        $data['create_date']    = date("Y-m-d h:i:s");
        $data['modified_date']    = date("Y-m-d h:i:s");
        
        $this->db->insert('saved_searches', $data);
        //echo $this->db->last_query();die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
      
       
    } 
    
  function total_saved_search(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('user_id',$usd['id'])->get('saved_searches')->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }    
    
    public function addToBookShelves(){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $rs=$this->db->select('*')->where('user_id',$usd['id'])->where('Wid',$this->input->post('wid'))->where('bid',$this->input->post('bkself_id'))->get('bookshelf_works');
        //$data['user_id'] = $usd['id'];
        if($rs->num_rows() == 0){
        
            if($this->input->post('bkself_id') != '0')
            {
            $data['user_id'] = $usd['id'];    
            $data['Wid'] = $this->input->post('wid');
            $data['bid'] = $this->input->post('bkself_id');
            $data['created_date']    = date("Y-m-d h:i:s");
             
            $this->db->insert('bookshelf_works', $data);
            }
        }
        //echo $this->db->last_query();die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
      
       
    } 
    
    public function BookShelves_share(){
        $data   = array();
        
        $data['email'] = $this->input->post('email');
        $data['note'] = $this->input->post('note');
        $data['bself_id'] = $this->input->post('bself_id');
        
        $this->send_mail_to_registered_user($data['email'], $data['note'],$data['bself_id']);
         //echo "sssssss";die;
       return 1;
    }
    
   function send_mail_to_registered_user($email ,$note,$bselfid){
        
        $sub    = 'Inkubate Shared Bookshelf';
        $str    = '<div style="width:100%;background-color: #39302c; padding-bottom:20px;"><div style="width:750px; padding:0px 0 0 0; margin:40px auto; font-family:Verdana, Geneva, sans-serif; font-size:13px;background-color: #39302c;">

   <table width="100%" border="0" cellpadding="8" cellspacing="0" style="color:#39302c; padding:10px 0 0px 0px;">
   
   <tr>
   
     <td style=" padding:15px 0" ><a href="" style="padding-bottom:0px;"><img src="http://billbahadur.com/demo/inkubate/images/logo.png" alt="" /></a>
     <hr style="boder-bottom:1px solid #ccc; width:100%; background:#ccc"><br />
     </td>
     
   
   </tr>
  <tr style="background-color: #fff;">
    <td width="27%" style="color: #000;"><p>Dear Editor,</p>

    <p>'.$note.'</p>

    <p>Please <a href="http://billbahadur.com/demo/inkubate/bookshelves/sharebooklist/'.$bselfid.'">click here</a> to view</p>

    </td>
  </tr>
  
</table></div></div>';
        //die($str);
        //die();
        //$headers  = "From: Admin <das.prasenjit55@gmail.com>\n";
        $headers = "From: inkubate@inkubate.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-Type: text/HTML; charset=ISO-8859-1\r\n";
        @mail($email, $sub, stripslashes($str), $headers);
        return 1;
    }   
    
   
   function get_bookshelf(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('user_id',$usd['id'])->get('bookshelfs')->result_array();
         //$data  = $this->db->select('s.*,a.*')->from('bookshelfs as s')->join('bookshelf_works as a','s.id = a.bid','inner')->where('s.user_id', $usd['id'])->get()->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;             
    
    }
    function get_bookshelf_with_search($search="",$offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         if($search == "")
         {
         	$data=$this->db->select('*')->where('user_id',$usd['id'])->where('is_status !=','0')->limit($limit,$offset)->get('bookshelfs')->result_array();
            
         }
         else
         {
         	$data=$this->db->select('*')->where('user_id',$usd['id'])->where('is_status !=','0')->like('name', $search)->limit($limit,$offset)->get('bookshelfs')->result_array();
            //echo $this->db->last_query();die;
         }
         
         //$data  = $this->db->select('s.*,a.*')->from('bookshelfs as s')->join('bookshelf_works as a','s.id = a.bid','inner')->where('s.user_id', $usd['id'])->get()->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;             
    
    }
    function count_bookshelf_with_search($search=""){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         if($search == "")
         {
         	$data=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->where('is_status !=','0')->get('bookshelfs')->result_array();
         }
         else
         {
         	$data=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->where('is_status !=','0')->like('name', $search)->get('bookshelfs')->result_array();
         }
         
         //$data  = $this->db->select('s.*,a.*')->from('bookshelfs as s')->join('bookshelf_works as a','s.id = a.bid','inner')->where('s.user_id', $usd['id'])->get()->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data[0]['count'];             
    
    }
    
    function get_bookshelf_one($bookshelf_id=0){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('user_id',$usd['id'])->where('bid',$bookshelf_id)->order_by('id','asc')->limit(1)->get('bookshelf_works')->row_array();
        
         //$data  = $this->db->select('s.*,a.*')->from('bookshelfs as s')->join('bookshelf_works as a','s.id = a.bid','inner')->where('s.user_id', $usd['id'])->where('a.bid',$bookshelf_id)->order_by('a.bid','asc')->limit(1)->get()->result_array();
       // echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        //echo $bookshelf_id; 
        return $data;               
    
    }
     function get_bookshelf_first($bookshelf_id=0){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('bid',$bookshelf_id)->order_by('id','asc')->limit(1)->get('bookshelf_works')->row_array();
        
         //$data  = $this->db->select('s.*,a.*')->from('bookshelfs as s')->join('bookshelf_works as a','s.id = a.bid','inner')->where('s.user_id', $usd['id'])->where('a.bid',$bookshelf_id)->order_by('a.bid','asc')->limit(1)->get()->result_array();
       // echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        //echo $bookshelf_id; 
        return $data;               
    
    }
    function get_user_book_self_count($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('count(*) as count')->where('bid',$id)->get('bookshelf_works')->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data['0']['count'];               
    
    }
    function get_rest_bookshelf($bid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('id !=',$bid)->where('user_id',$usd['id'])->where('is_status','1')->get('bookshelfs')->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
   function saveTitle($wid){
         $data=array();
         $dataBookshelf = array();
         $usd = $this->session->userdata('logged_user');
         $rs=$this->db->select('id')->where('user_id',$usd['id'])->where('is_status','0')->get('bookshelfs')->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        if(count($rs) > 0)
        {
            $row=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->where('wid',$wid)->where('bid',$rs['id'])->get('bookshelf_works')->row_array();
            
            if($row['count'] == '0')
            {
                $data['user_id'] = $usd['id'];
                $data['wid'] = $wid;
                $data['bid'] = $rs['id'];
                $data['created_date'] = date("Y-m-d h:i:s");
                //$this->db->insert('bookshelfs',$data);
                $this->db->insert('bookshelf_works', $data);
                return 1; 
            }
            else
            {
                return 0;   
            }
        }
        else
        {
            $dataBookshelf['user_id'] = $usd['id'];
        	$dataBookshelf['name'] = $usd['id'].'DeafaultBookshelf';
        	$dataBookshelf['protected'] = "1";
            $dataBookshelf['default_list'] = "1";
            $dataBookshelf['create_date'] = date('Y-m-d h:i:s');
            $dataBookshelf['modified_date'] = date('Y-m-d h:i:s');
        	$dataBookshelf['is_status'] = "0";
        	$this->db->insert('bookshelfs', $dataBookshelf);
            
      $rst=$this->db->select('id')->where('user_id',$usd['id'])->where('is_status','0')->get('bookshelfs')->row_array(); 
      
      $row=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->where('wid',$wid)->where('bid',$rst['id'])->get('bookshelf_works')->row_array();
            
            if($row['count'] == '0')
            {
                $data['user_id'] = $usd['id'];
                $data['wid'] = $wid;
                $data['bid'] = $rst['id'];
                $data['created_date'] = date("Y-m-d h:i:s");
                //$this->db->insert('bookshelfs',$data);
                $this->db->insert('bookshelf_works', $data);
                return 1; 
            }
            else
            {
                return 0;   
            }           
            
        }                  
    
    } 
    
    function get_bookself_name($bid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('id,name,user_id,create_date')->where('id',$bid)->get('bookshelfs')->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }
     
    
    function get_user_book_self($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data=$this->db->select('*')->where('bid',$id)->get('bookshelf_works')->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
    function delete_details($id)
    {
        $this->db->where('id',$id)->delete('messages');
    } 
    
     function get_book_cat($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('s.*,a.*')->from('work_categories as s')->join('categories as a','s.cid = a.id','inner')->where('s.wid', $wid)->get();
         
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;                
    
    }
    
    function get_book_tag($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('s.*,a.*')->from('work_tags as s')->join('tags as a','s.tid = a.id','inner')->where('s.Wid', $wid)->get();
         
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;                
    
    }
    
     function get_all_books($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,status_id')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name_first'] = '';   
                }
                if(!empty($row['name_middle']))
                {
                $data[$each]['name_middle'] = $row['name_middle'];
                }
                else
                {
                 $data[$each]['name_middle'] = '';   
                }
                if(!empty($row['name_last']))
                {
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name_last'] = '';   
                }
                if(!empty($row['user_guid']))
                {
                $data[$each]['user_guid'] = $row['user_guid'];
                }
                else
                {
                 $data[$each]['user_guid'] = '';   
                }
                
                
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                
                $row38=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row38['work_type_name']))
                {
                $data[$each]['type_name'] = $row38['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
               
               $row37=$this->db->select('a.id,a.Wid,a.cid,c.id as catid,c.category_name')->from('work_categories as a')->join('categories as c','a.cid = c.id','inner')->where('a.Wid', $value['id'])->order_by('a.id','asc')->limit(1)->get()->row_array();
                if(!empty($row37['category_name']))
                {
                $data[$each]['category_name'] = $row37['category_name'];
                }
                else
                {
                 $data[$each]['category_name'] = '';   
                } 
                 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    function getSearchInfoByName($name)
    {
    	$usd = $this->session->userdata('logged_user');
    	$info = array();
    	$searchInfo = $this->db->select('id')->where('user_id',$usd['id'])->where('saved_search_name',$name)->limit(1)->get('saved_searches')->row_array();
    	if(isset($searchInfo['id']))
    	{
    		$id = $searchInfo['id'];
    	}
    	else
    	{
    		$id = 0;
    	}
    	$view  = $this->db->select('format_id,type_id,category_id,filter_type')->where('user_id',$usd['id'])->where('search_id',$id)->where('is_deleted','0')->get('saved_filters')->result_array();
	
	$info['type'] = "";
	$type = "";
	$search = array();
	foreach($view as $v)
	{
		$type = $v['filter_type'];
		if($v['filter_type'] == "genre")
		{
			$search[] = $v['category_id'];
		}
		if($v['filter_type'] == "format")
		{
			$search[] = $v['format_id'];
		}
		if($v['filter_type'] == "types")
		{
			$search[] = $v['type_id'];
		}
		
	}
	$info['type'] = $type;
	$info['search'] = implode(",",$search);
	
	return $info;
    }
    function getSearchInfoBySearch($search)
    {
    	$usd = $this->session->userdata('logged_user');
    	$info = array();
    	$data['types'] = $this->db->select('work_type_id')->like('work_type_name',$search)->get('work_types')->result_array();
    	$data['format'] = $this->db->select('work_form_id')->like('work_form_name',$search)->get('work_forms')->result_array();
    	$data['genre'] = $this->db->select('id')->like('category_name',$search)->get('categories')->result_array();
    	//echo "<pre>";print_r($data);exit;
    	$info['type'] = "multiple";
    	if(count($data['genre']) > 0 || count($data['types']) > 0 || count($data['format']) > 0)
    	{
    		//$info['type'] = "multiple";
	    	if(count($data['genre']) > 0)
		{
			$sep = "";
			$info['genre'] = "";
			foreach($data['genre'] as $val)
			{
				$info['genre'] .= $sep.$val['id'];
				$sep = ",";
			}
			
		}
		if(count($data['format']) > 0)
		{
			$sep = "";
			$info['format'] = "";
			foreach($data['format'] as $val)
			{
				$info['format'] .= $sep.$val['work_form_id'];
				$sep = ",";
			}
			//$info['format'] = implode(",", $data['format']);
		}
		if(count($data['types']) > 0)
		{
			$sep = "";
			$info['types'] = "";
			foreach($data['types'] as $val)
			{
				$info['types'] .= $sep.$val['work_type_id'];
				$sep = ",";
			}
			//$info['types'] = implode(",", $data['types']);
		}
    	}
    	//print_r($info);exit;
	return $info;
    }
    function getSearchInfo($id)
    {
    	$usd = $this->session->userdata('logged_user');
    	$view  = $this->db->select('format_id,type_id,category_id,filter_type,is_multiple,search_criteria')->where('user_id',$usd['id'])->where('search_id',$id)->where('is_deleted','0')->get('saved_filters')->result_array();
	//print_r($view);exit;
	$info['type'] = "";
	$search = array();
	$subtype = "";
	foreach($view as $v)
	{
		if($v['is_multiple'] == "1")
		{
			$type = "multiple";
			if($v['filter_type'] == "genre")
			{
				$search['genre'][] = $v['category_id'];
			}
			if($v['filter_type'] == "format")
			{
				$search['format'][] = $v['format_id'];
			}
			if($v['filter_type'] == "types")
			{
				$search['types'][] = $v['type_id'];
			}
		}
		else
		{
			if($v['filter_type'] == "global")
			{
				$type = "multiple";
				$subtype = "global";
				$search[0] = $v['search_criteria'];
			}
			else
			{
				$type = $v['filter_type'];
				if($v['filter_type'] == "genre")
				{
					$search[] = $v['category_id'];
				}
				if($v['filter_type'] == "format")
				{
					$search[] = $v['format_id'];
				}
				if($v['filter_type'] == "types")
				{
					$search[] = $v['type_id'];
				}
			}
			
		}
		
	}
	$info['type'] = $type;
	$info['subtype'] = $subtype;
	if($type == "multiple")
	{
		if($subtype == "global")
		{
			$info['search'] = $search[0];
		}
		else
		{
			if(isset($search['genre']))
			{
				$info['search']['genre'] = implode(",",$search['genre']);
			}
			if(isset($search['types']))
			{
				$info['search']['types'] = implode(",",$search['types']);
			}
			if(isset($search['format']))
			{
				$info['search']['format'] = implode(",",$search['format']);
			}
			
			
		}
		
	}
	else
	{
		$info['search'] = implode(",",$search);
	}
	
	return $info;
    } 
    function getSavedSearches($offset=0,$limit=5)
    {
    	$data = array();
    	$usd = $this->session->userdata('logged_user');
    	$data  = $this->db->select('id,saved_search_name,create_date')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit($limit,$offset)->get('saved_searches')->result_array();
    	//print_r($data);exit;
    	foreach($data as $key => $val)
    	{
    		$count = array();
    		$view  = $this->db->select('format_id,type_id,category_id,filter_type,search_criteria,is_multiple')->where('user_id',$usd['id'])->where('search_id',$val['id'])->where('is_deleted','0')->get('saved_filters')->result_array();
    		/*if($val['id'] == "63")
    		{
    			echo "<pre>";print_r($view);echo "</pre>";exit;
    		}*/
    		$count['count'] = 0;
    		$type = "";
    		$search = array();
    		$subtype = "";
    		$searchCriteria="";
    		foreach($view as $v)
    		{
    			if($v['is_multiple'] == "1")
    			{
    				$type = "multiple";
    				if($v['filter_type'] == "genre")
	    			{
	    				$search['genre'][] = $v['category_id'];
	    			}
	    			if($v['filter_type'] == "format")
	    			{
	    				$search['format'][] = $v['format_id'];
	    			}
	    			if($v['filter_type'] == "types")
	    			{
	    				$search['types'][] = $v['type_id'];
	    			}
    			}
    			else
    			{
    				$type = $v['filter_type'];
	    			if($v['filter_type'] == "genre")
	    			{
	    				$search[] = $v['category_id'];
	    			}
	    			if($v['filter_type'] == "format")
	    			{
	    				$search[] = $v['format_id'];
	    			}
	    			if($v['filter_type'] == "types")
	    			{
	    				$search[] = $v['type_id'];
	    			}
	    			
	    			if($v['filter_type'] == "global")
	    			{
	    				$type = "multiple";
	    				$search = array();
	    				$subtype = $v['filter_type'];
	    				$searchCriteria = $v['search_criteria'];
	    				if($searchCriteria != "")
	    				{
	    					$info = $this->getSearchInfoBySearch($searchCriteria);
	    					if(!isset($info['genre']))
						{
							$search['genre'] = array();
				
						}
						else
						{
							$search['genre'] = explode(",",$info['genre']);
						}
						if(!isset($info['types']))
						{
							$search['types'] = array();
						}
						else
						{
							$search['types'] = explode(",",$info['types']);
						}
						if(!isset($info['format']))
						{
							$search['format'] = array();
						}
						else
						{
							$search['format'] = explode(",",$info['format']);
						}
						
	    				}
	    			}
    			}
    			
    		}
    		
    		
    		if(count($search) > 0 || $subtype == "global")
    		{
    			
    			$count['count'] = $this->getCountWorksWithSearch($type,$search,$subtype,$searchCriteria);
    		}
    		/*if($val['id'] == "67")
    		{
    			echo "sfkshdfksdf";
    			echo $count['count'];
    			print_r($search);exit;
    		}*/
    		$data[$key]['titles_returned'] = $count['count'];
    	}
    	
    	return $data;
    } 
    function getCountSavedSearches()
    {
    	$data = array();
    	$usd = $this->session->userdata('logged_user');
    	$data = $this->db->select('COUNT(*) AS count')->where('user_id',$usd['id'])->get('saved_searches')->row_array();
    	return $data['count'];
    }
    function get_books($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->limit($limit,$offset)->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name_first'] = '';   
                }
                if(!empty($row['name_middle']))
                {
                $data[$each]['name_middle'] = $row['name_middle'];
                }
                else
                {
                 $data[$each]['name_middle'] = '';   
                }
                if(!empty($row['name_last']))
                {
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name_last'] = '';   
                }
                if(!empty($row['user_guid']))
                {
                $data[$each]['user_guid'] = $row['user_guid'];
                }
                else
                {
                 $data[$each]['user_guid'] = '';   
                }
                
                
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    function getCountWorksWithSearch($type="",$search=array(),$subtype="",$searchCriteria="")
    {
    	 $data   = array();
       $usd = $this->session->userdata('logged_user');
    	if($type == "format")
    	{
    		$rs=$this->db->select('COUNT(*) AS count')->where_in('work_form_id', $search)->order_by('create_date','desc')->get('works');
        	$data   = $rs->result_array();
    	}
    	else if($type == "types")
    	{
    		//print_r($search);
    		$rs=$this->db->select('COUNT(*) AS count')->where_in('work_type_id', $search)->order_by('create_date','desc')->get('works');
        	$data   = $rs->result_array();
    	}
    	else if($type == "genre")
    	{
    		$rs=$this->db->select('COUNT(DISTINCT(w.id)) AS count')->from('works w')->join('work_categories as wc','w.id = wc.Wid','inner')->join('categories as c','c.id = wc.cid','inner')->where_in('cid', $search)->order_by('w.create_date','desc')->get();
    		$data   = $rs->result_array();
    	}
    	else if($type == "multiple")
    	{
    		//print_r($search);echo $subtype." ".$searchCriteria;exit;
    		   
    		    $this->db->query("SET SQL_BIG_SELECTS=1");
    		    if($subtype == "global")
    		    {
    		    	$tags  = $this->db->select('tag_name,id')->from('tags')->like('tag_name',$searchCriteria)->get()->result_array();
    		    	$work_tags = array();
    		    	foreach($tags as $val)
    		    	{
    		    		$work_tags[] = $val['id'];
    		    	}
    		    	
    		    	$this->db->select('COUNT(DISTINCT(w.id)) AS count');
    		    	$this->db->from('works w');
    		    	
    		    	$this->db->join('users as u','u.id = w.user_id','inner');
    		    	$this->db->join('work_categories as wc','w.id = wc.Wid','left');
    		   	$this->db->join('categories as c','c.id = wc.cid','left');  
    		   	/*if($searchCriteria == "novel")
    		   	{
    		   		$this->db->join('work_tagss as wt','wt.Wid = wc.id','left'); 
    		   	} 
    		   	else
    		   	{
    		   		$this->db->join('work_tags as wt','wt.Wid = wc.id','left'); 
    		   	}*/
    		   	$this->db->join('work_tags as wt','wt.Wid = wc.id','left'); 		   	
    		   	//$this->db->like('w.title', $searchCriteria);
    		   	//$this->db->or_like("concat_ws(name_first,' ',name_middle,' ',name_last)", $searchCriteria);
    		    	
	    		
    		    	/*if(count($search['types']) > 0)
	    		{
	    		    	$this->db->or_where_in('w.work_type_id', $search['types']);
	    		}
	    		if(count($search['format']) > 0)
	    		{
	    		    	$this->db->or_where_in('w.work_form_id', $search['format']);
	    		}
	    		if(count($search['genre']) > 0)
	    		{	    		    	   	
	    		    	$this->db->or_where_in('cid', $search['genre']);
	    		}*/
	    		//$this->db->or_like('w.titleS', $searchCriteria);
    		    	//$this->db->or_like("concat_ws(name_first,' ',name_middle,' ',name_last)", $searchCriteria);
	    		$sql = '';
	    		$sql = " w.title LIKE '%$searchCriteria%' ";
	    		$sql .= " OR concat_ws(name_first,' ',name_middle,' ',name_last) LIKE '%$searchCriteria%'";
	    		$sql .= " OR w.synopsis LIKE '%$searchCriteria%'";
	    		$sql .= " OR w.extract LIKE '%$searchCriteria%'";
	    		
    		    	if(count($search['types']) > 0)
	    		{
	    			$t = implode(",",$search['types'])  ;	
	    		    	$sql = ' OR w.work_type_id IN ('.$t.') ';
	    		}
	    		if(count($search['format']) > 0)
	    		{
	    			$f = implode(",",$search['format'])  ;	
	    			$sql .= ' OR w.work_form_id IN ('.$f.') ';
	    		    	//$this->db->or_where('w.work_form_id IN ('.$f.')');
	    		}
	    		if(count($search['genre']) > 0)
	    		{	    		    	 
	    			$g = implode(",",$search['genre'])  ;	
	    			$sql .= ' OR c.id IN ('.$g.')';
	    		    	//$this->db->or_where('c.id IN ('.$g.')');
	    		}
	    		if(count($work_tags) > 0)
	    		{
	    			$tgs = implode(",",$work_tags)  ;	
	    			$sql .= ' OR wt.tid IN ('.$tgs.')';
	    		}
	    		$this->db->where($sql,NULL,false);
	    		    
    		    }
    		    else
    		    {
    		    	//print_r($search);echo $subtype." ".$searchCriteria;exit;
    		    	$this->db->select('COUNT(DISTINCT(w.id)) AS count');
    		    	$this->db->from('works w');
    		    	$this->db->join('work_categories as wc','w.id = wc.Wid','left');
    		   	$this->db->join('categories as c','c.id = wc.cid','left');
    		    	 if(isset($search['types']) && count($search['types']) > 0)
	    		    {
	    		    	$this->db->where_in('w.work_type_id', $search['types']);
	    		    }
	    		    if(isset($search['format']) && count($search['format']) > 0)
	    		    {
	    		    	
	    		    	$this->db->where_in('w.work_form_id', $search['format']);
	    		    }
	    		    if(isset($search['genre']) && count($search['genre']) > 0)
	    		    {
	    		    	$this->db->where_in('cid', $search['genre']);
	    		    }
    		    }
	    		   
    		  //  $this->db->group_by('w.id');
    		 $rs =   $this->db->order_by('w.create_date','desc')->get();
    		 $this->db->query("SET SQL_BIG_SELECTS=0");
    		$data   = $rs->result_array();
    		//print_r($data);exit;
    	}
        else
        {
        	$rs=$this->db->select('COUNT(*) AS count')->order_by('create_date','desc')->get('works');
       	 	$data   = $rs->result_array();
        }
        //print_r($data);exit;
        
        return $data[0]['count']; 
	
    }
    function saveTheFilters($type = "",$search=array(),$search_name="")
    {
    	//print_r($search);exit;
    	$usd = $this->session->userdata('logged_user');
    	 $data['user_id'] = $usd['id'];
        //$data['search_form_id'] = $id;
        $data['saved_search_name'] = $search_name;
        
        $data['create_date']    = date("Y-m-d h:i:s");
        $data['modified_date']    = date("Y-m-d h:i:s");
        
        $this->db->insert('saved_searches', $data);
    	$insert_id=$this->db->insert_id();
    	if($type == "format")
    	{
    		foreach($search as $val)
    		{
    			//$data = $this->db->select('COUNT(*) AS count')->where('format_id',$val)->get('saved_filters')->result_array();
    			$insert = array();
    			//if($data[0]['count'] <= 0)
    			//{
    				$insert['type_id'] = '0';
    				$insert['category_id'] = '0';
    				$insert['format_id'] = $val;
    				$insert['user_id'] = $usd['id'];
    				$insert['filter_type'] = $type;
    				$insert['search_id'] = $insert_id;
    				$insert['is_deleted'] = '0';
    				$this->db->insert('saved_filters', $insert);
    			//}
    		}
    		
    	}
    	if($type == "types")
    	{
    		foreach($search as $val)
    		{
    			//$data = $this->db->select('COUNT(*) AS count')->where('type_id',$val)->get('saved_filters')->result_array();
    			$insert = array();
    			//if($data[0]['count'] <= 0)
    			//{
    				$insert['type_id'] = $val;
    				$insert['category_id'] = '0';
    				$insert['format_id'] = '0';
    				$insert['user_id'] = $usd['id'];
    				$insert['filter_type'] = $type;
    				$insert['search_id'] = $insert_id;
    				$insert['is_deleted'] = '0';
    				$this->db->insert('saved_filters', $insert);
    			//}
    		}
    		
    	}
    	if($type == "genre")
    	{
    		foreach($search as $val)
    		{
    			//$data = $this->db->select('COUNT(*) AS count')->where('category_id',$val)->get('saved_filters')->result_array();
    			$insert = array();
    			//if($data[0]['count'] <= 0)
    			//{
    				$insert['type_id'] = '0';
    				$insert['category_id'] = $val;
    				$insert['format_id'] = '0';
    				$insert['user_id'] = $usd['id'];
    				$insert['filter_type'] = $type;
    				$insert['search_id'] = $insert_id;
    				$insert['is_deleted'] = '0';
    				$this->db->insert('saved_filters', $insert);
    			//}
    		}
    		
    	}
    	if($type == "multiple")
    	{
    		if(count($search['genre']) > 0)
    		{
	    		foreach($search['genre'] as $val)
	    		{
	    			//$data = $this->db->select('COUNT(*) AS count')->where('category_id',$val)->get('saved_filters')->result_array();
	    			$insert = array();
	    			//if($data[0]['count'] <= 0)
	    			//{
	    				$insert['type_id'] = '0';
	    				$insert['category_id'] = $val;
	    				$insert['format_id'] = '0';
	    				$insert['user_id'] = $usd['id'];
	    				$insert['filter_type'] = "genre";
	    				$insert['search_id'] = $insert_id;
	    				$insert['is_deleted'] = '0';
	    				$insert['is_multiple'] = '1';
	    				$this->db->insert('saved_filters', $insert);
	    			//}
	    		}
    		}
    		if(count($search['types']) > 0)
    		{
	    		foreach($search['types'] as $val)
	    		{
	    			//$data = $this->db->select('COUNT(*) AS count')->where('type_id',$val)->get('saved_filters')->result_array();
	    			$insert = array();
	    			//if($data[0]['count'] <= 0)
	    			//{
	    				$insert['type_id'] = $val;
	    				$insert['category_id'] = '0';
	    				$insert['format_id'] = '0';
	    				$insert['user_id'] = $usd['id'];
	    				$insert['filter_type'] = "types";
	    				$insert['search_id'] = $insert_id;
	    				$insert['is_deleted'] = '0';
	    				$insert['is_multiple'] = '1';
	    				$this->db->insert('saved_filters', $insert);
	    			//}
	    		}
    		}
    		if(count($search['format']) > 0)
    		{
	    		foreach($search['format'] as $val)
	    		{
	    			//$data = $this->db->select('COUNT(*) AS count')->where('type_id',$val)->get('saved_filters')->result_array();
	    			$insert = array();
	    			//if($data[0]['count'] <= 0)
	    			//{
	    				$insert['type_id'] = 0;
	    				$insert['category_id'] = '0';
	    				$insert['format_id'] = $val;
	    				$insert['user_id'] = $usd['id'];
	    				$insert['filter_type'] = "format";
	    				$insert['search_id'] = $insert_id;
	    				$insert['is_deleted'] = '0';
	    				$insert['is_multiple'] = '1';
	    				$this->db->insert('saved_filters', $insert);
	    			//}
	    		}
    		}
    	}
    	if($type == "global")
    	{
    		$insert['type_id'] = '0';
		$insert['category_id'] = 0;
		$insert['format_id'] = '0';
		$insert['search_criteria'] = $search[0];
		$insert['user_id'] = $usd['id'];
		$insert['filter_type'] = $type;
		$insert['search_id'] = $insert_id;
		$insert['is_deleted'] = '0';
		$this->db->insert('saved_filters', $insert);
    	}
    }
    function publisher_viewed_searches($type,$arr,$subtype="")
    {
        if($type == "format")
        {
            //to be inserted into the viewed_filters table
        }
        if($type == "genre")
        {
            //to be inserted into the viewed_filters table
        }
        if($type == "types")
        {
            //to be inserted into the viewed_filters table
        }
        if($type == "multiple" && $subtype == "") //format,types,genre $arr = array(0 => array(id => 1,type=> format),)
        {
            //to be inserted into the viewed_filters table
        }
    }
    function author_viewed_searches($arr=array())
    {
        //echo '<pre/>';print_r($arr);die;
        //insert into the viewed searches table
        $usd = $this->session->userdata('logged_user');
        $data = array();
        if(count($arr) > 0)
        {
            foreach($arr as $view_author)
            {
               $rs  = $this->db->select('count(*) as count')->where('user_id', $usd['id'])->where('wid', $view_author['id'])->get('view_search')->row_array(); 
                if($rs['count'] == '0')
                {
                   $data['user_id'] = $usd['id'];
                   $data['wid'] = $view_author['id'];
                   $data['wuid'] = $view_author['user_id'];
                   $data['created_date'] = date("Y-m-d h:i:s");                   
                   $this->db->insert('view_search',$data ); 
                }
            }    
        }
        
    }
    function getSelectFilterInfo($type,$data)
    {
    	$values = array();
    	//print_r($data);
    	if($type == "format")
    	{
    		$values = $this->db->select('work_form_id,work_form_name,\'format\' as `type`',false)->where_in('work_form_id', $data)->get('work_forms')->result_array();
    	}
    	if($type == "types")
    	{
    		$values = $this->db->select('work_type_id,work_type_name,\'types\' as `type`',false)->where_in('work_type_id', $data)->get('work_types')->result_array();
    	}
    	if($type == "genre")
    	{
    		$values = $this->db->select('id,category_name,\'genre\' as `type`',false)->where_in('id', $data)->get('categories')->result_array();
    	}
    	if($type == "multiple")
    	{
    		if(isset($data['format']) && count($data['format']) > 0)
    		{
    			$format = $this->db->select('work_form_id,work_form_name,\'format\' as `subtype`,\'multiple\' as `type`',false)->where_in('work_form_id', $data['format'])->get('work_forms')->result_array();
    			foreach($format as $val)
    			{
    				$values[] = $val;
    			}
    		}
    		if(isset($data['types']) && count($data['types']) > 0)
    		{
    			$types = $this->db->select('work_type_id,work_type_name,\'types\' as `subtype`,\'multiple\' as `type`',false)->where_in('work_type_id', $data['types'])->get('work_types')->result_array();
    			foreach($types as $val)
    			{
    				$values[] = $val;
    			}
    		}
    		if(isset($data['genre']) && count($data['genre']) > 0)
    		{
    			$genre = $this->db->select('id,category_name,\'genre\' as `subtype`,\'multiple\' as `type`',false)->where_in('id', $data['genre'])->get('categories')->result_array();
    			foreach($genre as $val)
    			{
    				$values[] = $val;
    			}
    		}
    		
    	}
    	if($type == "global")
    	{
    		$values[0] = array('type' => 'global', 'value' => $data);
    	}
    	//print_r($values);exit;
    	return $values;
    }
   function get_books_with_search($offset=null,$limit=null,$type="",$search = array(),$subtype="",$searchCriteria=""){
         $data=array();
         
         $usd = $this->session->userdata('logged_user');
         if($type == "format")
    	{
    		$rs  = $this->db->select('*')->where_in('work_form_id', $search)->order_by('create_date','desc')->limit($limit,$offset)->get('works');
    		
    	}
    	else if($type == "types")
    	{
    		
    		$rs  = $this->db->select('*')->where_in('work_type_id', $search)->order_by('create_date','desc')->limit($limit,$offset)->get('works');
        	
    	}
    	else if($type == "genre")
    	{
    		$rs=$this->db->select('w.*,c.category_name')->from('works w')->join('work_categories as wc','w.id = wc.Wid','inner')->join('categories as c','c.id = wc.cid','inner')->where_in('cid', $search)->group_by('w.id')->order_by('w.create_date','desc')->limit($limit,$offset)->get();
    	}
    	else if($type == "multiple")
    	{
    		    $this->db->query("SET SQL_BIG_SELECTS=1");
    		    //$this->db->join('work_categories as wc','w.id = wc.Wid','inner');
    		    //$this->db->join('categories as c','c.id = wc.cid','inner');
    		    if($subtype == "global")
    		    {
    		    	
    		    	$tags  = $this->db->select('tag_name,id')->from('tags')->like('tag_name',$searchCriteria)->get()->result_array();
    		    	$work_tags = array();
    		    	foreach($tags as $val)
    		    	{
    		    		$work_tags[] = $val['id'];
    		    	}
    		    	
    		    	$this->db->select('w.*,c.category_name');
    		    	$this->db->from('works w');
    		    	$this->db->join('users as u','u.id = w.user_id','inner');
    		    	$this->db->join('work_categories as wc','w.id = wc.Wid','left');
    		   	$this->db->join('categories as c','c.id = wc.cid','left');  
    		   	$this->db->join('work_tags as wt','wt.Wid = wc.id','left');
    		   	   		   	
    		   	//$this->db->or_like('w.titleS', $searchCriteria);
    		    	//$this->db->or_like("concat_ws(name_first,' ',name_middle,' ',name_last)", $searchCriteria);
	    		$sql = '';
	    		$sql = " w.title LIKE '%$searchCriteria%' ";
	    		$sql .= " OR concat_ws(u.name_first,' ',u.name_middle,' ',u.name_last) LIKE '%$searchCriteria%'";
	    		$sql .= " OR w.synopsis LIKE '%$searchCriteria%'";
	    		$sql .= " OR w.extract LIKE '%$searchCriteria%'";
	    		
    		    	if(count($search['types']) > 0)
	    		{
	    			$t = implode(",",$search['types'])  ;	
	    		    	$sql = ' OR w.work_type_id IN ('.$t.') ';
	    		}
	    		if(count($search['format']) > 0)
	    		{
	    			$f = implode(",",$search['format'])  ;	
	    			$sql .= ' OR w.work_form_id IN ('.$f.') ';
	    		    	//$this->db->or_where('w.work_form_id IN ('.$f.')');
	    		}
	    		if(count($search['genre']) > 0)
	    		{	    		    	 
	    			$g = implode(",",$search['genre'])  ;	
	    			$sql .= ' OR c.id IN ('.$g.')';
	    		    	//$this->db->or_where('c.id IN ('.$g.')');
	    		}
	    		if(count($work_tags) > 0)
	    		{
	    			$tgs = implode(",",$work_tags)  ;	
	    			$sql .= ' OR wt.tid IN ('.$tgs.')';
	    		}
	    		$this->db->where($sql,NULL,false);
    		   	
	    		    
    		    }
    		    else
    		    {
    		    	$this->db->select('w.*,c.category_name');
    		    	$this->db->from('works w');
    		    	$this->db->join('work_categories as wc','w.id = wc.Wid','left');
    		   	$this->db->join('categories as c','c.id = wc.cid','left');
    		    	 if(count($search['types']) > 0)
	    		    {
	    		    	$this->db->where_in('w.work_type_id', $search['types']);
	    		    }
	    		    if(count($search['format']) > 0)
	    		    {
	    		    	
	    		    	$this->db->where_in('w.work_form_id', $search['format']);
	    		    }
	    		    if(count($search['genre']) > 0)
	    		    {
	    		    	$this->db->where_in('cid', $search['genre']);
	    		    }
    		    }
    		    /*if($subtype == "global")
    		    {
    		    	    if(count($search['types']) > 0)
	    		    {
	    		    	$this->db->where_in('w.work_type_id', $search['types']);
	    		    }
	    		    if(count($search['format']) > 0)
	    		    {
	    		    	$this->db->or_where_in('w.work_form_id', $search['format']);
	    		    }
	    		    if(count($search['genre']) > 0)
	    		    {
	    		    	$this->db->or_where_in('cid', $search['genre']);
	    		    }
    		    }
    		    else
    		    {
    		    	if(count($search['types']) > 0)
	    		    {
	    		    	$this->db->where_in('w.work_type_id', $search['types']);
	    		    }
	    		    if(count($search['format']) > 0)
	    		    {
	    		    	$this->db->where_in('w.work_form_id', $search['format']);
	    		    }
	    		    if(count($search['genre']) > 0)
	    		    {
	    		    	$this->db->where_in('cid', $search['genre']);
	    		    }
    		    }*/
    		    
    		    $this->db->group_by('w.id');
    		    $this->db->order_by('w.create_date','desc');
    	      $rs = $this->db->limit($limit,$offset)->get();
    	      $this->db->query("SET SQL_BIG_SELECTS=0");
    	}
    	else
    	{
    		$rs  = $this->db->select('*')->order_by('create_date','desc')->limit($limit,$offset)->get('works');
    	}
         
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0 && ($type == "format" || $type == "types" || $type == "")){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name_first'] = '';   
                }
                if(!empty($row['name_middle']))
                {
                $data[$each]['name_middle'] = $row['name_middle'];
                }
                else
                {
                 $data[$each]['name_middle'] = '';   
                }
                if(!empty($row['name_last']))
                {
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name_last'] = '';   
                }
                if(!empty($row['user_guid']))
                {
                $data[$each]['user_guid'] = $row['user_guid'];
                }
                else
                {
                 $data[$each]['user_guid'] = '';   
                }
                
                
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                $row22=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row22['work_type_name']))
                {
                $data[$each]['type_name'] = $row22['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
                $row44=$this->db->select('c.category_name')->where('wc.Wid',$value['id'])->from('work_categories as wc')->join('categories as c','c.id = wc.cid','inner')->get()->row_array();
                if(!empty($row44['category_name']))
                {
                $data[$each]['category_name'] = $row44['category_name'];
                }
                else
                {
                 $data[$each]['category_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
            
        }  
        if($rs->num_rows() > 0 && ($type == "genre" || $type == "multiple")){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name_first'] = '';   
                }
                if(!empty($row['name_middle']))
                {
                $data[$each]['name_middle'] = $row['name_middle'];
                }
                else
                {
                 $data[$each]['name_middle'] = '';   
                }
                if(!empty($row['name_last']))
                {
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name_last'] = '';   
                }
                if(!empty($row['user_guid']))
                {
                $data[$each]['user_guid'] = $row['user_guid'];
                }
                else
                {
                 $data[$each]['user_guid'] = '';   
                }
                
                
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                $row22=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row22['work_type_name']))
                {
                $data[$each]['type_name'] = $row22['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
                
                if($value['category_name'] == null)
                {
                	$data[$each]['category_name'] = '';  
                }
                
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
               
            }
        }      
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
  
  function get_saved_search(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('id,user_id,search_form_id,saved_search_name,create_date')->where('user_id',$usd['id'])->get('saved_searches');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('work_form_id',$value['search_form_id'])->get('work_forms')->row_array();
                
                if(!empty($row['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row['work_form_name'];
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }  
    function deleteSavedSearches($id)
    {
    	
    	$this->db->where('id',$id)->delete('saved_searches');
    	$data['is_deleted'] = "1";
    	$this->db->where('search_id',$id)->update("saved_filters",$data);
    	
    }
    	
  function delete_saved_search($id,$offset=0,$limit=15)
    {
        //$offset = 0;
        //$limit = 2;
        $this->db->where('id',$id)->delete('saved_searches');
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        
        $rs  = $this->db->select('id,user_id,search_form_id,saved_search_name,create_date')->where('user_id',$usd['id'])->get('saved_searches');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('work_form_id',$value['search_form_id'])->get('work_forms')->row_array();
                
                if(!empty($row['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row['work_form_name'];
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }
       
            
        $rs->free_result();
          
        return $data;

    } 
    
   function get_books_format($offset=null,$limit=null,$fid){
         $data=array();
         $sms_data = array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('work_form_id',$fid)->limit($limit,$offset)->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            $i = $offset+1;
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                $data[$each]['i'] = $i;
                //$data[$each]['type']    = 'PROPERTY';
                
                $rs_44  = $this->db->select('*')->where('user_id',$usd['id'])->where('wid',$value['id'])->get('view_search');
                if($rs_44->num_rows() == 0){
                    $sms_data[$each] = array(
                    'user_id' => $usd['id'],
                    'wid' => $value['id'],
                    'wuid' => $value['user_id'],
                    );
                }
                
                $i++;
            }
            
            $rs_44  = $this->db->select('*')->where('user_id',$usd['id'])->where('wid',$value['id'])->get('view_search');
            if($rs_44->num_rows() == 0){
            $this->db->insert_batch('view_search', $sms_data);
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
   function get_books_refine($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('work_form_id',$this->uri->segment(3))->limit($limit,$offset)->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
    function get_books_type($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('work_type_id',$this->uri->segment(3))->limit($limit,$offset)->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
   function writers($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_type','1')->where('status_id','1')->limit($limit,$offset)->get('users');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('user_id',$value['id'])->get('profile_writer')->row_array();
                //echo $this->db->last_query();die;
                if(!empty($row['biography']))
                    {
                    $data[$each]['bio'] = $row['biography'];
                    }
                else
                    {
                     $data[$each]['bio'] = '';   
                    }
                if(!empty($row['traditionally_published']))
                    {
                    $data[$each]['trd'] = $row['traditionally_published'];
                    }
                else
                    {
                     $data[$each]['trd'] = '';   
                    }
                if(!empty($row['self_published']))
                    {
                    $data[$each]['self'] = $row['self_published'];
                    }
                else
                    {
                     $data[$each]['self'] = '';   
                    }
                if(!empty($row['literary_awards']))
                    {
                    $data[$each]['award'] = $row['literary_awards'];
                    }
                else
                    {
                     $data[$each]['award'] = '';   
                    }
                if(!empty($row['work_been_reviewed']))
                    {
                    $data[$each]['rvw'] = $row['work_been_reviewed'];
                    }
                else
                    {
                     $data[$each]['rvw'] = '';   
                    } 
                if(!empty($row['published_abroad']))
                    {
                    $data[$each]['abroad'] = $row['published_abroad'];
                    }
                else
                    {
                     $data[$each]['abroad'] = '';   
                    }
                if(!empty($row['mfa_program']))
                    {
                    $data[$each]['mfa'] = $row['mfa_program'];
                    }
                else
                    {
                     $data[$each]['mfa'] = '';   
                    }
                    
             $row22=$this->db->where('user_id',$value['id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }                      
                
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
   function writers_letter($offset=null,$limit=null,$like=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_type','1')->where('status_id','1')->like('name_first',$like)->or_like('name_middle',$like)->or_like('name_last',$like)->limit($limit,$offset)->get('users');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('user_id',$value['id'])->get('profile_writer')->row_array();
                //echo $this->db->last_query();die;
                if(!empty($row['biography']))
                    {
                    $data[$each]['bio'] = $row['biography'];
                    }
                else
                    {
                     $data[$each]['bio'] = '';   
                    }
                if(!empty($row['traditionally_published']))
                    {
                    $data[$each]['trd'] = $row['traditionally_published'];
                    }
                else
                    {
                     $data[$each]['trd'] = '';   
                    }
                if(!empty($row['self_published']))
                    {
                    $data[$each]['self'] = $row['self_published'];
                    }
                else
                    {
                     $data[$each]['self'] = '';   
                    }
                if(!empty($row['literary_awards']))
                    {
                    $data[$each]['award'] = $row['literary_awards'];
                    }
                else
                    {
                     $data[$each]['award'] = '';   
                    }
                if(!empty($row['work_been_reviewed']))
                    {
                    $data[$each]['rvw'] = $row['work_been_reviewed'];
                    }
                else
                    {
                     $data[$each]['rvw'] = '';   
                    } 
                if(!empty($row['published_abroad']))
                    {
                    $data[$each]['abroad'] = $row['published_abroad'];
                    }
                else
                    {
                     $data[$each]['abroad'] = '';   
                    }
                if(!empty($row['mfa_program']))
                    {
                    $data[$each]['mfa'] = $row['mfa_program'];
                    }
                else
                    {
                     $data[$each]['mfa'] = '';   
                    }
                    
             $row22=$this->db->where('user_id',$value['id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }                      
                
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
    function writers_category($offset=null,$limit=null,$type=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
        // $rs  = $this->db->select('*')->where('user_type','1')->limit($limit,$offset)->get('users');
         $rs  = $this->db->select('*')->where($type,'1')->limit($limit,$offset)->get('profile_writer');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                //echo $this->db->last_query();die;
                if(!empty($row['name_first']))
                    {
                    $data[$each]['name_first'] = $row['name_first'];
                    }
                else
                    {
                     $data[$each]['name_first'] = '';   
                    }
                if(!empty($row['name_middle']))
                    {
                    $data[$each]['name_middle'] = $row['name_middle'];
                    }
                else
                    {
                     $data[$each]['name_middle'] = '';   
                    }
                if(!empty($row['name_last']))
                    {
                    $data[$each]['name_last'] = $row['name_last'];
                    }
                else
                    {
                     $data[$each]['name_last'] = '';   
                    }
                
               
                    
             $row22=$this->db->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }                      
                
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
   function writers_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('user_type','1')->where('status_id','1')->get('users')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
       
        return $data;               
    
    }   
    
  function get_writer_work($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('user_id',$id)->get('works')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    }
    
  function get_tradition(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('traditionally_published','1')->get('profile_writer')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    } 
  function get_self_pub(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('self_published','1')->get('profile_writer')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    }
  function get_award(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('literary_awards','1')->get('profile_writer')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    } 
  function get_review(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('work_been_reviewed','1')->get('profile_writer')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    } 
    
  function get_mfa(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('mfa_program','1')->get('profile_writer')->result_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    }          
    
    function single_form($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('*')->where('work_form_id',$id)->get('work_forms')->row_array();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        
        return $data;               
    
    } 
    
    function getCountWorks()
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('COUNT(*) AS count')->order_by('create_date','desc')->get('works');
        $data   = $rs->result_array();
        
        return $data[0]['count']; 
	
    }
    
   function allFiction()
        {
            $total = 0;
            $data = array();
            $rs = $this->db->where('work_type_id', '1')->get('works');
            //echo $this->db->last_query();die;
            if ($rs->num_rows() > 0) {
                //$data   = $rs->row_array();
                $total = $rs->num_rows();
            }
            $rs->free_result();
            return $total;
        }
        
   function allNonFiction()
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('work_type_id', '2')->get('works');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            //$data   = $rs->row_array();
            $total = $rs->num_rows();
        }
        $rs->free_result();
        return $total;
    }
    
    function allFormByFiction( $f_id )
    {
        $total = 0;
        $data = array();
        $rs = $this->db->where('work_type_id', $f_id)->get('work_forms');
        //echo $this->db->last_query();die;
        if ($rs->num_rows() > 0) {
            $data   = $rs->result_array();
             foreach ($data as $each => $value) {
                $row = $this->db->where('work_form_id', $value['work_form_id'])->where('work_type_id', $f_id)->get('works')->result_array();
                $data[$each]['work_form_count'] = count($row);
               // echo $this->db->last_query();die;
        }
            //$total = $rs->num_rows();
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }        
  function getAllFormat()
    {
        
        $data = array();
        $data = $this->db->get('work_forms')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    } 
    function getActiveFormat()
    {
        
        $data = array();
        $data = $this->db->where('is_show','1')->order_by('work_form_name')->get('work_forms')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    } 
    function getAllTypes(  )
    {
       
        $data = array();
        $data = $this->db->get('work_types')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }  
   
    function getAllCategories( )
    {
       
        $data = array();
        $data = $this->db->get('categories')->result_array();
        //$data = $this->db->limit($limit)->get('categories')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }  
    function getActiveCategories( )
    {
       
        $data = array();
        $data = $this->db->where('is_show','1')->order_by('category_name')->get('categories')->result_array();
        //$data = $this->db->limit($limit)->get('categories')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    } 
    
    function getSavedFilters( )
    {
       
        $data = array();
        //$this->db->_protect_identifiers = FALSE;
        $usd = $this->session->userdata('logged_user');
        $data['types'] = $this->db->select("distinct(s.type_id) as type_id, s.format_id, s.category_id, wt.work_type_name,s.filter_type")->from('saved_filters s')->join('work_types as wt','s.type_id = wt.work_type_id','left')->where('user_id',$usd['id'])->where('s.filter_type','types')->where('s.is_deleted','0')->get()->result_array();
        
         $data['format'] = $this->db->select("distinct(s.format_id) as format_id, s.type_id, s.category_id, wf.work_form_name,s.filter_type")->from('saved_filters s')->join('work_forms as wf','s.format_id = wf.work_form_id','left')->where('user_id',$usd['id'])->where('s.filter_type','format')->where('s.is_deleted','0')->get()->result_array();
         
          $data['genre'] = $this->db->select("distinct(s.category_id) as category_id, s.type_id, s.format_id, c.category_name,s.filter_type")->from('saved_filters s')->join('categories as c','s.category_id = c.id','left')->where('user_id',$usd['id'])->where('s.filter_type','genre')->where('s.is_deleted','0')->get()->result_array();
        //->order_by("FIND_IN_SET('filter_type','types,format,genre')","",false)->get()->result_array();
        //$this->db->_protect_identifiers = TRUE;
        /*$output = array();
        foreach($data as $val)
        {
        	if(!in_array(,$output[$val['filter_type']]))
        	$output[$val['filter_type']][] = $val;
        }*/
        //$data = $this->db->limit($limit)->get('categories')->result_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }  
  function get_book_list($bid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->where('bid',$bid)->get('bookshelf_works');
         $rs  = $this->db->select('s.id as wcid,s.Wid,s.bid,a.*')->from('bookshelf_works as s')->join('works as a','s.Wid = a.id','inner')->where('s.bid', $bid)->get();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                //$row1=$this->db->select('*')->where('id',$value['Wid'])->get('works')->row_array();
               
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
   function delete_bookshelf_new($id)
    {
        $this->db->where('id',$id)->delete('bookshelfs');
        $this->db->where('bid',$id)->delete('bookshelf_works');
    }
    
   function delete_save_title($id,$wcid)
    {
        $bcount = $this->db->select('count(*) as count')->where('id',$id)->where('is_status','0')->get('bookshelfs')->row_array();
        
        if($bcount['count'] > 0)
        {
           $this->db->where('bid',$id)->where('id',$wcid)->delete('bookshelf_works'); 
           $saved_title_bookshelf = $this->mwork->saveTitleWorkForBookshelf();
           
           ?>
           <div class="demo">
           <div id="owl-demo2" class="owl-carousel">
          <?php 
            if(!empty($saved_title_bookshelf))
                {
                    foreach($saved_title_bookshelf as $key=>$total_work_saved)
                    {
                ?>
                <div class="item" id="book<?php echo $total_work_saved['wcid'];?>">
                <h4><?php if(strlen($total_work_saved['title']) > 18) { ?><?=substr($total_work_saved['title'],0,18)?>... <?php }else{ ?><?=$total_work_saved['title']?><?php } ?></h4>
                <div class="item_left_section">
                <?php if($total_work_saved['photo'] != '') {?>
                <img src="<?=base_url()?>uploadImage/<?=$total_work_saved['user_id']?>/cover_image/medium/<?=$total_work_saved['photo']?>"/>
                <?php } else { ?>
                <img src="<?=base_url()?>images/img_default_cover.png"/>
                <?php } ?>
                </div>
                <div class="item_right_section">
                <p>
                Author: <?=$total_work_saved['name']?><br>
                Format: <?=$total_work_saved['type_name']?><br>
                Genre: <?=$total_work_saved['form_name']?></p>
                <a href="javascript:;" class="blue_but view_open" onclick="openDialog(<?php echo $total_work_saved['Wid'];?>)">VIEW</a><a href="javascript:void(0);" class="green_bg" onclick="del_savetitle(<?php echo $total_work_saved['bid'];?>,<?php echo $total_work_saved['wcid'];?>)">DELETE</a>
                
                </div>
                </div>
                <?php } } else {?>
                
                <span>No result found</span> 
                   
                   
                 <?php } ?>
                
                </div> 
               </div>  
         <?php  
        }
        
        
    }
    
    function search_book_title($val)
    {
        $workdetails_total  = $this->mbookshelf->allWorkForBookshelf($val);
        
        if(count($workdetails_total) > 0)
        {
           
           
           ?>
           
           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new orange1234" id="table_bookshelf">
              <thead>
                <tr>
                  <th align="center" width="70%" colspan="3"><?php //echo $details['name'];?>Search Title</th>
                  <th align="center" width="30%" colspan="2" id="delete_bookshelf"  onclick="del2(<?php //echo $details['id'];?>)" style="cursor:pointer;"></th>
                </tr>
              </thead>
              <tbody id="detail_view">
              	
                <tr class="hov_no">
                  <td width="100%" colspan="5">
                  
                <div class="demo">
                <div id="owl-demo33" class="owl-carousel">
                <?php foreach($workdetails_total as $key=>$total_work)
                {
                ?>
                <div class="item" id="book<?php echo $total_work['wcid'];?>">
                <h4><?php if(strlen($total_work['title']) > 18) { ?><?=substr($total_work['title'],0,18)?>... <?php }else{ ?><?=$total_work['title']?><?php } ?></h4>
                <div class="item_left_section">
                <?php if($total_work['photo'] != '') {?>
                <img src="<?=base_url()?>uploadImage/<?=$total_work['user_id']?>/cover_image/medium/<?=$total_work['photo']?>"/>
                <?php } else { ?>
                <img src="<?=base_url()?>images/img_default_cover.png"/>
                <?php } ?>
                </div>
                <div class="item_right_section">
                <p>
                Author: <?=$total_work['name']?><br>
                Format: <?=$total_work['type_name']?><br>
                Genre: <?=$total_work['form_name']?></p>
                <a href="javascript:;" class="blue_but view_open" onclick="openDialog(<?php echo $total_work['Wid'];?>)">VIEW</a><a href="#" class="green_bg" onclick="delete_bookshelf_book(<?php echo $total_work['Wid'];?>)">DELETE</a>
                
                </div>
                </div>
                <?php } ?>
                
                </div>
                </div>
                  
                  
                  </td>
                </tr>
                
              </tbody>
            </table>
           
             
         <?php  
        }
        else
        {
         ?>
         
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new orange1234" id="table_bookshelf">
              <thead>
                <tr>
                  <th align="center" width="70%" colspan="3"><?php //echo $details['name'];?>Search Title</th>
                  <th align="center" width="30%" colspan="2" id="delete_bookshelf"  onclick="del2(<?php //echo $details['id'];?>)" style="cursor:pointer;"></th>
                </tr>
              </thead>
              <tbody id="detail_view">
              	
                <tr class="hov_no">
                  <td width="100%" colspan="5">
                  
                  There are no result
                  
                  </td>
                  
                </tr>
              </tbody>
            </table>      
         
       <?php      
        }
        
        
    }
    
    function allWorkForBookshelf($search)
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->order_by('create_date','desc')->get('works');
         $rs  = $this->db->select('s.id as wcid,s.Wid,s.bid,s.user_id as buid,a.*')->from('bookshelf_works as s')->join('works as a','s.Wid = a.id','inner')->like('a.title', $search)->order_by('s.id','asc')->group_by('a.title')->get();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                $row23=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row23['work_type_name']))
                {
                $data[$each]['type_name'] = $row23['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                
               $row73=$this->db->where('id',$value['file_asset_id'])->where('description','work_file')->get('assets')->row_array();
                if(!empty($row73['filename']))
                {
                $data[$each]['work_file'] = $row73['filename'];
                }
                else
                {
                 $data[$each]['work_file'] = '';   
                }  
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }
    
   function saveTitleWorkForBookshelf()
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->order_by('create_date','desc')->get('works');
         $rs  = $this->db->select('b.id as bid_id,b.user_id as buser,b.is_status,s.id as wcid,s.Wid,s.bid,s.user_id as buid,a.*')->from('bookshelfs as b')->join('bookshelf_works as s','b.id = s.bid','left')->join('works as a','s.Wid = a.id','inner')->where('b.user_id', $usd['id'])->where('b.is_status', '0')->order_by('s.id','asc')->group_by('s.id')->get();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                $row23=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row23['work_type_name']))
                {
                $data[$each]['type_name'] = $row23['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                
               $row73=$this->db->where('id',$value['file_asset_id'])->where('description','work_file')->get('assets')->row_array();
                if(!empty($row73['filename']))
                {
                $data[$each]['work_file'] = $row73['filename'];
                }
                else
                {
                 $data[$each]['work_file'] = '';   
                }  
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }  
    
 function delete_bookshelf($id)
    {
        $this->db->where('id',$id)->delete('bookshelfs');
        $this->db->where('bid',$id)->delete('bookshelf_works');
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('*')->where('user_id',$usd['id'])->get('bookshelfs');
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            $i =1; 
            foreach($data as $each=>$details){
                
                $user_book_self = $this->mbookshelf->get_user_book_self_count($details['id']);
                $user_book_self_id = $this->mbookshelf->get_bookshelf_first($details['id']);
                
                ?>
        
          <tr>
            <td>
            
            <a href="#bookshelf_share_<?php echo $details['id']?>" rel="facebox" data-fruit ="<?php echo $details['name'];?>"class="share_btn">Share</a>
            
            
         <div id="bookshelf_share_<?php echo $details['id']?>" style="display:none;">
        
         <h2>Share my "<?php echo $details['name'];?>" Bookshelf with:</h2>
         <?php
           //$frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
           //echo form_open('bookshelves/BookShelves_share', $frmAttrs);
         ?>
         <form action="<?=base_url()?>bookshelves/BookShelves_share" method="post">
         <label>Email:</label>
         <input name="email" id="email" type="text" />
         <div class="clear"></div>
         
         <label class="bself_label">Note:</label>
         <textarea class="bself_note" name="note" id="note"></textarea>
         <div class="clear"></div>
         
         <input type="hidden" name="bself_id" id="bself_id" value="<?php echo $details['id']?>"/> 
         <input name="button" class="add_bkslf" type="submit" value="Send" style="margin-left: 60px !important;" />
         </form> 
         
         </div> 
            
            
            </td>
            <td ><?php echo $details['name'];?></td>
            <td ><?php echo $user_book_self;?></p></td>
            <td >
            
            <a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>
            <?php if(!empty($user_book_self_id)) {?>
            <a href="<?=base_url()?>work/carousel/<?=$user_book_self_id['Wid']?>/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a>
            <?php } ?>
            
            </td>
            <td ><span style="color:#3c97ff; padding:0 10px; cursor: pointer;" onclick="del(<?php echo $details['id']?>)">Delete</span></td>
          </tr>
           
         
             
         <?php 
            $i++; 
              }
             
           } 
           else
           {
            ?>
            <tr>
                <td></td>
                <td></td>
                <td><p>Sorry! There are no BookShelves.</p></td>
                <td ></td>
                <td></td>
                
                </tr>
            
        <?php
         }  
               
        $rs->free_result();
          
    

    }
    
    function delete_bookshelf_carousel($id)
    {
        $this->db->where('id',$id)->delete('bookshelf_works');
        
       return 1;
    

    }
    
    function delete_books_by_id($wcid)
    {
        $usd = $this->session->userdata('logged_user');
        $this->db->where('Wid',$wcid)->where('user_id',$usd['id'])->delete('bookshelf_works');
        //echo $this->db->last_query();die;
        //return 1;
        //echo $this->db->last_query();
    }
    function delete_books($wid,$bid)
    {
        $this->db->where('Wid',$wid)->where('bid',$bid)->delete('bookshelf_works');
        echo $this->db->last_query();die;
        return 1;
    }
    public function getAuthorList()
    {
        return $data    = $this->db->select('email')->where('user_type','1')->where('status_id','1')->get('users')->result_array();
    }
    
    
    function get_book_latest_list(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->where('bid',$bid)->get('bookshelf_works');
         $rs  = $this->db->select('s.id as wcid,s.Wid,s.bid,a.id,a.user_id,w.*')->from('bookshelf_works as s')->join('bookshelfs as a','s.bid = a.id','inner')->join('works as w','s.Wid = w.id','inner')->where('a.user_id',$usd['id'])->order_by('wcid','desc')->limit(4)->get();
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                //$row1=$this->db->select('*')->where('id',$value['Wid'])->get('works')->row_array();
               
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                $row22=$this->db->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row22['work_form_name']))
                {
                $data[$each]['form_name'] = $row22['work_form_name'];
                }
                else
                {
                 $data[$each]['form_name'] = '';   
                }
                
                $row23=$this->db->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row23['work_type_name']))
                {
                $data[$each]['type_name'] = $row23['work_type_name'];
                }
                else
                {
                 $data[$each]['type_name'] = '';   
                }
                
               $row33=$this->db->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row33['filename']))
                {
                $data[$each]['photo'] = $row33['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                } 
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }   
     
  function get_user_bookshelf_count(){
        
        $data = array();
         $usd = $this->session->userdata('logged_user');
        //$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'"; 
        //echo $query = $this->db->query($sql);die;
        $data  = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,a.Wid')->from('works as s')->join('bookshelf_works as a','s.id = a.Wid','right')->where('s.user_id', $usd['id'])->get()->row_array();
         //$data  = $this->db->select('count(*) as count')->where('profile_id',$usd['id'])->get('view_profile')->row_array();
         //echo $this->db->last_query();die;
         return $data;
         
    } 
    
   function get_user_author_bookshelf_count(){
        
        $data = array();
         $usd = $this->session->userdata('logged_user');
        
        //$data  = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,a.Wid')->from('works as s')->join('bookshelf_works as a','s.id = a.Wid','right')->where('a.user_id', $usd['id'])->get()->row_array();
        
        $data  = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,a.Wid')->from('works as s')->join('bookshelf_works as a','s.id = a.Wid','right')->where('a.user_id !=', '')->where('a.user_id !=', $usd['id'])->get()->row_array();
         //$data  = $this->db->select('count(*) as count')->where('profile_id',$usd['id'])->get('view_profile')->row_array();
         //echo $this->db->last_query();die;
         return $data;
         
    } 
    
   function InsertGenreWithSearch($genre){
        
        $data = array();
         $usd = $this->session->userdata('logged_user');
        
        foreach($genre as $genreid)
        {
            $data['user_id'] = $usd['id'];
            $data['cid'] = $genreid;
            $data['created_at'] = date("Y-m-d h:i:s");
            
            $this->db->insert('search_by_genre' , $data);
        }
         
    }   
    
 
   
}
