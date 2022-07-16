<?php
 
 
class CompanyVentures_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get product by product_id
     */
    function get_venture($VentureID)
    {

        $query = "SELECT v.*,c.CompName,z.ZoneName FROM ventureslist v
        LEFT JOIN company c ON v.CompID = c.CompID
        LEFT JOIN zones z on z.ZoneID = v.ZoneID
        WHERE v.VentureID = '$VentureID'";
        return $this->db->query($query)->row_array();
       
    }

    function get_company($company)
    {

        $query = "SELECT * from company 
        WHERE slug = '$company'";
        return $this->db->query($query)->row_array();
       
    }

    function get_venture_id($venture)
    {

        $query = "SELECT  v.*,c.CompName,z.ZoneName FROM ventureslist v
        LEFT JOIN company c ON v.CompID = c.CompID
        LEFT JOIN zones z on z.ZoneID = v.ZoneID
        WHERE venture_slug = '$venture'";
        return $this->db->query($query)->row_array();
       
    }   
        
    /*
     * Get all products
     */
    function get_all_ventures($where)
    {
        
            $query = "SELECT v.*,c.CompName,z.ZoneName FROM ventureslist v
                  LEFT JOIN company c ON v.CompID = c.CompID
                  LEFT JOIN zones z on z.ZoneID = v.ZoneID ".$where."";
        
            $result = $this->db->query($query)->result_array();
            return $result;
          
        
    }

        
    /*
     * function to add new product
     */
    function add_venture($params)
    {
        $this->db->insert('ventureslist',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update product
     */
    function update_venture($VentureID,$params)
    {
        $this->db->where('VentureID',$VentureID);
        return $this->db->update('ventureslist',$params);
    }

    
    function add_venture_plot($params){

        $this->db->insert('venture_plots',$params);
        return $this->db->insert_id();
    }

    function update_venture_plot($PlotID,$params){

        $this->db->where('PlotID',$PlotID);
        return $this->db->update('venture_plots',$params);
    }
    function get_venture_plots($VentureID){


        $query = "SELECT vp.*,pt.ptype_name,v.VentureName FROM venture_plots vp
                  LEFT JOIN ventureslist v ON v.VentureID = vp.VentureID
                  LEFT JOIN plot_type pt ON pt.ptype_id = vp.ptype_id
                  WHERE vp.VentureID = '$VentureID'";
        return $this->db->query($query)->result_array();
    }
    function get_venture_plot($PlotID){


        $query = "SELECT vp.*,pt.ptype_name,v.VentureName FROM venture_plots vp
                  LEFT JOIN ventureslist v ON v.VentureID = vp.VentureID
                  LEFT JOIN plot_type pt ON pt.ptype_id = vp.ptype_id
                  WHERE vp.PlotID = '$PlotID'";
        return $this->db->query($query)->row_array();
    }
    
    /*
     * function to delete product
     */
    function delete_product($product_id)
    {
        return $this->db->delete('products',array('product_id'=>$product_id));
    }

}
