<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class muserlist extends CI_Model
{
    function get_all_users($offset=null,$limit=null)
    {
        $data   = array();
        $rs=$this->db->select('*')->where('user_type !=','4')->where('status_id','1')->order_by('created','desc')->limit($limit,$offset)->get('users');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
            foreach($data as $each=>$value){
                
                
                $row=$this->db->where('user_id',$value['id'])->get('works')->result_array();
                
                $data[$each]['work_count'] = count($row);
                
                //$data[$each]['type']    = 'PROPERTY';
            }
        }
        $rs->free_result();
        //echo "<pre>";print_r($data);echo "</pre>";die;
        return $data;
    }
    function getCountUsers()
    {
       $data   = array();
        $rs=$this->db->select('*')->where('user_type !=','4')->where('status_id','1')->order_by('created','desc')->get('users');
        if($rs->num_rows()>0)
        {
            $data   = $rs->result_array();
        }
        
        return COUNT($data); 
	
    }
    
    function getCountSearchUsers( $value )
    {
        $data   = array();
        $this->db->select("*");
        $this->db->like("name_first", $value, "after");
        $this->db->or_like("name_middle", $value, "after");
        $this->db->or_like("name_last", $value, "after");
        $this->db->order_by('created','desc');
        $this->db->where('user_type !=','4');
        $this->db->where('status_id','1');
        $row = $this->db->get("users");
        if($row->num_rows()>0)
        {
            $data   = $row->result_array();
        }
        
        return COUNT($data); 
	
    }
    
    function getuser_by_search( $value, $offset=null,$limit=null )
    {
        $data = array();
        $this->db->select("*");
        $this->db->like("name_first", $value, "after");
        $this->db->or_like("name_middle", $value, "after");
        $this->db->or_like("name_last", $value, "after");
        $this->db->order_by('created','desc');
        $this->db->where('user_type !=','4');
        $this->db->where('status_id','1');
        $this->db->limit( $limit, $offset );
        $rs = $this->db->get("users");
        if($rs->num_rows()>0 )
        {
            $data   = $rs->result_array();
            foreach($data as $each=>$result){
                $row=$this->db->where('user_id',$result['id'])->get('works')->result_array();
                $data[$each]['work_count'] = count($row);
            }
        }
        $rs->free_result();
        return $data;
    }
    
    function get_user_details( $user_id )
    {
        $this->db->select("u.id, u.name_first, u.name_middle, u.name_last, u.postal_code, u.date_of_birth, u.email, u.created, u.status_id")->where( 'u.id',$user_id )->where('u.status_id','1');
        $row=$this->db->get('users u')->row_array();
        //echo $this->db->last_query();die;
        return $row;
    }
    
    public function get_user_biography( $user_id )
    {
        $this->db->select("biography")
                ->where( 'user_id',$user_id );
        $row=$this->db->get('profile_writer')->row_array();
        //echo $this->db->last_query();die;
        return $row;
    }
    
    public function get_user_photo( $user_id )
    {
        $this->db->select("filename image")
                ->where( 'user_id',$user_id );
        $row=$this->db->get('assets')->row_array();
        //echo $this->db->last_query();die;
        return $row;
    }
    
    function get_user_work( $user_id )
    {
        $this->db->select("works.title, work_types.work_type_name, categories.category_name");
        $this->db->join("work_types", "work_types.work_type_id = works.work_type_id", "left");
        $this->db->join("work_categories", "work_categories.Wid = works.id", "left");
        $this->db->join("categories", "categories.id = work_categories.cid", "left");
        $row=$this->db->where( 'works.user_id',$user_id )->get('works')->result_array();
        //echo $this->db->last_query();die;
        return $row;
    }
    
    function get_user_work_count( $user_id )
    {
        $this->db->select("count(*) total_count")
                ->where( 'works.user_id',$user_id );
        $row=$this->db->get('works')->row_array();
        //echo $this->db->last_query();die;
        return $row['total_count'];
    }
   

}
