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
    public function mailSend(){
        $data   = array();
        $data['submit'] = $this->input->post('submit');
        $data['draft'] = $this->input->post('draft');
        $usd = $this->session->userdata('logged_user');
        
       
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
            $configUpload['allowed_types'] = 'xls|doc|docx|pdf|xlsx|gif|jpg|png|bmp|jpeg';
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
        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
       // echo $_FILES['image']['name'].'hi';die;
        
        //echo $data['attach_file'] = $imgname['file_name'] ;;die;
        
        //this is for sending message by publisher for multiple send user id
        if($data['submit'] == 'Send')
        {
            $user_ids = explode(",",trim($this->input->post('user_email_id')));
		$result=$this->db->select('*')->where_in('id',$user_ids)->where('status_id','1')->get('users')->result_array();
		//echo $this->db->last_query();
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
		    
		    $data['created']    = date("Y-m-d h:i:s");
		    
		    unset($data['draft']);
		    unset($data['submit']);
		    $this->db->trans_start();
		    $this->db->insert('messages', $data);
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
		    
		    //echo $this->db->last_query();die;
		   // echo "sssssss";die;
		    //$last_id=$this->db->insert_id();
		     
		    //$str = $this->input->post('cc');
		    //$str1 = explode(',',$str);
		    
		    //print_r ($str1);die;
		     }
		}
            
            /*foreach($str1 as $cc)
            {
              $row22 = $this->db->select('*')->where('email',$cc)->get('users')->row_array();
                 if(!empty($row22['id']))
                 {
                 $data['to_user_id'] = $row22['id'];
                 
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
            
            $data['created']    = date("Y-m-d h:i:s");
            
            unset($data['draft']);
            unset($data['submit']);
            $this->db->insert('messages', $data);
                  
            }
           }*/
           return 1;
         
       }
       
       //this is for saving a draft by publisher for multiple send user id
       if($data['draft'] == 'Save Draft')
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
		
			unset($data['submit']);
			unset($data['draft']);
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
  
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->limit(4)->order_by('created','desc')->get('messages');
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
   function get_publisher_pitchit(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   
   $rs  = $this->db->select('s.pit_id as pitid,s.user_id as pituser,s.wid as pitwid,s.pitchit,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.wid = a.wid','inner')->where('s.user_id', $usd['id'])->order_by('a.id','desc')->limit(4)->get();
   
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.cid = a.cid','inner')->order_by('a.id','desc')->group_by('s.user_id')->limit(4)->get();
   
         //$rs=$this->db->select('*')->limit(4)->order_by('id','desc')->get('pitchit_view');
       //echo $this->db->last_query();die;
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
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
        //echo $this->db->last_query();die;
        return $data;               
    
    } 
    
  function get_user_work_details($offset=null,$limit=null){
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
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
   function get_user_pitchit_details(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '0')->order_by('s.created_date','desc')->limit(3)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //echo $this->db->last_query();die;
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
    function get_user_pitchit($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('*')->from('works')->where('id', $id)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //echo $this->db->last_query();die;
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
    function get_pit_details($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('*')->from('work_pitchits')->where('wid', $id)->get()->row_array();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //echo $this->db->last_query();die;
     
        return $rs;               
    
    }
    
   function get_user_pitchit_view($wid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->order_by('s.created_date','desc')->limit(3)->get();
         $rs=$this->db->select('*')->where('wid',$wid)->get('pitchit_view');
      //echo $this->db->last_query();die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return count($data);               
    
    }
    
    function get_user_total_pitchit_view(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.wid = a.wid','inner')->where('s.user_id', $usd['id'])->get();
         //$rs=$this->db->select('*')->where('wid',$wid)->get('pitchit_view');
      //echo $this->db->last_query();die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return count($data);               
    
    }  
    
  function get_pitchit_details(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
   $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->order_by('s.created_date','desc')->limit(3)->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //echo $this->db->last_query();die;
       
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
        //echo $this->db->last_query();die;
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
     //echo $this->db->last_query();die;
      
      //echo $row44->num_rows();die;
      
      /*if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
          
      
      foreach($data44 as $row_value){
      
      $rs  = $this->db->select('p.*,w.*')->from('work_pitchits as p')->join('works as w','p.wid = w.id','inner')->where('p.wid',$row_value['wid'])->get();*/
      
      //echo $this->db->last_query();  
    
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
        //echo $this->db->last_query();die;
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
     //echo $this->db->last_query();die;
      
      //echo $row44->num_rows();die;
      
      /*if($row44->num_rows() > 0){
            $data44   = $row44->result_array();
      
          
      
      foreach($data44 as $row_value){
      
      $rs  = $this->db->select('p.*,w.*')->from('work_pitchits as p')->join('works as w','p.wid = w.id','inner')->where('p.wid',$row_value['wid'])->get();*/
      
      //echo $this->db->last_query();  
    
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
        //echo $this->db->last_query();die;
         return $data;              
    
    } 
    
    
    function get_pitchit_details_view_limit(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
       
        $rs  = $this->db->select('w.id,w.user_id,w.asset_id,w.work_type_id,w.work_form_id,w.title,w.create_date,s.id as sid,s.user_id as suid,s.work_type_id as swtypid,,s.work_form_id as swfrmid,p.pit_id,p.user_id as pit_uid,p.wid,p.pitchit,p.created_date')->from('works as w')->join('publisher_forms as s','w.work_type_id = s.work_type_id','inner')->join('work_pitchits as p','p.wid = w.id','inner')->where('w.is_pitchited','1')->limit(3)->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
     //echo $this->db->last_query();die;
      
      
       if($rs->num_rows() > 0){
       
        $data   = $rs->result_array();
            
         //echo $this->db->last_query();die;   
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
        //echo $this->db->last_query();die;
         return $data;              
    
    }
    
    
   function get_pitchit_details_view_limit_cat(){
         $data=array();
         $row_workid = array();
         $data44 = array();         
         $temp = array();
         $usd = $this->session->userdata('logged_user');
  
      $rs  = $this->db->select('s.id as wcid,s.wid,s.cid,a.user_id as pubuid,a.cid as pubcid,p.pit_id,p.wid,p.pitchit,p.created_date,w.id,w.user_id,w.asset_id,w.work_type_id,w.work_form_id,w.title,w.create_date')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->join('work_pitchits as p','s.wid = p.wid','left')->join('works as w','w.id = s.wid','left')->where('w.is_pitchited','1')->group_by('p.pit_id')->limit(3)->get();
      
      //$row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','left')->get();
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
        //echo $this->db->last_query();die;
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
       //echo $this->db->last_query();die;       
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
    }  
    
    
    function get_pitchit_details_rest(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
    //$rsw=$this->db->select('*')->where('user_id',$usd['id'])->get('pitchit_view');
  
       //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('NOT EXISTS (SELECT `pitchit_id` FROM `pitchit_view` where pitchit_id = s.pit_id)', '', FALSE)->order_by('s.created_date','desc')->get();
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //echo $this->db->last_query();die;
      
      $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('pitchit_view as a','s.pit_id = a.pitchit_id','left')->where('a.pitchit_id',NULL)->order_by('s.created_date','desc')->get();
      
      //echo $this->db->last_query();die;
       
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
        //echo $this->db->last_query();die;
        return $data;               
    
    } 
    
   function get_pitchit_count(){
         $data=array();
         $data44 = array();
         $temp = array();
         $usd = $this->session->userdata('logged_user');
    
        //$rs  = $this->db->select('*')->where('user_id',$usd['id'])->get('pitchit_view');
        
      /*$rs_pit=$this->db->select('*')->count_all('work_pitchits');
      $rs_pit_view=$this->db->select('*')->where('user_id',$usd['id'])->count_all('pitchit_view');
      $data = $rs_pit - $rs_pit_view;*/
      
      //echo $this->db->last_query();die;
      
      
      //$rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('NOT EXISTS (SELECT `pitchit_id` FROM `pitchit_view` where pitchit_id = s.pit_id and user_id ='.$usd['id'].' )', '', FALSE)->order_by('s.created_date','desc')->get();
      //$rs  = $this->db->select('s.*')->from('work_pitchits as s')->where('s.pit_id NOT IN (select pitchit_id from `pitchit_view`)', NULL, FALSE)->order_by('s.created_date','desc')->get();
    $row44  = $this->db->select('s.id as wcid,s.wid,s.cid,a.*')->from('work_categories as s')->join('publisher_categories as a','s.cid = a.cid','inner')->get();
      //echo $this->db->last_query();die;
      
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
        
         
              }
            
           }
      }
      else
      {
       $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','left')->where('s.wid',$row_value['wid'])->order_by('s.created_date','desc')->get();
       
            if($rs->num_rows() == 0)
           {
            
            $rst  = $this->db->select('s.id as wfid,s.user_id as suid,s.work_type_id,s.work_form_id,w.*,p.pit_id,p.wid,p.pitchit,p.created_date,p.is_pitchit')->from('publisher_forms as s')->join('works as w','w.work_type_id = s.work_type_id','left')->join('work_pitchits as p','p.wid = w.id','right')->where('s.user_id',$usd['id'])->get();
            
            if($rst->num_rows() > 0){
            $data = $rst->result_array();
        
         
              }
            
           }
        
      }
       
       if($rs->num_rows() > 0){
        $data = $rs->result_array();
        
         }
         
      }
     }    
         
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
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
        $rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->get('works');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return COUNT($data); 
	
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
        //echo $this->db->last_query();die;
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
  
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->where('is_notified','0')->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
   
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
    public function replySend(){
        $data   = array();
        $data['reply'] = $this->input->post('reply');
        $data['forward'] = $this->input->post('forward');
        $usd = $this->session->userdata('logged_user');
       
        if($data['reply'] == 'reply')
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail_id'))->where('status_id','1')->get('users')->row_array();
        //echo $this->db->last_query();
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        $data['subject'] = $this->input->post('sub');
        
        $data['body'] = $this->input->post('editor3');
        
        $data['to_reply_id'] = $this->input->post('message_id');
        $data['created']    = date("Y-m-d h:i:s");
        
        unset($data['forward']);
        unset($data['reply']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //echo $this->db->last_query();die;
        
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
       }
       
         if($data['forward'] == 'forward')
        {
        $row=$this->db->select('*')->where('email',$this->input->post('user_mail'))->where('status_id','1')->get('users')->row_array();
        //echo $this->db->last_query();die;
        $data['to_user_id'] = $row['id'];
        
        $data['from_user_id'] = $usd['id'];
        
        $data['subject'] = $this->input->post('sub');
        
        $data['body'] = $this->input->post('editor2');
        
        $data['to_reply_id'] = '';
        $data['created']    = date("Y-m-d h:i:s");
        
        unset($data['reply']);
        unset($data['forward']);
        //print_r($data);die;
        
        
        $this->db->insert('messages', $data);
        //echo $this->db->last_query();die;
        
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
        //echo $this->db->last_query();
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
        //echo $this->db->last_query();die;
        
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
        //echo $this->db->last_query();die;
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
       
       return 1;
      
       
    } 
    
    function delete_details($id)
    {
        $this->db->where('id',$id)->delete('messages');
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
            $update_account=$this->db->where('id',$id)->update('messages',$data22);
            }
            if($rs['from_user_id'] == $usd['id'])
            {       
            $data22['is_from_viewed'] = '1';
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
         $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->where('is_notified','0')->get('messages');
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return count($data);     
        
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
      //echo $this->db->last_query();die;
      
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
                        //$update_account=$this->db->where('id',$detailsid)->update('messages',$data22);
                        $this->db->insert('pitchit_view', $data22);
                        
                        ///return ($this->db->last_query()); 
                        
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
         //echo $this->db->last_query();die;
        $data_cnt = count($rs_pit) - count($rs_pit_view);
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data_cnt;   
        
    }   
    
    function mailCount(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_viewed', '0')->where('to_user_id', $usd['id'])->order_by('created','desc')->get('messages');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
   function get_save_search_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data  = $this->db->select('count(*) as count')->where('user_id', $usd['id'])->get('saved_searches')->row_array();
        //echo $this->db->last_query();die;
        
        return $data;               
    
    } 
    
   function mailInfo($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->where('to_user_id', $usd['id'])->limit($limit,$offset)->get('messages');
        //echo $this->db->last_query();die;
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
    
   function sentMailInfo($offset=0,$limit=15){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
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
         //echo $this->db->last_query();die;
        
        //$this->db->limit($limit,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
                if(!empty($row['name_first']))
                {
                $data[$each]['name'] = $row['name_first'];
                }
                else
                {
                 $data[$each]['name'] = 'sorry!';   
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
   $data  = $this->db->select('s.*,a.*')->from('messages as s')->join('users as a','a.id = s.to_user_id','inner')->where('s.id', $id)->where('a.status_id','1')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    } 
    
    function replymailInfo($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   $rs  = $this->db->select('s.*,a.*')->from('messages as s')->join('users as a','a.id = s.to_user_id','inner')->where('s.to_reply_id', $id)->where('a.status_id','1')->get();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
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
        //echo $this->db->last_query();die;
        return $data;
    } 
    
   function fromUser1($id){
        $data=array();
         $usd = $this->session->userdata('logged_user');
   $data  = $this->db->select('s.*,a.*,ast.description,ast.filename')->from('messages as s')->join('users as a','a.id = s.from_user_id','left')->join('assets as ast','ast.user_id = s.from_user_id','left')->where('s.id', $id)->where('a.status_id','1')->where('ast.description', 'profile')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;
    }
    
    function fromUser($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('id', $id)->get('messages');
        //echo $this->db->last_query();die;
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
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('id',$value['to_user_id'])->where('status_id','1')->get('users')->row_array();
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
    function draftCount()
    {
    	 $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('count(*) as count')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages')->row_array();
         return $rs['count'];
        
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
    
function mark_msg($id,$offset=0,$limit=15)
{
        $data22   = array();
        $data22['is_marked']    = '1';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
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
function delete_folder($id)
{
	
	if($id > 0)
	{
		$data22['is_deleted'] = "1";
		$update=$this->db->where('id',$id)->update('folders',$data22);
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
function unmark_msg($id,$offset=0,$limit=15)
{
        $data22   = array();
        $data22['is_marked']    = '0';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
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
 function delete_msg($id,$offset=0,$limit=15)
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
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        
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
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->limit($limit,$offset)->get('messages');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                
                $s = $details['created'];
                $dt = new DateTime($s);
                $time = $dt->format('h:i A');
		 $data[$each]['date'] = date('m/d/Y',strtotime($s));
                
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
    function sentMailCount()
    {
    	 $data=array();
         $usd = $this->session->userdata('logged_user');
        // $rs  = $this->db->select('count(*) as count')->where('is_deleted !=', '1')->where('is_drafted', '0')->where('is_viewed', '0')->where('from_user_id', $usd['id'])->order_by('created','desc')->get('messages');
        $rs  = $this->db->select('count(*) as count')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        //echo $this->db->last_query();die;
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
       
        //echo $this->db->last_query();die;
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
                //echo $this->db->last_query();die;
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
                //echo $this->db->last_query();die;
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
                //echo $this->db->last_query();die;
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
                //echo $this->db->last_query();die;
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
            //echo $this->db->last_query();die;
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
		        //echo $this->db->last_query();die;
		        $mid = $maxid['id']+1;
		        $data22['id'] = $mid;
		        
		        $data22['user_id']    = $usd['id'];
		        $data22['folder_id']    = $foldid;
		        $data22['message_id']    = $value;
		        $data22['created']     = date("Y-m-d h:i:s");
		        //$update_account=$this->db->where("id",$value["id"])->update('messages',$data22);
		        $this->db->insert('message_folders', $data22);
                }
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
    
    function folderMailInfo($foldid,$offset=0,$limit=15){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $r = $this->db->select('*')->from('folders')->where('id', $foldid)->where('is_deleted','0')->get()->row_array();
         if(count($r) <= 0)
         {
         	redirect('home/inbox', 'refresh'); exit;
         }
         //$rs  = $this->db->select('s.*,a.*')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->limit($limit,$offset)->get();
         $rs  = $this->db->select('s.*,s.id as message_id')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->limit($limit,$offset)->get();
        //echo $this->db->last_query();die;
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
    public function getAuthorByAlphabet($alphabet,$length = 10,$offset = 0)
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

    public function getAuthorInviteByAlphabet($alphabet,$length = 10,$offset = 0)
    {
    	$usd = $this->session->userdata('logged_user');
        return $data    = $this->db->select('users.id,users.email,users.name_first,users.name_middle,users.name_last')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->like('users.name_first', $alphabet, 'after')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->limit($length,$offset)->get()->result_array();
    }   
    public function getAuthorCountInviteByAlphabet($alphabet)
    {
	$usd = $this->session->userdata('logged_user');
    	$data = $this->db->select('Count(*) as count')->from("author_address_books")->join('users','users.id = author_address_books.address_user_id','inner')->like('users.name_first', $alphabet, 'after')->where('users.status_id','1')->where("author_address_books.is_deleted","0")->where("author_address_books.status","1")->where("author_address_books.user_id",$usd['id'])->get()->result_array();
	//echo $this->db->last_query();die;
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
	public function getCountFolderMails($foldid)
	{
		$usd = $this->session->userdata('logged_user');
		$rs  = $this->db->select('count(*) as count')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->where('a.is_deleted','0')->where('s.is_deleted','0')->get()->result_array();
		return $rs[0]['count'];
		
	}
	
}
