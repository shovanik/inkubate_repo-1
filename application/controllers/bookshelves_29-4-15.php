<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookshelves extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mbookshelf','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->library('Common');
       
    }
    
  public function index($search = ""){
    if($this->session->userdata('logged_user')){
        $data   = array();
        
        $usd = $this->session->userdata('logged_user');
        
        /*this portion is for showing authorlist*/
        $per_page = 10;
        $offset = 0;
        $page = 1;
        $data['page'] = 1;
        $data['per_page'] = 10;
        
        $id = "a";
        $data['author_list']     = $this->memail->getAuthorByAlphabet($id,$per_page,$offset);
        $count = $this->memail->getAuthorCountByAlphabet($id);
	       
        $data['draft_count']  = $this->memail->draftCount();
        $page = array('count' => $count, 'per_page'=> $per_page,'page' => $page,'func' => "FnAuthors",'start' => $offset,'id'=>$id);
        $data['pagination'] = Common::page_html($page);
        //$this->load->view('template/inner_footer',$data);
        //print_r($data['author_list']);die;
        /*this portion is for showing authorlist*/
        
            if($usd['user_type'] == '2' || $usd['user_type'] == '3')
            {
            
                
                $data['title']  = 'My Bookshelves';

                $limit=5;
                $page = 1;
                //$page_ss = 1;
                $data['page'] = $page;
                $data['page_ss'] = $page;
                $data['total_rows']     = $this->mbookshelf->count_bookshelf_with_search($search);
                $offset = ($page - 1) * $limit;
                    $data['offset'] = $offset;
                //$this->load->helper('download');
                //$data['total_book'] = $this->mbookshelf->get_all_books();
                $data['share_bookshelf_test'] = $this->mbookshelf->get_bookshelf_with_share($search,$offset,$limit);
                $data['bookshelf_test'] = $this->mbookshelf->get_bookshelf_with_search($search,$offset,$limit);
                $data['bookshelf_count'] = $this->mbookshelf->count_bookshelf_with_search($search);
                $data['saved_title_bookshelf'] = $this->mwork->saveTitleWorkForBookshelf();
                $data['search'] = urldecode($search);
                //print_r($data);die;
                $this->load->view('bookshelf/index',$data);
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
    
    public function ajax_bokkshelf($search = ""){
        if($this->session->userdata('logged_user')){
        		
    		$data   = array();
    		
    		$data['title']  = 'My Bookshelves';
    		
    		$limit=5;
    		$data['page'] = $this->input->post('page');
    		$data['offset'] = ($data['page'] - 1) * $limit;
    		
        //$data['total_rows']  = $this->mwork->getCountAuthorRecentTitle();
        $data['total_rows']  = $this->mbookshelf->count_bookshelf_with_search($search);
        $data['bookshelf_test'] = $this->mbookshelf->get_bookshelf_with_search($search,$data['offset'],$limit);
    		
    		$this->load->view('bookshelf/ajax_bokkshelf',$data);
        }
        
    }
    
    public function index2(){
    if($this->session->userdata('logged_user')){
        
        $usd = $this->session->userdata('logged_user');
        
            if($usd['user_type'] == '2')
            {
            
            $data   = array();
            $data['title']  = 'My Bookshelves';
            //$this->load->helper('download');
            $data['bookshelf_test'] = $this->mbookshelf->get_bookshelf();
            
            
            $this->load->view('bookshelf/index_21_01_15',$data);
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
    
  public function addSavedSearch(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $fid = $this->input->post('fid');    
        $this->mbookshelf->addSavedSearch($fid);
        
        redirect('bookshelves/savedSearch/'.$fid, 'refresh');
        //$this->load->view('register_paypal', $data);mbookshelf
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('bookshelves/savedSearch/'.$fid, 'refresh'); 
            
        }
    }
    
  public function savedSearch(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Saved Search';
        //$this->load->helper('download');
        $limit=10;
            ### pagination starts ###
            $this->load->library('pagination');
            $config['base_url']       = base_url().'bookshelves/savedSearch/'.$this->uri->segment(3);
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
        
        $this->load->view('search/savedSearch',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }     
    
 public function BookShelves_share(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mbookshelf->BookShelves_share();
        
        redirect('bookshelves/', 'refresh');
        //$this->load->view('register_paypal', $data);mbookshelf
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('bookshelves/', 'refresh'); 
            
        }
    }
    
  public function sharebooklist(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Share Booksleves List';
        //$this->load->helper('download');
        $data['booklist'] = $this->mbookshelf->get_book_list($this->uri->segment(3));
        $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(3));
        
        $this->load->view('bookshelf/sharedlist',$data);
        }
        else{
            //redirect('bookshelves/', 'refresh');
            $return_url = "bookshelves/sharebooklist/".$this->uri->segment(3);
            redirect("home/login/".$return_url, 'refresh');
            //redirect("home/login/"."'".$return_url."'", 'refresh');
        }
    }     
    
  public function addToBookShelves(){
        if($this->input->post(null)){
            //echo '<pre>';print_r($this->input->post());
        $this->mbookshelf->addToBookShelves();
        
        redirect('discovery/', 'refresh');
        //$this->load->view('register_paypal', $data);mbookshelf
        //$this->load->view('templates/template', $data);
        //}
        }else{
        redirect('discovery/', 'refresh'); 
            
        }
    }
    public function addToBookShelvesAjax()
    {
      $res = $this->mbookshelf->addToBookShelvesAjax($this->input->post('bkself_id'),$this->input->post('wid'));
      echo $res;
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
  public function delete_bookshelf_new()
	{
	   $data['title']  = 'My Bookshelves';
       //echo $this->uri->segment(3);die;
      
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             $this->mbookshelf->delete_bookshelf_new($this->input->post('id')); 
      
	} 
  }
 public function booklist(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Booksleves List';
        //$this->load->helper('download');
        $data['booklist'] = $this->mbookshelf->get_book_list($this->uri->segment(3));
        $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(3));
        
        $this->load->view('bookshelf/list',$data);
        }
        else{
            //redirect('bookshelves/', 'refresh');
            redirect('home/login', 'refresh');
        }
    }
    
   public function delete_books()
	{
	
	   $data['title']  = 'My Bookshelves';
       
       $wid = $this->uri->segment(3);
       $bid = $this->uri->segment(4);
       
          $this->mbookshelf->delete_books($wid,$bid);
           
           $data['booklist'] = $this->mbookshelf->get_book_list($this->uri->segment(4));
           $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(4));
           redirect('bookshelves/booklist/'.$bid, 'refresh');
   
  }
   public function delete_books_by_id()
	{
	
	  $wcid = $_POST['id'];
       
          $this->mbookshelf->delete_books_by_id($wcid);
           
           
   	exit;
  }
  function show_book_detail()
  {
  	  $wid = $_POST['id'];
      $work_pitch = $this->mwork->allWorkByPitch( $wid );
      $work_pitch_conversation = $this->mwork->allWorkByPitchConversation( $wid );
  	$d['workdetails_test']  = $this->mwork->allWorkById( $wid );
  	$data['workdetails_test'] = $d['workdetails_test'][0];

    //$data['workdetails_test']['message_id'] = $this->mwork->getMessageIdByWid( $wid );

  	//print_r($data['workdetails_test']);die;
        
        $data['workdetails_test']['create_date'] = date('m/d/Y',strtotime($data['workdetails_test']['create_date']));
  	if($data['workdetails_test']['self_published'] == "1" && $data['workdetails_test']['been_reviewed'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed and self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed.";
  	}
  	else
  	{
  		$data['workdetails_test']['self_published_text'] = "";  	
  	}
  	$data['workdetails_test']['title_text'] = $data['workdetails_test']['title']." by ".$data['workdetails_test']['full_name']." was added on ".$data['workdetails_test']['create_date'];
  	$tags = $this->mwork->work_tags_details($wid);
    //print_r($tags);die;
    //$temp = array();
  	$data['workdetails_test']['tag_text'] = "";
  	$sep = "";
  	foreach($tags as $val)
  	{
  		 //$temp[] = $val['tag_name'];
  		$data['workdetails_test']['tag_text'] .= $sep.$val['tag_name'];
  		$sep = ", ";
  	}  	
  	if(!empty($data['workdetails_test']['tag_text']))
  	{
  		$data['workdetails_test']['tag_text'] ="Tags: ".$data['workdetails_test']['tag_text'];
  	}
  	if($data['workdetails_test']['extract'] != "")
  	{
  		$data['workdetails_test']['extract'] = html_entity_decode($data['workdetails_test']['extract'], ENT_QUOTES, 'UTF-8');
  	}
  	if($data['workdetails_test']['synopsis'] != "")
  	{
  		$data['workdetails_test']['synopsis'] = html_entity_decode($data['workdetails_test']['synopsis'], ENT_QUOTES, 'UTF-8');
  	}
    
    /*-------Downloaded File----*/ 
    
    if($data['workdetails_test']['user_id'] != "")
  	{
  		$data['workdetails_test']['user_id'] = $data['workdetails_test']['user_id'];
  	}
    if($data['workdetails_test']['file_asset_id'] != "")
  	{
  		$data['workdetails_test']['file_asset_id'] = $data['workdetails_test']['file_asset_id'];
  	}
    if($data['workdetails_test']['work_file'] != "")
  	{
  		$data['workdetails_test']['work_file'] = $data['workdetails_test']['work_file'];
  	}
   /*----------End-------------*/ 
   
    if(isset($work_pitch['count']))
    {
    	$data['workdetails_test']['pitch_count'] = $work_pitch['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count'] = 0;
    }
    if(isset($work_pitch_conversation['count']))
    {
    	$data['workdetails_test']['pitch_count_conversation'] = $work_pitch_conversation['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count_conversation'] = 0;
    }

    //print_r($data);die;
    
  	header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
  }
  
  
  function show_book_detail_for_author()
  {
  	$wid = $_POST['id'];
    $work_pitch = $this->mwork->allWorkByPitch( $wid );
    $work_pitch_conversation = $this->mwork->allWorkByPitchConversation( $wid );
  	$d['workdetails_test']  = $this->mwork->allWorkById( $wid );
  	$data['workdetails_test'] = $d['workdetails_test'][0];
  	//print_r($data['workdetails_test']);
  	$data['workdetails_test']['create_date'] = date('m/d/Y',strtotime($data['workdetails_test']['create_date']));
  	if($data['workdetails_test']['self_published'] == "1" && $data['workdetails_test']['been_reviewed'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed and self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed.";
  	}
  	else
  	{
  		$data['workdetails_test']['self_published_text'] = "";  	
  	}
  	$data['workdetails_test']['title_text'] = $data['workdetails_test']['title']." was added on ".$data['workdetails_test']['create_date'];
  	$tags = $this->mwork->work_tags_details($wid);
    //print_r($tags);die;
    //$temp = array();
  	$data['workdetails_test']['tag_text'] = "";
  	$sep = "";
  	foreach($tags as $val)
  	{
  		 //$temp[] = $val['tag_name'];
  		$data['workdetails_test']['tag_text'] .= $sep.$val['tag_name'];
  		$sep = ", ";
  	}  	
  	if(!empty($data['workdetails_test']['tag_text']))
  	{
  		$data['workdetails_test']['tag_text'] ="Tags: ".$data['workdetails_test']['tag_text'];
  	}
  	if($data['workdetails_test']['extract'] != "")
  	{
  		$data['workdetails_test']['extract'] = html_entity_decode($data['workdetails_test']['extract'], ENT_QUOTES, 'UTF-8');
  	}
  	if($data['workdetails_test']['synopsis'] != "")
  	{
  		$data['workdetails_test']['synopsis'] = html_entity_decode($data['workdetails_test']['synopsis'], ENT_QUOTES, 'UTF-8');
  	}
    
    /*-------Downloaded File----*/ 
    
    if($data['workdetails_test']['user_id'] != "")
  	{
  		$data['workdetails_test']['user_id'] = $data['workdetails_test']['user_id'];
  	}
    if($data['workdetails_test']['file_asset_id'] != "")
  	{
  		$data['workdetails_test']['file_asset_id'] = $data['workdetails_test']['file_asset_id'];
  	}
    if($data['workdetails_test']['work_file'] != "")
  	{
  		$data['workdetails_test']['work_file'] = $data['workdetails_test']['work_file'];
  	}
   /*----------End-------------*/ 
   
    if(isset($work_pitch['count']))
    {
    	$data['workdetails_test']['pitch_count'] = $work_pitch['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count'] = 0;
    }
    if(isset($work_pitch_conversation['count']))
    {
    	$data['workdetails_test']['pitch_count_conversation'] = $work_pitch_conversation['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count_conversation'] = 0;
    }
    
  	header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
  }

 function show_book_detail_for_publisher()
  {
  	$wid = $_POST['id'];
    $uid = $_POST['uid'];
    $this->mwork->userTitleSearch( $wid,$uid );
    
    $work_pitch = $this->mwork->allWorkByPitch( $wid );
    $work_pitch_conversation = $this->mwork->allWorkByPitchConversation( $wid );
  	$d['workdetails_test']  = $this->mwork->allWorkById( $wid );
  	$data['workdetails_test'] = $d['workdetails_test'][0];
  	//print_r($data['workdetails_test']);
  	$data['workdetails_test']['create_date'] = date('m/d/Y',strtotime($data['workdetails_test']['create_date']));
  	if($data['workdetails_test']['self_published'] == "1" && $data['workdetails_test']['been_reviewed'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed and self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been self published.";
  	}
  	else if($data['workdetails_test']['self_published'] == "1")
  	{
  		$data['workdetails_test']['self_published_text'] = "This work has been reviewed.";
  	}
  	else
  	{
  		$data['workdetails_test']['self_published_text'] = "";  	
  	}
  	$data['workdetails_test']['title_text'] = $data['workdetails_test']['title']." by ".$data['workdetails_test']['full_name']." was added on ".$data['workdetails_test']['create_date'];
  	$tags = $this->mwork->work_tags_details($wid);
    //print_r($tags);die;
    //$temp = array();
  	$data['workdetails_test']['tag_text'] = "";
  	$sep = "";
  	foreach($tags as $val)
  	{
  		 //$temp[] = $val['tag_name'];
  		$data['workdetails_test']['tag_text'] .= $sep.$val['tag_name'];
  		$sep = ", ";
  	}  	
  	if(!empty($data['workdetails_test']['tag_text']))
  	{
  		$data['workdetails_test']['tag_text'] ="Tags: ".$data['workdetails_test']['tag_text'];
  	}
  	if($data['workdetails_test']['extract'] != "")
  	{
  		$data['workdetails_test']['extract'] = html_entity_decode($data['workdetails_test']['extract'], ENT_QUOTES, 'UTF-8');
  	}
  	if($data['workdetails_test']['synopsis'] != "")
  	{
  		$data['workdetails_test']['synopsis'] = html_entity_decode($data['workdetails_test']['synopsis'], ENT_QUOTES, 'UTF-8');
  	}
    
   /*-------Downloaded File----*/ 
    
    if($data['workdetails_test']['user_id'] != "")
  	{
  		$data['workdetails_test']['user_id'] = $data['workdetails_test']['user_id'];
  	}
    if($data['workdetails_test']['file_asset_id'] != "")
  	{
  		$data['workdetails_test']['file_asset_id'] = $data['workdetails_test']['file_asset_id'];
  	}
    if($data['workdetails_test']['work_file'] != "")
  	{
  		$data['workdetails_test']['work_file'] = $data['workdetails_test']['work_file'];
  	}
   /*----------End-------------*/ 
    if(isset($work_pitch['count']))
    {
    	$data['workdetails_test']['pitch_count'] = $work_pitch['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count'] = 0;
    }
    if(isset($work_pitch_conversation['count']))
    {
    	$data['workdetails_test']['pitch_count_conversation'] = $work_pitch_conversation['count'];
    }
    else
    {
    	$data['workdetails_test']['pitch_count_conversation'] = 0;
    }
    
  	header('Content-Type: application/json; charset=utf-8');
	   echo json_encode($data);
	   exit;
  }
    
  public function delete_books_carousel()
	{
	   $data['title']  = 'My Bookshelves';
       
       $wid = $this->uri->segment(3);
       //$bid = $this->uri->segment(4);
       
          $this->mbookshelf->delete_bookshelf_carousel($wid);
           
           $data['booklist'] = $this->mbookshelf->get_book_list($this->uri->segment(4));
           $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(4));
           redirect('bookshelves/booklist/'.$bid, 'refresh');
   
  } 
  
  public function saveTitle()
	{
	   $data['title']  = 'My Bookshelves';
       
      if($this->input->post())
      {
          echo $this->mbookshelf->saveTitle($this->input->post('id'));
           
        }   
   
  }
  
  public function delete_save_title()
	{
	   $data['title']  = 'My Bookshelves';
       //echo $this->uri->segment(3);die;
      
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;wcid
             $this->mbookshelf->delete_save_title($this->input->post('id'),$this->input->post('wcid')); 
      
	} 
  } 
  
  public function search_book_title()
	{
	   $data['title']  = 'My Bookshelves';
       //echo $this->uri->segment(3);die;
      
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;wcid
             $this->mbookshelf->search_book_title($this->input->post('val')); 
      
	} 
  }  
     
}
