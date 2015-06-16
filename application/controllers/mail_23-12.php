<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('memail','mprofile'));
        $this->load->helper(array('url','form'));
        //$this->load->helper('download');
       
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
            $this->memail->mailSend();
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
	   $data['title']  = 'Mail Details';
       //echo $this->uri->segment(3);die;
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
        $data['single_mail_details']  = $this->memail->singleMailInfo($this->uri->segment(3));
       $data['reply_mail_details']  = $this->memail->replymailInfo($this->uri->segment(3));
       $data['mail_details']  = $this->memail->mailInfo();
       $data['from_user']  = $this->memail->fromUser($this->uri->segment(3));
       $data['draft_details']  = $this->memail->draftInfo();
       $data['folder_details']  = $this->memail->folderInfo();
       $data['mail_count']  = $this->memail->mailCount();
       $data['user_photo'] = $this->mprofile->get_user_photo();
       $this->load->view('mail_detail',$data);
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
                
                //print_r($this->input->post('id'));die;
             //echo  $this->memail->replySend($this->input->post('message_id'),$this->input->post('editor2'),$this->input->post('user_mail'),$this->input->post('sub')); 
             $this->memail->replySend(); 
             redirect('mail/details/'.$this->input->post('message_id'), 'refresh');
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
