<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pitchit extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin', 'mpitchit', 'memail', 'mwork', 'mbookshelf', 'mprofile'));
        $this->load->helper(array('url','form'));
        $this->load->helper('text');
       
    }
   
    public function pitchAdd(){
        if($this->input->post())
        {
            //$add_data['feeds_url'] = $this->input->post('feeds_url');
            //$sql = $this->db->insert("feeds_url", $add_data);
            $sql = $this->mpitchit->addpitchit();
            if($sql == 1){
                $this->session->set_flashdata('success','Pitchits Successfully added');
                redirect(base_url()."pitchit/pitchDetails");
            }else{
                $this->session->set_flashdata('error','There are ome problem to add Pitchits, please try again');
                redirect(base_url()."pitchit/pitchDetails");
            }
        }else{
            $data   = array();
            $data['title']  = 'Add Pitchits!';
            $this->load->view('admin/pitchit/add',$data);
        }
    }
    
   public function pitchDetails(){
        $data   = array();
        $data['title']  = 'Pitchit package list';
        $data['pitchitlist']  = $this->mpitchit->getPitchitList();
        //$data['feedsurl_list']  = $this->mpitchit->getFeedsUrlList();
        $this->load->view('admin/pitchit/index',$data);
    }
    
    public function edit(){
        
        if($this->input->post())
        {
            $id = $this->input->post('id');
            
            $sql = $this->mpitchit->editpitchit($id);
            
            
            if($sql == '1'){
                $this->session->set_flashdata('success','Pitchits Successfully updated');
                redirect(base_url()."pitchit/pitchDetails");
            }else{
                $this->session->set_flashdata('error','There are ome problem to update Pitchits, please try again');
                redirect(base_url()."pitchit/edit/".$id);
            }
        }else{
            $id = $this->uri->segment(3);
            $data   = array();
            $data['title']  = 'Update Pitchit Package';
            $data['details'] =  $this->mpitchit->getPitchitListById( $id );
            $this->load->view('admin/pitchit/edit',$data);
        }
    }

    function changeRank()
    {
        $data['rank'] = $this->input->post('rank');
        $pit_id = $this->input->post('pit_id');
        $sql = $this->db->where("pit_id", $pit_id)->update("work_pitchits_saved", $data);
        if($sql){
            echo '1';
        }else{
            echo '0';
        }
    }
    
    public function save_pub_pit(){
        if($this->uri->segment(3))
        {
            
            $sql = $this->mpitchit->save_pub_pit($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
            redirect(base_url().'home/publisher','refresh');
            
        }else{
            $data   = array();
            $data['title']  = 'Publisher';
            //$this->load->view('admin/pitchit/add',$data);
            redirect(base_url().'home/publisher','refresh');
        }
    } 

    public function ajax_pitchit_search(){
        if($this->session->userdata('logged_user')){
            $data   = array();
            if($this->input->post('type') == "pitchit"){$limit = 5;}else{$limit = 10;}
            $data['page'] = $this->input->post('page');
            $data['offset'] = ($data['page'] - 1) * $limit;

            $tab_id = $this->input->post('tab_id');
            switch ($tab_id) {
                case "tab1":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['userLatestPitchitDetails']  = $this->mpitchit->getUserLatestPitchitDetails($data['offset'],$limit);
                    $data['userLatestPitchitCount']  = $this->mpitchit->getUserLatestPitchitCount();
                    $data['view_more']  = (count($data['userLatestPitchitCount'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_latest_pitchit_search',$data);
                    break;

                case "tab2":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['userSavedPitchitDetails']    = $this->mpitchit->getUserSavedPitchitDetails_pub($data['offset'],$limit);
                    $data['userSavedPitchitCount']    = $this->mpitchit->getUserSavedPitchitCount_pub();
                    //echo $this->db->last_query();die;
                    $data['view_more']  = (count($data['userSavedPitchitCount'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_saved_pitchit_search',$data);
                    break;

                case "tab3":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['userViewallPitchitDetails']    = $this->mpitchit->getUserAllPitchitDetails($data['offset'],$limit);
                    $data['userViewallPitchitCount']      = $this->mpitchit->getUserAllPitchitCount();
                    $data['view_more']  = (count($data['userViewallPitchitCount'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_viewall_pitchit_search',$data);
                    break;

                case "tab4":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['pitchit_details_limit_cat']  = $this->memail->get_pitchit_details_view_limit_cat();
                    $data['pitchit_details_limit_form']  = $this->memail->get_pitchit_details_view_limit();
                    $pitchit_details_limit_total = array_merge( $data['pitchit_details_limit_form'], $data['pitchit_details_limit_cat'] );
                    
                    if(!empty($pitchit_details_limit_total))
                    {
                    foreach($pitchit_details_limit_total as $keys=>$pit) 
                    {
                        $data['pitchit_details_limit_total'][$pit["id"]] = $pit;
                    }
                    $data['pitchit_details_limit_original'] = array_slice ($data['pitchit_details_limit_total'], $data['offset'],$limit);
                    
                    $data['view_more']  = (count($data['pitchit_details_limit_total'])-($limit*$data['page']));
                    }
                    
                    
                    $this->load->view('ajax_search/ajax_response_pitchit_search',$data);
                    break;

                case "tab5":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['totalViewPitchit']           = $this->mpitchit->getTotalViewPitchit($data['offset'],$limit);
                    $data['totalViewPitchitCount']      = $this->mpitchit->getTotalViewPitchitCount();
                    $data['view_more']  = (count($data['totalViewPitchitCount'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_totalviewed_pitchit_search',$data);
                    break;

                case "tab_dem1":
                    //$data['total_rows']['count']  = 25;
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['total_rows']  = $this->mpitchit->get_user_recently_add_titles_count();
                    $data['user_recently_add_titles']  = $this->memail->get_user_recently_add_titles($data['offset'],$limit);
                    $data['view_more']  = ($data['total_rows']['count']-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_author_rcenttitle_search',$data);
                    break;

                case "tab_dem2":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['total_rows']  = $this->memail->get_author_view_details_cnt();
                    $data['author_view_details']  = $this->memail->get_author_view_details($data['offset'],$limit);
                    $data['view_more']  = ($data['total_rows']['count']-($limit*$data['page']));//print_r($data);die;
                    $this->load->view('ajax_search/ajax_author_view_search',$data);
                    break;

                case "tab_dem3":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['total_rows']  = $this->memail->get_downloads_details_count();
                    $data['user_download_details']  = $this->memail->get_user_work_download_details($data['offset'],$limit);
                    $data['view_more']  = (count($data['total_rows']['count'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_author_download_search',$data);
                    break;

                case "tab_dem4":
                    $data['user_contact'] = $this->mprofile->get_user_iscontact();
                    $data['total_rows']          = $this->mbookshelf->get_user_author_bookshelf_count();
                    //$data['bookshelf_profiles']  = $this->mpitchit->getTotalViewPitchit($data['offset'],$limit);
                    $data['bookshelf_profiles']  = $this->mwork->allBookshelfByWriterProfiles();
                    $data['view_more']  = (count($data['total_rows']['count'])-($limit*$data['page']));
                    $this->load->view('ajax_search/ajax_publisher_bookshelved_search',$data);
                    break;

                default:
                    echo "There is an error";
            }

            
        }
        
    } 
    
   
    public function pitchitHour(){
        $data   = array();
        $data['title']  = 'All Pitchits!';
        //$data['work_type']  = 1;
        
        $limit=40;
        ### pagination starts ###
        $this->load->library('pagination');
        $config['base_url']       = base_url().'admin/allfiction/';
        $config['total_rows']     = $this->madmin->allFiction();
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
        
        
        $data['all_hour']  = $this->madmin->allPitchitHour();
        $data['allPitchit']  = $this->madmin->work_pitchits();
        
        //echo $this->db->last_query();die;
        $this->load->view('admin/pitchit/pitchit_hour',$data);
    }
    
   function add_pitchit_hour()
    {
        $data = array();
        $hour_id = $this->input->post('hour_id');
        $pitchit_id = $this->input->post('pitchit_id');
        
        $pitid = explode(', ',$pitchit_id);
        
        
         $today = date("Y-m-d H:i:s");
        //echo date('Y-m-d H:i:s',strtotime('+'.$hour_id.'hour',strtotime($today)));
       // echo date('Y-m-d H:i:s',strtotime('+13 hours +20 minutes',strtotime($today)));
       if($hour_id == '')
        {
           $data['allow_date'] = null;
           $data['allow_hour'] = null;
        }
        else
        {
           $data['allow_date'] = date('Y-m-d H:i:s',strtotime('+'.$hour_id.'hours',strtotime($today))); 
           $data['allow_hour'] = $hour_id;
        }
        
        
        $usd = $this->session->userdata('logged_user');
        
        foreach($pitid as $pid)
        {
         $sql = $this->db->where('pit_id',$pid)->update('work_pitchits', $data);
        }
      
        $data['all_hour']  = $this->madmin->allPitchitHour();
        $data['allPitchit']  = $this->madmin->work_pitchits();
        
        //echo $this->db->last_query();die;
        $this->load->view('ajax_search/ajax_pitchit_control',$data); 
        
        
        /*if($sql){
            echo '1';
        }else{
            echo "0";
        }
        exit;*/
    } 
          
}
