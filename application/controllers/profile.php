<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('mprofile','mhome','memail','mwork'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
        $this->load->library('ActonConnection');
       
    }
    
  public function index(){
    if($this->session->userdata('logged_user')){
        $data   = array();
        $data['title']  = 'Profile';
        $this->load->helper('download');
        $data['show_edit']  = "Yes";
        $usd = $this->session->userdata('logged_user');
        $data['user_id'] = $usd['id'];
        
        
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
        
        
        $data['user_bio'] = $this->mprofile->get_user_bio();
        //print_r($data['user_bio']);die;
        $data['user_contact'] = $this->mprofile->get_user_iscontact();
        $data['work_count'] = $this->mprofile->get_user_work_count();
        $data['user_photo'] = $this->mprofile->get_user_photo();
        $data['user_work_details']  = $this->memail->get_user_work_details($this->uri->segment(3),$limit);
        $data['work_type_details']  = $this->mwork->get_work_type_details();
        //$data['user_web_link'] = $this->mprofile->get_user_web_link();
        $this->load->view('profile/index',$data);
        }
        else{
            redirect('home/login', 'refresh');
        }
    } 
    
    public function cat_details()
	{
	  
        if($this->input->post(null)){
                
                //print_r($this->input->post('id'));die;
             echo  $this->mprofile->delete_cat_details($this->input->post('id')); 
            } 
       
       
	} 
    
  public function editProfile(){   
        
        if($this->input->post())
        {
            $genre_id = $this->input->post('cate_gory_hid');
            if(!empty($genre_id))
                {
                    foreach($genre_id as $cc)
                    {
                      
                      $ad = $cc;
                      
                    }
                }
            //echo $ad;die;
            if(!empty($genre_id))
            {
             $genre = $this->db->select('id,category_name')->where('id',$ad)->get('categories')->row_array();
            }
            
            $work_type_id = $this->input->post('WorkTypeId');
            if(!empty($work_type_id))
            {
                $work_type = $this->db->select('*')->where('work_type_id',$work_type_id)->get('work_types')->row_array();
                
                if(!empty($work_type['work_type_name']))
                {
                  $work_tp_name = $work_type['work_type_name'];
                }
                else
                {
                  $work_tp_name = '';  
                }
                
            }
            else
            {
                $work_tp_name = '';
            }
            
            $gender = $this->input->post('gender');
            
            if(!empty($gender))
            {
                if($gender == '1')
                {
                    $gender_org = 'Male';
                }
                else{
                    
                    $gender_org = 'Female';
                }
            }
            else
            {
                $gender_org = '';
            }
            
            $user_type = $this->input->post('user_type');
            
            if(!empty($user_type))
            {
                if($user_type == '1')
                {
                    $user_type_org = 'Writer';
                }
                elseif($user_type == '2')
                {  
                    $user_type_org = 'Publisher';
                }
                elseif($user_type == '3')
                {
                    $user_type_org = 'Agent';
                }
                else{
                    
                    $user_type_org = 'Editor';
                }
            }
            
            //echo $gender_org;
            //echo $user_type;die;
            
            $post1 = new ActonConnection;
            $post1->setPostItems('First Name',$this->input->post('name_first'));
            $post1->setPostItems('Last Name',$this->input->post('name_last')); 
            $post1->setPostItems('Email',$this->input->post('personal_email'));
            $post1->setPostItems('User Segmentation Type',$user_type_org); //Select options 01
            $post1->setPostItems('Gender',$gender_org); //Select options 02
            $post1->setPostItems('Age',$this->input->post('age'));
            $post1->setPostItems('Mailing Street',$this->input->post('address'));
            $post1->setPostItems('Mailing City',$this->input->post('city')); 
            $post1->setPostItems('Mailing State/Province',$this->input->post('state')); //Select options 03
            $post1->setPostItems('Mailing Zip/Postal Code',$this->input->post('postal_code'));
            $post1->setPostItems('Mailing Country',$this->input->post('country')); //Select options 04
            $post1->setPostItems('Company',$this->input->post('company_name'));
            $post1->setPostItems('Industry',$this->input->post('industry')); //Select options 05
            $post1->setPostItems('Title',$this->input->post('job_title'));
            $post1->setPostItems('Website',$this->input->post('web'));
            $post1->setPostItems('Twitter Handle',$this->input->post('twitter'));
            $post1->setPostItems('Facebook ID',$this->input->post('facebook'));
            $post1->setPostItems('LinkedIn ID',$this->input->post('linkedin'));
            $post1->setPostItems('Google+ ID',$this->input->post('googleplus'));
            
            if(!empty($genre_id))
            {
              $post1->setPostItems('Title Genre Interest',$genre['category_name']); //Select options 06
            }
            else
            {
              $post1->setPostItems('Title Genre Interest',''); //Select options 06
            }
            
            if(!empty($work_type_id))
            {
               $post1->setPostItems('Title Content Interest Type',$work_tp_name); //Select options 07
            }
            else
            {
               $post1->setPostItems('Title Content Interest Type',''); //Select options 07 
            }
            $post1->setPostItems('Interested in New Titles','Yes'); //Select options 08
            $post1->setPostItems('Manuscripts Viewed',$this->input->post('manuscript_total'));
            $post1->setPostItems('Titles Published Annually',$this->input->post('title_publish')); //Select options 09
            $post1->setPostItems('Offers eBooks','Yes'); //Select options 10
            $post1->setPostItems('Description',$this->input->post('desc'));
            $post1->setPostItems('Are You a Self Published Author','Yes'); //Select options 11
            $post1->setPostItems('Titles Have Won Literary Awards','Yes'); //Select options 12
            $post1->setPostItems('In or Completed MFA in Creative Writing','Yes'); //Select options 13
            $post1->setPostItems('# of Manuscripts Created',$this->input->post('manuscript_total'));
            $post1->setPostItems('Lifetime Number of Titles Published',$this->input->post('title_publish')); //Select options 14
            $post1->processConnection('http://marketing.inkubate.com/acton/eform/13876/0016/d-ext-0001');


            $this->mprofile->updateProfile();
            $this->session->set_flashdata('msg','Profile Successfully updated');
            redirect('profile/','refresh');
        }
        else
        {
            if($this->session->userdata('logged_user')){
            $data   = array();
            $data['title']  = 'Edit Profile';
            //$data['id']    = $this->uri->segment(3);
            $data['work_count'] = $this->mprofile->get_user_work_count();
            $data['user_bio'] = $this->mprofile->get_user_bio($this->uri->segment(3));
            $data['user_contact'] = $this->mprofile->get_user_iscontact();
            $data['user_photo'] = $this->mprofile->get_user_photo();
            $data['user_work_details']  = $this->memail->get_user_work_details();
            //$data['fiction_details']  = $this->mwork->fiction_details(1);
            $data['work_type_details']  = $this->mwork->get_work_type_details();
            $data['countries']          = $this->mprofile->getCountries();
            
            $this->load->view('profile/editProfile',$data);
         }
        else{
            redirect('home/login', 'refresh');
        }
        }
        
    } 
}
