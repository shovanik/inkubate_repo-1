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
        
        $data['user_id'] = $usd['id'];    
        $data['Wid'] = $this->input->post('wid');
        $data['bid'] = $this->input->post('bkself_id');
        $data['created_date']    = date("Y-m-d h:i:s");
         
        $this->db->insert('bookshelf_works', $data);
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
    function get_bookshelf_with_search($search=""){
         $data=array();
         $usd = $this->session->userdata('logged_user');
         if($search == "")
         {
         	$data=$this->db->select('*')->where('user_id',$usd['id'])->get('bookshelfs')->result_array();
         }
         else
         {
         	$data=$this->db->select('*')->where('user_id',$usd['id'])->like('name', $search)->get('bookshelfs')->result_array();
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
         	$data=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->get('bookshelfs')->result_array();
         }
         else
         {
         	$data=$this->db->select('count(*) as count')->where('user_id',$usd['id'])->like('name', $search)->get('bookshelfs')->result_array();
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
         $data=$this->db->select('*')->where('id !=',$bid)->where('user_id',$usd['id'])->get('bookshelfs')->result_array();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //echo $this->db->last_query();die;
        return $data;               
    
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
        $rs=$this->db->select('*')->order_by('create_date','desc')->get('works');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return COUNT($data); 
	
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
        $this->db->where('id',$wcid)->delete('bookshelf_works');
        //echo $this->db->last_query();die;
        return 1;
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
        $data  = $this->db->select('count(*) as count,s.id as wcid,s.user_id as wuid,a.*')->from('works as s')->join('bookshelf_works as a','s.id = a.Wid','right')->where('s.user_id', $usd['id'])->get()->row_array();
         //$data  = $this->db->select('count(*) as count')->where('profile_id',$usd['id'])->get('view_profile')->row_array();
         //echo $this->db->last_query();die;
         return $data;
         
    } 
    
 
   
}
