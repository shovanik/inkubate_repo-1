<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    var $author_per_page = 10;
    var $author_offset = 0;
    var $author_alphabet = "a";
   public function __construct()
    {
    	
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf','mfeeds','mnews','mpitchit'));
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
         else if($usd['user_type'] == '2')
         {
            redirect('home/publisher', 'refresh');
         }
         else if($usd['user_type'] == '3')
         {
            redirect('home/agent', 'refresh');
         }
         else
         {
            redirect('home/editor', 'refresh');
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
                   
                
                }
                else if($valid == '3'){  
                /*echo '<script type="text/javascript"> alert("Please Update Your Account..");window.location.href="'.base_url().'home/login"; </script>';*/
                    //redirect('myHome/index', 'refresh');
                    
                    if($this->input->post('seg1') != '' && $this->input->post('seg2') != '' && $this->input->post('seg3') != '')
                        {
                          redirect(base_url().$return_url, 'refresh');
                        }
                    else
                        {
                          redirect('home/agent', 'refresh');  
                        }
                   
                
                }
                else{
                     $this->session->set_flashdata('active_account', "Sorry, Either your e-mail or password are incorrect.");
                     redirect('home/login', 'refresh');
                }
               } 
            }
            $this->load->view('login', $data);
            
        }
        
    public function author()
	{
	   //$this->session->unset_userdata('random_number');
       
	   if($this->session->userdata('logged_user')){
	    $usd = $this->session->userdata('logged_user');
            if($usd['user_type'] == '1'){   
            $data['title']  = 'Author';

            $limit=6;
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
        
        $data['user_contact'] = $this->mprofile->get_user_iscontact();
        
        $data['publisher_pitchit']  = $this->memail->get_publisher_pitchit();
        $data['pitchit_details_limit'] = $this->memail->pitchitInbox_limit3();
        
        //$data['user_work_details']  = $this->memail->get_user_work_details($this->uri->segment(3),$limit);
        
        $data['user_work_details']  = $this->memail->get_user_work_details();
        

        //Latest Pitchit Portion Start//
        //$data['user_pitchit_details']  = $this->memail->get_user_pitchit_details();
        $limit_latest   =  6;
        $page_latest    =  1;
        $offset_latest  = ($page_latest - 1) * $limit_latest;
        $data['offset_latest']  = $offset_latest;
        $data['page_latest']    = $page_latest;
        $data['user_pitchit_details']  = $this->mpitchit->getAuthorLatestPitchitDetails($offset_latest,$limit_latest);
       /* echo "<pre>".print_r($data['user_pitchit_details']);die;
        
        $i = 0;
        $author_pitchit_details = array();
        foreach($data['user_pitchit_details'] as $pitch_details){
           $single_user_view_cnt = $this->mwork->single_user_view_count($pitch_details['pit_id']); 
           if($single_user_view_cnt['count'] > 0)
           {
                $user_pitchit_view_details = $this->mpitchit->getAuthorLatestPitchitViewDetails($pitch_details['pit_id']);
                foreach($user_pitchit_view_details as $pitch_2)
                {
                    $author_pitchit_details[$i]['pit_id'] = $data['user_pitchit_details']['pit_id'];
                    $author_pitchit_details[$i]['user_id'] = $pitch_2['user_id'];
                    $author_pitchit_details[$i]['wid'] = $data['user_pitchit_details']['wid'];
                    $author_pitchit_details[$i]['pitchit'] = $data['user_pitchit_details']['pitchit'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    
                    $author_pitchit_details[$i]['view'] = $data['user_pitchit_details']['view'];
                    $author_pitchit_details[$i]['is_pitchit'] = $data['user_pitchit_details']['is_pitchit'];
                    $author_pitchit_details[$i]['is_drafted'] = $data['user_pitchit_details']['is_drafted'];
                    $author_pitchit_details[$i]['rank'] = $data['user_pitchit_details']['rank'];
                    $author_pitchit_details[$i]['id'] = $data['user_pitchit_details']['id'];
                    $author_pitchit_details[$i]['asset_id'] = $data['user_pitchit_details']['asset_id'];
                    $author_pitchit_details[$i]['file_asset_id'] = $data['user_pitchit_details']['file_asset_id'];
                    $author_pitchit_details[$i]['work_guid'] = $data['user_pitchit_details']['work_guid'];
                    $author_pitchit_details[$i]['work_type_id'] = $data['user_pitchit_details']['work_type_id'];
                    $author_pitchit_details[$i]['work_form_id'] = $data['user_pitchit_details']['work_form_id'];
                    $author_pitchit_details[$i]['user_guid'] = $data['user_pitchit_details']['user_guid'];
                    $author_pitchit_details[$i]['title'] = $data['user_pitchit_details']['title'];
                    $author_pitchit_details[$i]['synopsis'] = $data['user_pitchit_details']['synopsis'];
                    $author_pitchit_details[$i]['extract'] = $data['user_pitchit_details']['extract'];
                    $author_pitchit_details[$i]['status_id'] = $data['user_pitchit_details']['status_id'];
                    $author_pitchit_details[$i]['visibility_id'] = $data['user_pitchit_details']['visibility_id'];
                    $author_pitchit_details[$i]['cover_asset_guid'] = $data['user_pitchit_details']['cover_asset_guid'];
                    $author_pitchit_details[$i]['sequence'] = $data['user_pitchit_details']['sequence'];
                    $author_pitchit_details[$i]['create_date'] = $data['user_pitchit_details']['create_date'];
                    $author_pitchit_details[$i]['modified_date'] = $data['user_pitchit_details']['modified_date'];
                    $author_pitchit_details[$i]['self_published'] = $data['user_pitchit_details']['self_published'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    $author_pitchit_details[$i]['created_date'] = $data['user_pitchit_details']['created_date'];
                    
                    $i++;
                }
           }else{
                $data['user_pitchit_details']['name'] = "N/A";
                
                $i++;
           }
            
        } */
        
        //print_r($data['user_pitchit_details']);die;
        
        
        
        $data['AuthorLatestPitchitCount']  = $this->mpitchit->getAuthorLatestPitchitCount();
        //Latest Pitchit Portion End//
        
        //Saved Pitchit Portion Start//
        $limit_saved   =  6;
        $page_saved    =  1;
        $offset_saved  = ($page_saved - 1) * $limit_saved;
        $data['offset_saved']  = $offset_saved;
        $data['page_saved']    = $page_saved;
        $data['user_pitchit_saved_details']  = $this->memail->get_user_pitchit_saved_details($offset_saved,$limit_saved);
        $data['user_pitchit_saved_details_cnt']  = $this->memail->get_user_pitchit_saved_details_cnt();
        //Saved Pitchit Portion End//


        $data['user_view_count']  = $this->mwork->get_user_view_count();
        $data['user_bookshelf_count']  = $this->mbookshelf->get_user_bookshelf_count();
        $data['user_download_count']  = $this->mwork->get_user_download_count();
        $data['user_search_count']  = $this->mwork->get_user_search_count();
        
        $data['user_details_payment']  = $this->mwork->get_user_details();
        $data['news']  = $this->mnews->getNewsName_author();

        //Total Viewed Pitchit Portion Start//
        $limit_totalviewed   =  6;
        $page_totalviewed    =  1;
        $offset_totalviewed  = ($page_totalviewed - 1) * $limit_totalviewed;
        $data['offset_totalviewed']  = $offset_totalviewed;
        $data['page_totalviewed']    = $page_totalviewed;
        $data['total_view_pitchit']  = $this->memail->get_publisher_totalview_pitchit($offset_totalviewed,$limit_totalviewed);
        $data['total_view_pitchit_cnt']  = $this->memail->get_publisher_totalview_pitchit_cnt();
        //Total Viewed Pitchit Portion End//
        
        
        
        $data['aep_male_percent']  = $this->memail->get_aep_male_percent();
        $data['aep_female_percent']  = $this->memail->get_aep_female_percent();
        $data['total_aep']  = $this->memail->get_aep_total();
        
        $data['purchase_pitchit']  = $this->memail->get_purchase_pitchit_total();
        $data['pitchit_use_count']  = $this->memail->get_use_pitchit_count();
        $data['pitchit_count']  = $this->memail->get_pitchit_count();
        
        $data['total_pitchit_package']  = $this->memail->get_total_pitchit_package();
        
        $limit_p=10;
        $page = 1;
        $offset = ($page - 1) * $limit_p;
	    $data['offset'] = $offset;
        $data['page'] = $page;
        
        $data['total_rows']                 = $this->mwork->getCountSearch();
        $data['user_search_details']        = $this->memail->get_user_search_details($offset,$limit_p);
        
        $data['total_rows2']                = $this->mwork->getCountUserView();
        $data['user_view_details']          = $this->memail->get_user_view_details($offset,$limit_p);
        //$data['user_view_details']  = $this->memail->get_author_view_details($offset,$limit_p);
        
        $data['total_rows3']                = $this->mwork->getCountUserDownload();
        $data['user_download_details']      = $this->memail->get_user_download_details($offset,$limit_p);
        
        $data['total_rows4']                = $this->mwork->getCountUserBookshelf();
        $data['bookshelf_profiles']         = $this->mwork->allBookshelfByProfiles($offset,$limit_p);
        
        $data['user_popular_search_work']   = $this->memail->get_user_popular_search_work();
        $data['countries']                  = $this->mprofile->getCountries();

        //profile percentage
                     $val = 0;
             $oth = $this->mprofile->get_user_web_link(4);
              if(!empty($oth['url'])) { $val=$val+1; } 
             
              $fb = $this->mprofile->get_user_web_link(1);
              if(!empty($fb['url'])) { $val=$val+1;}
             
              $twt = $this->mprofile->get_user_web_link(2);
              if(!empty($twt['url'])) { $val=$val+1; }
             
              $rss = $this->mprofile->get_user_web_link(3);
              if(!empty($rss['url'])) { $val=$val+1; } 
              $linkin= $this->mprofile->get_user_web_link(5);
             if(!empty($linkin['url'])) { $val=$val+1; } 
             
           $user_bio = $this->mprofile->get_user_bio($this->uri->segment(3));
           if(!empty($user_bio['biography'])) { $val=$val+1; } 
           if(!empty($user_bio['self_published'])) { $val=$val+1; }
           //if(!empty($user_bio['published_abroad'])) { $val=$val+1; }
           if(!empty($user_bio['literary_awards'])) { $val=$val+1; }
           
           $user_pic = $this->mprofile->get_user_picture();
           if(!empty($user_pic['filename'])) { $val=$val+1; }
           //echo "<pre>";
           //print_r($user_bio);
           $user_contact = $this->mprofile->get_user_iscontact();
           if(!empty($user_contact['name_first'])) { $val=$val+1; } 

           if(!empty($user_contact['address'])) { $val=$val+1; }
           if(!empty($user_contact['city'])) { $val=$val+1; }
           if(!empty($user_contact['state'])) { $val=$val+1; } 
           if(!empty($user_contact['country'])) { $val=$val+1; } 

           if(!empty($user_contact['company_name'])) { $val=$val+1; }
           if(!empty($user_contact['industry'])) { $val=$val+1; }  
           if(!empty($user_contact['postal_code'])) { $val=$val+1; }

           if(!empty($user_contact['job_title'])) { $val=$val+1; } 
           
            if(!empty($user_contact['age'])) { $val=$val+1; }
            //echo $val; exit; 
           if(!empty($user_contact['gender'])) { $val=$val+1; }  
           //echo $val; exit;                                      
            //print_r($user_contact);
           $data['val'] = $val;
           //exit;
           //profile percentage

        
        $this->load->view('author_dashboard',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}

    function ajax_latest_pitchit_search_author()
    {
        if($this->session->userdata('logged_user')){
            
            $data   = array();
            
            $limit_latest    = $this->input->post('limit_latest');
            $data['page_latest'] = $this->input->post('page_latest');
            $data['offset_latest'] = ($data['page_latest'] - 1) * $limit_latest;
            $data['user_pitchit_details']  = $this->mpitchit->getAuthorLatestPitchitDetails($data['offset_latest'],$limit_latest);
            $data['AuthorLatestPitchitCount']  = $this->mpitchit->getAuthorLatestPitchitCount();
            $data['view_more']  = (count($data['AuthorLatestPitchitCount'])-($limit_latest*$data['page_latest']));
            $this->load->view('ajax_search/ajax_latest_pitchit_search_author',$data);
        }
    }

    function ajax_viewall_pitchit_search_author()
    {
        if($this->session->userdata('logged_user')){
            
            $data   = array();
            
            $limit_latest    = $this->input->post('limit_latest');
            $data['page_latest'] = $this->input->post('page_latest');
            $data['offset_latest'] = ($data['page_latest'] - 1) * $limit_latest;
            $data['user_pitchit_details']  = $this->mpitchit->getAuthorLatestPitchitDetails($data['offset_latest'],$limit_latest);
            $data['AuthorLatestPitchitCount']  = $this->mpitchit->getAuthorLatestPitchitCount();
            $data['view_more']  = (count($data['AuthorLatestPitchitCount'])-($limit_latest*$data['page_latest']));
            $this->load->view('ajax_search/ajax_viewall_pitchit_search_author',$data);
        }
    }

    function ajax_totalviewed_pitchit_search_author()
    {
        if($this->session->userdata('logged_user')){
            
            $data   = array();
            
            $limit_totalviewed    = $this->input->post('limit');
            $data['page_totalviewed'] = $this->input->post('page');
            $data['offset_totalviewed'] = ($data['page_totalviewed'] - 1) * $limit_totalviewed;
            $data['total_view_pitchit']  = $this->memail->get_publisher_totalview_pitchit($data['offset_totalviewed'],$limit_totalviewed);
            $data['total_view_pitchit_cnt']  = $this->memail->get_publisher_totalview_pitchit_cnt();
            $data['view_more']  = ($data['total_view_pitchit_cnt']-($limit_totalviewed*$data['page_totalviewed']));
            //echo count($data['total_view_pitchit_cnt']);die;
            $this->load->view('ajax_search/ajax_totalviewed_pitchit_search_author',$data);
        }
    }
  
  
   public function ajax_publisher_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
		
			$data['total_rows']  = $this->mwork->getCountSearch();   
			$data['user_search_details']  = $this->memail->get_user_search_details($data['offset'],$limit);
		
		$this->load->view('ajax_search/ajax_publisher_search',$data);
        }
        
    }
    
    public function ajax_publisher_view_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
		
            $data['total_rows2']  = $this->mwork->getCountUserView();
            $data['user_view_details']  = $this->memail->get_user_view_details($data['offset'],$limit);
		
		$this->load->view('ajax_search/ajax_publisher_view_search',$data);
        }
        
    }
    
    public function ajax_publisher_download_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
        $data['total_rows3']  = $this->mwork->getCountUserDownload();
        $data['user_download_details']  = $this->memail->get_user_download_details($data['offset'],$limit);
		
		$this->load->view('ajax_search/ajax_publisher_download_search',$data);
        }
        
    }
  
   public function ajax_publisher_bookshelved_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
        $data['total_rows4']  = $this->mwork->getCountUserBookshelf();
        $data['bookshelf_profiles']  = $this->mwork->allBookshelfByProfiles($data['offset'],$limit);
		
		$this->load->view('ajax_search/ajax_publisher_bookshelved_search',$data);
        }
        
    }
  
    public function author_demo()
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
        $data['user_pitchit_saved_details']  = $this->memail->get_user_pitchit_saved_details();
        $data['user_pitchit_saved_details_cnt']  = $this->memail->get_user_pitchit_saved_details_cnt();
        $data['user_view_count']  = $this->mwork->get_user_view_count();
        $data['user_bookshelf_count']  = $this->mbookshelf->get_user_bookshelf_count();
        $data['user_download_count']  = $this->mwork->get_user_download_count();
        $data['user_search_count']  = $this->mwork->get_user_search_count();
        
        $data['total_view_pitchit']  = $this->memail->get_publisher_totalview_pitchit();
        $data['total_view_pitchit_cnt']  = $this->memail->get_publisher_totalview_pitchit_cnt();
        
        $data['aep_male_percent']  = $this->memail->get_aep_male_percent();
        $data['aep_female_percent']  = $this->memail->get_aep_female_percent();
        $data['total_aep']  = $this->memail->get_aep_total();
        
        //$data['user_search_details']  = $this->memail->get_user_search_details();
        
       
        
        $data['user_view_details']  = $this->memail->get_user_view_details();
        $data['user_download_details']  = $this->memail->get_user_download_details();
        
        $this->load->view('author_dashboard(30-01-15)',$data);
          }
           else{
                redirect('home/login', 'refresh');
            }
       }else{
            redirect('home/login', 'refresh');
        }
	}
  
  public function user_details_search()
  {
     $result_set = array();
     $page = array();
        /*------------ajax paginatio---------------*/
        
        $page_number = $this->input->post('page_number');
        $item_par_page = 6;
        $position = ($page_number*$item_par_page);
        
         $result_set['data'] = $this->memail->get_user_search_details_demo($position,$item_par_page);
         $total_set =  count($result_set['data']);
         //print_r($total_set);die;
         $page['total'] =  $this->memail->get_user_search_details_total() ;
         $total =  count($page['total']);
         //echo $total;die;
        /*$result_set = $this->db->query("SELECT * FROM countries LIMIT ".$position.",".$item_par_page);
        $total_set =  $result_set->num_rows();
        $page =  $this->db->get('countries') ;
        $total =  $page->num_rows();*/
        
       
        $total = ceil($total/$item_par_page);
        
        if($total_set>0){
            $entries = null;
	// get data and store in a json array
            foreach($result_set['data'] as $row){
                 $entries[] = $row;
            }
            $data = array(
                'TotalRows' => $total,
                'Rows' => $entries
            );              
            $this->output->set_content_type('application/json');
            echo json_encode(array($data));
        }
        exit;
        
        /*-------------end pagination--------------*/
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
           $data['user_notification_total']  = $this->memail->get_total_user_notification();
           $data['bookshelf_test'] = $this->mbookshelf->get_bookshelf();
           $data['bookshelf_latest_list'] = $this->mbookshelf->get_book_latest_list();
           
           $data['user_contact'] = $this->mprofile->get_user_iscontact();
           
           $data['pitchit_details_category']  = $this->memail->get_pitchit_details_view();
           $data['pitchit_details_form']  = $this->memail->get_pitchit_details_form_view();
           
           //$data['pitchit_details'] = array_merge( $data['pitchit_details_category'], $data['pitchit_details_form'] );
           $data['pitchit_details'] = $this->memail->get_pitchit_details_form_view();

           //Latest Pitchit Portion Start//
            $limit   =  5;
            $page    =  1;
            $offset  = ($page - 1) * $limit;
            $data['offset']  = $offset;
            $data['page']    = $page;
            $data['userLatestPitchitDetails']  = $this->mpitchit->getUserLatestPitchitDetails($offset,$limit);
            $data['userLatestPitchitCount']  = $this->mpitchit->getUserLatestPitchitCount();
            $data['view_more']  = (count($data['userLatestPitchitCount'])-($limit*$data['page']));
            //Latest Pitchit Portion End//

            //Saved pitchits portion//
            $data['userSavedPitchitCount']    = $this->mpitchit->getUserSavedPitchitCount_pub();
            //Saved pitchits portion//

            //View All pitchits portion//
            $data['userViewallPitchitCount']      = $this->mpitchit->getUserAllPitchitCount();
            //View All pitchits portion//

            //pitchits responses portion Start//
            $data['pitchit_resp_cnt'] = $this->memail->get_user_pitchit_msg_response_cnt();;
            //pitchits responses portion End//

            //Total Viewed pitchits portion Start//
            $data['totalViewPitchitCount']    = $this->mpitchit->getTotalViewPitchitCount();
            //Total Viewed pitchits portion End//

            $data['pitchit_details_limit'] = $this->memail->pitchitInbox_limit3();
           
           

            $data['pitchit_count']  = $this->memail->get_pitchit_count();
            $data['save_search_count']  = $this->memail->get_save_search_count();
           
           
           
           
           $data['total_view_pitchit']  = $this->memail->get_publisher_totalview_pitchit_side();
           
           $data['writer_male_percent']  = $this->memail->get_writer_male_percent();
           $data['writer_female_percent']  = $this->memail->get_writer_female_percent();
           $data['total_writer']  = $this->memail->get_writer_total();
           
           $data['user_popular_search_work']  = $this->memail->get_user_popular_search_work();
           
           
           //Recently Added Titles Portion//
            $limit_p=10;
            $page = 1;
            $offset = ($page - 1) * $limit_p;
    	    $data['offset'] = $offset;
            $data['page'] = $page;
            
            //$data['total_rows']  = $this->mwork->getCountAuthorRecentTitle();
            //$data['total_rows']  = 50;
            $data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles($offset,$limit_p);
            $data['total_rows']  = $this->mpitchit->get_user_recently_add_titles_count();
            //$data['user_recently_add_titles_cnt']  = $this->memail->get_user_recently_add_titles_count();
            //$data['user_recently_add_titles_cnt']  = 50;
            //Recently Added Titles Portion//
            
            /*$data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles();
           $data['user_recently_add_titles_cnt']  = $this->memail->get_user_recently_add_titles_count();*/
           $data['total_rows2']  = $this->mwork->getCountAuthorView();
           //$data['author_view_details']  = $this->memail->get_author_view_details($offset,$limit_p);
           //$data['author_view_cnt']  = $this->memail->get_author_view_details_count();
           $data['author_view_cnt']  = $this->memail->get_author_view_details_cnt();
           
           $data['total_rows3']  = $this->mwork->getCountDownload();
           //$data['user_download_details']  = $this->memail->get_user_work_download_details($offset,$limit_p);
           $data['user_download_details_cnt']  = $this->memail->get_downloads_details_count();
           
           $data['user_bookshelf_details_cnt']  = $this->mbookshelf->get_user_author_bookshelf_count();
           
           $data['user_popular_category_work']  = $this->memail->get_user_popular_category_work();
           //$data['bookshelf_profiles']  = $this->mwork->allBookshelfByWriterProfiles();
           
           $data['feeds_list']          = $this->mfeeds->getAllFeeds();
           //$data['feeds_url']           = $this->mfeeds->getActiveFeedsUrlList( $usd['id'] );
           $data['feeds_url']           = $this->mfeeds->getAllFeedsUrl();
           //print_r($data['feeds_url']);die;
           
           //################feeds list portion################//
            $feeds_data = array();
            $feeds_array = array();
            $feeds = $this->mfeeds->getActiveFeedsUrlList($usd['id']);
            if(is_array($feeds) && count($feeds) >0){
                foreach($feeds as $feeds_list){
                    $json   = simplexml_load_file($feeds_list['feeds_url']);
                    $image = $json->channel->image->title;
                    //echo "<pre>".print_r( $json->channel->item )."</pre>";die;
                    //if(is_array($json->channel->item) && count($json->channel->item) >0){
                        foreach($json->channel->item as $row){
                            
                            $media  = $row->children('media', TRUE);
                            if ($media->content && $media->content->attributes()) {
                                $attrs = $media->content->attributes();
                                $feeds_array['image'] = '<img class="feed_image" src="'.$attrs['url'].'" alt="" height="30" width="30" />';
                            }else{
                                if($image == "PublishersWeekly.com"){
                                    $feeds_array['image'] = '<img style="height:30px;" src="http://www.publishersweekly.com/images/logo-trans.png" alt="" />';
                                }else{
                                    $feeds_array['image'] = '<img src="'.base_url().'images/wsj.png" alt="" />';
                                }
                                
                            }
                            
                            $feeds_array['guid'] = ($row->guid !="") ? $row->guid : "";
                            $feeds_array['description'] = ($row->description !="") ? $row->description : "";
                            $feeds_array['create_date'] = ($row->pubDate !="") ? $row->pubDate : "";
                            $feeds_array['title'] = ($row->title !="") ? $row->title : "";
                            $feeds_array['link'] = ($row->link !="") ? $row->link : "";
                            $feeds_array['type'] = "feeds";
                            $feeds_array['source_org'] = explode('.com',$json->channel->image->title);
                            $feeds_array['source'] = $feeds_array['source_org'][0];
                            array_push($feeds_data, $feeds_array);
                        }
                    //}
                }
            }
            $data['feeds_details'] = $feeds_data;
            
            
            //$json= simplexml_load_file('http://publishersweekly.com/pw/feeds/recent/index.xml');
            //echo "<pre>".print_r( $json )."</pre>";die;
           //################feeds list portion################//
             $val = 0;
             $oth = $this->mprofile->get_user_web_link(4);
              if(!empty($oth['url'])) { $val=$val+1; } 
             
              $fb = $this->mprofile->get_user_web_link(1);
              if(!empty($fb['url'])) { $val=$val+1;}
             
              $twt = $this->mprofile->get_user_web_link(2);
              if(!empty($twt['url'])) { $val=$val+1; }
             
              $rss = $this->mprofile->get_user_web_link(3);
              if(!empty($rss['url'])) { $val=$val+1; } 
              $linkin= $this->mprofile->get_user_web_link(5);
             if(!empty($linkin['url'])) { $val=$val+1; } 
             
           $user_bio = $this->mprofile->get_user_bio($this->uri->segment(3));
           if(!empty($user_bio['biography'])) { $val=$val+1; } 
           if(!empty($user_bio['interested_title'])) { $val=$val+1; }
           //if(!empty($user_bio['literary_awards'])) { $val=$val+1; }
           if(!empty($user_bio['offer_ebook'])) { $val=$val+1; }
           
           $user_pic = $this->mprofile->get_user_picture();
           if(!empty($user_pic['filename'])) { $val=$val+1; }
           //echo "<pre>";
           //print_r($user_bio);
           $user_contact = $this->mprofile->get_user_iscontact();
           if(!empty($user_contact['name_first'])) { $val=$val+1; } 
           if(!empty($user_contact['address'])) { $val=$val+1; }
           if(!empty($user_contact['city'])) { $val=$val+1; }
           if(!empty($user_contact['state'])) { $val=$val+1; } 
           if(!empty($user_contact['country'])) { $val=$val+1; } 
           if(!empty($user_contact['company_name'])) { $val=$val+1; }
           if(!empty($user_contact['industry'])) { $val=$val+1; }  
           if(!empty($user_contact['postal_code'])) { $val=$val+1; }
           if(!empty($user_contact['job_title'])) { $val=$val+1; }  
            if(!empty($user_contact['age'])) { $val=$val+1; } 
           if(!empty($user_contact['gender'])) { $val=$val+1; }                                        
            //print_r($user_contact);
           $data['val'] = $val;
            //exit;
           //$data['total_response_recent']  = $this->memail->get_user_pitchit_msg_recent();
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
    
    
   public function ajax_author_rcenttitle_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
            //$data['total_rows']  = $this->mwork->getCountAuthorRecentTitle();
            $data['total_rows']  = 50;
            $data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles($data['offset'],$limit);
		
		$this->load->view('ajax_search/ajax_author_rcenttitle_search',$data);
        }
        
    }

    public function ajax_latest_pitchit_search(){
        if($this->session->userdata('logged_user')){
            
            $data   = array();
            
            $limit_latest           =  $this->input->post('limit_latest');
            $data['page_latest']    = $this->input->post('page_latest');
            $data['offset_latest']  = ($data['page_latest'] - 1) * $limit_latest;
            $data['userLatestPitchitDetails']  = $this->mpitchit->getUserLatestPitchitDetails($data['offset_latest'],$limit_latest);
            $data['userLatestPitchitCount']  = $this->mpitchit->getUserLatestPitchitCount();
            $data['view_more']  = (count($data['userLatestPitchitCount'])-($limit_latest*$data['page_latest']));//echo $data['userLatestPitchitCount'];die;
            $this->load->view('ajax_search/ajax_latest_pitchit_search',$data);
        }
        
    }


    
   public function ajax_author_view_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
            $data['total_rows2']  = $this->mwork->getCountAuthorView();
            $data['author_view_details']  = $this->memail->get_author_view_details($data['offset'],$limit);
            
		
		$this->load->view('ajax_search/ajax_author_view_search',$data);
        }
        
    } 
    
   public function ajax_author_download_search(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
		$limit=10;
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
            $data['total_rows3']  = $this->mwork->getCountDownload();
            $data['user_download_details']  = $this->memail->get_user_work_download_details($data['offset'],$limit);
            
		
		$this->load->view('ajax_search/ajax_author_download_search',$data);
        }
        
    }  
    
   public function agent()
	{
	   if($this->session->userdata('logged_user')){
	      $usd = $this->session->userdata('logged_user');
          if($usd['user_type'] == '3'){
	       $data['title']  = 'Agent';
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
           
           $data['user_pitchit_details']  = $this->memail->get_user_pitchit_details_publisher();
           $data['pitchit_count']  = $this->memail->get_pitchit_count();
           $data['save_search_count']  = $this->memail->get_save_search_count();
           
           $data['total_response_cnt']  = $this->memail->get_user_pitchit_msg_total_cnt();
           $data['total_pit_save_cnt']  = $this->memail->pitchit_save_cnt();
           
           $data['total_view_pitchit']  = $this->memail->get_publisher_totalview_pitchit_side();
           
           $data['writer_male_percent']  = $this->memail->get_writer_male_percent();
           $data['writer_female_percent']  = $this->memail->get_writer_female_percent();
           $data['total_writer']  = $this->memail->get_writer_total();
           
           
            $limit_p=10;
            $page = 1;
            $offset = ($page - 1) * $limit_p;
    	    $data['offset'] = $offset;
            $data['page'] = $page;
            
            //$data['total_rows']  = $this->mwork->getCountAuthorRecentTitle();
            $data['total_rows']  = 50;
            $data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles($offset,$limit_p);
            //$data['user_recently_add_titles_cnt']  = $this->memail->get_user_recently_add_titles_count();
            $data['user_recently_add_titles_cnt']  = 50;
            
            /*$data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles();
           $data['user_recently_add_titles_cnt']  = $this->memail->get_user_recently_add_titles_count();*/
           
           $data['total_rows2']  = $this->mwork->getCountAuthorView();
           $data['author_view_details']  = $this->memail->get_author_view_details($offset,$limit_p);
           //$data['author_view_cnt']  = $this->memail->get_author_view_details_count();
           $data['author_view_cnt']  = $this->memail->get_author_view_details_cnt();
           
           $data['total_rows3']  = $this->mwork->getCountDownload();
           $data['user_download_details']  = $this->memail->get_user_work_download_details($offset,$limit_p);
           $data['user_download_details_cnt']  = $this->memail->get_downloads_details_count();
           
           $data['user_bookshelf_details_cnt']  = $this->mbookshelf->get_user_author_bookshelf_count();
           
           $data['user_popular_category_work']  = $this->memail->get_user_popular_category_work();
           $data['bookshelf_profiles']  = $this->mwork->allBookshelfByWriterProfiles();
           
           $data['feeds_list']          = $this->mfeeds->getAllFeeds();
           $data['feeds_url']           = $this->mfeeds->getActiveFeedsUrlList( $usd['id'] );
           
           
           //################feeds list portion################//
            $feeds_data = array();
            $feeds_array = array();
            $feeds = $this->mfeeds->getActiveFeedsUrlList($usd['id']);
            if(is_array($feeds) && count($feeds) >0){
                foreach($feeds as $feeds_list){
                    $json   = simplexml_load_file($feeds_list['feeds_url']);
                    //echo "<pre>".print_r( $json->channel->item )."</pre>";die;
                    //if(is_array($json->channel->item) && count($json->channel->item) >0){
                        foreach($json->channel->item as $row){
                            $feeds_array['guid'] = ($row->guid !="") ? $row->guid : "";
                            $feeds_array['description'] = ($row->description !="") ? $row->description : "";
                            $feeds_array['create_date'] = ($row->pubDate !="") ? $row->pubDate : "";
                            $feeds_array['title'] = ($row->title !="") ? $row->title : "";
                            $feeds_array['link'] = ($row->link !="") ? $row->link : "";
                            $feeds_array['type'] = "feeds";
                            array_push($feeds_data, $feeds_array);
                        }
                    //}
                }
            }
            $data['feeds_details'] = $feeds_data;
            
            
            //$json= simplexml_load_file('http://publishersweekly.com/pw/feeds/recent/index.xml');
            //echo "<pre>".print_r( $json )."</pre>";die;
           //################feeds list portion################//
           
           
           //$data['total_response_recent']  = $this->memail->get_user_pitchit_msg_recent();
           //$data['pitchit_details_rest']  = $this->memail->get_pitchit_details_rest();
           $this->load->view('agent_dashboard',$data);
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
                $msg_type = $this->input->post('msg_type');
                $data['messages'] =  $this->memail->delete_msg($msg_type, $this->input->post('id'),$this->uri->segment(3),$limit);
                
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
    
  public function editPitchit(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
                //$msg_type = $this->input->post('msg_type');
                $data['messages'] =  $this->memail->editpitchit($this->input->post('id'),$this->input->post('pit'));
                
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    }
    
    public function doPitchit_old(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
                //$msg_type = $this->input->post('msg_type');
                $data['messages'] =  $this->memail->doPitchit($this->input->post('id'),$this->input->post('pit'),$this->input->post('wid'));
                
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    }
    
    public function doPitchit(){
   	
      if($this->session->userdata('logged_user')){
          
          $data   = array();
          
          $data['status'] = "true";
                
          $data['messages'] =  $this->memail->doPitchit($this->input->post('id'),$this->input->post('pit'),$this->input->post('wid'));
          $data['pit_cnt']  = $this->memail->dopitchit_cnt();
          
          $data['AuthorLatestPitchitCount']  = $this->mpitchit->getAuthorLatestPitchitCount();
       
          $limit_saved   =  6;
          $page_saved    =  1;
          $offset_saved  = ($page_saved - 1) * $limit_saved;
          $data['offset_saved']  = $offset_saved;
          $data['page_saved']    = $page_saved;
          $data['user_pitchit_saved_details']  = $this->memail->get_user_pitchit_saved_details($offset_saved,$limit_saved);
          $data['user_pitchit_saved_details_cnt']  = $this->memail->get_user_pitchit_saved_details_cnt();
          echo $data['pit_cnt']['count'].'~'.$this->load->view('ajax_search/ajax_saved_pitchit_search_author_org',$data);
         
      }      
    }
    
    public function doCreatePitchit(){
   	$data = array();
   	//echo 1;die;
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
                //$msg_type = $this->input->post('msg_type');
                echo $data['messages'] =  $this->memail->doCreatePitchit($this->input->post('id'),$this->input->post('desc'),$this->input->post('cate_gory_hid'));
                
            } 
        }
      
            
    }
    
   public function doSavePitchit(){
   	$data = array();
   	
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
                //$msg_type = $this->input->post('msg_type');
        //echo $data['messages'] =  $this->memail->doSavePitchit($this->input->post('id'),$this->input->post('desc'),$this->input->post('cate_gory_hid'));
         
          
          $data['status'] = "true";
                
          $data['messages'] =  $this->memail->doSavePitchit($this->input->post('id'),$this->input->post('desc'),$this->input->post('cate_gory_hid'));
          $data['pit_cnt']  = $this->memail->dopitchit_cnt();
          
          $data['AuthorLatestPitchitCount']  = $this->mpitchit->getAuthorLatestPitchitCount();
       
          $limit_saved   =  6;
          $page_saved    =  1;
          $offset_saved  = ($page_saved - 1) * $limit_saved;
          $data['offset_saved']  = $offset_saved;
          $data['page_saved']    = $page_saved;
          $data['user_pitchit_saved_details']  = $this->memail->get_user_pitchit_saved_details($offset_saved,$limit_saved);
          $data['user_pitchit_saved_details_cnt']  = $this->memail->get_user_pitchit_saved_details_cnt();
          echo $data['pit_cnt']['count'].'~'.$this->load->view('ajax_search/ajax_saved_pitchit_search_author_org',$data);
                
            } 
        }
      
            
    } 
    
    public function delPitchit(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
                //$msg_type = $this->input->post('msg_type');
                $data['messages'] =  $this->memail->delPitchit($this->input->post('id'));
                
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
                $data['messages'] = $this->memail->mark_msg($this->input->post('msg_type'),$this->input->post('id'),$this->uri->segment(3),$limit);
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
                $data['messages'] = $this->memail->unmark_msg($this->input->post('msg_type'),$this->input->post('id'),$this->uri->segment(3),$limit);
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
                //print_r($this->input->post());die;
                $msg_type = $this->input->post('msg_type');
                if($msg_type != 'pitchit'){
                    $d = $this->memail->folder_msg($this->input->post('id'),$this->input->post('foldId'),$this->input->post('foldname'));
                }else{
                    $d = $this->memail->pitchit_msg($this->input->post('id'),$this->input->post('foldId'),$this->input->post('foldname'));
                }
             //echo $this->db->last_query();die;
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
           //$data['category_details']  = $this->mwork->category_details(2);
           $data['category_details']     = $this->mbookshelf->getActiveCategories();
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
      
      public function addWork22()
    	{
    	   $usd = $this->session->userdata('logged_user');
    	   if($this->session->userdata('logged_user')){
    	     
             if($usd['user_type'] == '1'){
               
    	   $data['title']  = 'Add Work';
           $data['user_photo']  = $this->mprofile->get_user_photo();
           $data['fiction_details']  = $this->mwork->fiction_details(1);
           $data['category_details']  = $this->mwork->category_details(2);
           $this->load->view('add_work_2-3-15',$data);
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
       $data['sentmail_count']  = $this->memail->sentmailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['pitchit_details']  = $this->memail->pitchitInfo();
       $data['pitchit_count']  = $this->memail->pitchitCount();
       
       
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
                $msg_type = $this->input->post('msg_type');
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
             $data['messages'] =  $this->memail->delete_folder_msg($this->input->post('id'),$this->uri->segment(3),$this->uri->segment(5),$limit); 
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/folder/'.$this->uri->segment(3)."/".$this->uri->segment(4);
            $config['total_rows']     = $this->memail->getCountFolderMails($this->uri->segment(3), $msg_type);
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
	    $folder_new =$this->uri->segment(4);
	    
            $data = $this->address();
            $data['mail_sidebar'] = "6";
            
            $data['title']              = $this->memail->getFolderName($this->uri->segment(3),$folder_new);
            $data['foldid']             = $this->uri->segment(3);
            $data['mail_count']         = $this->memail->mailCount();
            $data['folder_details']     = $this->memail->folderInfo();
            $data['pitchit_details']    = $this->memail->pitchitInfo();
            $data['draft_count']        = $this->memail->draftCount();
            $data['folder_count']       = $this->memail->getCountFolderMails($this->uri->segment(3), $this->uri->segment(4));
            //echo $this->db->last_query();die;
            $data['pitchit_count']      = $this->memail->pitchitCount();
            $data['msg_type']           = $this->uri->segment(4);
            $limit = 15;
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/folder/'.$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5);
            $config['total_rows']     = $data['folder_count'];
            $config['per_page']       = $limit;
            $config['uri_segment']    = 6;
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
            //$data['mail_details']  = $this->memail->folderMailInfo($this->uri->segment(5), $this->uri->segment(3),$this->uri->segment(6),$limit);
            $data['mail_details']  = $this->memail->folderMailInfo($this->uri->segment(4), $this->uri->segment(3),$this->uri->segment(5),$limit);
            //echo $this->db->last_query();die;
   
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
        $data['sentmail_count']  = $this->memail->sentmailCount();
        $data['folder_details']  = $this->memail->folderInfo();
        $data['pitchit_details']  = $this->memail->pitchitInfo();
        $data['pitchit_count']  = $this->memail->pitchitCount();
        $data['msg_status']  = "inbox";
        $this->load->view('inbox',$data);
        }else{
             redirect('home/login', 'refresh');
        }
    }
    
   
        
    public function pitchits_inbox()
    {
        if($this->session->userdata('logged_user')){
        $data = $this->address();

        $data['title']  = 'Pitchit Inbox';
        $data['mail_sidebar'] = "7";
        $limit=15;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'home/pitchits_inbox/';
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
      
        $data['mail_details']  = $this->memail->pitchitInbox($this->uri->segment(3),$limit);
        $data['mail_count']  = $this->memail->mailCount();
        $data['draft_count']  = $this->memail->draftCount();
        $data['draft_details']  = $this->memail->draftInfo();
        $data['sentmail_count']  = $this->memail->sentmailCount();
        $data['folder_details']  = $this->memail->folderInfo();
        $data['pitchit_details']  = $this->memail->pitchitInfo();
        $data['msg_status']  = "pitchit";
        
        $data['pitchit_count']  = $this->memail->pitchitCount();
        
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
               $data['pitchit_details']  = $this->memail->pitchitInfo();
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
               $data['pitchit_details'] = $this->memail->pitchitInfo();
	       
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
       $data['folder_details']   = $this->memail->folderInfo();
       $data['pitchit_details']  = $this->memail->pitchitInfo();
       $data['draft_count']      = $this->memail->draftCount();
       $data['pitchit_count']  = $this->memail->pitchitCount();
       
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
            $data['sentmail_count']  = $this->memail->sentmailCount();
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
       $data['trash_mail_count']    = $this->memail->trashMailCount();
       $data['folder_details']      = $this->memail->folderInfo();
       $data['pitchit_details']     = $this->memail->pitchitInfo();
       $data['draft_count']  = $this->memail->draftCount();
       $data['sentmail_count']  = $this->memail->sentmailCount();
       $data['pitchit_count']  = $this->memail->pitchitCount();
       
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
    
    public function addpitchit(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->memail->addpitchit();
        $data = array();
        $data['abc'] = $this->memail->getLastPitfolder();
        //print_r($data['abc']);die;
        foreach($data['abc'] as $datalist)
        {
        redirect('home/folder/'.$datalist['id'].'/'.$datalist['name'].'/pitchit', 'refresh');
        }
        //$this->load->view('register_paypal', $data);
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('home/pitchits_inbox', 'refresh'); 
            
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
       $data['sentmail_count']  = $this->memail->sentmailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['pitchit_details']  = $this->memail->pitchitInfo();
       $data['draft_count']  = $this->memail->draftCount();
       $data['pitchit_count']  = $this->memail->pitchitCount();
       //$data['user_details']  = $this->memail->userdetails();
       $per_page = 20;
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
                            $url = "http://www.inkubate.com/writer-sign-in";
	  			$to = $email;
	  			//$from = $usd['email'];
	  			$from = "support@inkubate.com";
	  			$name = ucfirst($usd['name_first'])." ".ucfirst($usd['name_middle'])." ".ucfirst($usd['name_last']);
	  			$from_name = "Join Inkubate";
	  			$subject = "Join Inkubate";
	  			$body = "<p>Your friend ".$name." invited you to join Inkubate, the world first social network for professional content creators, agents, and publishers. When you join Inkubate, you will have access to thousands of other professional writers, editors, agents, and publishers who are looking to collaborate with you and help you publish your content. Inkubate is free to join. Click here.<br><a href='".$url."'>http://www.inkubate.com/writer-sign-in</a></p><br/><br/><p>Kind Regards,</p><p>The Inkubate Team</p>";
	  			Common::send_mail($to,$from,$subject,$body,$from_name);
	  			$this->session->set_userdata('invite_mail', "Invite mail sent successfully.");
	  			
	  		}
			
	  		$register_type = $this->input->post('register_type');
			if($register_type=='publisher')
			{
			   redirect('home/publisher'); 
			}
			else
			{
			    redirect('home/author');
			}
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
                        $msg_type = $this->input->post('msg_type');
  			$data['status'] = $this->memail->delete_folder($msg_type, $id);
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
			if($data == 1){}else {
			    $email = array();
			    $email = $this->memail->getUserDetails($usd['id'],$search);
			    $email = $email[0];
			    array_push($data['email'], $email);
			}
  			
  		}
  		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);
		exit;
  	}
    
    /*function get_captcha()
  	{
  		
		//session_start();
     
        $string = '';
        
        for ($i = 0; $i < 5; $i++) {
        	$string .= chr(rand(97, 122));
        }
        
        //$_SESSION['random_number'] = $string;
        $this->session->set_userdata('random_number', $string);
        
        $dir = 'fonts1/';
        
        $image = imagecreatetruecolor(165, 50);
        
        // random number 1 or 2
        $num = rand(1,2);
        if($num==1)
        {
        	$font = "Capture it 2.ttf"; // font style
        }
        else
        {
        	$font = "Molot.otf";// font style
        }
        
        // random number 1 or 2
        $num2 = rand(1,2);
        if($num2==1)
        {
        	$color = imagecolorallocate($image, 113, 193, 217);// color
        }
        else
        {
        	$color = imagecolorallocate($image, 163, 197, 82);// color
        }
        
        $white = imagecolorallocate($image, 255, 255, 255); // background color white
        imagefilledrectangle($image,0,0,399,99,$white);
        
        //imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);
        imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $this->session->set_userdata('random_number'));
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        header("Content-type: image/png");
        
        imagepng($image);
  	}*/
    function get_captcha()
    {
        session_start();
        $string = '';

        for ($i = 0; $i < 5; $i++) {
        	$string .= chr(rand(97, 122));
        }
        
        $_SESSION['random_number'] = $string;
        
        //$this->session->set_userdata('random_number', $string);
        
        $dir = 'fonts1/';
        
        $image = imagecreatetruecolor(165, 50);
        
        // random number 1 or 2
        $num = rand(1,2);
        if($num==1)
        {
        	$font = "Capture it 2.ttf"; // font style
        }
        else
        {
        	$font = "Molot.otf";// font style
        }
        
        // random number 1 or 2
        $num2 = rand(1,2);
        if($num2==1)
        {
        	$color = imagecolorallocate($image, 113, 193, 217);// color
        }
        else
        {
        	$color = imagecolorallocate($image, 163, 197, 82);// color
        }
        
        $white = imagecolorallocate($image, 255, 255, 255); // background color white
        imagefilledrectangle($image,0,0,399,99,$white);
        
        imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['random_number']);
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        header("Content-type: image/png");
        
        imagepng($image);
   }
   
  function get_purchase()
  {
    if($_POST)
    {
      $this->mhome->purchase($_POST);
    
    }
  }
  
  function do_purchase()
  {
    if($_POST)
    {
      //$this->mhome->do_purchase($_POST);
      $Exp = explode('/' , $_POST['ExpDate']);
      $yeardigit = substr($Exp[1] , -2);
      $ExpDate = $Exp[0].'/'.$yeardigit;
      
      $this->load->library('Braintree_lib');
      
        Braintree_Configuration::environment('sandbox');
        Braintree_Configuration::merchantId('27r7c3hgzhhzyxj5');
        Braintree_Configuration::publicKey('yww6td7fr7mj7vm8');
        Braintree_Configuration::privateKey('cad1c19c34fd61b5bf6c1076d534b952');
        
        $result = Braintree_Transaction::sale(array(
            'amount' => $_POST['package_price'],
            
            'customer' => array(
                'firstName' => $_POST['name_first'],
                'lastName' => $_POST['name_last']
            ),
            'creditCard' => array(
                'number' => $_POST['ccNumber'],
                'expirationDate' => $_POST['ExpDate']
            )
        ));
        
        if ($result->success) {
            //print_r("success!: " . $result->transaction->id);
            //echo '<pre/>';print_r( $result->transaction->customer['firstName']);
            //echo '<pre/>';print_r( $result->transaction);
            $this->mhome->purchase_package($_POST['package_id'],$result->transaction->id);
            
            echo 1;
            
        } else if ($result->transaction) {
            print_r("Error processing transaction:");
            print_r("\n  code: " . $result->transaction->processorResponseCode);
            print_r("\n  text: " . $result->transaction->processorResponseText);
        } else {
            print_r("Validation errors: \n");
            print_r($result->errors->deepAll());
            echo 0;
        }
      
    
    }
  } 
  
  public function ajax_package_price(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		
		$data['title']  = 'Dashboard';
		
	
        $data['price']  = $this->memail->get_ajax_package_price($this->input->post('id'));
		
		$this->load->view('ajax_search/ajax_package_price',$data);
        }
        
    }
    
  public function draft_send()
  {
    if($this->input->post(null))
    {
        $this->memail->draft_send($this->input->post('id'));
    }
  }  
  
    public function reply_send()
    {
        if($this->input->post(null))
        {
            $this->memail->reply_send($this->input->post('id'));
        }
    }

    function moveToInbox()
    {
        $data = array();
        $data['success'] = 0;
        if($this->session->userdata('logged_user')){
            $usd = $this->session->userdata('logged_user');
            if($this->input->post(null)){
                $id = $this->input->post('id');
                $msg_type = $this->input->post('msg_type');
                foreach($id as $value){
                    $msg_array['is_moved'] = '0';
                    $this->db->where('id', $value)->update("messages", $msg_array);

                    if($msg_type == "pitchit"){
                        $this->db->where('message_id', $value)->where('user_id', $usd['id'])->delete("message_pitchits");
                    }else{
                        $this->db->where('message_id', $value)->where('user_id', $usd['id'])->delete("message_folders");
                    }
                    $data['success'] = 1;
                
                }
       
            }
        } 
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;  
    } 

    function moveToFolder()
    {
        $usd = $this->session->userdata('logged_user');
        $id = $this->input->post('id');
        $foldid = $this->input->post('foldId');
        $foldname = $this->input->post('foldname');
        $msg_type = $this->input->post('msg_type');
        $data['status'] = false;
        $data['success'] = "0";
        foreach($id as $value){
            if($msg_type == "pitchit"){
                $rs  = $this->db->select('id')->where('user_id', $usd['id'])->where('message_id', $value)->get('message_pitchits');
                if($rs->num_rows() > 0){
                    $d = $rs->row_array();                
                    $data22['pitchit_id']    = $foldid;
                    $this->db->where('id',$d['id'])->update('message_pitchits', $data22);
                    $data['status'] = true; 
                    $data['success'] = $foldname; 
                }
            }else{
                $rs  = $this->db->select('id')->where('user_id', $usd['id'])->where('message_id', $value)->get('message_folders');
                if($rs->num_rows() > 0){
                    $d = $rs->row_array();                
                    $data22['folder_id']    = $foldid;
                    $this->db->where('id',$d['id'])->update('message_folders', $data22);
                    $data['status'] = true; 
                    $data['success'] = $foldname; 
                }
            }
            
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;  
    } 
    

}
?>
