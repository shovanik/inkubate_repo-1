<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class mcategories extends CI_Model
{

    function getAllCategoriesByWorktype( $work_type )
    {
    $this->db->select("id, category_name categories, work_type_id, pid")
        ->where("pid", 0)
        ->where("work_type_id", $work_type);
    $res = $this->db->get("categories");
    return $res->result_array();
    } 

    function getAllSubCategoriesByWorktype( $work_type, $cat_id )
     {
        $this->db->select("id, category_name sub_cat, work_type_id, pid")
            ->where("pid", $cat_id)
            ->where("work_type_id", $work_type);
        $res = $this->db->get("categories");
        $row = $res->result_array();
        //echo $this->db->last_query();die;
        return $row;
     } 
     
     function getAllCategories()
     {
        $row = $this->db->select("id, category_name categories, work_type_id, pid")->where("pid =", '0')->order_by("id", "desc")->get("categories")->result_array();
        //echo $this->db->last_query();die;
        return $row;
     }
     
     function getAllCategoriesById( $id )
     {
        $row = $this->db->select("id, category_name categories, work_type_id, pid")->where("id", $id)->order_by("id", "desc")->get("categories")->row_array();
        //echo $this->db->last_query();die;
        return $row;
     }
     
     function getAllCategoriesCount()
     {
        $row = $this->db->select("count(*) count")->get("categories")->row_array();
        //echo $this->db->last_query();die;
        return $row['count'];
     }     
   
}
