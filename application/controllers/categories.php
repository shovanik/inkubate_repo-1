<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

   public function __construct()
    {
        parent:: __construct();
       
        $this->load->model(array('madmin', 'mcategories', 'msubcategories'));
        $this->load->helper(array('url','form'));
        $this->load->library('pagination', 'session');
       
    }
    
   public function index(){
        $data   = array();
        $data['title']  = 'Category List';
        $data['categories'] = $this->mcategories->getAllCategories( );
        $data['count_category'] = $this->mcategories->getAllCategoriesCount( );
        //echo $this->db->last_query();die;
        //print_r($data['categories']);die;
        $this->load->view('admin/categories/index',$data);
    }
       
    public function getCategory()
    {
        $message = '<select class="form-control" name="category" id="category" onchange="get_subcategory(this.value)"><option value="">Select Category</option>';
        $work_type  = $this->input->post("work_type");
        $data['categories'] = $this->mcategories->getAllCategoriesByWorktype( $work_type );
        if(isset($data['categories']) && count($data['categories']) >0 )
        {
            foreach($data['categories'] as $categories){
                $message .= '<option value="'.$categories['id'].'">'.$categories['categories'].'</option>';
            }
            
        }else{
            $message .= '<option value=""></option>';
        }
        $message .='</select>';
        echo $message;die;
    }
    
    public function getSubCategory()
    {
        $message = '';
        $cat_id     = $this->input->post("cat_id");
        //$work_type  = $this->input->post("work_type");
        $data['sub_cat'] = $this->msubcategories->getAllSubCategoriesByCatid( $cat_id );
        $data['count_subcategory'] = $this->msubcategories->SubCategoriesCountByCatid( $cat_id );
        
        if(isset($data['sub_cat']) && count($data['sub_cat']) >0 )
        {
            $i = 1;
            foreach($data['sub_cat'] as $subcat){
                $message .='<tr>
            		<td>'.$i.'</td>
            		<td>'.$subcat['categories'].'</td>
            		<td class="numeric"><a href="'.base_url('subcategories/edit_subcategory/'.$subcat['id']).'">Edit</a> <br />
                    <a href="javascript:(void)" onclick="delete_category('.$subcat['id'].')">Delete</a></td>
            	</tr>';
             $i++;   
            }
            
        }else{
            $message.='<tr><td colspan="3" align="left">No result found...</td></tr>';
        }
        //$message .='</select>';
        echo $message."appsbee".$data['count_subcategory'];die;
    } 
    
    function edit_category()
    {
        $data   = array();
        $data['title']              = 'Category List';
        $cat_id                     = $this->uri->segment(3);
        $data['category_by_id']     = $this->mcategories->getAllCategoriesById( $cat_id );
        $data['categories']         = $this->mcategories->getAllCategoriesByWorktype( $data['category_by_id']['work_type_id'] );
        //echo $this->db->last_query();die;
        $this->load->view('admin/categories/edit_category',$data);
    }
    
    function add_category()
    {
        $data   = array();
        $data['title']              = 'Add Category';
        $data['categories'] = $this->mcategories->getAllCategoriesByWorktype( 1 );
        $this->load->view('admin/categories/new',$data);
    } 
    
    function add_category_process()
    {
        $data   = array();
        $data['title']              = 'Add Category';
        if($this->input->post(null)){
            $insertdata['work_type_id']     = $this->input->post("work_type");
            $insertdata['category_name']    = $this->input->post("category");
            $insertdata['create_date']      = date("Y-m-d H:i:s");
            $insertdata['status_id']        = 1;
            $sql = $this->db->insert("categories", $insertdata);
            if($sql){
                $this->session->set_flashdata('success', 'Category successfully added');
            }else{
                $this->session->set_flashdata('error', 'There are some error, please check...');
            }
        }   
        
        //redirect(base_url("categories/add_category"));
        redirect(base_url("categories"));
    } 
    
    function update_category()
    {
        if($this->input->post(null)){
            $updatedata['work_type_id']     = $this->input->post("work_type");
            $updatedata['category_name']    = $this->input->post("category");
            $updatedata['modified_date']      = date("Y-m-d H:i:s");
            $id = $this->input->post("cat_id");
            $this->db->where('id', $id);
            $sql = $this->db->update("categories", $updatedata);
            if($sql){
                $this->session->set_flashdata('success', 'Category successfully updated');
            }else{
                $this->session->set_flashdata('error', 'There are some error, please check...');
            }
        }   
        redirect(base_url("categories"));
        //redirect(base_url("categories/edit_category/".$id));
    }
    
    function deleteCategory()
    {
        $cat_id  = $this->uri->segment(3);
        if($cat_id != ""){
            $this->db->where('id', $cat_id);
            $sql = $this->db->delete("categories");
            if($sql){
                $this->session->set_flashdata('success', 'Category successfully deleted');
            }else{
                $this->session->set_flashdata('error', 'There are some error to delete, please check...');
            }
        }
        redirect(base_url("categories"));
        
    } 
}
