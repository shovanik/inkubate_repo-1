<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mhome','memail','mprofile','mwork','mbookshelf'));
        $this->load->helper(array('url','form'));
        $this->load->helper('download');
        $this->load->helper('text');
       
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
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        $data['user_work_details']  = $this->memail->get_user_work_details();
        $data['user_pitchit_details']  = $this->memail->get_user_pitchit_details();
        
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
           $data['pitchit_details']  = $this->memail->get_pitchit_details_view();
           $data['pitchit_count']  = $this->memail->get_pitchit_count();
           $this->load->view('publisher_dashboard',$data);
           }
       else{
            redirect('home/login', 'refresh');
        }
           
       }else{
            redirect('home/login', 'refresh');
        }
	}    
      
      
   public function delete_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->delete_msg($this->input->post('id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
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
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->folder_msg($this->input->post('id'),$this->input->post('foldId'),$this->input->post('foldname')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
    public function delete_draft_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->delete_draft_msg($this->input->post('id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    } 
    
   public function delete_sentmail_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->delete_sentmail_msg($this->input->post('id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
    }
    
   public function delete_trash_msg(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->delete_trash_msg($this->input->post('id')); 
            } 
        }
      else{
            redirect(base_url(), 'refresh');
        }        
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
    	   if($this->session->userdata('logged_user')){
    	   $data['title']  = 'Add Work';
           $data['user_photo']  = $this->mprofile->get_user_photo();
           $data['fiction_details']  = $this->mwork->fiction_details(1);
           $data['category_details']  = $this->mwork->category_details(2);
           $this->load->view('add_work',$data);
           }
            else{
            redirect(base_url(), 'refresh');
          } 
    	}   
        
   public function inbox()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'Inbox';
       
       $limit=15;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'home/inbox/';
            $config['total_rows']     = $this->memail->getCountMails();
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
        
        //$data['totaluser']  = $this->muserlist->get_all_users($this->uri->segment(3),$limit);
      
       $data['mail_details']  = $this->memail->mailInfo($this->uri->segment(3),$limit);
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $this->load->view('inbox',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	} 
    
   public function compose_mail()
	{
	   if($this->session->userdata('logged_user')){ 
        $usd = $this->session->userdata('logged_user');
        
	   $data['title']  = 'Compose Mail';
       $data['mail_details']    = $this->memail->mailInfo();
       $data['mail_count']      = $this->memail->mailCount();
       $data['draft_details']   = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['author_list']     = $this->memail->getAuthorList();
       $this->load->view('compose_mail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
   public function DraftMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'DraftMail';
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $this->load->view('draftmail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	} 
    
    public function SentMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'SentMail';
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['sent_mail_details']  = $this->memail->sentMailInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $this->load->view('sentmail',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	} 
    
     public function TrashMail()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'TrashMail';
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['trash_mail_details']  = $this->memail->trashMailInfo();
       $data['folder_details']  = $this->memail->folderInfo();
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
  public function folder()
	{
	   $data['title']  = $this->uri->segment(4);
       $data['mail_details']  = $this->memail->folderMailInfo($this->uri->segment(3));
       $data['mail_count']  = $this->memail->mailCount();
       $data['folder_details']  = $this->memail->folderInfo();
       $this->load->view('folder_message',$data);
	}
  public function addressBook()
	{
	   if($this->session->userdata('logged_user')){
	   $data['title']  = 'Address Book';
       $data['mail_details']  = $this->memail->mailInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       //$data['user_details']  = $this->memail->userdetails();
       $this->load->view('addressBook',$data);
       }else{
            redirect('home/login', 'refresh');
        }
	}
    
  
}
?>