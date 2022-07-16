<?php
 
 
class Companies_admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get employee by emp_id
     */
    function get_company_admin($CompAdminID)
    {
        
         $query = " SELECT c .* FROM compadmins c WHERE c.CompAdminID = '$CompAdminID'";
         return $this->db->query($query)->row_array();
    }
        
    /*
     * Get all employees
     */
    function get_all_company_admins($where)
    {   

        $this->db->select('ca.*,c.CompName');
        $this->db->from('compadmins ca');
        $this->db->join('company c','ca.CompID = c.CompID','left');
        if($where!=""){
            if($Role == 2){
                $this->db->where('c.CompID',$this->session->userdata('company_id'));
            }

            if($Role == 3){
                $this->db->where('c.CompAdminID',$this->session->userdata('user_id'));
            }
            
        }
        return $this->db->get()->result_array();
    }
	

    /*
     * function to add new employee
     */
    function add_cadmin($params)
    {
        $this->db->insert('compadmins',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update employee
     */
    function update_company_admin($CompAdminID,$params)
    {
        $this->db->where('CompAdminID',$CompAdminID);
        return $this->db->update('compadmins',$params);
    }
    
    /*
     * function to delete employee
     */
    function delete_cadmin($CompAdminID)
    {
        return $this->db->delete('compadmins',array('CompAdminID'=>$CompAdminID));
    }

    
}
