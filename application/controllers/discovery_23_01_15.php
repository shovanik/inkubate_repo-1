<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class discovery extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mbookshelf','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
    
  public function index(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/index/';
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
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
        
        
        $data['discovery'] = $this->mbookshelf->get_books($this->uri->segment(3),$limit);
        $data['fiction_details']  = $this->mwork->fiction_details(1);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('discovery/index',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }
    
  public function formatSearch(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/formatSearch/'.$this->uri->segment(3);
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 4;
            $config['next_link']        = 'Next';
            $config['next_tag_open']    = '<span class="nextPage">';
            $config['next_tag_close']   = '</span>';
            $config['prev_link']        = 'Prev';
            $config['prev_tag_open']    = '<span class="prevPage">';
            $config['prev_tag_close']   = '</span>';
            $config['cur_tag_open']     = '<span class="active_page">';
            $config['cur_tag_close']    = '</span>';
            $config['display_pages']    = TRUE;
            $this->pagination->initialize($config);
        
        
        $data['discovery'] = $this->mbookshelf->get_books_format($this->uri->segment(4),$limit,$this->uri->segment(3));
        $data['fiction_details']  = $this->mwork->fiction_details(1);
        $data['form_name']  = $this->mbookshelf->single_form($this->uri->segment(3));
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/formatSearch',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
    public function typeSearch(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/typeSearch/'.$this->uri->segment(3);
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 4;
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
        
        
        $data['discovery'] = $this->mbookshelf->get_books_type($this->uri->segment(4),$limit);
        $data['form_name']  = $this->uri->segment(3);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/typeSearch',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
   public function writers(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Writers';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/writers/';
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
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
        
        
        $data['writer'] = $this->mbookshelf->writers($this->uri->segment(3),$limit);
        //$data['form_name']  = $this->uri->segment(3);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/writers',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }
    
  public function writers_category(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Writers';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/writers_category/'.$this->uri->segment(3);
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 4;
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
        
        
        $data['writers_category'] = $this->mbookshelf->writers_category($this->uri->segment(4),$limit,$this->uri->segment(3));
        //$data['form_name']  = $this->uri->segment(3);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/writers_category',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }
    
   public function writers_letter(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Writers';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/writers_letter/'.$this->uri->segment(3);
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 4;
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
        
        
        $data['writers_letter'] = $this->mbookshelf->writers_letter($this->uri->segment(4),$limit,$this->uri->segment(3));
        //$data['form_name']  = $this->uri->segment(3);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/writers_letter',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }
    
  public function refine(){
    if($this->session->userdata('logged_user')){
        
        $$this->input->post('group1');
        $this->input->post('work_form');
        
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/refine/'.$this->uri->segment(3);
            $config['total_rows']     = $this->mbookshelf->getCountWorks();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 4;
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
        
        
        $data['discovery'] = $this->mbookshelf->get_books_refine($this->uri->segment(4),$limit);
        $data['fiction_details']  = $this->mwork->fiction_details(1);
        $data['form_name']  = $this->mbookshelf->single_form($this->uri->segment(3));
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        $this->load->view('search/refine',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }    
    
   
   public function demo(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $data['discovery'] = $this->mbookshelf->get_books();
        
        $this->load->view('discovery/demo',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
      
    
 public function addBookShelves(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mbookshelf->addBookShelves();
        
        redirect('bookshelves/', 'refresh');
        //$this->load->view('register_paypal', $data);mbookshelf
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('bookshelves/', 'refresh'); 
            
        }
    }
    
  public function delete_bookshelf()
	{
	   $data['title']  = 'My Bookshelves';
       //echo $this->uri->segment(3);die;
      
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mbookshelf->delete_bookshelf($this->input->post('id')); 
      
	} 
  }
 
 public function user_details()
    {
        if($this->session->userdata('logged_user')){
        $data   = array();
        $wid = $this->uri->segment(3);
        $data['title'] = "User Details";
        
        $this->mwork->viewedbyUser( $wid );
        
        $data['workdetails_test']  = $this->mwork->allUserById( $wid );
        $data['works_count']  = $this->mwork->work_uploaded_UserById( $wid );
        $data['user_work_details']  = $this->mwork->get_user_work_details_byId($wid);
        
        $this->load->view('discovery/userdetails',$data);
       }
        else{
            redirect('home/login', 'refresh');
        } 
    }
    
     
    public function view_profile_details()
    {
        if($this->session->userdata('logged_user')){
        $data   = array();
        //$wid = $this->uri->segment(3);
        $data['title'] = "Profile Details";
        
        //$this->mwork->viewedbyUser( $wid );
        
        $data['profiles']  = $this->mwork->allProfiles();
        //$data['works_count']  = $this->mwork->work_uploaded_UserById( $wid );
        //$data['user_work_details']  = $this->mwork->get_user_work_details_byId($wid);
        
        $this->load->view('discovery/profiledetails',$data);
       }
        else{
            redirect('home/login', 'refresh');
        } 
    }
  
  public function view_bookshelf_profile_details()
    {
        if($this->session->userdata('logged_user')){
        $data   = array();
        //$wid = $this->uri->segment(3);
        $data['title'] = "Bookshelf Details";
        
        //$this->mwork->viewedbyUser( $wid );
        
        $data['profiles']  = $this->mwork->allBookshelfProfiles();
        //$data['works_count']  = $this->mwork->work_uploaded_UserById( $wid );
        //$data['user_work_details']  = $this->mwork->get_user_work_details_byId($wid);
        
        $this->load->view('discovery/bookshelf_profiledetails',$data);
       }
        else{
            redirect('home/login', 'refresh');
        } 
    } 
    
  public function view_download_profile_details()
    {
        if($this->session->userdata('logged_user')){
        $data   = array();
        //$wid = $this->uri->segment(3);
        $data['title'] = "Download Details";
        
        //$this->mwork->viewedbyUser( $wid );
        
        $data['profiles']  = $this->mwork->allDownloadProfiles();
        //$data['works_count']  = $this->mwork->work_uploaded_UserById( $wid );
        //$data['user_work_details']  = $this->mwork->get_user_work_details_byId($wid);
        
        $this->load->view('discovery/download_profiledetails',$data);
       }
        else{
            redirect('home/login', 'refresh');
        } 
    }  
  
  public function download ($file_path = "")
    {
            $this->load->helper('download'); //load helper
             
            //$file_path = $this->input->post("file_path",TRUE);
            $this->mwork->viewDownloadedFile($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            
            $usd = $this->session->userdata('logged_user');
            $file_path = "uploadImage/".$this->uri->segment(5)."/extra_file/".$this->uri->segment(6);
            $layout="no_theme"; //if you have layout
             
            $data['download_path'] = $file_path;        
                         
            $this->load->view("view_file",$data);
            //redirect("same url", "refresh");                        
                     
    }
    
 public function ManageSavedSearches(){
    
    $usd = $this->session->userdata('logged_user');
    if($this->session->userdata('logged_user')){
        
            if($usd['user_type'] == '2')
            {
            $data   = array();
            $data['title']  = 'Saved Searches';
            
            $data['discovery'] = $this->mbookshelf->get_saved_search();
            $data['fiction_details']  = $this->mwork->fiction_details(1);
            $data['form_name']  = $this->mbookshelf->single_form($this->uri->segment(3));
            $data['count_allfiction']  = $this->mbookshelf->allFiction();
            $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
            
            $this->load->view('discovery/ManageSavedSearches',$data);
            }
            else
            {
             redirect('home/author', 'refresh');   
            }
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
  public function delete_saved_search(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
            $data['messages'] =  $this->mbookshelf->delete_saved_search($this->input->post('id'),$this->uri->segment(3),$limit); 
            /*$this->load->library('pagination');
            $config['base_url']       = base_url().'discovery/ManageSavedSearches/';
            $config['total_rows']     = $this->memail->get_save_search_count();
            $config['per_page']       = $limit;
            $config['uri_segment']    = 3;
            $config['next_link']        = '';
            $config['next_tag_open']    = '<span class="nextPage">';
            $config['next_tag_close']   = '</span>';
            $config['prev_link']        = 'Prev';
            $config['prev_tag_open']    = '<span class="prevPage">';
            $config['prev_tag_close']   = '</span>';
            $config['cur_tag_open']     = '<span class="active_page">';
            $config['cur_tag_close']    = '</span>';
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
            
            
            
             $data['pagination'] = $this->pagination->create_links();*/
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    }       
    
     
}
