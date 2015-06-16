<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Work extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mwork','mprofile','mbookshelf','memail'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
   
   
  public function addWork(){   
        
        $usd = $this->session->userdata('logged_user');
        
        if($this->session->userdata('logged_user')){
           
           //echo  $usd['user_type'];die;
            
        if($usd['user_type'] == '1'){
            
        if($this->input->post())
        {
            $this->mwork->addWork();
            $this->session->set_flashdata('msg','Work Successfully Added');
            redirect('home/author','refresh');
        }
        else
        {
           $data['title']  = 'Add Work';
           $data['user_photo']  = $this->mprofile->get_user_photo();
           $data['fiction_details']  = $this->mwork->fiction_details(1);
           $data['category_details']  = $this->mwork->category_details(2);
           $this->load->view('add_work',$data);
        }
        
       }
       
       else{
            redirect(base_url().'home/publisher', 'refresh');
          } 
         
     }
       else{
            redirect(base_url(), 'refresh');
          }  
        
    }
    
   public function details()
	{
	   $data['title']  = 'Add Work';
       
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mwork->form_details($this->input->post('id')); 
            } 
       
       
	} 
    
     public function editWork()
	{
	   
       $usd = $this->session->userdata('logged_user');
        
        if($this->session->userdata('logged_user')){
       
        if($usd['user_type'] == '1'){
       
       $data['title']  = 'Work Details';
       if($this->input->post(null)){
                
        //print_r($this->input->post('id'));die;
             $this->mwork->editWork($this->input->post('wid'));
             $this->session->set_flashdata('msg','Work Successfully Updated');
             redirect('home/author','refresh'); 
            } 
       
           else
           {
            //$this->memail->update_view($this->uri->segment(3));
            $data['single_work_details']  = $this->mwork->singleWorkDetails($this->uri->segment(3));
            $data['user_photo']  = $this->mprofile->get_user_photo();
            $data['fiction_details']  = $this->mwork->fiction_details(1);
            $data['category_details']  = $this->mwork->category_details(2);
            $this->load->view('edit_work',$data);
           }
        }
         
       else{
            redirect(base_url().'home/publisher', 'refresh');
            }    
       
      }
      
      else{
            redirect(base_url(), 'refresh');
          }  
       
	}
    
    public function cat_details()
	{
	  
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mwork->delete_cat_details($this->input->post('id'),$this->input->post('wid')); 
            } 
       
       
	} 
    
    public function tag_details()
	{
	  
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mwork->delete_tag_details($this->input->post('id'),$this->input->post('wid')); 
            } 
       
       
	} 
    
    function work_details()
    {
        $data   = array();
        $wid = $this->uri->segment(3);
        $bid = $this->uri->segment(4);
        $data['title'] = "Work Details";
        
        if($this->session->userdata('logged_user')){
            
        $data['workdetails_test']  = $this->mwork->allWorkById( $wid );
        $data['workdetails_total']  = $this->mwork->allWork($bid);
        $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(4));
        
        $this->load->view('discovery/details',$data);
        }
        else
        {
         redirect(base_url().'home/login', 'refresh');   
        }
    }
    
    function carousel()
    {
        $data   = array();
        $wid = $this->uri->segment(3);
        $bid = $this->uri->segment(4);
        $data['title'] = "Work Details";
        
        if($this->session->userdata('logged_user')){
            
        $data['workdetails_test']  = $this->mwork->allWorkById( $wid );
        $data['workdetails_total']  = $this->mwork->allWork($bid);
        $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(4));
        
        $this->load->view('discovery/carousel_details',$data);
        }
        else
        {
         redirect(base_url().'home/login', 'refresh');   
        }
    }
    function bookshelf_carousel()
    {
        $data   = array();
        $wid = $this->uri->segment(3);
        $bid = $this->uri->segment(4);
        $data['title'] = "Work Details";
        
        if($this->session->userdata('logged_user')){
            
        $data['workdetails_test']  = $this->mwork->allWorkById( $wid );
        $data['workdetails_total']  = $this->mwork->allWorkForBookshelf($bid);
        $data['bookself_name'] = $this->mbookshelf->get_bookself_name($this->uri->segment(4));
        
        $this->load->view('discovery/bookshelf_carousel_details',$data);
        }
        else
        {
         redirect(base_url().'home/login', 'refresh');   
        }
    }
    function work_details_demo()
    {
        $data   = array();
        $wid = $this->uri->segment(3);
        $data['title'] = "Work Details";
        $data['workdetails_test']  = $this->mwork->allWorkById( $wid );
        
        $this->load->view('discovery/details_demo',$data);
        
    }
    
    public function addPitchit()
	{
	   $data['title']  = 'Work Details';
       //echo $this->uri->segment(3);die;
       if($this->session->userdata('logged_user')){
           if($this->input->post(null)){
                
        //print_r($this->input->post('id'));die;
        $purchase_pitchit  = $this->memail->get_purchase_pitchit_total();
        $pitchit_use_count  = $this->memail->get_use_pitchit_count();
        
         if($purchase_pitchit['sum_total'] >= $pitchit_use_count['count'])
               {
                 $this->mwork->addPitchit($this->input->post('wid'));
                 $this->session->set_flashdata('msg','Pitchit Successfully Added');
                 redirect('home/author','refresh'); 
               } 
           else
               {
                $this->session->set_flashdata('msg','Pitchits are not availlable');
                 redirect('home/author','refresh');
               }    
                
            } 
       
           else
           {
            //$this->memail->update_view($this->uri->segment(3));
            redirect('home/author','refresh');
           }
       
	  }
      else
      {
        redirect('home/login','refresh');
      }
    }
    
  public function editPitchit()
	{
	   $data['title']  = 'Edit Pitchit';
       //echo $this->uri->segment(3);die;
       
        if($this->input->post(null)){
                
        //print_r($this->input->post('id'));die;
             $this->mwork->editPitchit($this->input->post('pid'),$this->input->post('wid'));
             $this->session->set_flashdata('msg','Pitchit Successfully Updated');
             redirect('home/author','refresh'); 
            } 
       
       else
       {
        //$this->memail->update_view($this->uri->segment(3));
        $data['user_photo']  = $this->mprofile->get_user_photo();
        $data['user_notification']  = $this->memail->get_user_notification();
        $data['user_notification_count']  = $this->memail->get_user_notification_count();
        $data['user_pitchit_details']  = $this->mwork->get_user_savepitchit_details();
        $this->load->view('view_save_pitchit',$data);
       }
       
	}  
    
  public function pitchit_view()
	{
	   $data['title']  = 'Pitchit Details';
       //echo $this->uri->segment(3);die;
       
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->update_pitchit_view($this->input->post('id')); 
            } 
       
	}
    
   public function pitchit_single_view()
	{
	   $data['title']  = 'Pitchit Details';
       //echo $this->uri->segment(3);die;
       
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->update_pitchit_single_view($this->input->post('pit_id'),$this->input->post('wid')); 
            } 
       
	} 
    
   public function pitchit_single_save()
	{
	   $data['title']  = 'Pitchit Details';
       //echo $this->uri->segment(3);die;
       
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->memail->update_pitchit_single_save($this->input->post('pit_id'),$this->input->post('wid')); 
            } 
       
	} 
    
   public function work_dtls(){
   	$data = array();
   	$data['status'] = "false";
   	$data['messages'] = array();
    $data['cat'] = array();
   	//$limit = 15;
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                $data['status'] = "true";
                //print_r($this->input->post('id'));die;
            $data['messages'] =  $this->mwork->allWorkById($this->input->post('id')); 
            $data['cat']  = $this->mbookshelf->get_book_tag($this->input->post('id'));
            
            } 
        }
      
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);     
        exit;       
    }
    
   public function delete_work(){
         //echo $id;die;
        if($this->session->userdata('logged_user')){
            
             $this->memail->delete_work($this->uri->segment(3)); 
             redirect('home/author','refresh');
             
           
        }
      else{
            redirect('work/editWork/'.$this->uri->segment(3), 'refresh');
        }        
    }      
     
          
}
