<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mpitchit extends CI_Model
{
 
    function getPitchitList()
    {
        $rs  = $this->db->select('*')->get('pitch_master');
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }        
        $rs->free_result();
        return $data;
    }
    
    function getPitchitListById( $id )
    {
        $data = array();
        $rs  = $this->db->select('*')->where("id", $id)->get('pitch_master');
        if($rs->num_rows() > 0){
            $data   = $rs->row_array();
        }        
        
        return $data;
    }
    
    function addpitchit()
    {
        $data   = array();
        
        $data['package_name'] = $this->input->post('package_name');
        $data['price'] = $this->input->post('price');
        $data['number'] = $this->input->post('number');
        $data['status'] = $this->input->post('active');
        $data['created_date'] = date("Y-m-d h:i:s");
        
        $this->db->insert('pitch_master', $data);
        return 1;
    }
    
    function editpitchit($id)
    {
        $data   = array();
        
        $data['package_name'] = $this->input->post('package_name');
        $data['price'] = $this->input->post('price');
        $data['number'] = $this->input->post('number');
        $data['status'] = $this->input->post('active');
        $data['created_date'] = date("Y-m-d h:i:s");
        
        $this->db->where('id',$id)->update('pitch_master', $data);
        return 1;
    }

    function getUserLatestPitchitDetails($offset=null,$limit=null)
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','0')->order_by('wp.pit_id','desc')->limit($limit,$offset)->get();
        //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
            foreach($data as $each=>$value){
                $row25=$this->db->select('*')->where('pit_id',$value['pit_id'])->get('work_pitchits')->row_array();
                if(!empty($row25['pitchit'])){
                    $data[$each]['pitchit'] = $row25['pitchit'];
                }else{
                 $data[$each]['pitchit'] = '';   
                }
                
                if(!empty($row25['user_id'])){
                    $data[$each]['pitchit_user'] = $row25['user_id'];
                }else{
                    $data[$each]['pitchit_user'] = '';   
                }
                
                if(!empty($row25['created_date'])){
                    $data[$each]['created_date'] = $row25['created_date'];
                }else{
                 $data[$each]['created_date'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
            }
        }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    }

    function getUserLatestPitchitCount()
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','0')->get();
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
        }   
        return $data;
    }

    function getUserSavedPitchitDetails($offset=null,$limit=null)
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','1')->order_by('wp.pit_id','desc')->limit($limit,$offset)->get();
        //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
            foreach($data as $each=>$value){
                $row25=$this->db->select('*')->where('pit_id',$value['pit_id'])->get('work_pitchits')->row_array();
                if(!empty($row25['pitchit'])){
                    $data[$each]['pitchit'] = $row25['pitchit'];
                }else{
                 $data[$each]['pitchit'] = '';   
                }
                
                if(!empty($row25['user_id'])){
                    $data[$each]['pitchit_user'] = $row25['user_id'];
                }else{
                    $data[$each]['pitchit_user'] = '';   
                }
                
                if(!empty($row25['created_date'])){
                    $data[$each]['created_date'] = $row25['created_date'];
                }else{
                 $data[$each]['created_date'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
            }
        }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    }

    function getUserSavedPitchitCount()
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','1')->get();
        //die;
       
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
        }   
        return $data;
    }
    
    function getUserSavedPitchitDetails_pub($offset=null,$limit=null)
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits_saved as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','1')->order_by('wp.pit_id','desc')->limit($limit,$offset)->get();
        //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
   
            foreach($data as $each=>$value){
                $row25=$this->db->select('*')->where('pit_id',$value['pit_id'])->get('work_pitchits_saved')->row_array();
                if(!empty($row25['pitchit'])){
                    $data[$each]['pitchit'] = $row25['pitchit'];
                }else{
                 $data[$each]['pitchit'] = '';   
                }
                
                if(!empty($row25['user_id'])){
                    $data[$each]['pitchit_user'] = $row25['user_id'];
                }else{
                    $data[$each]['pitchit_user'] = '';   
                }
                
                if(!empty($row25['created_date'])){
                    $data[$each]['created_date'] = $row25['created_date'];
                }else{
                 $data[$each]['created_date'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
            }
        }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    }

    function getUserSavedPitchitCount_pub()
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits_saved as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','1')->get();
        //die;
       
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
        }   
        return $data;
    }

    function getUserAllPitchitDetails($offset=null,$limit=null)
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','0')->order_by('wp.pit_id','desc')->limit($limit,$offset)->get();
        //die;
       
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();//die;
   
            foreach($data as $each=>$value){
                $row25=$this->db->select('*')->where('pit_id',$value['pit_id'])->get('work_pitchits')->row_array();
                if(!empty($row25['pitchit'])){
                    $data[$each]['pitchit'] = $row25['pitchit'];
                }else{
                 $data[$each]['pitchit'] = '';   
                }
                
                if(!empty($row25['user_id'])){
                    $data[$each]['pitchit_user'] = $row25['user_id'];
                }else{
                    $data[$each]['pitchit_user'] = '';   
                }
                
                if(!empty($row25['created_date'])){
                    $data[$each]['created_date'] = $row25['created_date'];
                }else{
                 $data[$each]['created_date'] = '';   
                }
                
                //$data[$each]['type']    = 'PROPERTY';
            }
        }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;
    }

    function getUserAllPitchitCount()
    {
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('wp.*,w.id,w.title, w.modified_date')->from('work_pitchits as wp')->join('works as w','wp.wid = w.id','inner')->where('wp.is_drafted','0')->order_by('wp.pit_id','desc')->get();
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
        }   
        return $data;
    }

    function getTotalViewPitchit($offset=null,$limit=null){
        $data=array();
        $usd = $this->session->userdata('logged_user');
   
        $rs  = $this->db->select('pv.id as pitid,pv.user_id as pituser,pv.wid as pitwid,pv.pitchit_id as pitchitid,pv.date as pitdate,wp.pit_id,wp.user_id,wp.pitchit')->from('pitchit_view as pv')->join('work_pitchits as wp','pv.pitchit_id = wp.pit_id','inner')->where('wp.user_id', $usd['id'])->order_by('pv.id','desc')->limit($limit,$offset)->get();
        $data   = $rs->result_array();
        //echo $this->db->last_query();die;
        if($rs->num_rows() > 0){
            //$data   = $rs->result_array();
            //echo $this->db->last_query();die;
            foreach($data as $each=>$value){
                $row=$this->db->select('name_first,name_middle,name_last')->where('id',$value['pituser'])->where('status_id','1')->get('users')->row_array();
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
                
                $row22=$this->db->select('title')->where('id',$value['pitwid'])->get('works')->row_array();
                if(!empty($row22['title'])){
                    $data[$each]['title'] = $row22['title'];
                }else{
                    $data[$each]['title'] = '';   
                }
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }

    function getTotalViewPitchitCount(){
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $rs  = $this->db->select('pv.id as pitid,pv.user_id as pituser,pv.wid as pitwid,pv.pitchit_id as pitchitid,pv.date as pitdate,wp.pit_id,wp.user_id,wp.pitchit')->from('pitchit_view as pv')->join('work_pitchits as wp','pv.pitchit_id = wp.pit_id','inner')->where('wp.user_id', $usd['id'])->get();
        
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            //echo $this->db->last_query();die;
        }   
        return $data;               
    
    }

    function getAuthorLatestPitchitDetails($offset=null,$limit=null){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
        //$rs  = $this->db->select('s.*,a.*,p.user_id as puid,p.wid as pwid,p.pitchit_id as p_pitchit,p.date as pdate')->from('work_pitchits as s')->join('pitchit_view as p','p.pitchit_id = s.pit_id','inner')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '0')->order_by('s.pit_id','desc')->limit($limit,$offset)->get();
        
        $rs  = $this->db->select('s.*,a.*,pv.id as pid,pv.user_id as pvuid,pv.wid as pwid,pv.pitchit_id as pvpitid,pv.date as pvdate')->from('work_pitchits as s')->join('works as a','s.wid = a.id')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->join('pitchit_view as pv','pv.pitchit_id=s.pit_id','left')->where('s.is_drafted', '0')->group_by('pv.user_id,pv.pitchit_id')->order_by('s.pit_id','desc')->limit($limit,$offset)->get();
         //echo $this->db->last_query();die;
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
      
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
            
       //echo '<pre/>';print_r($data);exit;
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
                
                $row25=$this->db->select('id,name_first,name_middle,name_last')->where('id',$value['pvuid'])->get('users')->row_array();
                if(!empty($row25['name_first']))
                {
                $data[$each]['name_first'] = $row25['name_first'];
                
                }
                else
                {
                 $data[$each]['name_first'] = '';   
                }
                
                if(!empty($row25['name_middle']))
                {
                $data[$each]['name_middle'] = $row25['name_middle'];
                
                }
                else
                {
                 $data[$each]['name_middle'] = '';   
                }
                
                if(!empty($row25['name_last']))
                {
                $data[$each]['name_last'] = $row25['name_last'];
                
                }
                else
                {
                 $data[$each]['name_last'] = '';   
                }
                
                
                //$data[$each]['type']    = 'PROPERTY';
            }
         }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
    
    function getAuthorLatestPitchitViewDetails($pit_id){
         $data=array();
         $usd = $this->session->userdata('logged_user');
  
        //$rs  = $this->db->select("CONCAT(u.name_first,' ',u.name_middle,' ',u.name_last) name", false)->from('users u')->join('pitchit_view pv', 'pv.user_id = u.id')->where('pv.pitchit_id', $pit_id)->get();
        $rs  = $this->db->select("u.name_first,u.name_middle,u.name_last, u.id", false)->from('users u')->join('pitchit_view pv', 'pv.user_id = u.id')->where('pv.pitchit_id', $pit_id)->get();
        //echo $this->db->last_query();die;
        //$rs  = $this->db->select('s.*,a.*,p.user_id as puid,p.wid as pwid,p.pitchit_id as p_pitchit,p.date as pdate')->from('work_pitchits as s')->join('pitchit_view as p','p.pitchit_id = s.pit_id','inner')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '0')->order_by('s.pit_id','desc')->limit($limit,$offset)->get();
        
        
         //echo $this->db->last_query();die;
         //$rs=$this->db->select('*')->where('user_id',$usd['id'])->order_by('create_date','desc')->limit(4)->get('works');
      //die;
      
       if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }   
        return $data;               
    
    }

    function getAuthorLatestPitchitCount(){
        $data=array();
        $usd = $this->session->userdata('logged_user');
  
        $rs  = $this->db->select('s.*,a.*')->from('work_pitchits as s')->join('works as a','s.wid = a.id','inner')->where('s.user_id', $usd['id'])->where('s.is_pitchit', '1')->where('s.is_drafted', '0')->order_by('s.pit_id','desc')->get();
        if($rs->num_rows() > 0){
            $data   = $rs->result_array();
        }   
        //echo "<pre>";print_r($data);echo "</pre>";die;
        //die;
        return $data;               
    
    }
    
   function save_pub_pit($id,$wid,$pit)
   {
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        
        $data['pit_id'] = $id;
        $data['user_id'] = $usd['id'];
        $data['wid'] = $wid;
        $data['pitchit'] = $pit;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['is_pitchit'] = '0';
        $data['is_drafted'] = '1';
        
        $this->db->insert('work_pitchits_saved', $data);
        return 1;
   } 
   
  function get_pitch_inbox($pit_id)
   {
        $data   = array();
        $usd = $this->session->userdata('logged_user');
        
        //$rs  = $this->db->select('id')->where("pitchit_id", $pit_id)->get('messages');
        $data  = $this->db->select('id')->where("pitchit_id", $pit_id)->order_by('id','desc')->limit(1)->get('messages')->row_array();
        
        //echo $this->db->last_query(); 
        
        return $data;
   }


   function get_user_recently_add_titles_count($offset=null,$limit=null){
        $data=array();
        $usd = $this->session->userdata('logged_user');
        $now = date('Y-m-d');
        $date1 = str_replace('-', '/', $now);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
       
        $beforedate = strtotime($now .' -1 months');
        $final=date('Y-m-d', $beforedate);
         
        $data  = $this->db->select('count(*) as count')->from('works')->get()->row_array();
       
        return $data;               
    
    }  
    
    
}
