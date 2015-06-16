<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {
var $author_per_page = 10;
    var $author_offset = 0;
    var $author_alphabet = "a";
   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('memail','mprofile','mwork'));
        $this->load->helper(array('url','form'));
        //$this->load->helper('download');
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
    	
	 
	 return $data;
    }
    public function checkmail(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
             echo  $this->memail->checkmail($this->input->post('user_mail')); 
            } 
        }
      else{
            redirect('mail/compose', 'refresh');
        }        
    }
   
  public function compose(){   
        
        if($this->input->post())
        {
            $button_type = $this->uri->segment(3);
            //print_r($this->input->post());die;
            //echo $_FILES['image']['name'];die;
            
            $this->memail->mailSend($button_type);
            $this->session->set_flashdata('msg','Message Successfully send');
            redirect('home/inbox','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Compose Mail';
            $this->load->view('compose_mail',$data);
        }
        
    }
    
   public function compose_forward(){   
        
        if($this->input->post())
        {
            $button_type = $this->uri->segment(3);
            //print_r($this->input->post());die;
            //echo $_FILES['image']['name'];die;
            
            $this->memail->mailSend_forward($button_type);
            $this->session->set_flashdata('msg','Message Successfully send');
            redirect('home/inbox','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Compose Mail';
            $this->load->view('compose_mail',$data);
        }
        
    } 
    
    public function compose_pit_msg(){   
        
        if($this->input->post())
        {
            $button_type = 'send';
            $pit_type= $this->input->post('send_type');
            //print_r($this->input->post());die;
            //echo $_FILES['image']['name'];die;
            
            $this->memail->mailSend($button_type,$pit_type);
            $this->session->set_flashdata('msg','Message Successfully send');
            redirect('home/inbox','refresh');
        }
        else
        {
            $data   = array();
            $data['title']  = 'Compose Mail';
            $this->load->view('compose_mail',$data);
        }
        
    }
    
   public function details()
	{
	   $data = $this->address();
	   $data['title']  = 'Mail Details';
       //echo $this->uri->segment(3);die;
       if($this->session->userdata('logged_user')){
       if (isset($_POST['notify'])) 
       {
        if($this->input->post(null)){
                
            //print_r($this->input->post('id'));die;
             echo  $this->memail->update_notify_view($this->input->post('id')); 
            } 
       /*$this->memail->update_notify_view($this->uri->segment(4)); 
       $data['single_mail_details']  = $this->memail->singleMailInfo($this->uri->segment(4));
       $data['reply_mail_details']  = $this->memail->replymailInfo($this->uri->segment(4));
       $data['mail_details']  = $this->memail->mailInfo();
       $data['from_user']  = $this->memail->fromUser($this->uri->segment(4));
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $this->load->view('mail_detail',$data);*/
       }
       else
        {
            $this->memail->update_view($this->uri->segment(3));
            $data['user_contact'] = $this->mprofile->get_user_iscontact();
            $data['single_mail_details']  = $this->memail->singleMailInfo($this->uri->segment(3));
            $data['reply_mail_details']  = $this->memail->replymailInfo($this->uri->segment(3));
            $data['mail_details']  = $this->memail->mailInfo();
            $data['from_user']  = $this->memail->fromUser($this->uri->segment(3));
            $data['draft_details']  = $this->memail->draftInfo();
            $data['folder_details']  = $this->memail->folderInfo();
            $data['mail_count']  = $this->memail->mailCount();
            $data['draft_count']  = $this->memail->draftCount();
            $data['pitchit_count']  = $this->memail->pitchitCount();
            $data['user_photo'] = $this->mprofile->get_user_photo();
            
            $data['pitchit_details']  = $this->memail->pitchitInfo();
            $data['msg_status']  = "inbox";
        
            $this->load->view('mail_detail',$data);
        }
      }
      else{
            redirect('home/login', 'refresh');
        }  
       
    } 
    
   public function pitch_msgcnt()
	{
		$data = $this->address();
	   $data['title']  = 'Mail Details';
       //echo $this->uri->segment(3);die;
       if (isset($_POST['notify'])) 
       {
        if($this->input->post(null)){
                
            //print_r($this->input->post('id'));die;
             echo  $this->memail->update_notify_pithmsg_view($this->input->post('id')); 
            } 
       /*$this->memail->update_notify_view($this->uri->segment(4)); 
       $data['single_mail_details']  = $this->memail->singleMailInfo($this->uri->segment(4));
       $data['reply_mail_details']  = $this->memail->replymailInfo($this->uri->segment(4));
       $data['mail_details']  = $this->memail->mailInfo();
       $data['from_user']  = $this->memail->fromUser($this->uri->segment(4));
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $this->load->view('mail_detail',$data);*/
       }
       
       
    } 
    
   public function download ($file_path = "")
    {
            $this->load->helper('download'); //load helper
             
            //$file_path = $this->input->post("file_path",TRUE);
            $usd = $this->session->userdata('logged_user');
            $file_path = "uploadImage/".$this->uri->segment(3)."/attach_image/".$this->uri->segment(4);
            $layout="no_theme"; //if you have layout
             
            $data['download_path'] = $file_path;        
                         
            $this->load->view("view_file",$data);
            //redirect("same url", "refresh");                        
                     
    }
   
   public function delete_details(){
         //echo $id;die;
        if($this->session->userdata('logged_user')){
            
             $this->memail->delete_details($this->uri->segment(3)); 
             redirect('home/inbox','refresh');
             
           
        }
      else{
            redirect('mail/details', 'refresh');
        }        
    }


    public function msgDelete(){
        $val = $this->uri->segment(4); 
        $arr = explode('-',$val);
        //print_r($arr);
        foreach($arr as $mid) {
            $this->memail->msgDelete($mid); 
        }
        if($this->uri->segment(5) == 'ALL'){       
            redirect('home/inbox','refresh');       
        } else {
            redirect('mail/details/'.$this->uri->segment(3), 'refresh');
        }        
    }


    
    public function draft_details(){
         //echo $id;die;
        if($this->session->userdata('logged_user')){
            
             $this->memail->draft_details($this->uri->segment(3)); 
             redirect('home/inbox','refresh');
                   
        }
      else{
            redirect('mail/details', 'refresh');
        }        
    } 
    
    public function trash_details(){
         //echo $id;die;
        if($this->session->userdata('logged_user')){
            
             $this->memail->trash_details($this->uri->segment(3)); 
             redirect('home/inbox','refresh');
             
           
        }
      else{
            redirect('mail/details', 'refresh');
        }        
    }
   
    public function replybox(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                $button_type = $this->uri->segment(3);
                //echo $_FILES['image']['name'];die;
                //print_r($this->input->post());die;
             //echo  $this->memail->replySend($this->input->post('message_id'),$this->input->post('editor2'),$this->input->post('user_mail'),$this->input->post('sub')); 
             $reply = $this->memail->replySend($button_type);
             //echo $reply;die;
             redirect('mail/details/'.$this->input->post('reply_message_id'), 'refresh');
            } 
        }
      else{
            redirect('home/inbox','refresh');
        }        
    }
    
    public function replyAllbox(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                $button_type = $this->uri->segment(3);
                //echo $_FILES['image']['name'];die;
                //print_r($this->input->post());die;
             //echo  $this->memail->replySend($this->input->post('message_id'),$this->input->post('editor2'),$this->input->post('user_mail'),$this->input->post('sub')); 
             $reply = $this->memail->replyAllSend($button_type);
             //echo $reply;die;
             redirect('mail/details/'.$this->input->post('reply_message_id'), 'refresh');
            } 
        }
      else{
            redirect('home/inbox','refresh');
        }        
    }
    
    public function draftAllbox(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                $button_type = $this->uri->segment(3);
                //echo $_FILES['image']['name'];die;
                //print_r($this->input->post());die;
             //echo  $this->memail->replySend($this->input->post('message_id'),$this->input->post('editor2'),$this->input->post('user_mail'),$this->input->post('sub')); 
             $reply = $this->memail->draftAllSend($button_type);
             //echo $reply;die;
             redirect('home/inbox', 'refresh');
            } 
        }
      else{
            redirect('home/inbox','refresh');
        }        
    }
    
    public function forward(){
        if($this->session->userdata('logged_user')){
            if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             //echo  $this->memail->replySend($this->input->post('message_id'),$this->input->post('editor2'),$this->input->post('user_mail'),$this->input->post('sub')); 
             $this->memail->forward(); 
             redirect('mail/details/'.$this->input->post('message_id'), 'refresh');
            } 
        }
      else{
            redirect('home/inbox','refresh');
        }        
    }     

          
}
