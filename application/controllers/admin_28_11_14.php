<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin'));
        $this->load->helper(array('url','form'));
       $this->load->library('pagination');
    }
	public function index()
	{
		$this->load->view('admin/login');
	}
   
   public function verify_login(){
        if($this->input->post(null)){
            if($this->madmin->verify_login()){
                redirect('admin/dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('msg', 'Either username or password is incorrect !');
                redirect('admin/', 'refresh');
            }
        }else{
            $this->session->set_flashdata('msg', 'Please login to continue !');
            redirect('admin/', 'refresh');
        }
    } 
    
  private function _check_logged_in(){
        if(!$this->session->userdata('logged_admin')){
            $this->session->set_flashdata('msg', 'Please login to continue !');
            redirect('admin/', 'refresh');
        }
    }  
    
  public function dashboard(){
        $this->_check_logged_in();                  #check the authenticity of the admin
        $data   = array();
        $data['title']  = 'Dashboard';
        $this->load->view('admin/dashboard',$data);
    }
    
 public function logout(){
        $this->session->sess_destroy();
        redirect('admin/', 'refresh');
    }     
    
    public function Demo(){
        $data   = array();
        $data['title']  = 'Demo';
        $this->load->view('admin/test_page',$data);
    }
    public function allfiction(){
        $data   = array();
        $data['title']  = 'All Fiction';
        $data['work_type']  = 1;
        
        $limit=40;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'admin/allfiction/';
        $config['total_rows']     = $this->madmin->allFiction();
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
        
        
        $data['all_form']  = $this->madmin->allFormByFiction( 1 );
        $data['allfictionwork']  = $this->madmin->allWorkByFiction( 1, $this->uri->segment(3), $limit );
        $data['count_totalwork']  = $this->madmin->allFiction();
        //echo $this->db->last_query();die;
        $this->load->view('admin/allfiction/index',$data);
    } 
  public function allnonfiction(){
        $data   = array();
        $data['title']  = 'All Non Fiction';
        $data['work_type']  = 2;
        
        $limit=40;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'admin/allnonfiction/';
        $config['total_rows']     = $this->madmin->allNonFiction();
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
        
        $data['all_form']  = $this->madmin->allFormByFiction( 2 );
        $data['allfictionwork']  = $this->madmin->allWorkByFiction( 2, $this->uri->segment(3), $limit );
        $data['count_totalwork']  = $this->madmin->allNonFiction();
        $this->load->view('admin/allfiction/index',$data);
    } 
    
    function work_details()
    {
        $data   = array();
        $wid = $this->uri->segment(3);
        $data['title'] = "Work Details";
        $data['workdetails']  = $this->madmin->allWorkById( $wid );
        
        $this->load->view('admin/allfiction/details',$data);
        
    }
    
    function allfictionBySearch()
    {
        $message = "";
        $limit = 40;
        $array = array("value" => $this->input->post('value'), "wt_id" => $this->input->post('wt_id'),);
        $this->session->set_userdata( $array );
        $value = $this->session->userdata('value');
        $wt_id = $this->session->userdata('wt_id');
        //echo $value;die;
        //$value = $this->input->post('value');
        $data['totaluser']  = $this->madmin->searchAllWorkByFiction( $wt_id, $this->uri->segment(3), $limit, $value );
        $total = $this->madmin->SearchAllFiction($wt_id, $value);
        /*=======================================*/
        if(!empty($data['totaluser']) && count($data['totaluser'])>0)
        {
            
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'admin/allfictionBySearchNext/';
        $config['total_rows']     = $this->madmin->SearchAllFiction($wt_id, $value);
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
        
            
            foreach($data['totaluser'] as $fictionwork)
            { 
                if((isset($fictionwork['category_name']) && $fictionwork['category_name']!= "")){
                    $cat_name = "<strong>Categories : </strong>".$fictionwork['category_name'];
                }else{
                    $cat_name="";
                }
                if((isset($fictionwork['tag_name']) && $fictionwork['tag_name']!= "")){
                    $tag = "<strong>Tags :</strong> ".$fictionwork['tag_name'];
                }else{
                    $tag="";
                }
                
                
                $message.='<tr class="itemld">
                	<td style="width: 20%;"><img src="'.base_url('images/img_01.jpg').'"></td>
    				<td style="width: 50%;">
    					<a href="'.base_url('admin/work_details/'.$fictionwork['id']).'"><strong>'.$fictionwork['title'].'</strong></a><br /> 
                        ('.$fictionwork['work_form_name'].')<br />
                        by <strong>'.$fictionwork['name'].'</strong>, added <strong>'.date("F Y", strtotime($fictionwork['create_date'])).'</strong><br /><br />
                        '.html_entity_decode(substr($fictionwork['extract'], 0, 150)).'<br />
                        '.$cat_name.'<br />
                        '.$tag.'
    				</td>
    				<td style="width: 30%;">
    					 <a href="#">Add to Judge`s Bookshelf</a><br /> <br /> 
                         <a href="#">Remove from Judge`s Bookshelf</a>
                    </td>
                 </tr>';
            } 
            $message.='<tr class="paginate pagination3"><td>'.$this->pagination->create_links().'</td></tr>';
        }else{
                $message.='<tr><td colspan="3" align="left">No result found...</td></tr>';
            }
        /*=======================================*/
        
        echo $message."appsbee".$total;die;
    }
    
    
    public function allfictionBySearchNext(){
        $data   = array();
        $value = $this->session->userdata('value');
        $wt_id = $this->session->userdata('wt_id');
        $limit=40;
        $total = $this->madmin->SearchAllFiction($wt_id, $value);
        
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'admin/allfictionBySearchNext/';
        $config['total_rows']     = $total;
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
        
        
        $data['allfictionwork']  = $this->madmin->searchAllWorkByFiction( $wt_id, $this->uri->segment(3), $limit, $value );
        
        //echo $this->db->last_query();die;
        $this->load->view('admin/allfiction/index',$data);
    } 
    
    
            
}
