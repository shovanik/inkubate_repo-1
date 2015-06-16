<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategories extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin', 'msubcategories', 'mcategories'));
        $this->load->helper(array('url','form'));
        $this->load->library('pagination', 'session');
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Sub Category List';
        $data['subcategories'] = $this->msubcategories->getAllSubCategories( );
        $data['count_subcategory'] = $this->msubcategories->getAllSubCategoriesCount( );
        $data['categories']      = $this->mcategories->getAllCategories( );
        //echo $this->db->last_query();die;
        //print_r($data['categories']);die;
        $this->load->view('admin/subcategories/index',$data);
    }
    
    function add_subcategory()
    {
        $data   = array();
        $data['title']              = 'Add Sub Category';
        $data['categories'] = $this->mcategories->getAllCategories( );
        $this->load->view('admin/subcategories/new',$data);
    } 
    
    function add_subcategory_process()
    {
        $data   = array();
        $data['title']              = 'Add Sub Category';
        if($this->input->post(null)){
            $insertdata['work_type_id']     = $this->input->post("work_type");
            $insertdata['pid']              = $this->input->post("category");
            $insertdata['category_name']    = $this->input->post("sub_cat");
            $insertdata['create_date']      = date("Y-m-d H:i:s");
            $insertdata['status_id']        = 1;
            $sql = $this->db->insert("categories", $insertdata);
            if($sql){
                $this->session->set_flashdata('success', 'Sub category successfully added');
            }else{
                $this->session->set_flashdata('error', 'There are some error, please check...');
            }
        }   
        redirect(base_url("subcategories"));
        //redirect(base_url("subcategories/add_subcategory"));
    } 
    
    function edit_subcategory()
    {
        $data   = array();
        $data['title']              = 'Sub category List';
        $cat_id                     = $this->uri->segment(3);
        $data['category_by_id']     = $this->mcategories->getAllCategoriesById( $cat_id );
        $data['categories']      = $this->mcategories->getAllCategories( );
        //echo $this->db->last_query();die;
        $this->load->view('admin/subcategories/edit_subcategory',$data);
    }
    
    function update_subcategory()
    {
        if($this->input->post(null)){
            $updatedata['work_type_id']     = $this->input->post("work_type");
            $updatedata['pid']              = $this->input->post("category");
            $updatedata['modified_date']    = date("Y-m-d H:i:s");
            $updatedata['category_name']    = $this->input->post("sub_cat");
            $id = $this->input->post("cat_id");
            $this->db->where('id', $id);
            $sql = $this->db->update("categories", $updatedata);
            if($sql){
                $this->session->set_flashdata('success', 'Category successfully updated');
            }else{
                $this->session->set_flashdata('error', 'There are some error, please check...');
            }
        }   
        
        //redirect(base_url("subcategories/edit_subcategory/".$id));
        redirect(base_url("subcategories"));
    }
    
    function deleteSubCategory()
    {
        $cat_id  = $this->uri->segment(3);
        if($cat_id != ""){
            $this->db->where('id', $cat_id);
            $sql = $this->db->delete("categories");
            if($sql){
                $this->session->set_flashdata('success', 'Sub category successfully deleted');
            }else{
                $this->session->set_flashdata('error', 'There are some error to delete, please check...');
            }
        }
        redirect(base_url("subcategories"));
        
    }  
       
    
}
