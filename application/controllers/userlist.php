<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserList extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('muserlist','madmin'));
        $this->load->helper(array('url','form'));
        $this->load->library("pagination");
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'View users';
        
        $limit=40;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'userlist/index/';
        $config['total_rows']     = $this->muserlist->getCountUsers();
        $config['per_page']       = $limit;
        $config['uri_segment']    = 3;
        $config['next_link']        = 'Next';
        $config['next_tag_open']    = '<span class="nextPage">';
        $config['next_tag_close']   = '</span>';
        $config['prev_link']        = 'Prev';
        $config['prev_tag_open']    = '<span class="prevPage">';
        $config['prev_tag_close']   = '</span>';
        $config['cur_tag_open']     = '<span class="active_page">';
        $config['cur_tag_close']    = '</span>';
        $config['display_pages']    = FALSE;
        $this->pagination->initialize($config);
        
        $data['totaluser']  = $this->muserlist->get_all_users($this->uri->segment(3),$limit);
        $data['count_totaluser']  = $this->muserlist->getCountUsers();
        $this->load->view('admin/userlist/index',$data);
    }
    
    public function user_search()
    {
        $message = "";
        $limit = 40;
        $array = array("value" => $this->input->post('value'));
        $this->session->set_userdata( $array );
        $value = $this->session->userdata('value');
        //echo $value;die;
        //$value = $this->input->post('value');
        $data['totaluser']  = $this->muserlist->getuser_by_search( $value, $this->uri->segment(3), $limit );
        $total = $this->muserlist->getCountSearchUsers( $value );
        //echo $this->db->last_query();die;
        /*=======================================*/
        if(!empty($data['totaluser']) && count($data['totaluser'])>0)
        {
            
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'userlist/user_search_pagination';
            $config['total_rows']     = $this->muserlist->getCountSearchUsers( $value );
            $config['per_page']       = $limit;
            $config['uri_segment']    = 3;
            $config['next_link']        = 'Next';
            $config['next_tag_open']    = '<span class="nextPage">';
            $config['next_tag_close']   = '</span>';
            $config['prev_link']        = 'Prev';
            $config['prev_tag_open']    = '<span class="prevPage">';
            $config['prev_tag_close']   = '</span>';
            $config['cur_tag_open']     = '<span class="active_page">';
            $config['cur_tag_close']    = '</span>';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
            
            foreach($data['totaluser'] as $user)
            { 
                $row    = $this->db->where('user_id',$user['id'])->get('works')->result_array();
                $work_count     = count($row);
                
                $message.='<tr class="itemld">
                	<td><a href="'.base_url('userlist/userdetails/'.$user['id']).'" style="color: #414247; text-decoration: none;">'.$user['name_first'].' '.$user['name_middle'].' '.$user['name_last'].'</a></td>
                	<td>'.$work_count.'</td>
                	<td class="numeric">'.date('d F Y',strtotime($user['created'])).'</td>
                 </tr>';
            } 
            $message.='<tr class="paginate pagination3"><td>'.$this->pagination->create_links().'</td></tr>';
        }else{
                $message.='<tr><td colspan="3" align="left">No result found...</td></tr>';
            }
        /*=======================================*/
        
        echo $message."appsbee".$total;die;
    }
    
    public function user_search_pagination(){
        $data   = array();
        $value = $this->session->userdata('value');
        $limit=40;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'userlist/user_search_pagination/';
        $config['total_rows']     = $this->muserlist->getCountSearchUsers( $value );
        $config['per_page']       = $limit;
        $config['uri_segment']    = 3;
        $config['next_link']        = 'Next';
        $config['next_tag_open']    = '<span class="nextPage">';
        $config['next_tag_close']   = '</span>';
        $config['prev_link']        = 'Prev';
        $config['prev_tag_open']    = '<span class="prevPage">';
        $config['prev_tag_close']   = '</span>';
        $config['cur_tag_open']     = '<span class="active_page">';
        $config['cur_tag_close']    = '</span>';
        $config['display_pages']    = FALSE;
        $this->pagination->initialize($config);
        
        $data['totaluser']  = $this->muserlist->getuser_by_search( $value, $this->uri->segment(3), $limit );
        //$data['count_totaluser']  = $this->muserlist->getCountUsers();
        $this->load->view('admin/userlist/index',$data);
    }
    
    
    /*public function user_search_pagination()
    {
        $message = "";
        $limit=40;
        $value = $this->input->post('value');
        $data['totaluser']  = $this->muserlist->getuser_by_search( $value, $limit );
        $total = $this->muserlist->getCountSearchUsers( $value );
        //echo $this->db->last_query();die;
        
        if(!empty($data['totaluser']))
        {
            
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'userlist/user_search/';
            $config['total_rows']     = $this->muserlist->getCountSearchUsers( $value );
            $config['per_page']       = $limit;
            $config['uri_segment']    = 3;
            $config['next_link']        = 'Next';
            $config['next_tag_open']    = '<span class="nextPage">';
            $config['next_tag_close']   = '</span>';
            $config['prev_link']        = 'Prev';
            $config['prev_tag_open']    = '<span class="prevPage">';
            $config['prev_tag_close']   = '</span>';
            $config['cur_tag_open']     = '<span class="active_page">';
            $config['cur_tag_close']    = '</span>';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
            
            foreach($data['totaluser'] as $user)
            { 
                $row    = $this->db->where('user_id',$user['id'])->get('works')->result_array();
                $work_count     = count($row);
                
                $message.='<tr class="itemld">
                	<td>'.$user['name_first'].' '.$user['name_middle'].' '.$user['name_last'].'</td>
                	<td>'.$work_count.'</td>
                	<td class="numeric">'.date('d F Y',strtotime($user['created'])).'</td>
                 </tr>';
            } 
            $message.='<tr class="paginate pagination3"><td>'.$this->pagination->create_links().'</td></tr>';
        }else{
                $message.='<tr><td colspan="3" align="left">No result found...</td></tr>';
            }
        
        
        echo $message."appsbee".$total;die;
    }*/
    
    public function userdetails()
    {
        $user_id = $this->uri->segment(3);
        //$user_id = 2;
        $data   = array();
        $data['title']  = 'User profile';
        $data['user_work'] = $this->muserlist->get_user_work( $user_id );
        $data['user_details'] = $this->muserlist->get_user_details( $user_id );
        //$data['work_count'] = $this->muserlist->get_user_work_count( $user_id );
        $data['user_photo'] = $this->muserlist->get_user_photo( $user_id );
        $data['user_biography'] = $this->muserlist->get_user_biography( $user_id );
        //print_r($data['user_details']);die;
        
        $this->load->view('admin/userlist/userdetails',$data);
    }
    
    
    
    
}
