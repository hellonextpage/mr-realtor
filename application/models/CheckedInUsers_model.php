<?php
 
 
class CheckedInUsers_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get product by product_id
     */
    function get_product($product_id)
    {
        return $this->db->get_where('products',array('product_id'=>$product_id))->row_array();
    } 
        
    /*
     * Get all products
     */
    function get_all_checkins($where)
    {

        $query = "SELECT cu.*,c.CompName FROM check_in_users cu 
                  LEFT JOIN company c 
                  ON cu.CompID = c.CompID ".$where."";
        
        return $this->db->query($query)->result_array();
    }
        
    /*
     * function to add new product
     */
    function add_product($params)
    {
        $this->db->insert('products',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update product
     */
    function update_product($product_id,$params)
    {
        $this->db->where('product_id',$product_id);
        return $this->db->update('products',$params);
    }
    
    /*
     * function to delete product
     */
    function delete_product($product_id)
    {
        return $this->db->delete('products',array('product_id'=>$product_id));
    }
}
