<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    var $author_per_page = 10;
    var $author_offset = 0;
    var $author_alphabet = "a";
   public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
        $this->load->library('Common');
        
        
    }
    protected function address()
    {
    	 $usd = $this->session->userdata('logged_user');
    	 $per_page = $this->author_per_page;
    	 $data['per_page'] = $per_page;
    	 $page = 1;
    	 $data['page'] = $page;
    	 $offset = 0;
    	
	 if($usd['user_type'] == "1")
		{
			$data['author_list'] = $this->memail->getAuthorInviteByAlphabet($this->author_alphabet,$this->author_per_page,$this->author_offset);
			
			 $data['author_count'] = $this->memail->getAuthorCountInviteByAlphabet($this->author_alphabet);
			
		}
		else
		{
			 $data['author_list']     = $this->memail->getAuthorByAlphabet($this->author_alphabet,$this->author_per_page,$this->author_offset);
	       
	 		 $data['author_count'] = $this->memail->getAuthorCountByAlphabet($this->author_alphabet);
		}
       		$arr = array('count' => $data['author_count'], 'per_page'=> $per_page,'page' => $page,'func' => "FnAuthors",'start' => $offset,'id'=>$this->author_alphabet);
	       $data['pagination'] = Common::page_html($arr);
	      //print_r($data);
    	
	 
	 return $data;
    }
   public function index()
	{
	   //echo "here";die;
       $data['page']   = 'home';
       $data['title']  = 'Inkubate links writers with publishers and agents';
	   $this->load->view('index',$data);
	}
    
   public function signUp(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mhome->register();
        
        $data['page']   = 'signUpSuccess';
        $data['title']  = 'The Inkubate - signUpSuccess';
        $this->load->view('requestsent',$data);
        //$this->load->view('register_paypal', $data);
        //$this->load->view('templates/template', $data);
        //}
        }else{
        $data['page']   = 'signUp';
        $data['title']  = 'The Inkubate - signUp';
        $data['fiction_details']  = $this->mwork->fiction_details(1);
        $this->load->view('signUp', $data);  
            
        }
    }
    
    public function step2(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mhome->register2();
        
        $data['page']   = 'signUpSuccess';
        $data['title']  = 'The Inkubate - signUpSuccess';
        //redirect('home/inbox', 'refresh');
          if($this->session->userdata('logged_user')){
	     $usd = $this->session->userdata('logged_user');
         
         if($usd['user_type'] == '1')
         {
            redirect('home/author', 'refresh');
         }
         else if($usd['user_type'] == '2'){
            
            redirect('home/publisher', 'refresh');
         }
         else
         {
            redirect('admin', 'refresh');
         }
         
        }
        
        //$this->load->view('subscription',$data);
        //$this->load->view('register_paypal', $data);
        //$this->load->view('templates/template', $data);
        //}
        }else{
        $data['page']   = 'signUp';
        $data['title']  = 'The Inkubate - signUp';
        $data['unqid']   = $this->uri->segment(3);
        $this->load->view('step2', $data);  
            
        }
    }
    
  public function register_email_exists(){
        //if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
             echo  $this->mhome->register_email_exists(); 
            } 
        //}
             
    }  
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('home/login', 'refresh');
    } 
    
   public function login(){
        if($this->session->userdata('logged_user')){ 
        //redirect('myhome/league', 'refresh');
        $usd = $this->session->userdata('logged_user');
        
        if($usd['user_type'] == '1')
         {
            redirect('home/author', 'refresh');
         }
         else
         {
            redirect('home/publisher', 'refresh');
         }   
        }else{    
        $data['page']   = 'login';
        $data['title']  = 'The Inkubate - Login';
        
        if (!$this->input->post('remember_me')) {
           //echo "ssssssssssssss"; die;
                $this->session->sess_expiration = 7200;
                $this->session->sess_expire_on_close = TRUE;
            }
            if($this->input->post(null)){
               // print_r($_POST);die;
               $return_url = $this->input->post('seg1').'/'.$this->input->post('seg2').'/'.$this->input->post('seg3');
                                             
                $valid  = $this->mhome->check_credentials();
                if($valid == '1'){
                    //$timezone_identifier = $this->session->userdata['logged_user']['timezone'];
                    //date_default_timezone_set($timezone_identifier);
                    //echo date_default_timezone_get(); die;
                    if($this->input->post('seg1') != '' && $this->input->post('seg2') != '' && $this->input->post('seg3') != '')
                        {
                          redirect(base_url().$return_url, 'refresh');
                        }
                    else
                        {
                          redirect('home/author', 'refresh');  
                        }
                    
                }
                else if($valid == '2'){  
                /*echo '<script type="text/javascript"> alert("Please Update Your Account..");window.location.href="'.base_url().'home/login"; </script>';*/
                    //redirect('myHome/index', 'refresh');
                    
                    if($this->input->post('seg1') != '' && $this->input->post('seg2') != '' && $this->input->post('seg3') != '')
                        {
                          redirect(base_url().$return_url, 'refresh');
                        }
                    else
                        {
                          redirect('home/publisher', 'refresh');  
                        }
                   
                
                }else{
                     $this->session->set_flashdata('active_account', "Sorry, Either your e-mail or password are incorrect.");
                     redirect('home/login', 'refresh');
                }
               } 
            }
            $this->load->view('login', $data);
            
        }
        
    public function author()
	{
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
        if($usd['user_type'] == '1'){   
        $data['title']  = 'Author';
        
         $limit=4;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/author/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
        
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        $data['publisher_pitchit']  = $this->memail->get_publisher_pitchit();
        $data['user_work_details']  = $this->memail->get_user_work_details($this->uri->segment(3),$limit);
        $data['user_pitchit_details']  = $this->memail->get_user_pitchit_details();
        $data['user_view_count']  = $this->mwork->get_user_view_count();
        $data['user_bookshelf_count']  = $this->mbookshelf->get_user_bookshelf_count();
        $data['user_download_count']  = $this->mwork->get_user_download_count();
        $data['user_search_count']  = $this->mwork->get_user_search_count();
        
        $this->load->view('author_dashboard',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
    public function view_all_work()
	{
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
        if($usd['user_type'] == '1'){   
        $data['title']  = 'View All Works';
        
        
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/view_all_work/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        $data['user_work_details']  = $this->memail->get_user_all_work_details($this->uri->segment(3),$limit);
        $this->load->view('view_all_work',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
    public function view_all_pitchit()
	{
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
        if($usd['user_type'] == '1'){   
        $data['title']  = 'View All Pitchits';
        
        
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/view_all_pitchit/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        //$data['user_work_details']  = $this->memail->get_user_all_work_details($this->uri->segment(3),$limit);
        $data['user_pitchit_details']  = $this->memail->get_user_pitchit_details();
        $this->load->view('view_all_pitchit',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
    public function savePitchit()
	{
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
        if($usd['user_type'] == '1'){   
        $data['title']  = 'Save Pitchits';
        
        
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/savePitchit/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        //$data['user_work_details']  = $this->memail->get_user_all_work_details($this->uri->segment(3),$limit);
        $data['user_pitchit_details']  = $this->mwork->get_user_savepitchit_details();
        $this->load->view('view_save_pitchit',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
    public function view_pitchit()
	{
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
        if($usd['user_type'] == '2'){   
        $data['title']  = 'View Pitchit';
        
        
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/view_pitchit/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        //$data['user_work_details']  = $this->memail->get_user_all_work_details($this->uri->segment(3),$limit);
        $data['user_pitchit_details']  = $this->memail->get_user_pitchit($this->uri->segment(3));
        $data['user_pit_details'] = $this->memail->get_pit_details($this->uri->segment(3));  
        $this->load->view('view_single_pitchit',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
    public function publisher()
	{
	   if($this->session->userdata('logged_user')){
	      $usd = $this->session->userdata('logged_user');
          if($usd['user_type'] == '2'){
	       $data['title']  = 'Publisher';
           $data['user_photo']  = $this->mprofile->get_user_photo();
           $data['user_notification']  = $this->memail->get_user_notification();
           $data['user_notification_count']  = $this->memail->get_user_notification_count();
           $data['bookshelf_test'] = $this->mbookshelf->get_bookshelf();
           $data['bookshelf_latest_list'] = $this->mbookshelf->get_book_latest_list();
           
           $data['pitchit_details_category']  = $this->memail->get_pitchit_details_view();
           $data['pitchit_details_form']  = $this->memail->get_pitchit_details_form_view();
           
           //$data['pitchit_details'] = array_merge( $data['pitchit_details_category'], $data['pitchit_details_form'] );
           $data['pitchit_details'] = $this->memail->get_pitchit_details_form_view();
           
           $data['pitchit_details_limit_cat']  = $this->memail->get_pitchit_details_view_limit_cat();
           $data['pitchit_details_limit_form']  = $this->memail->get_pitchit_details_view_limit();
           $data['pitchit_details_limit'] = array_merge( $data['pitchit_details_limit_form'], $data['pitchit_details_limit_cat'] );
           
           $data['pitchit_count']  = $this->memail->get_pitchit_count();
           $data['save_search_count']  = $this->memail->get_save_search_count();
           //$data['pitchit_details_rest']  = $this->memail->get_pitchit_details_rest();
           $this->load->view('publisher_dashboard',$data);
           }
       else{
            redirect('home/login', 'refresh');
           }
           
       }else{
            redirect('home/login', 'refresh');
        }
	} 
    
  public function view_total_pitchits()
	{
	   if($this->session->userdata('logged_user')){
	      $usd = $this->session->userdata('logged_user');
          if($usd['user_type'] == '2'){
	       $data['title']  = 'View Pitchit';
        
        
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/view_pitchit/';
            $config['total_rows']     = $this->memail->getCountWorks();
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
             $config['first_link'] = '';
    	    $config['last_link'] = '';
            $config['display_pages']    = FALSE;
            $this->pagination->initialize($config);
        
        $data['user_photo']  = $this->mprofile->get_user_photo();
       
        $data['user_pitchit_details']  = $this->memail->get_total_pitchit();
       
        $this->load->view('view_total_pitchit',$data);
           }
       else{
            redirect('home/login', 'refresh');
           }
           
       }else{
            redirect('home/login', 'refresh');
        }
   }     
    
      
      
   public function delete_msg(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
             $data['messages'] =  $this->memail->delete_msg($this->input->post('id'),$this->uri->segment(3),$limit); 
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/inbox/';
            $config['total_rows']     = $this->memail->getCountMails();
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
            
            
            
             $data['pagination'] = $this->pagination->create_links();
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    }
    public function mark_msg(){
    	$data = array('status' => "false", 'messages' => array());
        if($this->session->userdata('logged_user')){
           
            if($this->input->post(null)){
                $limit = 15;
		     //print_r($this->input->post('id'));die;
		     $data['status'] = "true";
		     $data['messages'] = $this->memail->mark_msg($this->input->post('id'),$this->uri->segment(3),$limit);
		     $this->load->library('pagination');
		    $config['base_url']       = base_url().'home/inbox/';
		    $config['total_rows']     = $this->memail->getCountMails();
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

		     $data['pagination'] = $this->pagination->create_links();
		     
            } 
        }
      
       header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;
            
    }
    
    public function unmark_msg(){
    	$data = array('status' => "false", 'messages' => array());
        if($this->session->userdata('logged_user')){
           
            if($this->input->post(null)){
                $limit = 15;
		     //print_r($this->input->post('id'));die;
		     $data['status'] = "true";
		     $data['messages'] = $this->memail->unmark_msg($this->input->post('id'),$this->uri->segment(3),$limit);
		      $this->load->library('pagination');
		    $config['base_url']       = base_url().'home/inbox/';
		    $config['total_rows']     = $this->memail->getCountMails();
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

		     $data['pagination'] = $this->pagination->create_links();
            } 
        }
      
       header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;
            
    }
    public function search_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->search_msg($this->input->post('search')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
     public function search_draft_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->search_draft_msg($this->input->post('search')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
    public function search_sent_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->search_sent_msg($this->input->post('search')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
    public function search_trash_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->search_trash_msg($this->input->post('search')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
    public function folder_msg(){
    	$data = array();
    	$data['status'] = "false";
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
             $d = $this->memail->folder_msg($this->input->post('id'),$this->input->post('foldId'),$this->input->post('foldname')); 
             $data['exists'] = $d['exists'];
             $data['success'] = $d['success'];
            } 
        }
          header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;  
    }
    
    
   
    
   
    
  public function move_trash_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->move_trash_msg($this->input->post('id'),$this->input->post('revice_id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
  public function move_draft_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->move_draft_msg($this->input->post('id'),$this->input->post('revice_id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }      
    
     public function addWork()
    	{
    	   $usd = $this->session->userdata('logged_user');
    	   if($this->session->userdata('logged_user')){
    	     
             if($usd['user_type'] == '1'){
               
    	   $data['title']  = 'Add Work';
           $data['user_photo']  = $this->mprofile->get_user_photo();
           $data['fiction_details']  = $this->mwork->fiction_details(1);
           $data['category_details']  = $this->mwork->category_details(2);
           $this->load->view('add_work',$data);
            }
            
           else{
            redirect(base_url().'home/publisher', 'refresh');
            }
            
           }
           
            else{
            redirect(base_url(), 'refresh');
          } 
    	}   
    	
      public function DraftMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data = $this->address();
	   $data['mail_sidebar'] = "2";
	   $data['title']  = 'DraftMail';
	   $limit = 15;
	   $data['draft_count']  = $this->memail->draftCount();
	   $this->load->library('pagination');
            $config['base_url']       = base_url().'home/DraftMail/';
            $config['total_rows']     = $data['draft_count'];
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
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_details']  = $this->memail->draftInfo($this->uri->segment(3),$limit);
       $data['folder_details']  = $this->memail->folderInfo();
       
       
       
            
            
            
        //$data['pagination'] = $this->pagination->create_links();
       $this->load->view('draftmail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}  
public function delete_folder_msg(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
             $data['messages'] =  $this->memail->delete_folder_msg($this->input->post('id'),$this->uri->segment(3),$this->uri->segment(5),$limit); 
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/folder/'.$this->uri->segment(3)."/".$this->uri->segment(4);
            $config['total_rows']     = $this->memail->getCountFolderMails($this->uri->segment(3));
            $config['per_page']       = $limit;
            $config['uri_segment']    = 5;
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
            
            
            
             $data['pagination'] = $this->pagination->create_links();
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    } 
   public function folder()
	{
	 if($this->session->userdata('logged_user')){
		$data = $this->address();
		$data['mail_sidebar'] = "6";
		
	   $data['title']  = urldecode($this->uri->segment(4));
      $data['foldid'] = $this->uri->segment(3);
       $data['mail_count']  = $this->memail->mailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['draft_count']  = $this->memail->draftCount();
       $data['folder_count']  = $this->memail->getCountFolderMails($this->uri->segment(3));
       $limit = 15;
        $this->load->library('pagination');
       $config['base_url']       = base_url().'home/folder/'.$this->uri->segment(3)."/".$this->uri->segment(4);
            $config['total_rows']     = $data['folder_count'];
            $config['per_page']       = $limit;
            $config['uri_segment']    = 5;
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
            $data['mail_details']  = $this->memail->folderMailInfo($this->uri->segment(3),$this->uri->segment(5),$limit);
       	    $this->load->view('folder_message',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}
   public function inbox()
	{
	   if($this->session->userdata('logged_user')){
	   $data = $this->address();
	   
	   $data['title']  = 'Inbox';
           $data['mail_sidebar'] = "1";
       $limit=15;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/inbox/';
            $config['total_rows']     = $this->memail->getCountMails();
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
        
        //$data['totaluser']  = $this->muserlist->get_all_users($this->uri->segment(3),$limit);
      
       $data['mail_details']  = $this->memail->mailInfo($this->uri->segment(3),$limit);
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_count']  = $this->memail->draftCount();
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $this->load->view('inbox',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	} 
    
   public function compose_mail()
	{
	   
	   if($this->session->userdata('logged_user'))
	   { 
	   	$per_page = 10;
	   	$offset = 0;
	   	$page = 1;
	   	$data['page'] = 1;
	   	$data['per_page'] = 10;
	       $usd = $this->session->userdata('logged_user');
	       $id = "a";
	       
	       $data['title']  = 'Compose Mail';
	       $data['mail_details']    = $this->memail->mailInfo();
	       $data['mail_count']      = $this->memail->mailCount();
	       $data['draft_details']   = $this->memail->draftInfo();
	       $data['folder_details']  = $this->memail->folderInfo();
	       //$data['author_list']     = $this->memail->getAuthorList($per_page,$offset);
	       $data['author_count']	= $this->memail->getAuthorCount();
	       
	       $data['author_list']     = $this->memail->getAuthorByAlphabet($id,$per_page,$offset);
	       
	       $count = $this->memail->getAuthorCountByAlphabet($id);
	       
	       $data['draft_count']  = $this->memail->draftCount();
	       $page = array('count' => $count, 'per_page'=> $per_page,'page' => $page,'func' => "FnAuthors",'start' => $offset,'id'=>$id);
	       $data['pagination'] = Common::page_html($page);
	       $this->load->view('compose_mail',$data);
	   }
	   else
	   {
            	redirect('home/login', 'refresh');
           }
	}
	public function compose_mail_author()
	{
	   if($this->session->userdata('logged_user'))
	   { 
	   	$per_page = 10;
	   	$offset = 0;
	   	$page = 1;
	       $usd = $this->session->userdata('logged_user');
	       $id = 0;
	     $data['page'] = 1;
	   	$data['per_page'] = 10;
	       $data['title']  = 'Compose Mail';
	       $data['mail_details']    = $this->memail->mailInfo();
	       $data['mail_count']      = $this->memail->mailCount();
	       $data['draft_details']   = $this->memail->draftInfo();
	       $data['folder_details']  = $this->memail->folderInfo();
	       
	       //$data['author_list']     = $this->memail->getAuthorInviteList($per_page,$offset);
	       $data['author_count']	= $this->memail->getAuthorInviteCount();
	       
	       $data['author_list'] = $this->memail->getAuthorInviteByAlphabet($id,$per_page,$offset);
		$count = $this->memail->getAuthorCountInviteByAlphabet($id);
	       
	       $page = array('count' => $count, 'per_page'=> $per_page,'page' => $page,'func' => "FnAuthors",'start' => $offset,'id'=>0);
	       $data['pagination'] = Common::page_html($page);
	       $this->load->view('compose_mail_author',$data);
	   }
	   else
	   {
            	redirect('home/login', 'refresh');
           }
	}
   	public function authors_page()
	{
	   /*if($this->session->userdata('logged_user'))
	   { 
	   	//$id = $this->input->post('id');
		//$page = $_REQUEST['page'];
		$usd = $this->session->userdata('logged_user');
		$data['status'] = "0";    
		$page     = $this->input->post('page');    
		$cur_page = $page;
		//$page -= 1;
		$per_page = $this->input->post('per_page');   
		if($usd['user_type'] == "1")
		{
			$count = $this->memail->getAuthorInviteCount();
			
		}
		else
		{
			$count = $this->memail->getAuthorCount();
		}
		
		$offset = ($page-1) * $per_page;
		$array = array(
		    'page' => $page,
		    'count' => $count,
		    'per_page' => $per_page,
		    'start' => $offset,
		    'id' => '0',
		    'func' => "FnAuthors"
		);
	       $usd = $this->session->userdata('logged_user');
	       if($usd['user_type'] == "1")
		{
			 $data['author_list']     = $this->memail->getAuthorInviteList($per_page,$offset);
		}
		else
		{
			 $data['author_list']     = $this->memail->getAuthorList($per_page,$offset);
		}
	      
	       if(count($data['author_list']) > 0)
	       {
	       	  	$data['status'] = "1"; 
	       }
	       
	       $data['pagination'] = "";
               $data['pagination'] = Common::page_html($array);
	   }
	   else
	   {
            	$data['status'] = "2";    
           }
	   header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;*/
	    if($this->session->userdata('logged_user'))
	   { 
	   	$id = $this->input->post('id');
		//$page = $_REQUEST['page'];
		$data['status'] = "0";    
		$page     = $this->input->post('page');    
		$cur_page = $page;
		//$page -= 1;
		$per_page = $this->input->post('per_page');  
		$usd = $this->session->userdata('logged_user');
		$offset = ($page-1) * $per_page;
		
		 if($usd['user_type'] == "1")
		{
			$data['author_list'] = $this->memail->getAuthorInviteByAlphabet($id,$per_page,$offset);
			 $count = $this->memail->getAuthorCountInviteByAlphabet($id);
		}
		else
		{
			 $data['author_list']     = $this->memail->getAuthorByAlphabet($id,$per_page,$offset);
			$count = $this->memail->getAuthorCountByAlphabet($id);
		}
		
		
		$array = array(
		    'page' => $page,
		    'count' => $count,
		    'per_page' => $per_page,
		    'start' => $offset,
		    'id' => $id,
		    'func' => "FnAuthors"
		);
	       
		 
	      
	       if(count($data['author_list']) > 0)
	       {
	       	  	$data['status'] = "1"; 
	       }
	       
	       $data['pagination'] = "";
               $data['pagination'] = Common::page_html($array);
	   }
	   else
	   {
            	$data['status'] = "2";    
           }
	   header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
	} 
public function delete_draft_msg(){
    	$data = array();
    	$data['status'] = "false";
   	$data['draft_details'] = array();
   	$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
               // print_r($this->input->post('id'));die;
               $id = $this->input->post('id');
             $data['draft_details'] =  $this->memail->delete_draft_msg($id,$this->uri->segment(3),$limit); 
             $this->load->library('pagination');
            $config['base_url']       = base_url().'home/DraftMail/';
            $config['total_rows']     = $this->memail->draftCount();
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
            
            
            
             $data['pagination'] = $this->pagination->create_links();
            } 
        }
        //print_r($data);
         header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
    } 
   public function delete_sentmail_msg(){
   	$data = array();
   	$data['status'] = "false";
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $limit = 15;
                //print_r($this->input->post('id'));die;
               $data['status'] = "true";
             $data['sent_mail_details'] =  $this->memail->delete_sentmail_msg($this->input->post('id'),$this->uri->segment(3),$limit); 
              $data['sent_mail_count']  = $this->memail->sentMailCount();
             $this->load->library('pagination');
            $config['base_url']       = base_url().'home/SentMail/';
            $config['total_rows']     = $data['sent_mail_count'];
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
            } 
        }
        header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
     //$this->load->view('delete_sentmail_msg',$data);
    }
    
    public function SentMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data = $this->address();
	   $data['mail_sidebar'] = "3";
	   $data['title']  = 'SentMail';
	   $limit = 15;
      // $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
      
       $data['sent_mail_count']  = $this->memail->sentMailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['draft_count']  = $this->memail->draftCount();
       
        $this->load->library('pagination');
            $config['base_url']       = base_url().'home/SentMail/';
            $config['total_rows']     = $data['sent_mail_count'];
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
            $config['display_pages']    = FALSE;
            $config['first_link'] = '';
    	    $config['last_link'] = '';

            $this->pagination->initialize($config);
        $data['sent_mail_details']  = $this->memail->sentMailInfo($this->uri->segment(3),$limit);
       $this->load->view('sentmail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	} 
public function delete_trash_msg(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                $limit = 15;
                //print_r($this->input->post('id'));die;
             $data['messages'] = $this->memail->delete_trash_msg($this->input->post('id'),$this->uri->segment(3),$limit); 
              $this->load->library('pagination');
		    $config['base_url']       = base_url().'home/TrashMail/';
		    $config['total_rows']     = $this->memail->trashMailCount();
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
            } 
        }
       header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;    
    }
    public function undelete_msg(){
    	$data = array('status' => "false", 'messages' => array());
        if($this->session->userdata('logged_user')){
           
            if($this->input->post(null)){
                
		     //print_r($this->input->post('id'));die;
		     $data['status'] = "true";
		     $limit = 15;
		     $data['messages'] = $this->memail->undelete_msg($this->input->post('id'),$this->uri->segment(3),$limit);
		     $this->load->library('pagination');
		    $config['base_url']       = base_url().'home/TrashMail/';
		    $config['total_rows']     = $this->memail->trashMailCount();
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
            } 
        }
      
       header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;
            
    }
     public function TrashMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data = $this->address();
	   $data['mail_sidebar'] = "5";
	   $data['title']  = 'TrashMail';
	   $limit = 15;
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['trash_mail_details']  = $this->memail->trashMailInfo($this->uri->segment(3),$limit);
       $data['trash_mail_count']  = $this->memail->trashMailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['draft_count']  = $this->memail->draftCount();
       
       $this->load->library('pagination');
            $config['base_url']       = base_url().'home/TrashMail/';
            $config['total_rows']     = $data['trash_mail_count'];
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
       	    
       	    
       	    
       $this->load->view('trashmail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}  
    
   public function youtube()
	{
	   $data['page']   = 'Video';
       $data['title']  = 'Inkubate Video';
	   $this->load->view('inkubate_video',$data);
	}      
        
   public function faq()
	{
	   $data['page']   = 'Faq';
       $data['title']  = 'Inkubate Faqs';
	   $this->load->view('faq',$data);
	}
   public function publishers()
	{
	   $data['page']   = 'Publishers';
       $data['title']  = 'Discover new writers on Inkubate';
	   $this->load->view('publishers',$data);
	}
   public function investors()
	{
	   $data['page']   = 'Investors';
       $data['title']  = 'Inkubate investors';
	   $this->load->view('investors',$data);
	} 
  public function about()
	{
	   $data['page']   = 'About';
       $data['title']  = 'Inkubate about';
	   $this->load->view('about',$data);
	} 
    
  public function tour()
	{
	   $data['page']   = 'Tour';
       $data['title']  = 'Inkubate tour';
	   $this->load->view('tour',$data);
	}
  public function contact()
	{
	   $data['page']   = 'Contact';
       $data['title']  = 'Contact Inkubate, connecting writers, publishers and agents';
	   $this->load->view('contact',$data);
	} 
  public function team()
	{
	   $data['page']   = 'Team';
       $data['title']  = 'Inkubate team';
	   $this->load->view('team',$data);
	}
    
  public function terms()
	{
	   $data['page']   = 'Terms';
       $data['title']  = 'Terms of use for Inkubate';
	   $this->load->view('terms',$data);
	}
  public function addfolder(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->memail->addfolder();
        
        redirect('home/inbox', 'refresh');
        //$this->load->view('register_paypal', $data);
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('home/inbox', 'refresh'); 
            
        }
    }
  
  public function addressBook()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'Address Book';
	   $data['mail_sidebar'] = "4";
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['draft_count']  = $this->memail->draftCount();
       //$data['user_details']  = $this->memail->userdetails();
       $per_page = 10;
       $offset = 0;
       $page = 1;
	$usd = $this->session->userdata('logged_user');
	 if($usd['user_type'] == "1")
		{
			$data['author_list'] = $this->memail->getAuthorInviteByAlphabet("a",$per_page,$offset);
			//echo $this->db->last_query();die;
			 $data['author_count'] = $this->memail->getAuthorCountInviteByAlphabet("a");
			$data['count'] = $this->memail->getAuthorInviteAllCount();
			//print_r($data['author_list']);exit;
		}
		else
		{
			 $data['author_list'] = $this->memail->getAuthorByAlphabet("a",$per_page,$offset);
			$data['author_count'] = $this->memail->getAuthorCountByAlphabet("a");
			$data['count'] = $this->memail->getAuthorCount();
		}
       
       
       //print_r($data['author_list']);
       $data['per_page'] = $per_page;
       $data['offset'] = $offset;
       $data['page'] = $page;
       $page = array('count' => $data['author_count'], 'per_page'=> $per_page,'page' => $page,'func' => "FnAuthorsPage",'start' => $offset,'id'=> 'a');
	$data['pagination'] = Common::page_html($page);
       $this->load->view('addressBook',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}
    public function authors_alphabet_page()
	{
	   if($this->session->userdata('logged_user'))
	   { 
	   	$id = $this->input->post('id');
		//$page = $_REQUEST['page'];
		$data['status'] = "0";    
		$page     = $this->input->post('page');    
		$cur_page = $page;
		//$page -= 1;
		$per_page = $this->input->post('per_page');  
		$usd = $this->session->userdata('logged_user');
		$offset = ($page-1) * $per_page;
		
		 if($usd['user_type'] == "1")
		{
			$data['author_list'] = $this->memail->getAuthorInviteByAlphabet($id,$per_page,$offset);
			 $count = $this->memail->getAuthorCountInviteByAlphabet($id);
		}
		else
		{
			 $data['author_list']     = $this->memail->getAuthorByAlphabet($id,$per_page,$offset);
			$count = $this->memail->getAuthorCountByAlphabet($id);
		}
		
		
		$array = array(
		    'page' => $page,
		    'count' => $count,
		    'per_page' => $per_page,
		    'start' => $offset,
		    'id' => $id,
		    'func' => "FnAuthorsPage"
		);
	       
		 
	      
	       if(count($data['author_list']) > 0)
	       {
	       	  	$data['status'] = "1"; 
	       }
	       
	       $data['pagination'] = "";
               $data['pagination'] = Common::page_html($array);
	   }
	   else
	   {
            	$data['status'] = "2";    
           }
	   header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
	} 
  	public function invite_email_exist()
  	{
  		$email = $this->input->post('email');
  		$data = $this->memail->checkMailExist($email);
  		header('Content-Type: application/json; charset=utf-8');
		   echo json_encode($data);
		   exit;
  	}
  	public  function invite()
  	{
  		 if($this->session->userdata('logged_user')){
  		 	$usd = $this->session->userdata('logged_user');
	  		$email = $this->input->post('friend_email');
	  		$name = $this->input->post('friend_name');  
	  		$id = $this->memail->saveInvite($email,$name);
	  		if($id > 0)
	  		{
	  			$to = $email;
	  			//$from = $usd['email'];
	  			$from = "support@inkubate.com";
	  			$name = $usd['name_first']." ".$usd['name_middle']." ".$usd['name_last'];
	  			$from_name = "Join Inkubate";
	  			$subject = "Join Inkubate";
	  			$body = "<p>Your friend ".$name." invited you to join Inkubate, the world first social network for professional content creators, agents, and publishers. When you join Inkubate, you will have access to thousands of other professional writers, editors, agents, and publishers who are looking to collaborate with you and help you publish your content. Inkubate is free to join. Click here.<br><a href='".base_url()."home/signUp'>inkubate.com/signUp</a></p><p>Kind Regards,</p><p>The Inkubate Team</p>";
	  			Common::send_mail($to,$from,$subject,$body,$from_name);
	  			$this->session->set_userdata('invite_mail', "Invite mail sent successfully.");
	  			
	  		}
	  		//exit;
	  		redirect('home/author', 'refresh');
  		}else{
            		redirect('home/login', 'refresh');
        	}
  	}
  	
  	function delete_folder()
  	{  		
  		$data['status'] = "0";
  		if($this->session->userdata('logged_user'))
  		{
  			$id = $this->input->post('id');
  			$data['status'] = $this->memail->delete_folder($id);
  		}
  		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
		exit;
  	}
  	function search_authors()
  	{
  		
		$data['status'] = "0";
		$data['email'] = array();
		
  		if($this->session->userdata('logged_user'))
  		{
  			$usd = $this->session->userdata('logged_user');
  			$search = $this->input->post('value');
  			$data['status'] = "1";
  			if($usd['user_type'] == "2")
  			{
  				$data['email'] = $this->memail->search_authors($search);
  			}
  			if($usd['user_type'] == "1")
  			{
  				$data['email'] = $this->memail->search_by_author($search);
  			}
  			
  		}
  		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
		exit;
  	}
}
?>
