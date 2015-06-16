<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pitchit_search extends CI_Controller {

  public function __construct()
  {
      parent:: __construct();
     
      $this->load->model(array('mpitchit', 'memail', 'mwork'));
      $this->load->helper(array('url','form'));
      $this->load->helper('text');
     
  }
   
  function ajax_saved_pitchit_search_author()
  {
      if($this->session->userdata('logged_user')){
          
          $data   = array();
          
          $limit_saved    = $this->input->post('limit_saved');
          $data['page_saved'] = $this->input->post('page_saved');
          $data['offset_saved'] = ($data['page_saved'] - 1) * $limit_saved;
          $data['user_pitchit_saved_details']  = $this->memail->get_user_pitchit_saved_details($data['offset_saved'],$limit_saved);
          $data['user_pitchit_saved_details_cnt']  = $this->memail->get_user_pitchit_saved_details_cnt();
          $data['view_more']  = ($user_pitchit_saved_details_cnt['count']-($limit_saved*$data['page_saved']));
          $this->load->view('ajax_search/ajax_saved_pitchit_search_author',$data);
      }
  }

  function ajax_viewall_pitchit_search()
  {
      if($this->session->userdata('logged_user')){
          
          $data   = array();
          $limit_viewall    = $this->input->post('limit_viewall');
          $data['page_viewall']     = $this->input->post('page_viewall');
          $data['offset_viewall'] = ($data['page_viewall'] - 1) * $limit_viewall;
          $data['userViewallPitchitDetails']    = $this->mpitchit->getUserAllPitchitDetails($data['offset_viewall'],$limit_viewall);
          $data['userViewallPitchitCount']      = $this->mpitchit->getUserAllPitchitCount();
          $data['view_more']  = (count($data['userViewallPitchitCount'])-($limit_viewall*$data['page_viewall']));
          $this->load->view('ajax_search/ajax_viewall_pitchit_search_publisher',$data);
      }
  }
  
  function ajax_total_pitchit_search()
  {
      if($this->session->userdata('logged_user')){
          
          $data   = array();
          $limit_total    = $this->input->post('limit_total');
          $data['page_total']     = $this->input->post('page_total');
          $data['offset_total'] = ($data['page_total'] - 1) * $limit_total;
          $data['totalViewPitchit']    = $this->mpitchit->getTotalViewPitchit($data['offset_total'],$limit_total);
          $data['totalViewPitchitCount']    = $this->mpitchit->getTotalViewPitchitCount();
          $data['view_more']  = (count($data['totalViewPitchitCount'])-($limit_total*$data['page_total']));
          $this->load->view('ajax_search/ajax_total_pitchit_search',$data);
      }
  }  

  function ajax_response_pitchit_search()
  {
      if($this->session->userdata('logged_user')){
          
          $data   = array();
          $limit_resp    = $this->input->post('limit_resp');
          $data['page_resp']     = $this->input->post('page_resp');
          $data['offset_resp'] = ($data['page_resp'] - 1) * $limit_resp;
          
          $data['pitchit_details_limit_cat']  = $this->memail->get_pitchit_details_view_limit_cat();
          $data['pitchit_details_limit_form']  = $this->memail->get_pitchit_details_view_limit();
          $pitchit_details_limit_total = array_merge( $data['pitchit_details_limit_form'], $data['pitchit_details_limit_cat'] );
          foreach($pitchit_details_limit_total as $keys=>$pit) 
          {
              $data['pitchit_details_limit_total'][$pit["id"]] = $pit;
          }
          $data['pitchit_details_limit_original'] = array_slice ($data['pitchit_details_limit_total'], $data['offset_resp'], $limit_resp);
          $data['view_more']  = (count($data['pitchit_details_limit_total'])-($limit_resp*$data['page_resp']));
          $this->load->view('ajax_search/ajax_response_pitchit_search',$data);
      }
  } 
          
}
