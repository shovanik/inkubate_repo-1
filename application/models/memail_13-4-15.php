<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class memail extends CI_Model
{

    public function checkmail(){
        
        if($this->input->post('user_mail'))
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail'))->get('users');
        if($row->num_rows() > 0)
        {
        echo 'OK';
        }
        else
        {
        echo '<font color="red">Email not available</font>';
        }
        }
  }
    public function mailSend($type){
        $data   = array();
        
        //print_r($this->input->post('user_email_id'));die;
        //echo $type;die;
        //$data['submit'] = $this->input->post('send');
        //$data['draft'] = $this->input->post('draft');
        $usd = $this->session->userdata('logged_user');
        //echo $_FILES['image']['name'];die;
       // echo $this->input->post('user_email_id');
        //echo $this->input->post('subject');
       // echo $this->input->post('desc');die;
       
        if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
   
    if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/inbox','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
        
        
        
        if($type == 'send')
        {
         $user_ids = explode(",",trim($this->input->post('user_email_id')));
		 $result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
		//die;
		 if(count($result) > 0)
		   {
		    foreach($result as $key => $row)
		    {
		    $data['to_user_id'] = $row['id'];
		   
		     /*$row22 = $this->db->select('*')->where('email',$this->input->post('cc'))->get('users')->row_array();
		         if(!empty($row22['id']))
		         {
		         $data['to_cc_id'] = $row22['id'];
		         }  
		         else
		         {
		           $data['to_cc_id'] = '';  
		         }*/
		    $data['from_user_id'] = $usd['id'];
		    if($this->input->post('sub') != '')
		    {
		    $data['subject'] = $this->input->post('sub');
		    }
		    $data['body'] = $this->input->post('desc');
		    
		    if($_FILES['image']['name'] != "")
		    {
		    $data['attach_file'] = $imgname['file_name']; 
		    }
		    else
		    {
		      $data['attach_file'] = '';   
		    }   
		    
            if($this->input->post('is_pitchit') != '')
		    {
		    $data['is_pitchited'] = $this->input->post('is_pitchit');
            $data['pitchit_id'] = $this->input->post('get_pitchit_id');
            //$data['pitchit_id'] = $pit_id;
		    }
            else
            {
             $data['is_pitchited'] = '';
             $data['pitchit_id'] = '';   
            }
            
		    $data['created']    = date("Y-m-d h:i:s");
		    
		    //unset($data['draft']);
		    //unset($data['submit']);
		    $this->db->trans_start();
		    $this->db->insert('messages', $data);
            
            //die;
            
		    $insert_id = $this->db->insert_id();
		    $this->db->trans_complete();
		    
		    //to save the address of the publisher in the author address book
		   
		    if($usd['user_type'] == "2")
		    {
		    	
		    	if($row['user_type'] == "1")
		    	{
		    		
		    		//not already added to author address book
		    		$row_addr=$this->db->select('count(*) as count')->where('address_user_id',$usd['id'])->where("user_id",$row['id'])->get('author_address_books')->row_array();		    		
		    		if($row_addr['count'] <= 0)
		    		{
		    			
		    			$address['address_user_id'] = $usd['id'];
		    			$address['user_id'] = $row['id'];
		    			$address['status'] = "1";
        				$address['is_deleted'] = "0";
        				$this->db->insert('author_address_books', $address);
		    		}
		    	}
		    }
		    
		    //die;
		   // echo "sssssss";die;
		    //$last_id=$this->db->insert_id();
		     
		    //$str = $this->input->post('cc');
		    //$str1 = explode(',',$str);
		    
		    //print_r ($str1);die;
		     }
		}
            
           return 1;
         }
      
       
       //this is for saving a draft by publisher for multiple send user id
       
       if($type == 'draft')
        {
           	 $user_ids = explode(",",trim($this->input->post('user_email_id')));
           	 $result = $this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
           	 if(count($result) > 0)
		 {
		    foreach($result as $key => $row22)
		    {
			$data['to_user_id'] = $row22['id'];
		  	
		        /* if(!empty($row22['id']))
		         {
		         $data['to_cc_id'] = $row22['id'];
		         }  
		         else
		         {
		           $data['to_cc_id'] = '';  
		         }*/
			$data['from_user_id'] = $usd['id'];
			if($this->input->post('sub') != '')
			{
			$data['subject'] = $this->input->post('sub');
			}
			$data['body'] = $this->input->post('desc');
		
			if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
		
			//$data['attach_file'] = $imgname['file_name'];
			$data['is_drafted'] = '1';
			$data['created']    = date("Y-m-d h:i:s");
		
			//unset($data['submit']);
			//unset($data['draft']);
			//print_r($data);
			$this->db->insert('messages', $data);
			
	       	  }
	       }
	       return 1;
        }
     
       
    }
    
   
   public function mailSend_forward($type){
        $data   = array();
        //echo $type;die;
        //$data['submit'] = $this->input->post('send');
        //$data['draft'] = $this->input->post('draft');
        $usd = $this->session->userdata('logged_user');
        //echo $_FILES['image']['name'];die;
       // echo $this->input->post('user_email_id');
        //echo $this->input->post('subject');
       // echo $this->input->post('desc');die;
       
        if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
   
    if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/inbox','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
        
     
        
        if($type == 'send')
        {
            $user_ids = explode(",",trim($this->input->post('user_email_id_1')));
		 $result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
		//die;
		 if(count($result) > 0)
		   {
		    foreach($result as $key => $row)
		    {
		    $data['to_user_id'] = $row['id'];
		   
		     /*$row22 = $this->db->select('*')->where('email',$this->input->post('cc'))->get('users')->row_array();
		         if(!empty($row22['id']))
		         {
		         $data['to_cc_id'] = $row22['id'];
		         }  
		         else
		         {
		           $data['to_cc_id'] = '';  
		         }*/
		    $data['from_user_id'] = $usd['id'];
		    if($this->input->post('sub') != '')
		    {
		    $data['subject'] = $this->input->post('sub');
		    }
		    $data['body'] = $this->input->post('desc');
		    
		    if($_FILES['image']['name'] != "")
		    {
		    $data['attach_file'] = $imgname['file_name']; 
		    }
		    else
		    {
		      $data['attach_file'] = '';   
		    }   
		    
            if($this->input->post('is_pitchit') != '')
		    {
		    $data['is_pitchited'] = $this->input->post('is_pitchit');
            $data['pitchit_id'] = $this->input->post('get_pitchit_id');
            //$data['pitchit_id'] = $pit_id;
		    }
            else
            {
             $data['is_pitchited'] = '';
             $data['pitchit_id'] = '';   
            }
            
		    $data['created']    = date("Y-m-d h:i:s");
		    
		    //unset($data['draft']);
		    //unset($data['submit']);
		    $this->db->trans_start();
		    $this->db->insert('messages', $data);
            
            //die;
            
		    $insert_id = $this->db->insert_id();
		    $this->db->trans_complete();
		    
		    //to save the address of the publisher in the author address book
		   
		    if($usd['user_type'] == "2")
		    {
		    	
		    	if($row['user_type'] == "1")
		    	{
		    		
		    		//not already added to author address book
		    		$row_addr=$this->db->select('count(*) as count')->where('address_user_id',$usd['id'])->where("user_id",$row['id'])->get('author_address_books')->row_array();		    		
		    		if($row_addr['count'] <= 0)
		    		{
		    			
		    			$address['address_user_id'] = $usd['id'];
		    			$address['user_id'] = $row['id'];
		    			$address['status'] = "1";
        				$address['is_deleted'] = "0";
        				$this->db->insert('author_address_books', $address);
		    		}
		    	}
		    }
		 
         }
		}
            
           return 1;
         }
      
       
       //this is for saving a draft by publisher for multiple send user id
       
       if($type == 'draft')
        {
           	 $user_ids = explode(",",trim($this->input->post('user_email_id_1')));
           	 $result = $this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
           	 if(count($result) > 0)
		 {
		    foreach($result as $key => $row22)
		    {
			$data['to_user_id'] = $row22['id'];
		  	
		        /* if(!empty($row22['id']))
		         {
		         $data['to_cc_id'] = $row22['id'];
		         }  
		         else
		         {
		           $data['to_cc_id'] = '';  
		         }*/
			$data['from_user_id'] = $usd['id'];
			if($this->input->post('sub') != '')
			{
			$data['subject'] = $this->input->post('sub');
			}
			$data['body'] = $this->input->post('desc');
		
			if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
		
			//$data['attach_file'] = $imgname['file_name'];
			$data['is_drafted'] = '1';
			$data['created']    = date("Y-m-d h:i:s");
		
			//unset($data['submit']);
			//unset($data['draft']);
			//print_r($data);
			$this->db->insert('messages', $data);
			
	       	  }
	       }
	       return 1;
        }
     
       
    } 
    
    
    function get_user_notification(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('messages');
         
         $rs  = $this->db->select('*')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->order_by('created','desc')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->limit(3)->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = ''; 
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
                
                $row22=$this->db->select('filename')->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    function get_total_user_notification(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('messages');
         
         $rs  = $this->db->select('*')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->order_by('created','desc')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = ''; 
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
                
                $row22=$this->db->select('filename')->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   function get_publisher_pitchit(){
         $data=array(); 
         $usd = $this->session->userdata('logged_user');
   
   $rs  = $this->db->select('s.pit_id as pitid,s.user_id as pituser,s.wid as pitwid,s.pitchit,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.wid = a.wid','inner')->where('s.user_id', $usd['id'])->order_by('a.id','desc')->limit(4)->get();
   
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.cid = a.cid','inner')->order_by('a.id','desc')->group_by('s.user_id')->limit(4)->get();
   
         //$rs=$this->db->select('*')->limit(4)->order_by('id','desc')->get('pitchit_view');
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
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
                
                $row22=$this->db->select('filename')->where('user_id',$value['user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
    
      function get_publisher_totalview_pitchit($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   
   $rs  = $this->db->select('s.id as pitid,s.user_id as pituser,s.wid as pitwid,s.pitchit_id as pitchitid,s.date as pitdate,a.pit_id,a.user_id,a.pitchit')->from('pitchit_view as s')->join('work_pitchits as a','s.pitchit_id = a.pit_id','inner')->where('a.user_id', $usd['id'])->order_by('s.id','desc')->limit($limit,$offset)->get();
   
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.cid = a.cid','inner')->order_by('a.id','desc')->group_by('s.user_id')->limit(4)->get();
   
         //$rs=$this->db->select('*')->limit(4)->order_by('id','desc')->get('pitchit_view');
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['pituser'])->where('status_id','1')->get('users')->row_array();
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
                
                $row22=$this->db->select('title')->where('id',$value['pitwid'])->get('works')->row_array();
                if(!empty($row22['title']))
                {
                $data[$each]['title'] = $row22['title'];
                }
                else
                {
                 $data[$each]['title'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
   function get_publisher_totalview_pitchit_side(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   
   $rs  = $this->db->select('s.id as pitid,s.user_id as pituser,s.wid as pitwid,s.pitchit_id as pitchitid,s.date as pitdate,a.pit_id,a.user_id,a.pitchit,a.created_date')->from('pitchit_view as s')->join('work_pitchits as a','s.pitchit_id = a.pit_id','inner')->where('s.user_id', $usd['id'])->order_by('s.id','desc')->limit(5)->get();
   
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.cid = a.cid','inner')->order_by('a.id','desc')->group_by('s.user_id')->limit(4)->get();
   
         //$rs=$this->db->select('*')->limit(4)->order_by('id','desc')->get('pitchit_view');
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
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
                
                $row22=$this->db->select('title')->where('id',$value['pitwid'])->get('works')->row_array();
                if(!empty($row22['title']))
                {
                $data[$each]['title'] = $row22['title'];
                }
                else
                {
                 $data[$each]['title'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }  
    
    
    
    function get_publisher_totalview_pitchit_cnt(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   
   $rs  = $this->db->select('s.pitchit_id as pitchitid,a.pit_id,a.user_id')->from('pitchit_view as s')->join('work_pitchits as a','s.pitchit_id = a.pit_id','inner')->where('a.user_id', $usd['id'])->get()->result_array();
   
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.cid = a.cid','inner')->order_by('a.id','desc')->group_by('s.user_id')->limit(4)->get();
   
         //$rs=$this->db->select('*')->limit(4)->order_by('id','desc')->get('pitchit_view');
       //die;
       
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        //echo count($rs);die;
        return count($rs);               
    
    } 
    
    
   function get_user_notification_pitchit(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name_first'] = $row['name_first'];
                $data[$each]['name_middle'] = $row['name_middle'];
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->select('filename')->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
  function get_user_work_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit($limit,$offset)->get('works');
         $rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('id','desc')->get('works');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
        foreach($data as $each=>$value){
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first'])){
                	$data[$each]['name_first'] = $row['name_first'];
                }else{
                 $data[$each]['name_first'] = '';   
                }

                if(!empty($row['name_middle'])){
                	$data[$each]['name_middle'] = $row['name_middle'];
                }else{
                 $data[$each]['name_middle'] = '';   
                }

                if(!empty($row['name_last'])){
                	$data[$each]['name_last'] = $row['name_last'];
                }else{
                 $data[$each]['name_last'] = '';   
                }
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    function getUserWorkDetailsById($usd, $offset=null,$limit=null){
         $data=array();
         //$usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit($limit,$offset)->get('works');
         $rs=$this->db->select('*')->where('user_id',$usd)->order_by('create_date','desc')->get('works');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   function get_user_pitchit_details(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '0')->order_by('s.pit_id','desc')->limit(6)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   
   function get_user_pitchit_saved_details($offset = null, $limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
  // $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '1')->order_by('s.pit_id','desc')->limit($limit,$offset)->get();
   
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_drafted', '1')->order_by('s.pit_id','desc')->limit($limit,$offset)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   
   function get_user_pitchit_saved_details_cnt(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('count(*) as count,s.*,a.title,a.id')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '1')->get()->row_array();
   
   $rs  = $this->db->select('count(*) as count,s.*,a.title,a.id')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_drafted', '1')->get()->row_array();
   
   return $rs;
   
   }
   
    function get_user_pitchit_details_publisher($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('s.*,a.id,a.title')->from('pitchit_view as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->order_by('s.date','desc')->limit(5)->get();
   
   $rs  = $this->db->select('s.*,a.id,a.title, a.modified_date')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.is_drafted','0')->order_by('s.created_date','desc')->limit($limit,$offset)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
        foreach($data as $each=>$value){
                
                
                $row25=$this->db->select('*')->where('pit_id',$value['pit_id'])->get('work_pitchits')->row_array();
                if(!empty($row25['pitchit']))
                {
                $data[$each]['pitchit'] = $row25['pitchit'];
                
                }
                else
                {
                 $data[$each]['pitchit'] = '';   
                }
                
                if(!empty($row25['user_id']))
                {
                $data[$each]['pitchit_user'] = $row25['user_id'];
                
                }
                else
                {
                 $data[$each]['pitchit_user'] = '';   
                }
                
                if(!empty($row25['created_date']))
                {
                $data[$each]['created_date'] = $row25['created_date'];
                
                }
                else
                {
                 $data[$each]['created_date'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
    
    function get_user_pitchit($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('*')->from('works')->where('id', $id)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    function get_pit_details($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('*')->from('work_pitchits')->where('wid', $id)->get()->row_array();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
     
        return $rs;               
    
    }
    
   function get_user_pitchit_view($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->order_by('s.created_date','desc')->limit(3)->get();
         $rs=$this->db->select('id')->where('wid',$wid)->where('user_id',$usd['id'])->get('pitchit_view');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return count($data);               
    
    }
    
    function get_user_pitchit_view_author($uid,$pitid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->order_by('s.created_date','desc')->limit(3)->get();
         $rs=$this->db->select('id')->where('user_id',$uid)->where('pitchit_id',$pitid)->get('pitchit_view');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return count($data);               
    
    }
    
  function get_user_pitchit_view_user($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.name_first,a.name_middle,a.name_last')->from('pitchit_view as s')->join('users as a','s.user_id = a.id','inner')->where('s.pitchit_id', $wid)->order_by('id','desc')->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
     function get_user_pitchit_msg($pid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count,subject,body,created')->from('messages')->where('pitchit_id', $pid)->where('is_pitchited', '1')->where('is_viewed', '0')->where('to_user_id',$usd['id'])->get()->row_array();
         
         //echo "<pre>";echo $this->db->last_query();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_from_pub($pid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count,subject,body,created')->from('messages')->where('pitchit_id', $pid)->where('is_pitchited', '1')->where('is_viewed', '0')->where('from_user_id',$usd['id'])->get()->row_array();
         
         //echo "<pre>";echo $this->db->last_query();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_response_cnt(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count,subject,body,created')->from('messages')->where('from_user_id',$usd['id'])->where('is_pitchited', '1')->where('is_viewed', '0')->where('pitchit_id IS NOT NULL', null, false)->or_where('to_user_id',$usd['id'])->where('is_pitchited', '1')->where('is_viewed', '0')->where('pitchit_id IS NOT NULL', null, false)->get()->row_array();
         
         //echo "<pre>";echo $this->db->last_query();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_auth($pid,$uid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count,subject,body,created')->from('messages')->where('pitchit_id', $pid)->where('from_user_id', $uid)->where('is_pitchited', '1')->where('is_viewed', '0')->where('to_user_id',$usd['id'])->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
      function get_user_pitchit_msg_total_cnt(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count,subject')->from('messages')->where('is_pitchited', '1')->where('is_viewed', '0')->where('to_user_id',$usd['id'])->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_total_reply($pit_id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('count(*) as count')->from('messages')->where('to_user_id',$usd['id'])->where('is_pitchited', '1')->where('is_viewed', '0')->where('pitchit_id',$pit_id)->or_where('from_user_id',$usd['id'])->where('is_pitchited', '1')->where('is_viewed', '0')->where('pitchit_id',$pit_id)->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_recent($pit_id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('id,subject,body,from_user_id,to_user_id,created,is_pitchited,is_viewed')->from('messages')->where('is_pitchited', '1')->where('is_viewed', '0')->where('to_user_id',$usd['id'])->where('pitchit_id',$pit_id)->order_by('id','desc')->limit(1)->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_msg_recent_auth($pit_id,$uid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('id,subject,body,from_user_id,to_user_id,created,is_pitchited,is_viewed')->from('messages')->where('is_pitchited', '1')->where('is_viewed', '0')->where('to_user_id',$usd['id'])->where('from_user_id',$uid)->where('pitchit_id',$pit_id)->order_by('id','desc')->limit(1)->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_send_user($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('id,name_first,name_middle,name_last')->from('users')->where('id', $wid)->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
    function get_user_pitchit_writer($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('s.*,a.name_first,a.name_middle,a.name_last')->from('pitchit_view as s')->join('users as a','s.user_id = a.id','inner')->where('s.pitchit_id', $wid)->get()->row_array();
         
         $rs  = $this->db->select('name_first,name_middle,name_last,email')->from('users')->where('id', $wid)->get()->row_array();
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }   
    
    function get_user_total_pitchit_view(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.wid = a.wid','inner')->where('s.user_id', $usd['id'])->get();
         //$rs=$this->db->select('*')->where('wid',$wid)->get('pitchit_view');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return count($data);               
    
    }  
    
  function get_pitchit_details(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->order_by('s.created_date','desc')->limit(3)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   function get_pitchit_details_view(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
            /*$rsw=$this->db->select('pitchit_id')->where('user_id',$usd['id'])->get('pitchit_view')->result_array();
            foreach($rsw as $key=>$each){
                $temp[] = $each['pitchit_id'];   //array_push($temp, $each['pitchit_id'])
            }
    
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where_not_in('s.pit_id', $temp)->order_by('s.created_date','desc')->get();*/
      $rs  = $this->db->select('s.id as wcid,s.wid,s.cid,a.user_id as pubuid,a.cid as pubcid,p.pit_id,p.wid,p.pitchit,p.created_date,w.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->join('work_pitchits as p','s.wid = p.wid','left')->join('works as w','w.id = s.wid','left')->where('w.is_pitchited','1')->group_by('p.pit_id')->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
     //die;
      
      //echo $row44->num_rows();die;
      
      /*if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
          
      
      foreach($data44 as $row_value){
      
      $rs  = $this->db->select('p.*,w.*')->from('work_pitchits as p')->join('works as w','p.wid = w.id','inner')->where('p.wid',$row_value['wid'])->get();*/
      
      //  
    
       //echo count($rs);die;
        
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
         //echo '<pre>';print_r($data);die; 
         //$i = 0;   
         foreach($data as $each=>$value){
                
               //$data[$i] = $value;
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                $data[$each]['middle'] = $row55['name_middle'];
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                $data[$each]['middle'] = '';
                $data[$each]['last'] = '';   
                }
                
                //$i++;  
                //$data[$each]['type']    = 'PROPERTY';
            }
         }
       
       
            
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
         return $data;              
    
    }
    
    
   function get_pitchit_details_form_view(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
            /*$rsw=$this->db->select('pitchit_id')->where('user_id',$usd['id'])->get('pitchit_view')->result_array();
            foreach($rsw as $key=>$each){
                $temp[] = $each['pitchit_id'];   //array_push($temp, $each['pitchit_id'])
            }
    
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where_not_in('s.pit_id', $temp)->order_by('s.created_date','desc')->get();*/
      $rs  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where('s.user_id',$usd['id'])->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
     //die;
      
      //echo $row44->num_rows();die;
      
      /*if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
          
      
      foreach($data44 as $row_value){
      
      $rs  = $this->db->select('p.*,w.*')->from('work_pitchits as p')->join('works as w','p.wid = w.id','inner')->where('p.wid',$row_value['wid'])->get();*/
      
      //  
    
       //echo count($rs);die;
        
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
         //echo '<pre>';print_r($data);die; 
         //$i = 0;   
         foreach($data as $each=>$value){
                
               //$data[$i] = $value;
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last,email,user_type')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                
                }
                if(!empty($row55['name_middle']))
                {
                
                $data[$each]['middle'] = $row55['name_middle'];
            
                }
                else
                {
               
                $data[$each]['middle'] = '';
                  
                }
                if(!empty($row55['name_last']))
                {
               
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                
                $data[$each]['last'] = '';   
                }
                
                if(!empty($row55['email']))
                {
               
                $data[$each]['email'] = $row55['email'];
                
                }
                else
                {
                
                $data[$each]['email'] = '';   
                }
                
                //$i++;  
                //$data[$each]['type']    = 'PROPERTY';
            }
         }
       
       
            
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
         return $data;              
    
    } 
    
    
    function get_pitchit_details_view_limit(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
       
        $rs  = $this->db->select('w.id,w.user_id,w.asset_id,w.work_type_id,w.work_form_id,w.title,w.create_date,s.id as sid,s.user_id as suid,s.work_type_id as swtypid,,s.work_form_id as swfrmid,p.pit_id,p.user_id as pit_uid,p.wid,p.pitchit,p.created_date,p.is_pitchit,p.is_drafted')->from('works as w')->join('publisher_forms as s','w.work_type_id = s.work_type_id','inner')->join('work_pitchits as p','p.wid = w.id','inner')->where('w.is_pitchited','1')->where('p.is_drafted','0')->group_by('p.pit_id')->order_by('p.created_date','desc')->limit(3)->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
     //die;
      
      
       if($rs->num_rows() > 0){
       
        $data   = $rs->result_array();
            
         //die;   
         //echo '<pre>';print_r($data);die; 
         //$i = 0;   
         foreach($data as $each=>$value){
                
               //$data[$i] = $value;
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                $data[$each]['middle'] = $row55['name_middle'];
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                $data[$each]['middle'] = '';
                $data[$each]['last'] = '';   
                }
                
                //$i++;  
                //$data[$each]['type']    = 'PROPERTY';
            }
       }
       
            
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
         return $data;              
    
    }
    
    
   function get_pitchit_details_view_limit_cat(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
      $rs  = $this->db->select('s.id as wcid,s.wid,s.cid,a.user_id as pubuid,a.cid as pubcid,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit,p.is_drafted,w.id,w.user_id,w.asset_id,w.work_type_id,w.work_form_id,w.title,w.create_date')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->join('work_pitchits as p','s.wid = p.wid','left')->join('works as w','w.id = s.wid','left')->where('w.is_pitchited','1')->where('p.is_drafted','0')->group_by('p.pit_id')->order_by('p.created_date','desc')->limit(3)->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
     //die;
      //echo $this->db->last_query();die;
       //echo count($rs);die;
        
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
         //echo '<pre>';print_r($data);die; 
         //$i = 0;   
         foreach($data as $each=>$value){
                
               //$data[$i] = $value;
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                $data[$each]['middle'] = $row55['name_middle'];
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                $data[$each]['middle'] = '';
                $data[$each]['last'] = '';   
                }
                
                //$i++;  
                //$data[$each]['type']    = 'PROPERTY';
            }
         }
      //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
         return $data;              
    
    } 
    
    
   function get_total_pitchit(){
         $data=array();
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
            /*$rsw=$this->db->select('pitchit_id')->where('user_id',$usd['id'])->get('pitchit_view')->result_array();
            foreach($rsw as $key=>$each){
                $temp[] = $each['pitchit_id'];   //array_push($temp, $each['pitchit_id'])
            }
    
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where_not_in('s.pit_id', $temp)->order_by('s.created_date','desc')->get();*/
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->order_by('s.created_date','desc')->get();
      
    
       //echo count($rs);die;
       //die;       
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
         //echo '<pre>';print_r($data);die;   
         foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                $data[$each]['middle'] = $row55['name_middle'];
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                $data[$each]['middle'] = '';
                $data[$each]['last'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }  
    
    
    function get_pitchit_details_rest(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
    //$rsw=$this->db->select('*')->where('user_id',$usd['id'])->get('pitchit_view');
  
       //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('NOT EXISTS (SELECT `pitchit_id` FROM `pitchit_view` where pitchit_id = s.pit_id)', '', FALSE)->order_by('s.created_date','desc')->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.pit_id = a.pitchit_id','left')->where('a.pitchit_id',NULL)->order_by('s.created_date','desc')->get();
      
      //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
         foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = '';   
                }
                
                $row33=$this->db->select('*')->where('work_form_id',$value['work_form_id'])->get('work_forms')->row_array();
                if(!empty($row33['work_form_name']))
                {
                $data[$each]['work_form_name'] = $row33['work_form_name'];
                
                }
                else
                {
                 $data[$each]['work_form_name'] = '';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                $row44=$this->db->select('filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row44['filename']))
                {
                $data[$each]['profile'] = $row44['filename'];
                
                }
                else
                {
                 $data[$each]['profile'] = '';   
                }
                
                $row55=$this->db->select('name_first,name_middle,name_last')->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row55['name_first']))
                {
                $data[$each]['first'] = $row55['name_first'];
                $data[$each]['middle'] = $row55['name_middle'];
                $data[$each]['last'] = $row55['name_last'];
                
                }
                else
                {
                $data[$each]['first'] = '';
                $data[$each]['middle'] = '';
                $data[$each]['last'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
   function get_pitchit_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('to_user_id', $usd['id'])->where('is_pitchited', "1")->where('pitchit_id !=', '')->where('is_notified', "0")->get('messages')->row_array();
        //die;
        //$this->db->limit(1,0);
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;           
    
    }
    
   function get_pitchit_count_11(){
         $data=array();
         $data44 = array();
         $temp = array();
         $usd = $this->session->userdata('logged_user');
    
        //$rs  = $this->db->select('*')->where('user_id',$usd['id'])->get('pitchit_view');
        
     
    $row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->get();
      //die;
     
      if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
      foreach($data44 as $each=>$row_value){ 
      
      $rsw=$this->db->select('pitchit_id')->where('user_id',$usd['id'])->get('pitchit_view')->result_array();
      
            foreach($rsw as $key=>$each){
                
                $temp[] = $each['pitchit_id'];   //array_push($temp, $each['pitchit_id'])
            }
    //echo '<pre/>';print_r($temp);die;
      
      if(!empty($temp))
      {
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where_not_in('s.pit_id', $temp)->where('s.wid',$row_value['wid'])->where('s.is_drafted','0')->order_by('s.created_date','desc')->get();
      
           if($rs->num_rows() == 0)
           {
            
            $rst  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where_not_in('p.pit_id', $temp)->where('s.user_id',$usd['id'])->where('p.is_drafted','0')->get();
            
            if($rst->num_rows() > 0){
            $data = $rst->result_array();
        
         
              }
            
           }
      }
      else
      {
       $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.wid',$row_value['wid'])->where('s.is_drafted','0')->order_by('s.created_date','desc')->get();
       
        //die; 
        
           if($rs->num_rows() == 0)
           {
            
            $rst  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where('s.user_id',$usd['id'])->where('p.is_drafted','0')->get();
            
            if($rst->num_rows() > 0){
            $data = $rst->result_array();
        
         
              }
            
           }
        
      }
       
       if($rs->num_rows() > 0){
        $data = $rs->result_array();
        
         }
       
      }
     // 
      
     }    
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;              
    
    }    
    
  function get_user_details($type_id,$form_id)
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('*')->where('work_type_id',$type_id)->where('work_form_id',$form_id)->where('status_id','1')->order_by('created','desc')->get('users');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data; 
	
    }
    
  function getCountWorks()
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->order_by('create_date','desc')->get('works');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data[0]['count']; 
	
    }  
    
  function get_user_all_work_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit($limit,$offset)->get('works');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
        foreach($data as $each=>$value){
                
                
                $row=$this->db->select('*')->where('work_type_id',$value['work_type_id'])->get('work_types')->row_array();
                if(!empty($row['work_type_name']))
                {
                $data[$each]['work_type_name'] = $row['work_type_name'];
                
                }
                else
                {
                 $data[$each]['work_type_name'] = 'sorry!';   
                }
                
                $row22=$this->db->select('filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }  
    
    function get_user_work_categories($wid){
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
    
    
    function get_user_notification_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->where('pitchit_id','')->where('is_notified','0')->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    function get_use_pitchit_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->where('is_pitchit','1')->get('work_pitchits')->row_array();
    
        //die;
         return $rs;               
    
    }
    
      public function update_pitchit_single_view($pit_id,$wid){
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        //$row=$this->db->select('count(*) as count')->where('pitchit_id',$pit_id)->where('wid',$wid)->where('user_id',$usd['id'])->get('pitchit_view')->row_array();
       
        //if($row['count'] == '0')
        //{
            $data['user_id'] = $usd['id'];
            
            $data['wid'] = $wid;
            
            $data['pitchit_id'] = $pit_id;
            
            $data['view'] = '1';
            
            $data['date']    = date("Y-m-d h:i:s");
            
            
            $this->db->insert('pitchit_view', $data);
            //die;
            
           // echo "sssssss";die;
            //$last_id=$this->db->insert_id();
           
           return 1;
       //}
      
     }  
    
    public function update_pitchit_single_save($pit_id,$wid){
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        $row=$this->db->select('count(*) as count')->where('pitchit_id',$pit_id)->where('wid',$wid)->where('user_id',$usd['id'])->get('pitchit_save')->row_array();
        //
        if($row['count'] == '0')
        {
            $data['user_id'] = $usd['id'];
            
            $data['wid'] = $wid;
            
            $data['pitchit_id'] = $pit_id;
            
            $data['save'] = '1';
            
            $data['date']    = date("Y-m-d h:i:s");
            
            
            $this->db->insert('pitchit_save', $data);
            //die;
            
           // echo "sssssss";die;
            //$last_id=$this->db->insert_id();
           
           return 1;
       }
       else
       {
         return 0;
       }
      
     } 
     
     
     public function update_pitchit_single_savecheck($pit_id,$wid){
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        $data=$this->db->select('count(*) as count')->where('pitchit_id',$pit_id)->where('wid',$wid)->where('user_id',$usd['id'])->get('pitchit_save')->row_array();
        return $data;
     }
     
     public function pitchit_save_cnt(){
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        //$data=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->get('pitchit_save')->row_array();
        $data  = $this->db->select('count(*) as count')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.is_drafted','0')->get()->row_array();
        return $data;
     } 
    
    
    public function replySend($type){
        $data   = array();
        //$data['reply'] = $this->input->post('reply');
        //$data['draft'] = $this->input->post('draft');
        
        $usd = $this->session->userdata('logged_user');
       
       //$data['image'] = $this->input->post('image');
       
       
        if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
    
        if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/compose_mail','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
       
       
        if($type == 'reply')
        {
            
            $user_ids = explode(",",trim($this->input->post('user_email_id_reply')));
            $result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
            //print_r($result);die;
            if(count($result) > 0)
            {
               foreach($result as $key => $row)
               {
		    
                    $data['to_user_id'] = $row['id'];
                    $data['from_user_id'] = $usd['id'];
                    $data['subject'] = $this->input->post('reply_sub');
                    $data['is_pitchited'] = $this->input->post('msg_type');
                    $data['body'] = $this->input->post('reply_text');

                    if($_FILES['image']['name'] != ""){
                        $data['attach_file'] = $imgname['file_name']; 
                    }else{
                        $data['attach_file'] = '';   
                    }

                    $data['to_reply_id'] = $this->input->post('reply_message_id');
                    $data['created']    = date("Y-m-d h:i:s");

                    $this->db->insert('messages', $data);

                    
                }
                
            }
            return 1;
        }
       
        if($type == 'draft')
        {
            
            $user_ids = explode(",",trim($this->input->post('user_email_id_reply')));
            $result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
           //die;
            if(count($result) > 0)
              {
               foreach($result as $key => $row)
               {
		      
                $data['to_user_id'] = $row['id'];
                $data['from_user_id'] = $usd['id'];

                if($this->input->post('reply_sub') != '')
                {
                $data['subject'] = $this->input->post('reply_sub');
                }
                $data['body'] = $this->input->post('reply_text');

                if($_FILES['image']['name'] != "")
                {
                    $data['attach_file'] = $imgname['file_name']; 
                }
                else
                {
                      $data['attach_file'] = '';   
                }

                //$data['attach_file'] = $imgname['file_name'];
                $data['is_drafted'] = '1';
                $data['created']    = date("Y-m-d h:i:s");

            //unset($data['reply']);
            //unset($data['draft']);
            //print_r($data);die;


            $this->db->insert('messages', $data);
            //die;

           // echo "sssssss";die;
            //$last_id=$this->db->insert_id();
              }
         }
       return 1;
       }
     
      
    }
    
   public function replyAllSend($type){
        $data   = array();
        //$data['reply'] = $this->input->post('reply');
        //$data['draft'] = $this->input->post('draft');
        
        $usd = $this->session->userdata('logged_user');
       
       //$data['image'] = $this->input->post('image');
       
       
       if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
    
    if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/compose_mail','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
       
       
        if($type == 'reply')
        {
            
         $user_email = explode(",",trim($this->input->post('reply_email')));
		 $result=$this->db->select('*')->where_in('email',$user_email)->where('status_id','1')->get('users')->result_array();
		//die;
		 if(count($result) > 0)
		   {
		    foreach($result as $key => $row)
		    {
		    
        //$row=$this->db->select('*')->where('email',$this->input->post('reply_email'))->where('status_id','1')->get('users')->row_array();
        //
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        $data['subject'] = $this->input->post('reply_sub');
        
        $data['is_pitchited'] = $this->input->post('msg_type');
        
        $data['body'] = $this->input->post('replyall_text');
        
        if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
        
        $data['to_reply_id'] = $this->input->post('reply_message_id');
        $data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['draft']);
        //unset($data['reply']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
         }
        } 
       
       return 1;
       }
       
         if($type == 'draft')
        {
            
         $user_email = explode(",",trim($this->input->post('reply_email')));
		 $result=$this->db->select('*')->where_in('email',$user_email)->where('status_id','1')->get('users')->result_array();
		//die;
		 if(count($result) > 0)
		   {
		    foreach($result as $key => $row)
		    {
		      
        //$row=$this->db->select('*')->where('email',$this->input->post('reply_email'))->where('status_id','1')->get('users')->row_array();
        //die;
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        	if($this->input->post('reply_sub') != '')
			{
			$data['subject'] = $this->input->post('reply_sub');
			}
			$data['body'] = $this->input->post('replyall_text');
		
			if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
		  
			//$data['attach_file'] = $imgname['file_name'];
			$data['is_drafted'] = '1';
			$data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['reply']);
        //unset($data['draft']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
          }
         }
       return 1;
       }
     
      
    } 
    
    
   public function draftAllSend($type){
        $data   = array();
        //$data['reply'] = $this->input->post('reply');
        //$data['draft'] = $this->input->post('draft');
        
        $usd = $this->session->userdata('logged_user');
       
       //$data['image'] = $this->input->post('image');
       
       
       if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
    
    if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/compose_mail','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
       
       
        if($type == 'reply')
        {
         
            $message_id = $this->input->post('message_id');  
            $this->db->where('id',$message_id)->delete('messages');
            //$user_email = explode(",",trim($this->input->post('reply_email')));
            //$result=$this->db->select('*')->where_in('email',$user_email)->where('status_id','1')->get('users')->result_array();
            
            $user_ids = explode(",",trim($this->input->post('user_email_id_draft')));
            $result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
            //die;
            if(count($result) > 0)
            {
                foreach($result as $key => $row)
                {
		    
                //$row=$this->db->select('*')->where('email',$this->input->post('reply_email'))->where('status_id','1')->get('users')->row_array();
                $data['to_user_id'] = $row['id'];
                $data['from_user_id'] = $usd['id'];
                $data['subject'] = $this->input->post('reply_sub');
                $data['is_drafted'] = '0';
                $data['body'] = $this->input->post('replyall_text');

                if($_FILES['image']['name'] != "")
                {
                    $data['attach_file'] = $imgname['file_name']; 
                }
                else
                {
                      $data['attach_file'] = '';   
                } 
        
            //$data['to_reply_id'] = $this->input->post('reply_message_id');
            $data['created']    = date("Y-m-d h:i:s");

            $this->db->insert('messages', $data);

            //$this->db->where('id',$message_id)->update('messages', $data);
        
            }
        } 
       
       return 1;
       }
       
         if($type == 'draft')
        {
            
         $user_email = explode(",",trim($this->input->post('reply_email')));
		 $result=$this->db->select('*')->where_in('email',$user_email)->where('status_id','1')->get('users')->result_array();
		//die;
		 if(count($result) > 0)
		   {
		    foreach($result as $key => $row)
		    {
		      
        //$row=$this->db->select('*')->where('email',$this->input->post('reply_email'))->where('status_id','1')->get('users')->row_array();
        //die;
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        	if($this->input->post('reply_sub') != '')
			{
			$data['subject'] = $this->input->post('reply_sub');
			}
			$data['body'] = $this->input->post('replyall_text');
		
			if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
		  
			//$data['attach_file'] = $imgname['file_name'];
			$data['is_drafted'] = '1';
			$data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['reply']);
        //unset($data['draft']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
          }
         }
       return 1;
       }
     
      
    } 
    
    
    public function replySend_11(){
        $data   = array();
        $data['reply'] = $this->input->post('reply');
        $data['draft'] = $this->input->post('draft');
        
        $usd = $this->session->userdata('logged_user');
       
       $data['image'] = $this->input->post('image').'hello';die;
       
       
       if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/attach_image/medium')){
            chmod('./uploadImage/' .$usd['id']. '/attach_image', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/attach_image/medium', 0777, TRUE);
        }  
    
    if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']['name']);die;
            //echo $_REQUEST['propertyId'];
           // exit();
           
              $file_element_name = 'image';
              $image_name=$_FILES['image']['name'];
           
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/attach_image';
            //$configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            //$configUpload['allowed_types'] = 'pdf|gif|jpg|png|bmp|jpeg|xls|doc|docx|xlsx';
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg|txt';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            //$configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            
            
         if (!$this->upload->do_upload($file_element_name))
              {
                 //echo "if";die;
                  $error = array('error' => $this->upload->display_errors());
                 //echo $error['error'];die;
                 $this->session->set_flashdata('error',$error['error']);
                 //echo "<script>parent.$.fancybox.close();</script>";
                 
                 redirect('home/compose_mail','refresh');
              }
              else
              {
                 //echo "else";die;
                    $imgname = $this->upload->data();
                    
              }
            
        }
       
       
        if($data['reply'] == 'Send')
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail'))->where('status_id','1')->get('users')->row_array();
        //
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        $data['subject'] = $this->input->post('sub');
        
        $data['is_pitchited'] = $this->input->post('msg_type');
        
        $data['body'] = $this->input->post('editor3');
        
        $data['to_reply_id'] = $this->input->post('message_id');
        $data['created']    = date("Y-m-d h:i:s");
        
        unset($data['draft']);
        unset($data['reply']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
       
         if($data['draft'] == 'Save Draft')
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail'))->where('status_id','1')->get('users')->row_array();
        //die;
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        	if($this->input->post('sub') != '')
			{
			$data['subject'] = $this->input->post('sub');
			}
			$data['body'] = $this->input->post('desc');
		
			if($_FILES['image']['name'] != "")
			{
			    $data['attach_file'] = $imgname['file_name']; 
			}
			else
			{
			      $data['attach_file'] = '';   
			}
		
			//$data['attach_file'] = $imgname['file_name'];
			$data['is_drafted'] = '1';
			$data['created']    = date("Y-m-d h:i:s");
        
        unset($data['reply']);
        unset($data['draft']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
     
      
    }
    
  public function forward(){
        $data   = array();
        $data['forward'] = $this->input->post('forward');
        $data['draft'] = $this->input->post('draft');
        $usd = $this->session->userdata('logged_user');
       
        if($data['forward'] == 'forward')
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail'))->where('status_id','1')->get('users')->row_array();
        //
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        $data['subject'] = $this->input->post('sub');
        
        $data['body'] = $this->input->post('editor2');
        
        $data['to_reply_id'] = '';
        $data['created']    = date("Y-m-d h:i:s");
        
        unset($data['draft']);
        unset($data['forward']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
       
    }  
    
  public function addfolder(){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $data['user_id'] = $usd['id'];
        $data['name'] = $this->input->post('folder');
        
        //$data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['draft']);
        //unset($data['submit']);
        $this->db->insert('folders', $data);
        //die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
      
       
    }
    
    public function addpitchit(){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $data['user_id'] = $usd['id'];
        $data['name'] = $this->input->post('pitchit');
        
        //$data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['draft']);
        //unset($data['submit']);
        $this->db->insert('pitchits_folder', $data);
        //die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
      
       
    }
   
   function getLastPitfolder()
   {
    $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        $data['user_id'] = $usd['id'];
        $data['name'] = $this->input->post('pitchit');
        
        $rs  = $this->db->select('*')->where('user_id', $usd['id'])->order_by('id','desc')->limit(1)->get('pitchits_folder')->result_array();
        
        //$data['created']    = date("Y-m-d h:i:s");
        
        //unset($data['draft']);
        //unset($data['submit']);
        //$this->db->insert('pitchits_folder', $data);
        //die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return $rs;
   } 
    
    function delete_details($id)
    {
        //$this->db->where('id',$id)->delete('messages');  
        $data22   = array();
        $data22['is_deleted']    = '1';
        $rs  = $this->db->select('id')->where('to_reply_id', $id)->order_by('id','desc')->limit(1)->get('messages');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            foreach($data as $each=>$value){ 
                $this->db->where('id',$value['id'])->update('messages',$data22);  
                }
         }      
        else
        {
           $this->db->where('id',$id)->update('messages',$data22); 
        }           
    }
    function getAllChildsMails($id)
    {
	$rs  = $this->db->select('id')->where('to_reply_id', $id)->where('is_deleted', 0)->get('messages');
       //echo $sql = $this->db->last_query();
	if($rs->num_rows() > 0)
	{
            $data   = $rs->num_rows();
	    
            return $data;
         }
	 else
	 {
	    
	    return 0;
	 }
    }
    function getParentMails($id)
    {
	$rs  = $this->db->select('id')->where('id', $id)->where('is_deleted', 0)->where('in_replied_section', 0)->get('messages');
       //echo $sql = $this->db->last_query();
	if($rs->num_rows() > 0)
	{
            $data   = $rs->num_rows();
	    
            return $data;
         }
	 else
	 {
	    
	    return 0;
	 }
    }
    

    function msgDelete($id){  
        $data22   = array();
        $data22['is_deleted']    = '1';
        $this->db->where('id',$id)->update('messages',$data22);
	
    }
    function msgDeleteFromList($id)
    {
	 $data22   = array();
        $data22['in_replied_section']    = '1';
        $this->db->where('id',$id)->update('messages',$data22); 
    }
    
    function draft_details($id)
    {
        //$this->db->where('id',$id)->delete('messages');
        $data = array();
        $data22   = array();
        $data22['is_drafted']    = '1';
       
        $rs  = $this->db->select('id')->where('to_reply_id', $id)->order_by('id','desc')->limit(1)->get('messages');
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            foreach($data as $each=>$value){
                
                $this->db->where('id',$value['id'])->update('messages',$data22);
                
                }
         }
         
        else
        {
          $this->db->where('id',$id)->update('messages',$data22);  
        }    
        
    } 
    
    function delete_work($id)
    {
        //$this->db->where('id',$id)->delete('messages');
        
       $this->db->where('id',$id)->delete('works');
        
    }
    
    function trash_details($id)
    {
        //$data22['is_drafted'] = '1';
        $data22['is_deleted'] = '1';
        $update_account=$this->db->where('id',$id)->update('messages',$data22);
    } 
    
    function update_view($id)
    {
        $data22 = array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('*')->where('id', $id)->get('messages')->row_array();
        
            if($rs['to_user_id'] == $usd['id'])
            {       
            $data22['is_viewed'] = '1';
            $data22['is_marked'] = '1';
            $update_account=$this->db->where('id',$id)->update('messages',$data22);
            }
            if($rs['from_user_id'] == $usd['id'])
            {       
            $data22['is_from_viewed'] = '1';
            $data22['is_marked'] = '1';
            $update_account=$this->db->where('id',$id)->update('messages',$data22);
            }
        
        
    } 
    
    function update_notify_view($notifyid)
    {
        //$data22['is_drafted'] = '1';
        foreach($notifyid as $each=>$details){
            foreach($details as $detailsid){
                $data22['is_notified'] = '1';
                $update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                }
       } 
        
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->where('pitchit_id','')->where('is_notified','0')->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return count($data);     
        
    }
    
    function update_notify_pithmsg_view($notifyid)
    {
        //$data22['is_drafted'] = '1';
        foreach($notifyid as $each=>$details){
            foreach($details as $detailsid){
                $data22['is_notified'] = '1';
                $update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                }
       } 
        
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('to_user_id', $usd['id'])->where('is_pitchited', "1")->where('pitchit_id !=', '')->where('is_notified', "0")->get('messages')->row_array(); 
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        //return count($data);     
        
        echo $data['count'];
    }
    
  
  function update_pitchit_view_19($pitid)
    {
        //$data22['is_drafted'] = '1';
        $data22=array();
        $data32=array();
        $usd = $this->session->userdata('logged_user');
        
        $rs  = $this->db->select('s.pit_id as pid,s.wid as pwid,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.pit_id = a.pitchit_id' ,'left')->where('a.pitchit_id',NULL)->where('a.user_id',$usd['id'])->order_by('s.created_date','desc')->get()->result_array();
        
        
        return ($this->db->last_query());     
        
    }
    
    function update_pitchit_view($pitid)
    {
        //$data22['is_drafted'] = '1';
        $data22=array();
        $data32=array();
        $data44 = array();
        $temp = array();
        
        $count_view = array();
        
        $usd = $this->session->userdata('logged_user');
        
       //$rs  = $this->db->select('s.*')->from('work_pitchits as s')->where('s.pit_id NOT IN (select pitchit_id from `pitchit_view`)', NULL, FALSE)->where('pitchit_view.user_id', $usd['id'])->order_by('s.created_date','desc')->get();
       
    $row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->get();
      //die;
      
      //echo $row44->num_rows();die;
      
      if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
      foreach($data44 as $each=>$row_value){   
       
       $rsw=$this->db->select('pitchit_id')->where('user_id',$usd['id'])->get('pitchit_view')->result_array();
            foreach($rsw as $key=>$each){
                $temp[] = $each['pitchit_id'];   //array_push($temp, $each['pitchit_id'])
            }
    
      if(!empty($temp))
      {
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where_not_in('s.pit_id', $temp)->where('s.wid',$row_value['wid'])->order_by('s.created_date','desc')->get();
      
           if($rs->num_rows() == 0)
           {
            
            $rst  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where_not_in('p.pit_id', $temp)->where('s.user_id',$usd['id'])->get();
            
            if($rst->num_rows() > 0){
            $data = $rst->result_array();
        
            foreach($data as $detailsid){
                  
                    
                        $data22['user_id'] = $usd['id'];
                        $data22['wid'] = $detailsid['wid'];
                        $data22['pitchit_id'] = $detailsid['pit_id'];
                        $data22['view'] = '1';
                        $data22['date']  = date("Y-m-d h:i:s");
                        //$update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                        $this->db->insert('pitchit_view', $data22);
                        
                    //return ($this->db->last_query()); 
                        
                 }
         
              }
            
           }
      
      }
      else
      {
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where('s.wid',$row_value['wid'])->order_by('s.created_date','desc')->get(); 
      
        //$rs  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where_not_in('p.pit_id', $temp)->where('s.user_id',$usd['id'])->get();
        
            if($rs->num_rows() == 0)
           {
            
            $rst  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where('s.user_id',$usd['id'])->get();
            
            if($rst->num_rows() > 0){
            $data = $rst->result_array();
        
            foreach($data as $detailsid){
                  
                    
                        $data22['user_id'] = $usd['id'];
                        $data22['wid'] = $detailsid['wid'];
                        $data22['pitchit_id'] = $detailsid['pit_id'];
                        $data22['view'] = '1';
                        $data22['date']  = date("Y-m-d h:i:s");
                        //$update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                        $this->db->insert('pitchit_view', $data22);
                        
                        ///return ($this->db->last_query()); 
                        
                 }
         
              }
            
           }
     
    }   
       
      if($rs->num_rows() > 0){
        $data = $rs->result_array();
        
            foreach($data as $detailsid){
                  
                    
                        $data22['user_id'] = $usd['id'];
                        $data22['wid'] = $detailsid['wid'];
                        $data22['pitchit_id'] = $detailsid['pit_id'];
                        $data22['view'] = '1';
                        //$update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                        $this->db->insert('pitchit_view', $data22);
                        
                        ///return ($this->db->last_query()); 
                        
            }
         
         }
        
       }
      }
      
        
         //$data=array();y
         $usd = $this->session->userdata('logged_user');
         $rs_pit=$this->db->select('*')->where('wid',$pitid)->get('work_pitchits')->result_array();
         $rs_pit_view=$this->db->select('*')->where('user_id',$usd['id'])->where('wid',$pitid)->get('pitchit_view')->result_array();
         //die;
        $data_cnt = count($rs_pit) - count($rs_pit_view);
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data_cnt;   
        
    }   
    
    function mailCount(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('is_marked', '0')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->order_by('created','desc')->get('messages');
         
         //$rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('is_viewed', '0')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->or_where('is_marked', '0')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->order_by('created','desc')->get('messages');
         
         
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
    function pitchitCount(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->where('is_marked', '0')->where('to_user_id', $usd['id'])->where('is_pitchited', '1')->order_by('created','desc')->get('messages');

        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data[0]['count'];               
    
    }
    
   function get_save_search_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('count(*) as count')->where('user_id', $usd['id'])->get('saved_searches')->row_array();
        //die;
        
        return $data;               
    
    } 
    
   function mailInfo($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->order_by('id','desc')->where('to_user_id', $usd['id'])->where('is_pitchited !=', '1')->limit($limit,$offset)->get('messages');
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['type'] = $row['user_type'];
                }
                else
                {
                 $data[$each]['type'] = '';   
                }
                
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
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
    
    function pitchitInbox($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_moved', '0')->order_by('id','desc')->where('to_user_id', $usd['id'])->where('is_pitchited', "1")->limit($limit,$offset)->get('messages');
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['type'] = $row['user_type'];
                }
                else
                {
                 $data[$each]['type'] = '';   
                }
                
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
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
    
    function pitchitInbox_limit3(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('messages.*,works.id as worksid,works.asset_id')->from('messages')->join('works','works.id = messages.wid','left')->where('messages.is_deleted !=', '1')->where('messages.is_drafted', '0')->where('messages.is_moved', '0')->order_by('messages.created','desc')->where('messages.to_user_id', $usd['id'])->where('messages.is_pitchited', "1")->limit(3)->get();
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['first'] = '';   
                }
                if(!empty($row['name_middle']))
                {
                $data[$each]['middle'] = $row['name_middle'];
                }
                else
                {
                 $data[$each]['middle'] = '';   
                }
                if(!empty($row['name_last']))
                {
                $data[$each]['last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['last'] = '';   
                }
                
                if(!empty($row['user_type']))
                {
                $data[$each]['type'] = $row['user_type'];
                }
                else
                {
                 $data[$each]['type'] = '';   
                }
                
                $row22=$this->db->select('id,description,filename')->where('id',$value['asset_id'])->where('description','cover')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['cover_image'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['cover_image'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
   function sentMailInfo($offset=0,$limit=15){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('id','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
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
                
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
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
    
   function trashMailInfo($offset=0,$limit=15){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->where('is_deleted !=', '0')->where('from_user_id', $usd['id'])->or_where('to_user_id', $usd['id'])->where('is_deleted !=', '0')->order_by('created','desc')->get('messages');
          $rs  = $this->db->select('*')->where('(is_deleted', '1')->where('trash_deleted_2','0')->where('is_drafted','0')->where("to_user_id = '{$usd['id']}')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','0')->where('trash_deleted_1','0')->where("deleted_by_sender = '1')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','1')->where('trash_deleted_1','0')->where("is_deleted = '1')")->order_by('created','desc')->limit($limit,$offset)->get('messages');
         //die;
        
        //$this->db->limit($limit,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                //$row=$this->db->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
                $row=$this->db->select('id,name_first,name_middle,name_last,status_id')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
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
                
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
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
    
   function singleMailInfo($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   //$data  = $this->db->select('s.*, s.created msg_created,a.*')->from('messages as s')->join('users as a','a.id = s.to_user_id','inner')->where('s.id', $id)->where('a.status_id','1')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        
        $data  = $this->db->select('s.*,s.created msg_created,a.id as uid,a.name_first,a.name_middle,a.name_last,ast.description,ast.filename')->from('messages as s')->join('users as a','a.id = s.to_user_id','left')->join('assets as ast','ast.user_id = s.to_user_id','left')->where('s.id', $id)->where('a.status_id','1')->where('ast.description', 'profile')->get()->row_array();
        
         //echo $this->db->last_query();die;
        return $data;
                 
    
    } 
    
    function replymailInfo($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   $rs  = $this->db->select('s.*, s.created msg_created,a.id as uid,a.name_first,a.name_middle,a.name_last,ast.description,ast.filename')->from('messages as s')->join('users as a','a.id = s.to_user_id','left')->join('assets as ast','ast.user_id = s.to_user_id','left')->where('a.status_id','1')->where('ast.description', 'profile')->where('s.is_deleted', '0')->where('s.to_reply_id', $id)->where('a.status_id','1')->order_by('s.id','desc')->get();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
   
   function reply_to_user($id){
        $data=array();
         $usd = $this->session->userdata('logged_user');
   $data  = $this->db->select('*')->from('users')->where('users.id', $id)->where('users.status_id','1')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    } 
    
   function fromUser1($id){
        $data=array();
         $usd = $this->session->userdata('logged_user');
   $data  = $this->db->select('s.*,a.*,ast.description,ast.filename')->from('messages as s')->join('users as a','a.id = s.from_user_id','left')->join('assets as ast','ast.user_id = s.from_user_id','left')->where('s.id', $id)->where('a.status_id','1')->where('ast.description', 'profile')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    }
    
    function fromUser($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('id', $id)->get('messages');
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                
                if(!empty($row['name_last']))
                {
                $data[$each]['name_last'] = $row['name_last'];
                }
                else
                {
                 $data[$each]['name'] = '';   
                }
                
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
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
  /*function getCountDrafts()
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('COUNT(*) AS count')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data[0]['count']; 
	
    }  */
  function draftInfo($offset=0,$limit=15){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->or_where('to_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
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
                //$data[$each]['type']    = 'PROPERTY';
                $row22=$this->db->select('id,user_id,description,filename')->where('user_id',$value['to_user_id'])->where('description','profile')->get('assets')->row_array();
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
    function draftCount()
    {
    	 $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('count(*) as count')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->or_where('to_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages')->row_array();
         
         //echo $this->db->last_query();die;
         
         return $rs['count'];
        
    }
   function getFolderName($id,$folder_new){

   	     //echo $id; exit;
         $data=array();
	 if($folder_new=='folder')
	 {
	       $rs  = $this->db->select('name')->where('id', $id)->get('folders');
	   //echo $this->db->last_query();die;
	 
	   if($rs->num_rows() > 0){
	       $data   = $rs->row_array(); 
	   }          
	   $rs->free_result();
	 }
	 else
	 {
	    $rs  = $this->db->select('name')->where('id', $id)->get('pitchits_folder');
	   //echo $this->db->last_query();die;
	 
	   if($rs->num_rows() > 0){
	       $data   = $rs->row_array(); 
	   }          
	   $rs->free_result();
	 }
       
        return $data['name'];               
    
    }   
  function folderInfo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_id', $usd['id'])->where('is_deleted', '0')->get('folders');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['uname'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['uname'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }    
    
    function pitchitInfo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_id', $usd['id'])->where('is_deleted', '0')->get('pitchits_folder');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['uname'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['uname'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
    
function mark_msg($msg_type,$id,$offset=0,$limit=15)
{
        $data22   = array();
        $data22['is_marked']    = '1';
        foreach($id as $each=>$value){
            $update_account=$this->db->where('id',$value)->update('messages',$data22);
        }
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        if($msg_type == "inbox"){
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited !=', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }else{
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }
        //$rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['time'] = $time;
		$data[$each]['date'] = date('m/d/Y',strtotime($details['created']));
                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
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
	return $data;
}   
function delete_folder($msg_type, $id)
{
	
	if($id > 0)
	{
            $data22['is_deleted'] = "1";
            if($msg_type == "folder"){
                $msg_qry    = $this->db->select('message_id')->where('folder_id',$id)->get('message_folders')->result_array();
                $update=$this->db->where('id',$id)->update('folders',$data22);
            }else{
                $msg_qry    = $this->db->select('message_id')->where('pitchit_id',$id)->get('message_pitchits')->result_array();
                $update=$this->db->where('id',$id)->update('pitchits_folder',$data22);
            }
            
            $msg_array['is_moved'] = '0';
            foreach($msg_qry as $msg_row){
                $this->db->where('id', $msg_row['message_id'])->update("messages", $msg_array);
            }
            
            
            
            $data['status'] = "1";
	}
	else
	{
		$data['status'] = "0";
	}
	return $data;
}
function undelete_msg($id,$offset=0,$limit=15)
{
        $data22   = array();
        //$data22['is_deleted']    = '0';
        $usd = $this->session->userdata('logged_user');
        foreach($id as $each=>$value){
        	$msg = array();
        	$msg =  $this->db->select('from_user_id,to_user_id,is_drafted')->where('id', $value)->get('messages')->row_array();
        	//print_r($msg);
                $data22 = array();
                if($msg['to_user_id'] == $usd['id'])
                {
                	$data22['is_deleted']    = '0';
                }
                if($msg['from_user_id'] == $usd['id'])
                {
                	$data22['deleted_by_sender']    = '0';
                }
                if($msg['from_user_id'] == $usd['id'] && $msg['is_drafted'] == "1")
                {
                	$data22['is_deleted']    = '0';
                }
                //print_r($data22);
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                $update_account=$this->db->where('to_reply_id',$value)->update('messages',$data22);
            }
           
            
        
        
        $data=array();
         
          $rs  = $this->db->select('*')->where('(is_deleted', '1')->where('trash_deleted_2','0')->where('is_drafted','0')->where("to_user_id = '{$usd['id']}')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','0')->where('trash_deleted_1','0')->where("deleted_by_sender = '1')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','1')->where('trash_deleted_1','0')->where("is_deleted = '1')")->order_by('created','desc')->limit($limit,$offset)->get('messages');
         //$rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['time'] = $time;
		$data[$each]['date'] = date('m/d/Y',strtotime($details['created']));
                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
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
	return $data;
}    
function unmark_msg($msg_type,$id,$offset=0,$limit=15)
{
        $data22   = array();
        $data22['is_marked']    = '0';
        foreach($id as $each=>$value){
            $update_account=$this->db->where('id',$value)->update('messages',$data22);
        }
        
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        if($msg_type == "inbox"){
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited !=', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }else{
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }
        //$rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['time'] = $time;
		$data[$each]['date'] = date('m/d/Y',strtotime($details['created']));
                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
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
	return $data;
}    
 function delete_msg($msg_type, $id,$offset=0,$limit=15)
    {
        //$offset = 0;
        //$limit = 2;
        $data22   = array();
        $data22['is_deleted']    = '1';
        foreach($id as $each=>$value){
            $update_account=$this->db->where('id',$value)->update('messages',$data22);
        }
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        if($msg_type == "inbox"){
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited !=', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }else{
            $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_pitchited', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        }
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['time'] = $time;
		$data[$each]['date'] = date('m/d/Y',strtotime($s));
                
                $row=$this->db->select('*')->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = ''; 
                 $data[$each]['name_first'] = '';  
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                /*?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img">
                                            <?php if(!empty($row22['filename'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['from_user_id']?>/profile/<?=$row22['filename']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?>
                                            </span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $data[$each]['name']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php */
             }
        }        
        $rs->free_result();
          
         return $data;

    }
    
    function editpitchit($id,$pit)
    {
        //$offset = 0;
        //$limit = 2;
        $data22   = array();
        $data22['pitchit']    = $pit;
        
            $update_account=$this->db->where('pit_id',$id)->update('work_pitchits',$data22);
       
        //$hrt = $this->db->last_query();
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        
        $rs  = $this->db->select('pitchit')->where('pit_id', $id)->get('work_pitchits');
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        
         }        
        $rs->free_result();
          
         return $data;

    }
    
    function dopitchit($id,$pit,$wid)
    {
        $usd = $this->session->userdata('logged_user');
        //$offset = 0;
        //$limit = 2;
        $data22   = array();
        $data22['pitchit']    = $pit;
        $data22['is_drafted']    = '0';
        $data22['is_pitchit']    = '1';
        
            $update_account=$this->db->where('pit_id',$id)->update('work_pitchits',$data22);
         
        $data33   = array();   
       //$data['user_id']           = $usd['id'];
       $data33['is_pitchited']      = '1';
       $this->db->where('user_id',$usd['id'])->where('id',$wid)->update('works',$data33);
        //$hrt = $this->db->last_query();
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        
        $rs  = $this->db->select('pitchit')->where('pit_id', $id)->get('work_pitchits');
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        
         }        
        $rs->free_result();
          
         return $data;

    }
    
    function doCreatePitchit($id,$pitch,$pubid)
    {
        $usd = $this->session->userdata('logged_user');
        $data   = array();
        $data22 = array();
        $data33 = array();
        
        if($pitch != '')
                {
                $data['user_id']           = $usd['id'];
                $data['is_pitchited']      = '1';
                $this->db->where('user_id',$usd['id'])->where('id',$id)->update('works',$data);
                    //die;
               
                $data22['user_id']           = $usd['id'];
                $data22['wid']               = $id;
                $data22['pitchit']           = $pitch;
                $data22['created_date']    = date("Y-m-d h:i:s");
                $data22['is_pitchit']      = '1';
                $data22['is_drafted']      = '0';
                $this->db->insert('work_pitchits', $data22); 
                //die; 
                
                //$row=$this->db->select('id')->where('user_type','2')->get('users')->result_array();
                $row  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->where('s.wid', $id)->get();
               //die;
                 //echo '<pre/>'; print_r($row);die;    
                    /*foreach($row as $key=>$user_publisher)
                    {
                       $temp[] = $user_publisher['id']; 
                    }
                    $trmp = implode(',',$temp);*/
               if($row->num_rows() > 0)
               {  
                    $row33   = $row->result_array();
                    foreach($row33 as $user_publisher)
                    {   
                    $data33['from_user_id']          = $usd['id'];
                    $data33['to_user_id']            = $user_publisher['user_id'];
                    $data33['wid']                   = $id;
                    $data33['subject']               = 'Pitchit!';
                    $data33['body']                  = $pitch;
                    //$data33['body']                  = base_url().'home/view_pitchit/'.$id;
                    $data33['created']               = date("Y-m-d h:i:s");
                    $data33['is_pitchited']          = '1';
                    $this->db->insert('messages', $data33); 
                    }   
                   
                    return 1;
                }
                
               $str1 = $pubid;
       		
            //$str1 = explode(',',$str);
                if(!empty($str1))
                {
                    foreach($str1 as $cc)
                    {
                        $data43['from_user_id']          = $usd['id'];
                        $data43['to_user_id']            = $cc;
                        $data43['wid']                   = $id;
                        $data43['subject']               = 'Pitchit!';
                        $data43['body']                  = $pitch;
                        //$data43['body']                  = base_url().'home/view_pitchit/'.$id;
                        $data43['created']               = date("Y-m-d h:i:s");
                        $data43['is_pitchited']          = '1';
                        $this->db->insert('messages', $data43);  
                    }
                } 
               
               echo '1';
                
            }

    }
    
    
   function doSavePitchit($id,$pitch,$pubid)
    {
        $usd = $this->session->userdata('logged_user');
        $data   = array();
        $data22 = array();
        $data33 = array();
        
        if($pitch != '')
                {
                //$data['user_id']           = $usd['id'];
                //$data['is_pitchited']      = '1';
                //$this->db->where('user_id',$usd['id'])->where('id',$id)->update('works',$data);
                    //die;
               
                $data22['user_id']           = $usd['id'];
                $data22['wid']               = $id;
                $data22['pitchit']           = $pitch;
                $data22['created_date']      = date("Y-m-d h:i:s");
                //$data22['is_pitchit']        = '1';
                $data22['is_drafted']        = '1';
                $this->db->insert('work_pitchits', $data22); 
               
               
               $rs  = $this->db->select('count(*) as count,s.*,a.title,a.id')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '1')->get()->row_array();
               
               echo '1'.'~'.$rs['count'];
                
            }

    } 
    
     function delPitchit($id)
    {
        
        $rs22  = $this->db->select('pitchit,wid')->where('pit_id', $id)->get('work_pitchits')->row_array();
        
        $data23   = array();
        //$data22['pitchit']    = $pit;
        $data23['is_pitchited']    = '0';
        
        $update_account=$this->db->where('id',$rs22['wid'])->update('works',$data23);
        
           $this->db->where('pit_id',$id)->delete('work_pitchits');
       
        //$hrt = $this->db->last_query();
        
        $data=array();
        $usd = $this->session->userdata('logged_user');
        
        $rs  = $this->db->select('pitchit')->where('pit_id', $id)->get('work_pitchits');
        
        $data22   = array();
        $data22['pitchit']    = $pit;
        $data22['is_drafted']    = '0';
        
            $update_account=$this->db->where('pit_id',$id)->update('work_pitchits',$data22);
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        
         }        
        $rs->free_result();
          
         return $data;

    }
    
    
    function delete_folder_msg($id,$foldid,$offset=0,$limit=15)
    {
        //$offset = 0;
        //$limit = 2;
        $data22   = array();
        $data22['is_deleted']    = '1';
        foreach($id as $each=>$value){
                
                //$update_folder=$this->db->where('message_id',$value)->where('folder_id',$foldid)->update('message_folders',$data22);
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('s.*')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->limit($limit,$offset)->get();
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['time'] = $time;
		$data[$each]['date'] = date('m/d/Y',strtotime($s));
                
                $row=$this->db->select('*')->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                $data[$each]['name_first'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = ''; 
                 $data[$each]['name_first'] = '';  
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
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
          
         return $data;

    }
   function search_msg($search)
    {
       
        $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->like('subject', $search)->order_by('created','desc')->get('messages');
         $rs  = $this->db->select('*')->like('subject', $search)->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img">
                                            
                                            <?php if(!empty($row22['filename'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['from_user_id']?>/profile/<?=$row22['filename']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?>
                                            
                                            </span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <!--<a href="#info" rel="facebox"><img src="<?//=base_url()?>images/attachment_icon.png" alt="" /></a>-->
                                            <?php if(!empty($details['attach_file'])) {?>  
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
                                            <a href="#" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a>
         
                                            <?php } ?> 
                                            </span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <?php if(!empty($details['attach_file'])) {?>  
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
                                             <a href="#" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a>
                                             
                                             <?php } ?> 
                                            </span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    } 
    
    function search_draft_msg($search)
    {
       
        $data=array();
         $usd = $this->session->userdata('logged_user');
         
         $rs  = $this->db->select('*')->like('subject', $search)->where('to_user_id', $usd['id'])->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    }   
    
  function search_sent_msg($search)
    {
       
        $data=array();
         $usd = $this->session->userdata('logged_user');
         
         $rs  = $this->db->select('*')->like('subject', $search)->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img">
                                            
                                            <?php if(!empty($row22['filename'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['from_user_id']?>/profile/<?=$row22['filename']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?>
                                            
                                            </span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    } 
    
   function search_trash_msg($search)
    {
       
        $data=array();
         $usd = $this->session->userdata('logged_user');
         
         $rs  = $this->db->select('*')->like('subject', $search)->where('is_deleted !=', '0')->where('from_user_id', $usd['id'])->or_where('to_user_id', $usd['id'])->where('is_deleted !=', '0')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php //echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php //echo $key ?>" data-keycheck="<?php //echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img">
                                            
                                            <?php if(!empty($row22['filename'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['from_user_id']?>/profile/<?=$row22['filename']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?>
                                            
                                            </span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    }    
      
    
    function delete_draft_msg($id,$offset=0,$limit=15)
    {
        $data22   = array();
        $data22['is_deleted']    = '1';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->or_where('to_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		 $data[$each]['date'] = date('m/d/Y',strtotime($s));
                
                $row=$this->db->select('id,name_first,name_middle,name_last,user_type')->where('id',$details['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = '';   
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
                
                $row22=$this->db->select('id,user_id,description,filename')->where('user_id',$details['to_user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                
               
                //$data[$each]['type']    = 'PROPERTY';
                /*?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php */
             }
        }        
        $rs->free_result();
          
    
	return $data;
    }
    function sentMailCount()
    {
    	 $data=array();
         $usd = $this->session->userdata('logged_user');
        // $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_viewed', '0')->where('from_user_id', $usd['id'])->order_by('created','desc')->get('messages');
        $rs  = $this->db->select('count(*) as count')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data[0]['count'];               
    }
    function trashMailCount()
    {
    	 $data=array();
         $usd = $this->session->userdata('logged_user');
        // $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_viewed', '0')->where('from_user_id', $usd['id'])->order_by('created','desc')->get('messages');
       $rs  = $this->db->select('count(*) as count')->where('(is_deleted', '1')->where('trash_deleted_2','0')->where('is_drafted','0')->where("to_user_id = '{$usd['id']}')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','0')->where('trash_deleted_1','0')->where("deleted_by_sender = '1')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','1')->where('trash_deleted_1','0')->where("is_deleted = '1')")->order_by('created','desc')->get('messages');
       
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data[0]['count'];          
    	
    }
   function delete_sentmail_msg($id,$offset=0,$limit=15)
    {
        $data22   = array();
        //$data22['is_deleted']    = '2';
        $data22['deleted_by_sender']    = '1';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                //die;
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		$data[$each]['date'] = date('m/d/Y',strtotime($s));
                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
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
          
     return $data;

    }
    
  function delete_trash_msg($id,$offset=0,$limit=15)
    {
        $data22   = array();
        $data22['trash_deleted_1']    = '1';
        $usd = $this->session->userdata('logged_user');
        foreach($id as $each=>$value){
                
                
                $msg = array();
        	$msg =  $this->db->select('from_user_id,to_user_id,is_drafted')->where('id', $value)->get('messages')->row_array();
        	//print_r($msg);
                $data22 = array();
                if($msg['to_user_id'] == $usd['id'])
                {
                	$data22['trash_deleted_2']    = '1';
                }
                if($msg['from_user_id'] == $usd['id'])
                {
                	$data22['trash_deleted_1']    = '1';
                }
                if($msg['from_user_id'] == $usd['id'] && $msg['is_drafted'] == "1")
                {
                	$data22['trash_deleted_1']    = '1';
                }
                //print_r($data22);
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                //$this->db->where('id',$value)->delete('messages');
                //die;
            }
        
        
        $data=array();
         
         //$rs  = $this->db->select('*')->where('is_deleted !=', '0')->where('from_user_id', $usd['id'])->or_where('to_user_id', $usd['id'])->where('is_deleted !=', '0')->order_by('created','desc')->get('messages');
       $rs  = $this->db->select('*')->where('(is_deleted', '1')->where('trash_deleted_2','0')->where('is_drafted','0')->where("to_user_id = '{$usd['id']}')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','0')->where('trash_deleted_1','0')->where("deleted_by_sender = '1')")->or_where('(from_user_id', $usd['id'])->where('is_drafted','1')->where('trash_deleted_1','0')->where("is_deleted = '1')")->order_by('created','desc')->limit($limit,$offset)->get('messages');
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                $row22=$this->db->where('user_id',$details['from_user_id'])->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['photo'] = $row22['filename'];
                }
                else
                {
                 $data[$each]['photo'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                /*?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php */
             }
        }        
        $rs->free_result();
          
        return $data;

    }
    
    
   function move_trash_msg($id,$revice_id)
    {
        $data22   = array();
        $usd = $this->session->userdata('logged_user');
        $data22['is_deleted']    = '0';
        $data22['to_user_id']    = $usd['id'];
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                //$this->db->where('id',$value)->delete('messages');
                //die;
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_deleted !=', '0')->where('from_user_id', $usd['id'])->or_where('to_user_id', $usd['id'])->where('is_deleted !=', '0')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    }
    
  function move_draft_msg($id)
    {
        $data22   = array();
        $data22['is_deleted']    = '0';
        $data22['is_drafted']    = '0';
        //$data22['is_inboxed']    = '0';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                //$this->db->where('id',$value)->delete('messages');
                //die;
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');

                
                $row=$this->db->where('id',$details['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:20px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $row['name_first']?></span>
                                                <span class="for_mob_time">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>
                                            <span class="soph_con1"><?php echo $time?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
           
         
             
         <?php 
             }
        }        
        $rs->free_result();
          
    

    }     
    
  function folder_msg($id,$foldid,$foldname)
    {
        $data22   = array();
        $usd = $this->session->userdata('logged_user');
        //print_r($id);die;
        $data['exists'] = "";
        $data['success'] = "";
        foreach($id as $value){
            
            $rs  = $this->db->select('*')->where('user_id', $usd['id'])->where('folder_id', $foldid)->where('message_id', $value)->get('message_folders');
            //die;
            if($rs->num_rows() > 0){
            		$data['exists'] = $foldname;
               
                }
              else{
                //$data   = $rs->result_array();
                $rs  = $this->db->select('id')->where('user_id', $usd['id'])->where('message_id', $value)->get('message_folders');
                if($rs->num_rows() > 0){
                	$d = $rs->row_array();                
                	$data22['folder_id']    = $foldid;
                	$this->db->where('id',$d['id'])->update('message_folders', $data22);
                        
                }
                else
                {
		        $maxid  = $this->db->select_max('id')->get('message_folders')->row_array();
		        //die;
		        $mid = $maxid['id']+1;
		        $data22['id'] = $mid;
		        
		        $data22['user_id']    = $usd['id'];
		        $data22['folder_id']    = $foldid;
		        $data22['message_id']    = $value;
		        $data22['created']     = date("Y-m-d h:i:s");
                        $this->db->insert('message_folders', $data22);
                        //die;
                        
                }
                $msg_array['is_moved'] = '1';
                $this->db->where('id', $value)->update("messages", $msg_array);
                $data['success'] = $foldname;
                
              }
       
      }
      return $data; 
    
    }
    
    function pitchit_msg($id,$foldid,$foldname)
    {
        $data22   = array();
        $usd = $this->session->userdata('logged_user');
        //print_r($id);die;
        $data['exists'] = "";
        $data['success'] = "";
        foreach($id as $value){
            
            $rs  = $this->db->select('*')->where('user_id', $usd['id'])->where('pitchit_id', $foldid)->where('message_id', $value)->get('message_pitchits');
            //die;
            if($rs->num_rows() > 0){
            		$data['exists'] = $foldname;
               
                }
              else{
                //$data   = $rs->result_array();
                $rs  = $this->db->select('id')->where('user_id', $usd['id'])->where('message_id', $value)->get('message_pitchits');
                if($rs->num_rows() > 0){
                	$d = $rs->row_array();                
                	$data22['pitchit_id']    = $foldid;
                	$this->db->where('id',$d['id'])->update('message_pitchits', $data22);
                        
                }
                else
                {
		        $maxid  = $this->db->select_max('id')->get('message_pitchits')->row_array();
		        //die;
		        $mid = $maxid['id']+1;
		        $data22['id'] = $mid;
		        
		        $data22['user_id']    = $usd['id'];
		        $data22['pitchit_id']    = $foldid;
		        $data22['message_id']    = $value;
		        $data22['created']     = date("Y-m-d h:i:s");
                        $this->db->insert('message_pitchits', $data22);
                        //die;
                        
                }
                $msg_array['is_moved'] = '1';
                $this->db->where('id', $value)->update("messages", $msg_array);
                $data['success'] = $foldname;
                
              }
       
      }
      return $data; 
    
    }
    
    function getCountMails()
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('count(*) as count')->where('to_user_id',$usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data[0]['count']; 
	
    }
    
   function folder_msg_cnt_usr($id)
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('count(*) as count')->from('message_folders')->join('messages','messages.id = message_folders.message_id','inner')->where('message_folders.user_id',$usd['id'])->where('message_folders.folder_id',$id)->where('message_folders.is_deleted','0')->where('messages.is_deleted','0')->get();
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data[0]['count']; 
	
    }
    
    function pitchit_msg_cnt_usr($id)
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('count(*) as count')->from('message_pitchits')->join('messages','messages.id = message_pitchits.message_id','inner')->where('message_pitchits.user_id',$usd['id'])->where('message_pitchits.pitchit_id',$id)->where('message_pitchits.is_deleted','0')->where('messages.is_deleted','0')->get();
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data[0]['count']; 
	
    }
    
    function folderMailInfo($msg_type, $foldid,$offset=0,$limit=15){
        $data=array();
        $usd = $this->session->userdata('logged_user');
         
        if($msg_type == "folder"){
            $r = $this->db->select('*')->from('folders')->where('id', $foldid)->where('is_deleted','0')->get()->row_array();
            $rs  = $this->db->select('s.*,s.id as message_id')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->limit($limit,$offset)->get();
        }else{
            $r = $this->db->select('*')->from('pitchits_folder')->where('id', $foldid)->where('is_deleted','0')->get()->row_array();
            $rs  = $this->db->select('s.*,s.id as message_id')->from('messages as s')->join('message_pitchits as a','s.id = a.message_id','inner')->where('a.pitchit_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->limit($limit,$offset)->get();
        }
        //if(count($r) <= 0)
        //{
        //    redirect('home/inbox', 'refresh'); exit;
        //}
        //$rs  = $this->db->select('s.*,a.*')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->limit($limit,$offset)->get();
        //////$rs  = $this->db->select('s.*,s.id as message_id')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->limit($limit,$offset)->get();
        //die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                $row=$this->db->where('id',$value['from_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
                }
                //$data[$each]['type']    = 'PROPERTY';
                $row22=$this->db->where('user_id',$value['from_user_id'])->get('assets')->row_array();
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
    
    public function getAuthorList($length = 10,$offset = 0)
    {
    	
        return $data    = $this->db->select('id,email,name_first,name_middle,name_last')->where('user_type','1')->where('status_id','1')->limit($length,$offset)->get('users')->result_array();
    }   
    public function getAuthorCount()
    {
    	$data = $this->db->select('Count(*) as count')->where('user_type','1')->where('status_id','1')->get('users')->result_array();
    	//return $data = $this->db->count_all('users')->where('user_type','1')->result_array();
    	return $data[0]['count'];
    }
    public function getAuthorByAlphabet($alphabet,$length = 20,$offset = 0)
    {
    	
        return $data    = $this->db->select('id,email,name_first,name_middle,name_last')->like('name_first', $alphabet, 'after')->where('user_type','1')->where('status_id','1')->limit($length,$offset)->get('users')->result_array();
    }   
    public function getAuthorCountByAlphabet($alphabet)
    {
    	$data = $this->db->select('Count(*) as count')->like('name_first', $alphabet, 'after')->where('user_type','1')->where('status_id','1')->where('status_id','1')->get('users')->result_array();
    	//return $data = $this->db->count_all('users')->where('user_type','1')->result_array();
    	return $data[0]['count'];
    } 
	
   
    function checkMailExist($email)
    {
    	$ret['status'] = "0";
    	if($email != "")
        {
        	$row=$this->db->select('*')->where('email',$email)->where('status_id != ', "4")->get('users');
		if($row->num_rows() > 0)
		{
			$data = $row->row_array();
			
			if($data['user_type'] == "1")
			{
				 $usd = $this->session->userdata('logged_user');
				$address = $this->db->select("count(*) as count")->where('user_id',$usd['id'])->where('address_user_id',$data['id'])->get('author_address_books')->row_array();
				if($address['count'] <= 0)
				{
					$d['user_id'] = $usd['id'];
					$d['address_user_id'] = $data['id'];
					$d['is_deleted'] = "0";
					$d['status'] = "1";
					$this->db->insert("author_address_books",$d);
				}
				
				if($data['status_id'] == "1")
				{
					$ret['user_type'] = "1";
				}
				else
				{
					$ret['user_type'] = "3";
				}
				
			}
			if($data['user_type'] == "2")
			{
				$ret['user_type'] = "2";
			}
			$ret['status'] = "1";
		}
		
        }
        return $ret;
    }
    function saveInvite($email,$name)
    {
    	$usd = $this->session->userdata('logged_user');
    	$data['user_id'] = $usd['id'];
    	$data['friend_name'] = $name;
    	$data['friend_email'] = $email;
    	$data['created'] =  date("Y-m-d h:i:s");
    	$data['is_deleted'] = "0";
    	$data['status'] = "1";
    	$this->db->insert('invites', $data);
    	$last_id=$this->db->insert_id();
    	return $last_id;
    }
   public function getAuthorInviteList($length = 10,$offset = 0)
    {
    	$usd = $this->session->userdata('logged_user');
        $data    = $this->db->select('users.id,users.email,users.name_first,users.name_middle,users.name_last')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->limit($length,$offset)->get()->result_array();
        
        return $data;
        
    }   
    public function getAuthorInviteCount()
    {
    	$usd = $this->session->userdata('logged_user');
    	$data = $this->db->select('Count(*) as count')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->get()->result_array();
    	//return $data = $this->db->count_all('users')->where('user_type','1')->result_array();
    	return $data[0]['count'];
    }

    public function getAuthorInviteByAlphabet($alphabet,$length = 20,$offset = 0)
    {
    	$usd = $this->session->userdata('logged_user');
        return $data    = $this->db->select('users.id,users.email,users.name_first,users.name_middle,users.name_last')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->like('users.name_first', $alphabet, 'after')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->limit($length,$offset)->get()->result_array();
    }   
    public function getAuthorCountInviteByAlphabet($alphabet)
    {
	$usd = $this->session->userdata('logged_user');
    	$data = $this->db->select('Count(*) as count')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->like('users.name_first', $alphabet, 'after')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->get()->result_array();
	//die;
    	//return $data = $this->db->count_all('use rs')->where('user_type','1')->result_array();
    	return $data[0]['count'];
    } 
	public function getAuthorInviteAllCount()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('Count(*) as count')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->get()->result_array();
		
	    	//return $data = $this->db->count_all('users')->where('user_type','1')->result_array();
	    	return $data[0]['count'];
	}

	public function getUserDetails($uid,$search)
	{
		$rs = $this->db->select('id,email,name_first,name_middle,name_last')->like('name_first', $search,'after')->where('id',$uid)->get('users');
		if($rs->num_rows() > 0){
		$data = $this->db->select('id,email,name_first,name_middle,name_last')->like('name_first', $search,'after')->where('id',$uid)->get('users')->result_array();
		} else {
			$data = 1;
		}
		return $data;
	}
	public function search_authors($search)
	{
		$data = $this->db->select('id,email,name_first,name_middle,name_last')->like('name_first', $search,'after')->where('status_id','1')->where('user_type','1')->order_by('name_first','asc')->limit(10,0)->get('users')->result_array();
		
		return $data;
	}
	public function search_by_author($search)
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('users.id,users.email,users.name_first,users.name_middle,users.name_last')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->like('users.name_first', $search, 'after')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->limit(10,0)->get()->result_array();
		
		return $data;
	}
	public function getCountFolderMails($foldid, $msg_type)
	{
		$usd = $this->session->userdata('logged_user');
                if($msg_type == "folder"){
                    $rs  = $this->db->select('count(*) as count')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->get()->result_array();
                }else{
                    $rs  = $this->db->select('count(*) as count')->from('messages as s')->join('message_pitchits as a','s.id = a.message_id','inner')->where('a.pitchit_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->get()->result_array();
                }
		return $rs[0]['count'];
		
	}
    
   public function get_aep_male_percent()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'2')->where("gender",'1')->get()->row_array();
		
		return $data;
	} 
   
   public function get_aep_female_percent()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'2')->where("gender",'0')->get()->row_array();
		
		return $data;
	}
     
   public function get_aep_total()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'2')->get()->row_array();
		
		return $data;
	}      
	
    
  public function get_writer_male_percent()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'1')->where("gender",'1')->get()->row_array();
		
		return $data;
	} 
   
   public function get_writer_female_percent()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'1')->where("gender",'0')->get()->row_array();
		
		return $data;
	}
     
   public function get_writer_total()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('count(*) as count')->from("users")->where("status_id","1")->where("user_type",'1')->get()->row_array();
		
		return $data;
	}
    
    function get_user_view_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       //$rs  = $this->db->select('s.user_id,s.profile_id,s.view_date,a.id,a.name_first,a.name_middle,a.name_last,a.user_type')->from('view_profile as s')->join('users as a','a.id = s.user_id','inner')->where('s.profile_id', $usd['id'])->order_by('s.view_date','desc')->limit($limit,$offset)->get();
        
        $rs  = $this->db->select('*')->from('view_title')->where('wuid',$usd['id'])->order_by('created_date','desc')->limit($limit,$offset)->get();
       
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row25=$this->db->select('title')->where('id',$value['wid'])->get('works')->row_array();
                if(!empty($row25['title']))
                {
                $data[$each]['title'] = $row25['title'];
                
                }
                else
                {
                 $data[$each]['title'] = '';   
                }
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
                $row22=$this->db->select('user_id,description,filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['filename'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['filename'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;              
    
    }
    
   function get_user_download_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       $rs  = $this->db->select('s.user_id,s.download_user_id,s.wid,s.file_id,s.created_at,a.id,a.title')->from('view_downloaded_file as s')->join('works as a','a.id = s.wid','inner')->where('s.download_user_id', $usd['id'])->order_by('s.created_at','desc')->limit($limit,$offset)->get();
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   function get_user_search_details($offset=null,$limit=null){
    //echo $position;
    //echo $item_par_page;
    
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
       //$rs  = $this->db->select('s.user_id,s.wid,s.wuid,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->limit(12)->get();
       
       $rs  = $this->db->select('s.id as viewid ,s.user_id,s.wid,s.wuid,s.created_date,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->limit($limit,$offset)->order_by('s.id','desc')->get();
       
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
  function get_user_search_details_demo($position,$item_par_page){
    //echo $position;
    //echo $item_par_page;
    
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
       //$rs  = $this->db->select('s.user_id,s.wid,s.wuid,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->limit(12)->get();
       
       $rs  = $this->db->select('s.id as viewid ,s.user_id,s.wid,s.wuid,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->limit($item_par_page)->order_by('s.id','desc')->get();
       
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
  function get_user_search_details_total(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
       //$rs  = $this->db->select('s.user_id,s.wid,s.wuid,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->limit(12)->get();
       
       $data  = $this->db->select('s.id as viewid, s.user_id,s.wid,s.wuid,a.id,a.title')->from('view_search as s')->join('works as a','a.id = s.wid','inner')->where('s.wuid', $usd['id'])->order_by('s.id','desc')->get()->result_array();
       
       
        return $data;               
    
    }  
     
    
   function get_user_recently_add_titles($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       $now = date('Y-m-d');
       $date1 = str_replace('-', '/', $now);
       $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
       
       $beforedate = strtotime($now .' -1 months');
       $final=date('Y-m-d', $beforedate);
         
       //$rs  = $this->db->select('id,title,user_id,user_id,create_date')->from('works')->where('create_date >=' , $final)->where('create_date <=' , $tomorrow)->order_by('create_date','desc')->limit(15)->get();
       
       $rs  = $this->db->select('id,title,user_id,user_id,create_date')->from('works')->order_by('create_date','desc')->limit($limit,$offset)->get();
       
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
                $row22=$this->db->select('user_id,description,filename')->where('user_id',$value['user_id'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['filename'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['filename'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
  function get_user_recently_add_titles_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
         $now = date('Y-m-d');
         $date1 = str_replace('-', '/', $now);
         $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
       
         $beforedate = strtotime($now .' -1 months');
         $final=date('Y-m-d', $beforedate);
       
        //$data  = $this->db->select('count(*) as count')->from('works')->where('create_date >=' , $final)->where('create_date <=' , $tomorrow)->get()->row_array();
        $data  = $this->db->select('count(*) as count')->from('works')->limit(50)->get()->row_array();
        
        //echo "<pre>";print_r($data);echo "</pre>";die;
        ///die;
        return $data;               
    
    }
    
  function get_author_view_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
       
       //$rs  = $this->db->select('s.user_id,s.profile_id,s.view_date,a.id,a.name_first,a.name_middle,a.name_last,a.user_type')->from('view_profile as s')->join('users as a','a.id = s.profile_id','inner')->where('s.user_id', $usd['id'])->order_by('s.view_date','desc')->limit(10)->get();
       
       
       //$rs  = $this->db->select('*')->from('view_title')->where('user_id !=', $usd['id'])->order_by('created_date','desc')->limit(10)->get();
       $rs  = $this->db->select('*')->from('view_title')->where('user_id !=', $usd['id'])->where('is_profile_seen','0')->order_by('created_date','desc')->limit($limit,$offset)->get();
       
       //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row25=$this->db->select('title')->where('id',$value['wid'])->get('works')->row_array();
                if(!empty($row25['title']))
                {
                $data[$each]['title'] = $row25['title'];
                
                }
                else
                {
                 $data[$each]['title'] = '';   
                }
                
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['wuid'])->get('users')->row_array();
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
                $row22=$this->db->select('user_id,description,filename')->where('user_id',$value['wuid'])->where('description','profile')->get('assets')->row_array();
                if(!empty($row22['filename']))
                {
                $data[$each]['filename'] = $row22['filename'];
                
                }
                else
                {
                 $data[$each]['filename'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
                       
    
    } 
    
    function get_author_view_details_cnt(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
       $data  = $this->db->select('count(*) as count')->from('view_title')->where('user_id !=',$usd['id'])->where('is_profile_seen','0')->get()->row_array();
       
       //die;
       
      
        return $data;
                       
    
    }
    
    function get_author_view_details_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       $data  = $this->db->select('count(*) as count')->from('view_profile')->where('user_id', $usd['id'])->get()->row_array();
       
        return $data;               
    
    }
    
    function get_user_work_download_details($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       //$rs  = $this->db->select('s.user_id,s.download_user_id,s.wid,s.file_id,s.created_at,a.id,a.title')->from('view_downloaded_file as s')->join('works as a','a.id = s.wid','inner')->where('s.user_id', $usd['id'])->order_by('s.created_at','desc')->limit(10)->get();
       
       $rs  = $this->db->select('s.user_id,s.download_user_id,s.wid,s.file_id,s.created_at,a.id,a.title')->from('view_downloaded_file as s')->join('works as a','a.id = s.wid','inner')->where('s.user_id !=',$usd['id'])->order_by('s.created_at','desc')->limit($limit,$offset)->get();
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                //$row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['download_user_id'])->get('users')->row_array();
                $row=$this->db->select('name_first,name_middle,name_last,user_type')->where('id',$value['user_id'])->get('users')->row_array();
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
                
                if(!empty($row['user_type']))
                {
                $data[$each]['user_type'] = $row['user_type'];
                
                }
                else
                {
                 $data[$each]['user_type'] = '';   
                }
                
            }
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
  
  function get_downloads_details_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       //$data  = $this->db->select('count(*) as count')->from('view_downloaded_file')->where('user_id', $usd['id'])->get()->row_array();
       $data  = $this->db->select('count(*) as count')->from('view_downloaded_file')->where('user_id !=', $usd['id'])->get()->row_array();
       
        return $data;               
    
    }
    
    function get_user_popular_category_work(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       //$frt = 'SELECT `cid`, COUNT(`cid`) as CustomerRowCount FROM `work_categories` GROUP BY `cid` ORDER BY COUNT(`cid`) DESC LIMIT 3';
       
       $rs  = $this->db->select('s.cid,COUNT(`cid`) as catcount,a.id,a.category_name')->from('work_categories as s')->join('categories as a','a.id = s.cid','inner')->group_by('s.cid')->order_by('COUNT(`cid`)','desc')->limit(5)->get();
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
         
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    function get_user_popular_search_work(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         //$rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('pitchit_messages');
       
       //$frt = 'SELECT `cid`, COUNT(`cid`) as CustomerRowCount FROM `work_categories` GROUP BY `cid` ORDER BY COUNT(`cid`) DESC LIMIT 3';
       
       $rs  = $this->db->select('s.cid,COUNT(`cid`) as catcount,a.id,a.category_name')->from('search_by_genre as s')->join('categories as a','a.id = s.cid','inner')->group_by('s.cid')->order_by('COUNT(`cid`)','desc')->limit(5)->get();
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
         
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    } 
    
   function get_total_pitchit_package(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('*')->where('status','1')->get('pitch_master');
       
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
         
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;              
    
    }
    
  function get_ajax_package_price($id){
         $rs=array();
         $usd = $this->session->userdata('logged_user');
  
         $rs  = $this->db->select('id,price,number')->where('id',$id)->get('pitch_master')->row_array();
       
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $rs;               
    
    }
    
  public function get_purchase_pitchit_total()
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('sum(pitch_use_total) as sum_total')->from("pitch_transaction")->where("user_id",$usd['id'])->get()->row_array();
		
		return $data;
	} 
    
   public function draft_send($id)
	{
		$usd = $this->session->userdata('logged_user');
		$data = $this->db->select('*')->from("messages")->where("id",$id)->get()->row_array();
        
        if($data['to_user_id'] == $usd['id'])
        {
            $rs = $this->db->select('*')->from("users")->where("id",$data['from_user_id'])->get()->row_array();
    		
            $fullname = $rs['name_first'].' '.$rs['name_middle'].' '.$rs['name_last'];
            
            echo $rs['email'].'~'.$fullname.'~'.$data['subject'].'~'.$data['body'];
        }
        else
        {
            $rs = $this->db->select('*')->from("users")->where("id",$data['to_user_id'])->get()->row_array();
    		
            $fullname = $rs['name_first'].' '.$rs['name_middle'].' '.$rs['name_last'];
            
            echo $rs['email'].'~'.$fullname.'~'.$data['subject'].'~'.$data['body'].'~'.$data['to_user_id'];
        }
		//return $data;
	}    
        
        public function reply_send($id)
	{
            $usd = $this->session->userdata('logged_user');
            $data = $this->db->select('*')->from("messages")->where("id",$id)->get()->row_array();
        
            if($data['to_user_id'] == $usd['id']){
                $rs = $this->db->select('*')->from("users")->where("id",$data['from_user_id'])->get()->row_array();
                $fullname = $rs['name_first'].' '.$rs['name_middle'].' '.$rs['name_last'];
                echo $rs['email'].'~'.$fullname.'~'.$data['subject'].'~'.$data['body'].'~'.$data['from_user_id'];
            }
            else{
                $rs = $this->db->select('*')->from("users")->where("id",$data['to_user_id'])->get()->row_array();
                $fullname = $rs['name_first'].' '.$rs['name_middle'].' '.$rs['name_last'];
                echo $rs['email'].'~'.$fullname.'~'.$data['subject'].'~'.$data['body'].'~'.$data['to_user_id'];
            }
		//return $data;
	} 
    
}
