<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mhome extends CI_Model
{
    
//-------------------------------
// EMAIL EXISTS (true or false)
//---------------------------------
private function email_exists($email)
{
	$this->db->where('email', $email);
	$query = $this->db->get('users');
	if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
}
 
//---------------------------------
// AJAX REQUEST, IF EMAIL EXISTS
//---------------------------------
function register_email_exists()
{
	if (array_key_exists('email',$_POST)) {
		if ( $this->email_exists($this->input->post('email')) == TRUE ) {
			echo json_encode(FALSE);
		} else {
			echo json_encode(TRUE);
		}
	}
}
    
    function register(){
        $data   = array();
        //$data   = $this->input->post(null);
        $unqid = md5(uniqid(rand(), true));
        
        $maxid  = $this->db->select_max('id')->get('users')->row_array();
        //echo $this->db->last_query();die;
        $mid = $maxid['id']+1;
        
        $data['id'] = $mid;
        //echo $data['id'];die;
        $data['username'] = $this->input->post('email');
        $data['email'] = $this->input->post('email');
        $data['user_type'] = $this->input->post('type');
        $data['user_guid'] = md5(uniqid(rand(), true));
        
        unset($data['name']);
        unset($data['con_email']);
        unset($data['desc']);
       
        $data['created']    = date("Y-m-d h:i:s");
        $this->db->insert('users', $data);
       // echo "sssssss";die;
        //$last_id=$this->db->insert_id();
        
        $this->send_mail_to_registered_user($data['email'], $data['user_guid'],$data['user_type']);
         //echo "sssssss";die;
       return 1;
    }
    
    function register2(){
        $data   = array();
        //$data   = $this->input->post(null);
        $unqid = $this->input->post('unqid');
        
        $data['name_first'] = $this->input->post('fname');
        $data['name_middle'] = $this->input->post('mname');
        $data['name_last'] = $this->input->post('lname');
        $data['date_of_birth'] = $this->input->post('dob');
        $data['postal_code'] = $this->input->post('zip');
        $data['password'] = md5($this->input->post('password'));
        
        unset($data['con_password']);
        
        $update_account=$this->db->where('user_guid',$unqid)->update('users',$data);
         //echo "sssssss";die;
       return 1;
    }
    
   function send_mail_to_registered_user($email ,$unqid,$usertype){
        $verified   = md5($email);
        if($usertype == 1)
        {
            $type = 'Writer';
        }
        if($usertype == 2)
        {
            $type = 'Publisher';
        }
        //echo "email : ".$email." : name : ".$name." : password :".$password."<br>";
        $sub    = 'Your Invitation to Inkubate';
        $str    = '<div style="width:750px; padding:0px 0 0 0; margin:40px auto; font-family:Verdana, Geneva, sans-serif; font-size:13px;background-color: #39302c;">

   <table width="100%" border="0" cellpadding="8" cellspacing="0" style="color:#39302c; padding:10px 0 0px 0px; border:#ccc solid 1px;">
   
   <tr>
   
     <td height="168"><a href="" style="padding-bottom:0px;"><img src="http://billbahadur.com/demo/inkubate/images/logo.png" alt="" /></a></td>
     
   
   </tr>
  <tr>
    <td width="27%"><strong style="color: white;">Dear '.$type.',<br/>

<p>Your request for an invitation to Inkubate has been approved. Please click <a href="http://billbahadur.com/demo/inkubate/home/step2/'.$unqid.'">http://billbahadur.com/demo/inkubate/home/step2/'.$unqid.'</a> to finish the registration process. *If this link does not work, copy and paste the URL into your browser.</p>

<p>Becoming a part of Inkubate will allow you to post your work in a highly organized, searchable portfolio that only vetted publishers and agents will be able to view. Heres how it works:</p>

<p>Sign on and post your work.</p>
<p>Create your profile.</p>
<p>Build your literary brand.</p>
<p>Its that simple. When we invite Publishers and agents to join Inkubate, they will be searching the works you have posted.</p>

<p>Once you have posted work, you can invite your writing friends and colleagues to join you on Inkubate!</p></strong></td>
    
  </tr>
  
   <tr>
   <td colspan="2" bgcolor="#ddd"><p><strong>&#169  2014 Inkubate. All rights reserved. </p></strong></td>
  
   </tr>
</table></div>';
        //die($str);
        //die();
        //$headers  = "From: Admin <das.prasenjit55@gmail.com>\n";
        $headers = "From: ashes.pramanick@appsbee.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-Type: text/HTML; charset=ISO-8859-1\r\n";
        @mail($email, $sub, stripslashes($str), $headers);
        return 1;
    }
    
 function check_credentials(){
        #dump into local variables
        
        
        $email  = $this->input->post('email');
        //$pass   = $this->input->post('password');
        $pass   = md5($this->input->post('password'));
        //$chkRs  = $this->db->select('id, name_first,email,user_type,DATE(created) as date')->where('email', $email)->where('password', $pass)->get('users');
        $chkRs  = $this->db->select('*')->where('email', $email)->where('password', $pass)->get('users');
        
        //echo $this->db->last_query();die;
        
        if($chkRs->num_rows() > 0){
            $temp   = array();
            $temp   = $chkRs->row_array();
            
        //$date =  date('d-m-Y',strtotime($temp['date']));
        $date =  date('d-m-Y',strtotime($temp['created']));
        $parts = explode('-',$date);
        $new_date = date('d-m-Y',mktime(1,1,1,$parts[1],($parts[0]+60),$parts[2]));
        $today_date=date('Y-m-d',strtotime($new_date));
        $date1 =  date('Y-m-d');
        
            #set the session for the logged in user
            //if($date1<=$today_date)
            //{
            $this->session->set_userdata('logged_user', $temp);
            
            //$data22['login_modified']    = date("Y-m-d h:i:s");
            $data22['created']    = date("Y-m-d h:i:s");
            $update_account=$this->db->where('email',$temp['email'])->update('users',$data22);
            //echo $this->db->last_query();die;
            //print_r($temp);die;
            if($temp['user_type'] == '1')
            {
            return 1;
            }
            else{
               
               return 2;
            }
        }else{
            return 0;
        }
    }   

}
