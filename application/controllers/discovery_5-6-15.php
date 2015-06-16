<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class discovery extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mbookshelf','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->library('Common');
    }
    
  public function index(){
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
        
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=5;
        $page = 1;
        //$page_ss = 1;
        $data['page'] = $page;
        $data['page_ss'] = $page;
        $data['total_rows']     = $this->mbookshelf->getCountWorks();
        $data['total_rows_ss']     = $this->mbookshelf->getCountSavedSearches();
	$offset = ($page - 1) * $limit;
	$data['offset'] = $offset;
        $data['discovery'] = $this->mbookshelf->get_books_with_search($offset,$limit);
        //$data['fiction_details']  = $this->mwork->fiction_details(1);
        $data['count_allfiction']  = $this->mbookshelf->allFiction();
        $data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        
        //to add the publisher search
        //$this->mbookshelf->publisher_viewed_searches($type,$data);
        
        //to be add the function author
        $this->mbookshelf->author_viewed_searches($data['discovery']);
        
        
        $data['formats'] = $this->mbookshelf->getActiveFormat();
        $data['types'] = $this->mbookshelf->getAllTypes();
	 $data['categories'] = $this->mbookshelf->getActiveCategories();
        //$data['savedfilters'] = $this->mbookshelf->getSavedFilters();
        $data['getSavedSearches'] = $this->mbookshelf->getSavedSearches($offset,$limit);
        //print_r($data['savedfilters']);exit;
        $this->load->view('discovery/index',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    }
    
   public function index2(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Discovery';
        //$this->load->helper('download');
        $limit=5;
        $page = 1;
        //$page_ss = 1;
        $data['page'] = $page;
        $data['page_ss'] = $page;
        $data['total_rows']     = $this->mbookshelf->getCountWorks();
        $data['total_rows_ss']     = $this->mbookshelf->getCountSavedSearches();
	$offset = ($page - 1) * $limit;
	$data['offset'] = $offset;
        $data['discovery'] = $this->mbookshelf->get_books_with_search($offset,$limit);
        //$data['fiction_details']  = $this->mwork->fiction_details(1);
        //$data['count_allfiction']  = $this->mbookshelf->allFiction();
        //$data['count_allnonfiction']  = $this->mbookshelf->allNonFiction();
        $data['formats'] = $this->mbookshelf->getActiveFormat();
        $data['types'] = $this->mbookshelf->getAllTypes();
	 $data['categories'] = $this->mbookshelf->getActiveCategories();
        $data['savedfilters'] = $this->mbookshelf->getSavedFilters();
        $data['getSavedSearches'] = $this->mbookshelf->getSavedSearches($offset,$limit);
        //print_r($data['savedfilters']);exit;
        $this->load->view('discovery/index2',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
    public function save_filters()
    {
    	if($this->session->userdata('logged_user')){
    		$data['type'] = (isset($_POST['type'])) ? $this->input->post('type') : "";
    		if($data['type'] == "format" && $this->input->post('format') != "")
		{
			$data['format'] = explode(",",$this->input->post('format'));
			$data['search_name'] = $this->input->post('search_name');
			
			$this->mbookshelf->saveTheFilters($data['type'],$data['format'],$data['search_name']);   
			
		}
		if($data['type'] == "types" && $this->input->post('types') != "")
		{
			$data['types'] = explode(",",$this->input->post('types'));
			$data['search_name'] = $this->input->post('search_name');
			
			$this->mbookshelf->saveTheFilters($data['type'],$data['types'],$data['search_name']);   
		}
		if($data['type'] == "genre" && $this->input->post('genre') != "")
		{
			$data['genre'] = explode(",",$this->input->post('genre'));
			$data['search_name'] = $this->input->post('search_name');
			
			$this->mbookshelf->saveTheFilters($data['type'],$data['genre'],$data['search_name']);   
		}
		if($data['type'] == "multiple" && ($this->input->post('genre') != "" || $this->input->post('types') != "" || $this->input->post('format') != ""))
		{
			$search = array();
			if($this->input->post('types') != "")
			{
				$search['types'] = explode(",",$this->input->post('types'));
			}
			else
			{
				$search['types'] = array();
			}
			if($this->input->post('format') != "")
			{
				$search['format'] = explode(",",$this->input->post('format'));
			}
			else
			{
				$search['format'] = array();
			}
			if($this->input->post('genre') != "")
			{
				$search['genre'] = explode(",",$this->input->post('genre'));
			}
			else
			{
				$search['genre'] = array();
			}
			$data['search_name'] = $this->input->post('search_name');
			
			$this->mbookshelf->saveTheFilters($data['type'],$search,$data['search_name']);  
		}
		if($data['type'] == "global")
		{
			$search[0] = $this->input->post('search_criteria');
			$data['search_name'] = $this->input->post('search_name');
			$this->mbookshelf->saveTheFilters($data['type'],$search,$data['search_name']);  
		}
		//$data['savedfilters'] = $this->mbookshelf->getSavedFilters();
		
		$this->load->view('discovery/save_filters',$data);
    	}	
    }
    function ajax_search_info()
    {
    	$type = $this->input->post('type');
    	
    		if($type == "format")
    		{
    			$search = explode(",",$this->input->post('format'));
    		}
    		if($type == "types")
    		{
    			$search = explode(",",$this->input->post('types'));
    		}
    		if($type == "genre")
    		{
    			$search = explode(",",$this->input->post('genre'));
    		}
    		if($type == "multiple")
    		{
    			$search['genre'] = explode(",",$this->input->post('genre'));
    			$search['types'] = explode(",",$this->input->post('types'));
    			$search['format'] = explode(",",$this->input->post('format'));
    		}
    		if($type == "global")
    		{
    			$search = $this->input->post('searchCriteria');
    		}
    		$info = $this->mbookshelf->getSelectFilterInfo($type,$search);
    		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($info);     
		exit; 
    	
    }
    function ajax_view_searches()
    {
    	if($this->session->userdata('logged_user')){
    		
    		$id = $this->input->post('id');
    		/*if( $id > 0)
    		{
    			$info = $this->mbookshelf->getSearchInfo($id);
    		}
    		else
    		{
    			$name = $this->input->post('name');
    			$info = $this->mbookshelf->getSearchInfoByName($name);
    		}*/
    		$info = $this->mbookshelf->getSearchInfo($id); 	
    		
    		if($info['type'] == "format")
    		{
    			$info['format'] = $info['search'];
    		}
    		if($info['type'] == "genre")
    		{
    			$info['genre'] = $info['search'];
    		}
    		if($info['type'] == "types")
    		{
    			$info['types'] = $info['search'];
    		}
    		if($info['type'] == "multiple")
    		{
    			if($info['subtype'] == "global")
    			{
    				$info['searchCriteria'] = $info['search'];
    			}
    			else
    			{
    				
    				if(isset($info['search']['types']))
    				{
    					$info['types'] = $info['search']['types'];
    				}
    				if(isset($info['search']['format']))
    				{
    					$info['format'] = $info['search']['format'];
    				}
    				if(isset($info['search']['genre']))
    				{
    					$info['genre'] = $info['search']['genre'];
    				}
	    			
	    			
    			}
    			
    		}
    		//echo "<pre>";print_r($info);exit;
    		$data   = array();
    		$data['searchCriteria']  = ""	;
    		$data['subtype'] = "";
		$data['s'] = $info['search'];
		$limit=5;
		$data['type'] = (isset($info['type'])) ? $info['type'] : "";
		$data['page'] = 1;
		$data['offset'] = ($data['page'] - 1) * $limit;
		$data['total_rows'] = 0;
		$data['discovery'] = array();
		if($data['type'] == "format")
		{
			$data['format'] = explode(",",$info['format']);
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['format']);   
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['format']);
		}
		else if($data['type'] == "types")
		{
			$data['types'] = explode(",",$info['types']);
			
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['types']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['types']);  
            
		}
		else if($data['type'] == "genre")
		{
			$data['genre'] = explode(",",$info['genre']);
			
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['genre']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['genre']);  
		}
		else if($data['type'] == "multiple")
		{
			//echo "dsfajdslf";exit;
			if(isset($info['genre']) && $info['genre'] != "")
			{
				$data['genre'] = explode(",",$info['genre']);
			}
			else
			{
				$data['genre'] = array();
			}
			if(isset($info['types']) && $info['types'] != "")
			{
				$data['types'] = explode(",",$info['types']);
			}
			else
			{
				$data['types'] = array();
			}
			if(isset($info['format']) && $info['format'] != "")
			{
				$data['format'] = explode(",",$info['format']);
				
			}
			else
			{
				$data['format'] = array();
			}
			if(isset($info['searchCriteria']) && $info['searchCriteria'] != "" && $info['subtype'] == "global")
			{
				$data['searchCriteria'] = $info['searchCriteria'];
				$data['subtype'] = $info['subtype'];
				//echo $data['searchCriteria'];
				$global = $this->mbookshelf->getSearchInfoBySearch($data['searchCriteria']);
				//echo "<pre>";print_r($global);exit;
				if(!isset($global['genre']))
				{
					$data['genre'] = array();
				
				}
				else
				{
					$data['genre'] = explode(",",$global['genre']);
					//$data['genre'] = $global['genre'];
				}
				if(!isset($global['types']))
				{
					$data['types'] = array();
				}
				else
				{
					$data['types'] = explode(",",$global['types']);
					//$data['types'] =$global['types'];
				}
				if(!isset($global['format']))
				{
					$data['format'] = array();
				}
				else
				{
					$data['format'] = explode(",",$global['format']);
					//$data['format'] = $global['format'];
				}
			}
			
			$data['search'] = $info;
			//echo "<pre>";print_r($data);exit;
			//if(!isset($data['subtype']) || $data['subtype'] != "global")
			//{
			
			
			//}
			
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data,$data['subtype'],$data['searchCriteria']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data,$data['subtype'],$data['searchCriteria']);  
		}
        //to add the publisher search
        //$this->mbookshelf->publisher_viewed_searches($type,$data);
        
        //to be add the function author
        //$this->mbookshelf->author_viewed_searches($data['discovery']);
        
		/*else
		{
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch();   
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit);
		}*/
		if($data['type'] == "format")
		{
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo($data['type'],$data['format']);
		}
		if($data['type'] == "types")
		{
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo($data['type'],$data['types']);
		}
		if($data['type'] == "genre")
		{
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo($data['type'],$data['genre']);
		}
		if($data['type'] == "multiple")
		{
			if($data['subtype'] == "global")
			{
				$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo($data['subtype'],$data['searchCriteria']);
			}
			else
			{
				$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo($data['type'],$data);
			}
			
		}
		$data['types'] = "";
		$data['format'] = "";
		$data['genre'] = "";
		
		$this->load->view('discovery/ajax_discovery',$data);
    	}
    }
    public function ajax_global_search()
    {
    	if($this->session->userdata('logged_user')){
    		$searchCriteria1 = $this->input->post("search_val");
            
            $searchCriteria2 = explode("'",$searchCriteria1);
            $searchCriteria = implode("''" ,$searchCriteria2);
            //echo $searchCriteria;die;
            
            
    		$info = $this->mbookshelf->getSearchInfoBySearch($searchCriteria);
    		$data   = array();
    		$data['s'] = "";
		$data['title']  = 'Discovery';
		$limit = 5;
		$data['type'] = (isset($info['type'])) ? $info['type'] : "";
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		$data['genre'] = "";
		$data['format'] = "";
		$data['types'] = "";	
		if($data['type'] == "multiple")
		{
		  //print_r($info['genre']);die;
			if(!isset($info['genre']))
			{
				$search['genre'] = array();
				
			}
			else
			{
				$search['genre'] = explode(",",$info['genre']);
				$data['genre'] = $info['genre'];
			}
			if(!isset($info['types']))
			{
				$search['types'] = array();
			}
			else
			{
				$search['types'] = explode(",",$info['types']);
				$data['types'] = $info['types'];
                //print_r($data['types']);
			}
			if(!isset($info['format']))
			{
				$search['format'] = array();
			}
			else
			{
				$search['format'] = explode(",",$info['format']);
				$data['format'] = $info['format'];
			}
			
			//print_r($info);
			//print_r($data);exit;
			$subtype="global";
			$data['subtype'] = $subtype;
			$data['searchOptions'][0] = array('type' => $subtype, 'value' => $searchCriteria);
			$data['searchCriteria'] = $searchCriteria;
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$search,$subtype,$searchCriteria); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$search,$subtype,$searchCriteria);  
		}
		
		
		$this->load->view('discovery/ajax_discovery',$data);
		
    	}
    }
    public function ajax_discovery(){
    if($this->session->userdata('logged_user')){
    		
		$data   = array();
		$data['s'] = "";
		$data['title']  = 'Discovery';
		$data['subtype'] = (isset($_POST['subtype'])) ? $this->input->post('subtype') : "";
		$data['searchCriteria'] = (isset($_POST['searchCriteria'])) ? $this->input->post('searchCriteria') : "";
		//$this->load->helper('download');
		$limit=5;
		$data['type'] = (isset($_POST['type'])) ? $this->input->post('type') : "";
		$data['page'] = $this->input->post('page');
		$data['offset'] = ($data['page'] - 1) * $limit;
		
		$data['genre'] = "";
		$data['types'] = "";
		$data['format'] = "";
		$data['searchOptions'] = array();
		//$data['category'] = explode(",",$this->input->post('genre'));
		//echo $data['type'];
		//$data['format'] = explode(",",$this->input->post('format'));
		if($data['type'] == "format")
		{
			$data['format'] = explode(",",$this->input->post('format'));
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo("format",$data['format']);
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['format']);   
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['format']);
		}
		else if($data['type'] == "types")
		{
			$data['types'] = explode(",",$this->input->post('types'));
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo("types",$data['types']);
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['types']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['types']);  
		}
		else if($data['type'] == "genre")
		{
			$data['genre'] = explode(",",$this->input->post('genre'));
			$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo("genre",$data['genre']);
			    //print_r($data['genre']);
			    /*-------Search by Genre-----------*/
			    
			    $this->mbookshelf->InsertGenreWithSearch($data['genre']); 
			    
			    /*---------End Search--------------*/
            
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$data['genre']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$data['genre']);  
		}
		else if($data['type'] == "multiple")
		{
			if($this->input->post('genre') == "")
			{
				$search['genre'] = array();
			}
			else
			{
				$search['genre'] = explode(",",$this->input->post('genre'));
                /*-------Search by Genre-----------*/
			    
			    $this->mbookshelf->InsertGenreWithSearch($search['genre']); 
			    
			    /*---------End Search--------------*/
				
			}
			if($this->input->post('types') == "")
			{
				$search['types'] = array();
			}
			else
			{
				$search['types'] = explode(",",$this->input->post('types'));
			}
			if($this->input->post('format') == "")
			{
				$search['format'] = array();
			}
			else
			{
				$search['format'] = explode(",",$this->input->post('format'));
			}
			if($data['subtype'] == "global")
			{
				$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo("global",$data['searchCriteria']);
			}
			else
			{
				$data['searchOptions'] = $this->mbookshelf->getSelectFilterInfo("multiple",$search);
			}
			
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch($data['type'],$search,$data['subtype'],$data['searchCriteria']); 
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit,$data['type'],$search,$data['subtype'],$data['searchCriteria']);            
		}
		else
		{
			$data['total_rows']     = $this->mbookshelf->getCountWorksWithSearch();   
			$data['discovery'] = $this->mbookshelf->get_books_with_search($data['offset'],$limit);
		}
		$data['genre'] = "";
		$data['types'] = "";
		$data['format'] = "";
		
		$this->mbookshelf->author_viewed_searches($data['discovery']);
        
		$this->load->view('discovery/ajax_discovery',$data);
        }
        
    }
    public function ajax_saved_searches(){
    if($this->session->userdata('logged_user')){
		$data   = array();
		$data['title']  = 'Discovery';
		$limit=5;
		$page = $this->input->post('page');
		$data['page_ss'] = $page;
		$offset = ($page - 1) * $limit;
		$data['offset'] = $offset;
		$data['total_rows_ss']     = $this->mbookshelf->getCountSavedSearches();		
		$data['getSavedSearches'] = $this->mbookshelf->getSavedSearches($offset,$limit);		
		$this->load->view('discovery/ajax_saved_searches',$data);
        }
        
    }
    function ajax_delete_search()
    {
    	if($this->session->userdata('logged_user')){
    		$id = $this->input->post('id');
    		if($id > 0)
    		{
    			$this->mbookshelf->deleteSavedSearches($id);
    		}
    	}
    }
    public function index_old(){
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
        
        
        $this->load->view('discovery/index_old_19-15',$data);
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
 
// public function user_details()
//    {
//        if($this->session->userdata('logged_user')){
//        $data   = array();
//        $wid = $this->uri->segment(3);
//        $data['title'] = "User Details";
//        
//        $this->mwork->viewedbyUser( $wid );
//        
//        $data['workdetails_test']  = $this->mwork->allUserById( $wid );
//        $data['work_count']  = $this->mwork->work_uploaded_UserById( $wid );
//        $data['user_work_details']  = $this->mwork->get_user_work_details_byId($wid);
//        
//        $this->load->view('discovery/userdetails',$data);
//       }
//        else{
//            redirect('home/login', 'refresh');
//        } 
//    }
public function user_details()
{
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Profile';
        $this->load->helper('download');
        $user_id = $this->uri->segment(3);
        $usd = $this->session->userdata('logged_user');
        $data['user_id'] = $user_id;
        
        $data['show_edit']  = "No";
        
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
        
        
        $data['user_bio'] = $this->mprofile->getUserBioById($user_id);
        //print_r($data['user_bio']);die;
        $data['user_contact'] = $this->mprofile->getUserIscontactById($user_id);
        $data['work_count'] = $this->mprofile->getUserWorkCountById($user_id);
        $data['user_photo'] = $this->mprofile->getUserPhotoById($user_id);
        $data['user_work_details']  = $this->memail->getUserWorkDetailsById($user_id,$this->uri->segment(3),$limit);
        $data['work_type_details']  = $this->mwork->getWorkTypeDetailsById($user_id);
        
        $this->mwork->viewedbyUser( $user_id );
        //echo $this->db->last_query();
        //print_r($data['work_type_details']);die;
        //$data['user_web_link'] = $this->mprofile->get_user_web_link();
        $this->load->view('profile/index',$data);
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
    
    function getMessageIdByWid(){
    	$wid = $this->input->post('wid');
        $data = $this->mwork->getMessageIdByWid( $wid );
        if(count($data) > 0){
        	$message_id = $data['id'];
        }else{
        	$message_id = '0';
        }
    	echo $message_id;
    }
    
     
}
