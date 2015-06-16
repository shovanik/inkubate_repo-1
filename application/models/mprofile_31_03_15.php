<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mprofile extends CI_Model
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
 
 function total_category_details()
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_show','1')->order_by('category_name','asc')->get('categories');
        
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        return $data;
     
    }
    
 function total_publisher_details($id,$type_id,$form_id)
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->get('categories');
         $rs  = $this->db->select('s.id as wid,s.work_type_id,a.*,u.id,u.name_first,u.name_middle,u.name_last')->from('publisher_forms as a')->join('users as u','u.id = a.user_id','left')->join('works as s','a.work_type_id = s.work_type_id','left')->where('s.id',$id)->where('s.work_type_id',$type_id)->group_by('u.id')->or_where('s.work_form_id',$form_id)->where('s.id',$id)->group_by('u.id')->get();
        
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        return $data;
     
    } 
    
   function total_publisher_details_forpitch()
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('id,name_first,name_middle,name_last,user_type')->where('user_type','2')->get('users');
         
        
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
        }        
        $rs->free_result();
        return $data;
     
    }    
  
    public function updateProfile(){
        
        //echo $this->input->post('facebook');die;
        
        $data   = array();
        $data22   = array();
        $data33   = array();
        $data55   = array();
        $data57   = array();
        $data58   = array();
        //$data['submit'] = $this->input->post('submit');
        //$data['draft'] = $this->input->post('draft');
        ///echo $this->input->post('twitter');die;
        $usd = $this->session->userdata('logged_user');
        
        
       
        if (!is_dir('uploadImage/'.$usd['id'])) {
            mkdir('./uploadImage/' .$usd['id'], 0777, TRUE);
            chmod('./uploadImage/' .$usd['id'], 0777);

        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/profile')){
            chmod('./uploadImage/' .$usd['id'], 0777);
            mkdir('./uploadImage/' .$usd['id']. '/profile', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/profile/thumbs')){
            chmod('./uploadImage/' .$usd['id'] .'/profile', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/profile/thumbs', 0777, TRUE);
        }
        if(!is_dir('./uploadImage/' .$usd['id']. '/profile/medium')){
            chmod('./uploadImage/' .$usd['id']. '/profile', 0777);
            mkdir('./uploadImage/' .$usd['id']. '/profile/medium', 0777, TRUE);
        }  
    
        //die();
        //echo "<pre>";print_r($_POST);echo "</pre>"; exit();
        /* Upload Image */
       // echo $_FILES['image']['name'].'hi';die;
        if($_FILES['image']['name'] != ""){
            
            //print_r($_FILES['image']);
            //echo $_REQUEST['propertyId'];
           // exit();
            $this->load->library('image_lib');
            
            $configUpload['upload_path']    = './uploadImage/'.$usd['id'].'/profile';
            $configUpload['allowed_types']  = 'gif|jpg|png|bmp|jpeg';
            $configUpload['max_size']       = '0';
            $configUpload['max_width']      = '0';
            $configUpload['max_height']     = '0';
            $configUpload['encrypt_name']   = true;
            $this->load->library('upload', $configUpload);
            /* size 64*72 for comments */
            $configThumb = array();  
            $configThumb['image_library']   = 'gd2';  
            $configThumb['create_thumb']    = TRUE;
            $configThumb['new_image']       = './uploadImage/'.$usd['id'].'/profile/thumbs/';  
            $configThumb['maintain_ratio']  = TRUE;
            $configThumb['width']           = 64;  
            $configThumb['height']          = 72;
            $configThumb['thumb_marker']    = "";
            //$this->load->library('image_lib');
            /* size 64*72 for comments */
            
            /* size 167*167 for profile page */
            $configThumbMedium = array();  
            $configThumbMedium['image_library']   = 'gd2';  
            $configThumbMedium['create_thumb']    = TRUE;
            $configThumbMedium['new_image']       = './uploadImage/'.$usd['id'].'/profile/medium/';  
            $configThumbMedium['maintain_ratio']  = TRUE;
            $configThumbMedium['width']           = 167;  
            $configThumbMedium['height']          = 167;
            $configThumbMedium['thumb_marker']    = "";
            /* size 167*167 for profile page */
            
            if(!$this->upload->do_upload('image')){
                return 0;
            }
            
            $uploadedDetails    = $this->upload->data();
            if($uploadedDetails['is_image'] == 1){
                $configThumb['source_image']        = $uploadedDetails['full_path'];
                $configThumbMedium['source_image']  = $uploadedDetails['full_path'];
                $raw_name                           = $uploadedDetails['raw_name'];
        	    $file_ext                           = $uploadedDetails['file_ext']; 
        	    $imgname                            = $raw_name.$file_ext;
                $this->image_lib->initialize($configThumb);
                $this->image_lib->resize();
                $this->image_lib->initialize($configThumbMedium);
                $this->image_lib->resize();
            }
           //$imgname = $raw_name.$file_ext;; 
        }
        
        /*$maxid  = $this->db->select_max('id')->get('assets')->row_array();
        //echo $this->db->last_query();die;
        $mid = $maxid['id']+1;
        $data['id'] = $mid;*/
        
        $maxid  = $this->db->select('*')->where('user_id',$usd['id'])->where('description','profile')->get('assets')->row_array();
        //echo $this->db->last_query();die;
        $mid = count($maxid);
        //echo $mid;die;
        if($mid>0) 
        {
        $data['user_id'] = $usd['id'];
            if($_FILES['image']['name'] != "")
            {
              $data['filename'] = $imgname; 
            }
            else
            {
              $data['filename'] = $maxid['filename']; 
            }
        $data['status_id'] = '1';
        $data['description'] = 'profile';
        $data['modified_date'] = date("Y-m-d h:i:s");
        $update_account=$this->db->where('user_id',$usd['id'])->where('description','profile')->update('assets',$data);
        
        $data22['user_id'] = $usd['id'];
        $data22['biography'] = $this->input->post('desc');
        $data22['h_asset_id'] = $maxid['id'];
        $data22['modified_date'] = date("Y-m-d h:i:s");
        
        //$data22['traditionally_published'] = $this->input->post('traditionally_published');
        if($usd['user_type'] == '1')
        {
        $data22['self_published'] = $this->input->post('self_published');
        $data22['literary_awards'] = $this->input->post('literary_awards');
        $data22['mfa_program'] = $this->input->post('mfa_program');
        }
        if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4')
        {
        $data22['interested_title'] = $this->input->post('interested_title');
        $data22['offer_ebook'] = $this->input->post('offer_ebook');   
        }
        //print_r($data22['literary_awards']);die;
        //$data22['work_been_reviewed'] = $this->input->post('work_been_reviewed');
        //$data22['published_abroad'] = $this->input->post('published_abroad');
        
        
        
        $str1 = $this->input->post('cate_gory_hid');
       
            //$str1 = explode(',',$str);
                if(!empty($str1))
                {
                    foreach($str1 as $cc)
                    {
                      //$row=$this->db->select('id')->where('category_name',$cc)->get('categories')->row_array();
                      $data55['user_id']       = $usd['id'];
                      $data55['cid']           = $cc;
                      $this->db->insert('publisher_categories', $data55);  
                    }
                }
          $format = $this->input->post('WorkTypeId');
          $formid = $this->input->post('work_form');
          $pub_format  = $this->db->select('*')->where('user_id',$usd['id'])->get('publisher_forms');  
          
          if($pub_format->num_rows() > 0)
          {     
            
              if(!empty($format))
                {
                  $data57['user_id']       = $usd['id'];
                  $data57['work_type_id']  = $format;
                  $data57['work_form_id']  = $formid;
                  $this->db->where('user_id',$usd['id'])->update('publisher_forms',$data57);    
                }
                
           }
           else
           {
                
             if(!empty($format))
                {
                  $data57['user_id']       = $usd['id'];
                  $data57['work_type_id']  = $format;
                  $data57['work_form_id']  = $formid;
                  $this->db->insert('publisher_forms', $data57);    
                }
           }     
        
        $update_account22=$this->db->where('user_id',$usd['id'])->update('profile_writer',$data22);
        
        
        
        //echo $this->input->post('facebook');
        //echo $this->input->post('twitter');die;
        
            if($this->input->post('facebook') != '')
            {
               $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','1')->get('profile_links')->result_array();
               $pid = count($prfid);
        //echo $pid;die;
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '1';
                   $data33['url'] = $this->input->post('facebook');
                   $data33['description'] = 'Facebook';
                   //$this->db->insert('profile_links', $data33);
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','1')->update('profile_links',$data33);
                   //echo $this->db->last_query();die;    
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '1';
                   $data33['url'] = $this->input->post('facebook');
                   $data33['description'] = 'Facebook';
                   $this->db->insert('profile_links', $data33); 
                   //echo $this->db->last_query();die;
               }
                
            }
            else
            {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '1';
                   $data33['url'] = '';
                   $data33['description'] = 'Facebook';
                   
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','1')->update('profile_links',$data33);  
            }
            
            if($this->input->post('twitter') != '')
            {
                
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','2')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '2';
                   $data33['url'] = $this->input->post('twitter');
                   $data33['description'] = 'Twitter';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','2')->update('profile_links',$data33);     
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '2';
                   $data33['url'] = $this->input->post('twitter');
                   $data33['description'] = 'Twitter';
                   $this->db->insert('profile_links', $data33); 
               }
                
               
            }
            
            else
            {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '2';
                   $data33['url'] = '';
                   $data33['description'] = 'Twitter';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','2')->update('profile_links',$data33); 
            }
            
            if($this->input->post('googleplus') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','3')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '3';
                   $data33['url'] = $this->input->post('googleplus');
                   $data33['description'] = 'Googleplus';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','3')->update('profile_links',$data33);      
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '3';
                   $data33['url'] = $this->input->post('googleplus');
                   $data33['description'] = 'Googleplus';
                   $this->db->insert('profile_links', $data33); 
               }
                
                
            }
            
            else
            {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '3';
                   $data33['url'] = '';
                   $data33['description'] = 'Googleplus';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','3')->update('profile_links',$data33);  
            }
            
            if($this->input->post('web') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '4';
                   $data33['url'] = $this->input->post('web');
                   $data33['description'] = 'Web';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->update('profile_links',$data33);       
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '4';
                   $data33['url'] = $this->input->post('web');
                   $data33['description'] = 'Web';
                   $this->db->insert('profile_links', $data33); 
               }
                
                
            }
            
            else
            {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '4';
                   $data33['url'] = '';
                   $data33['description'] = 'Web';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->update('profile_links',$data33);  
            }
            
            if($this->input->post('linkedin') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','5')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '5';
                   $data33['url'] = $this->input->post('linkedin');
                   $data33['description'] = 'Linkedin';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','5')->update('profile_links',$data33);       
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '5';
                   $data33['url'] = $this->input->post('linkedin');
                   $data33['description'] = 'Linkedin';
                   $this->db->insert('profile_links', $data33); 
               }
                
            }
            
            else
            {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '5';
                   $data33['url'] = '';
                   $data33['description'] = 'Linkedin';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','5')->update('profile_links',$data33); 
            }
            
            $data58['name_first']  = $this->input->post('name_first');
            $data58['name_last']  = $this->input->post('name_last');
            $data58['gender']  = $this->input->post('gender');
            $data58['age']  = $this->input->post('age');
            $data58['personal_email']  = $this->input->post('personal_email');
            $data58['user_type']  = $this->input->post('user_type');
            $data58['address']  = $this->input->post('address');
            //echo $data58['personal_email'];die;
            $data58['city']  = $this->input->post('city');
            $data58['state']  = $this->input->post('state');
            $data58['country']  = $this->input->post('country');
            $data58['postal_code']  = $this->input->post('postal_code');
            $data58['company_name']  = $this->input->post('company_name');
            $data58['industry']  = $this->input->post('industry');
            $data58['job_title']  = $this->input->post('job_title');
            $data58['manuscript_total']  = $this->input->post('manuscript_total');
            $data58['title_publish']  = $this->input->post('title_publish');
            $this->db->where('id',$usd['id'])->update('users',$data58);
            //echo $this->db->last_query();die;
            
        return 1;
        }
        
        else 
        {
        $data['user_id'] = $usd['id'];
        //$data['filename'] = $imgname;
        
          if($_FILES['image']['name'] != "")
            {
              $data['filename'] = $imgname; 
            }
            else
            {
              $data['filename'] = ''; 
            }
        
        $data['status_id'] = '1';
        $data['description'] = 'profile';
        $data['create_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $this->db->insert('assets', $data);
        $insert_id = $this->db->insert_id();
        
        /*$maxid22  = $this->db->select_max('id')->get('profile_writer')->row_array();
        $mid22 = $maxid22['id']+1;
        $data22['id'] = $mid22;*/
        $data22['user_id'] = $usd['id'];
        $data22['biography'] = $this->input->post('desc');
        $data22['h_asset_id'] = $insert_id;
        $data22['create_date'] = date("Y-m-d h:i:s");
        $data22['modified_date'] = date("Y-m-d h:i:s");
        
        //$data22['traditionally_published'] = $this->input->post('traditionally_published');
        if($usd['user_type'] == '1')
        {
        $data22['self_published'] = $this->input->post('self_published');
        $data22['literary_awards'] = $this->input->post('literary_awards');
        $data22['mfa_program'] = $this->input->post('mfa_program');
        }
        if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4')
        {
        $data22['interested_title'] = $this->input->post('interested_title');
        $data22['offer_ebook'] = $this->input->post('offer_ebook');   
        }
        //$data22['work_been_reviewed'] = $this->input->post('work_been_reviewed');
        //$data22['published_abroad'] = $this->input->post('published_abroad');
        
        
        
        $this->db->insert('profile_writer', $data22);
        
        //echo $this->input->post('facebook');die;
        if($this->input->post('facebook') != '')
            {
               $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','1')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '1';
                   $data33['url'] = $this->input->post('facebook');
                   $data33['description'] = 'Facebook';
                   //$this->db->insert('profile_links', $data33);
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','1')->update('profile_links',$data33);
                   //echo $this->db->last_query();die;    
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '1';
                   $data33['url'] = $this->input->post('facebook');
                   $data33['description'] = 'Facebook';
                   $this->db->insert('profile_links', $data33); 
                   //echo $this->db->last_query();die;
               }
                
            }
            if($this->input->post('twitter') != '')
            {
                
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','2')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '2';
                   $data33['url'] = $this->input->post('twitter');
                   $data33['description'] = 'Twitter';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','2')->update('profile_links',$data33);     
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '2';
                   $data33['url'] = $this->input->post('twitter');
                   $data33['description'] = 'Twitter';
                   $this->db->insert('profile_links', $data33); 
               }
                
               
            }
            
            if($this->input->post('googleplus') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','3')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '3';
                   $data33['url'] = $this->input->post('googleplus');
                   $data33['description'] = 'Googleplus';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','3')->update('profile_links',$data33);      
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '3';
                   $data33['url'] = $this->input->post('googleplus');
                   $data33['description'] = 'Googleplus';
                   $this->db->insert('profile_links', $data33); 
               }
                
                
            }
            if($this->input->post('web') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '4';
                   $data33['url'] = $this->input->post('web');
                   $data33['description'] = 'Web';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->update('profile_links',$data33);       
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '4';
                   $data33['url'] = $this->input->post('web');
                   $data33['description'] = 'Web';
                   $this->db->insert('profile_links', $data33); 
               }
                
                
            }
            
            if($this->input->post('linkedin') != '')
            {
                $prfid  = $this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->get('profile_links')->result_array();
               $pid = count($prfid);
        
                if($pid>0) 
                {
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '5';
                   $data33['url'] = $this->input->post('linkedin');
                   $data33['description'] = 'Linkedin';
                   $this->db->where('profile_writer_id',$usd['id'])->where('link_type_id','4')->update('profile_links',$data33);       
                }
               else
               {
                   $data33['profile_writer_id'] = $usd['id'];
                   $data33['create_date'] = date("Y-m-d h:i:s");
                   $data33['modified_date'] = date("Y-m-d h:i:s");
                   $data33['link_type_id'] = '5';
                   $data33['url'] = $this->input->post('linkedin');
                   $data33['description'] = 'Linkedin';
                   $this->db->insert('profile_links', $data33); 
               }
                
                
            }
            
            $data58['name_first']  = $this->input->post('name_first');
            $data58['name_last']  = $this->input->post('name_last');
            $data58['gender']  = $this->input->post('gender');
            $data58['age']  = $this->input->post('age');
            $data58['personal_email']  = $this->input->post('personal_email');
            $data58['user_type']  = $this->input->post('user_type');
            $data58['address']  = $this->input->post('address');
            //echo $data58['personal_email'];die;
            $data58['city']  = $this->input->post('city');
            $data58['state']  = $this->input->post('state');
            $data58['country']  = $this->input->post('country');
            $data58['postal_code']  = $this->input->post('postal_code');
            $data58['company_name']  = $this->input->post('company_name');
            $data58['industry']  = $this->input->post('industry');
            $data58['job_title']  = $this->input->post('job_title');
            $data58['manuscript_total']  = $this->input->post('manuscript_total');
            $data58['title_publish']  = $this->input->post('title_publish');
            $this->db->where('id',$usd['id'])->update('users',$data58);
            //echo $this->db->last_query();die;
       
       return 1;
       }
       
       
    }
    
  function work_categ_details($id){
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $data  = $this->db->select('s.id as pcid,s.user_id as suid,s.cid,a.*')->from('publisher_categories as s')->join('categories as a','s.cid = a.id','inner')->where('s.user_id', $id)->get()->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;
    }
    
    function workCategDetailsById($id){
        $data=array();
        //$usd = $this->session->userdata('logged_user');
        $data  = $this->db->select('s.id as pcid,s.user_id as suid,s.cid,a.*')->from('publisher_categories as s')->join('categories as a','s.cid = a.id','inner')->where('s.user_id', $id)->get()->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;
    }
    
  function delete_cat_details($id)
    {
        $data=array();
         $usd = $this->session->userdata('logged_user');
         //$rs  = $this->db->select('*')->where('work_type_id', $id)->get('work_forms');
        $this->db->where('id',$id)->delete('publisher_categories');
        
       $work_cat_details = $this->mprofile->work_categ_details($usd['id']);
       
       echo count($work_cat_details).'@';
       
         if(!empty($work_cat_details))
                   {
                    
                    foreach($work_cat_details as $catdetails)
                    {
                                       
        
        ?>
            
            <!--<li class="cat_id" onclick="catshow(<?php //echo $catdetails['pcid']?>)"><?php //echo $catdetails['category_name']?></li>-->
            
           
               <span class="fict_pan">
               <div class="fict_pan_in" style="background:#8ac749">
                 <span class="fc_pan"><?php echo $catdetails['category_name']?></span>
                 <span class="cls_pan">
                 
                 <img src="<?=base_url()?>images/cross_2.png" alt="" onclick="catshow(<?php echo $catdetails['pcid']?>)">
                 
                 </span>
                 <div class="clear"></div>
               </div>
              </span>
            
            
         <?php } } else {?>
    <span>There are no Categories!</span>     
    
    <?php }      
     
    } 
    
  function work_cat_select($id=null,$catid=null){
        
        //$sql = "SELECT COUNT(*)FROM `work_categories` WHERE `Wid` = '" . $id . "' and `cid` = '" . $catid . "'"; 
        //echo $query = $this->db->query($sql);die;
         $data  = $this->db->select('*')->where('user_id',$id)->where('cid',$catid)->get('publisher_categories')->result_array();
         //echo $this->db->last_query();die;
         return count($data);
         
    }   
         
    
     function get_user_bio(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   //$data  = $this->db->select('s.*,a.*')->from('assets as s')->join('profile_writer as a','a.h_asset_id = s.id','inner')->where('s.user_id', $usd['id'])->get()->row_array();
   $data=$this->db->select('*')->where('user_id',$usd['id'])->get('profile_writer')->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    }
    
    function getUserBioById($usd){
        $data=array();
        $data=$this->db->select('*')->where('user_id',$usd)->get('profile_writer')->row_array();
        return $data;               
    
    }
    
    function get_user_iscontact(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   //$data  = $this->db->select('s.*,a.*')->from('assets as s')->join('profile_writer as a','a.h_asset_id = s.id','inner')->where('s.user_id', $usd['id'])->get()->row_array();
   $data=$this->db->select('*')->where('id',$usd['id'])->get('users')->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
    } 
    
    function getUserIscontactById($usd){
        $data=array();
        $data=$this->db->select('*')->where('id',$usd)->get('users')->row_array();
        return $data;               
    
    } 
    
    function get_user_photo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   //$data  = $this->db->select('s.*,a.*')->from('assets as s')->join('profile_writer as a','a.h_asset_id = s.id','inner')->where('s.user_id', $usd['id'])->get()->row_array();
   $data22=$this->db->select('*')->where('user_id',$usd['id'])->get('assets')->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data22;               
    
    } 
    
    function getUserPhotoById($usd){
        $data=array();
        $data22=$this->db->select('*')->where('user_id',$usd)->get('assets')->row_array();
        return $data22;               
    
    } 
    
    function get_user_web_link($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
   
         $data22=$this->db->select('*')->where('profile_writer_id',$usd['id'])->where('link_type_id',$id)->get('profile_links')->row_array();
         return $data22;               
    
    } 
    
    function getUserWebLinkById($usd, $id){
         $data=array();
         $data22=$this->db->select('*')->where('profile_writer_id',$usd)->where('link_type_id',$id)->get('profile_links')->row_array();
         return $data22;               
    
    } 
    
     function get_user_work_count(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $data22=$this->db->select('*')->where('user_id',$usd['id'])->get('works')->result_array();
        
        return $data22;               
    
    }
    
    function getUserWorkCountById($usd){
        $data=array();
        $data22=$this->db->select('*')->where('user_id',$usd)->get('works')->result_array();
        return $data22;               
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
        
       /*$rs=$this->db->select('*')->where('to_reply_id',$this->input->post('message_id'))->get('messages');
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
            foreach($data as $each=>$details){
                $reply_user = $this->memail->reply_to_user($details['from_user_id']);
                
       ?>
       
          <div class="mid_content_inner_right_bottom_box_new new_bg">
            <div class="drop_menu_section_left">
            <div class="prof">
                <div class="drop_menu_section_left_profile"><img src="<?=base_url()?>images/img_indox2.png" alt="" /></div>
                <div class="drop_menu_section_left_text">
                <p><strong><?php echo $details['subject']?></strong></p>
                <p class="font_12"><span>From</span>:  <strong><?php echo $usd['name_first']?></strong><img src="<?=base_url()?>images/add_con.png" alt="" /><br />
                <span>To </span>: <strong><?php echo $reply_user['name_first']?> </strong><img src="<?=base_url()?>images/add_con.png" alt="" /><br />
                <span>Date </span>: <strong><?php echo date('d F Y',strtotime($details['created']))?></strong></p>
            </div>
            </div>
            </div>
            
            <div class="drop_menu_section_right">
            <a href="#" class="attachment_icon pad_top30"><img alt="" src="<?=base_url()?>images/attachment_icon.png"/>Def.doc</a>
            </div>
            <div class="clear"></div>
            </div>
            <div class="comment">
            <p><?php echo $details['body'];?></p>
            
            </div>
       
       <?php
          }
         } 
       $rs->free_result();*/
      
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
    
    function mailCount(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }
    
   function mailInfo($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->limit($limit,$offset)->get('messages');
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
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
   function sentMailInfo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
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
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    } 
    
   function trashMailInfo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('is_deleted !=', '0')->where('from_user_id', $usd['id'])->or_where('to_user_id', $usd['id'])->where('is_deleted !=', '0')->order_by('created','desc')->get('messages');
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
    
   function fromUser($id){
        $data=array();
         $usd = $this->session->userdata('logged_user');
   $data  = $this->db->select('s.*,a.*')->from('messages as s')->join('users as a','a.id = s.from_user_id','inner')->where('s.id', $id)->where('a.status_id','1')->get()->row_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;
    }
    
  function draftInfo(){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('from_user_id', $usd['id'])->where('is_deleted', '0')->where('is_drafted', '1')->order_by('created','desc')->get('messages');
        
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
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
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
    
    
 function delete_msg($id)
    {
        $data22   = array();
        $data22['is_deleted']    = '1';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('to_user_id', $usd['id'])->where('is_deleted !=', '1')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
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
                //$data[$each]['type']    = 'PROPERTY';
                ?>
        
         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php //echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php //echo $key ?>" data-keycheck="<?php //echo $key ?>"  /></span>-->
                                            
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
      
    
    function delete_draft_msg($id)
    {
        $data22   = array();
        $data22['is_deleted']    = '1';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                
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
    
   function delete_sentmail_msg($id)
    {
        $data22   = array();
        $data22['is_deleted']    = '2';
        foreach($id as $each=>$value){
                
                
                $update_account=$this->db->where('id',$value)->update('messages',$data22);
                //echo $this->db->last_query();die;
            }
        
        
        $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('from_user_id', $usd['id'])->where('deleted_by_sender', '0')->where('is_drafted', '0')->order_by('created','desc')->get('messages');
        
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
    
  function delete_trash_msg($id)
    {
        $data22   = array();
        //$data22['is_deleted']    = '2';
        foreach($id as $each=>$value){
                
                
                //$update_account=$this->db->where('id',$value)->update('messages',$data22);
                $this->db->where('id',$value)->delete('messages');
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
        foreach($id as $value){
            
            $rs  = $this->db->select('*')->where('user_id', $usd['id'])->where('folder_id', $foldid)->where('message_id', $value)->get('message_folders');
            //echo $this->db->last_query();die;
            if($rs->num_rows() > 0){
            
                ?>
               
              <strong><h4 style="color: red;">already move to <?php echo $foldname;?></h4></strong>  
                
               <?php 
                
                }
              else{
                //$data   = $rs->result_array();
            
                
                $maxid  = $this->db->select_max('id')->get('message_folders')->row_array();
                //echo $this->db->last_query();die;
                $mid = $maxid['id']+1;
                $data22['id'] = $mid;
                
                $data22['user_id']    = $usd['id'];
                $data22['folder_id']    = $foldid;
                $data22['message_id']    = $value;
                $data22['created']     = date("Y-m-d h:i:s");;
                //$update_account=$this->db->where("id",$value["id"])->update('messages',$data22);
                $this->db->insert('message_folders', $data22);
                ?>
                
             <strong><h4 style="color: green;">successfully move to <?php echo $foldname;?></h4></strong>   
                
             <?php     
              }
       
      } 
    
    }
    
    function getCountMails()
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('*')->where('to_user_id',$usd['id'])->order_by('created','desc')->get('messages');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return COUNT($data); 
	
    }
    
   function folder_msg_cnt_usr($id)
    {
       $data   = array();
       $usd = $this->session->userdata('logged_user');
        $rs=$this->db->select('*')->where('user_id',$usd['id'])->where('folder_id',$id)->get('message_folders');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return $data; 
	
    }
    
    function folderMailInfo($foldid){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('s.*,a.*')->from('messages as s')->join('message_folders as a','s.id = a.message_id','inner')->where('a.folder_id', $foldid)->where('a.user_id', $usd['id'])->get();
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
            }
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;               
    
    }   
     
   
  function check_bio($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_id',$id)->get('profile_writer');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return count($data);               
    
    }
  function check_photo($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_id',$id)->where('description','profile')->get('assets');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return count($data);               
    
    }
    
  function check_work($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('user_id',$id)->get('works');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return count($data);               
    
    }
    
   function check_social($id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         $rs  = $this->db->select('*')->where('profile_writer_id',$id)->get('profile_links');
        //echo $this->db->last_query();die;
        //$this->db->limit(1,0);
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
           
        }        
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return count($data);               
    
    }
         
   
}
