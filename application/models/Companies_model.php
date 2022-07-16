<?php
 
 
class Companies_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get employee by emp_id
     */
    function get_company($CompID)
    {
        
         $query = " SELECT c .* FROM company c";
         return $this->db->query($query)->row_array();
    }
        
    /*
     * Get all employees
     */
    function get_all_companies($where)
    { 
        $this->db->select('*');
        $this->db->from('company');
        if($where!=""){
            $this->db->where('CompID',$where);
        }  
        return $this->db->get()->result_array();
    }
	

    /*
     * function to add new employee
     */
    function add_companay($params)
    {
        $this->db->insert('company',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update employee
     */
    function update_comapany($CompID,$params)
    {
        $this->db->where('CompID',$CompID);
        return $this->db->update('company',$params);
    }
    
    /*
     * function to delete employee
     */
    function delete_employee($emp_id)
    {
        return $this->db->delete('employees',array('emp_id'=>$emp_id));
    }

    function update_emp_code($emp_id,$desig_id){


        $code = "";
        
        if($desig_id == EXECUTIVE_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'ME'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'ME'))->row_array();
            $code = "ME00".$result['value'];
        }else if($desig_id == TEAM_LEAD_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'ML'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'ML'))->row_array();
            $code = "MTL00".$result['value'];
        }else if($desig_id == MANAGER_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'MM'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'MM'))->row_array();
            $code = "MM00".$result['value'];
        }else if($desig_id == REGIONAL_MANAGER_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'RM'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'RM'))->row_array();
            $code = "RM00".$result['value'];
        }else if($desig_id == SUB_ADMIN_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'SA'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'SA'))->row_array();
            $code = "SA00".$result['value'];
        }else if($desig_id == ADMIN_DESIGNATION_ID){

            $update_query = "UPDATE `emp_code_tracking` SET `value` = `value` +1 WHERE `key` = 'AD'";
            $this->db->query($update_query);
            $result = $this->db->get_where('emp_code_tracking', array('key' => 'AD'))->row_array();
            $code = "AD00".$result['value'];
        }

        $res = $this->update_employee($emp_id, array('emp_code' => $code));

        return $code;
        
    }

    function check_login($emp_code,$password){

        $res =  $this->db->get_where('vw_employees', array('emp_code' => $emp_code, 'password' => $password))->result_array();
        
        if(sizeof($res) > 0 ){

            return $res[0];
        }else{

            return $res;
        }
       
    }

    function get_unmapped_locations(){
        
        $query = "SELECT av.*,s.short_name FROM `areas_view` av 
                  LEFT JOIN cities c ON av.city_id = c.city_id
                  LEFT JOIN states s ON c.state_id = s.state_id  
                  WHERE area_id NOT IN (SELECT area_id FROM `emp_location_mapping` GROUP BY area_id)";
        return $this->db->query($query)->result_array();
    }

    function get_unmapped_executives(){
        
        $desig_id = EXECUTIVE_DESIGNATION_ID;
        $query = "SELECT * FROM `employees` WHERE desig_id = '$desig_id' AND emp_id  NOT IN (SELECT exctv_id FROM `emp_location_mapping` WHERE exctv_id != 0 GROUP BY exctv_id) AND is_active = true";
        return $this->db->query($query)->result_array();
    }

    function get_all_locations(){
        
        $query = "SELECT av.*,s.short_name FROM `areas_view` av 
                  LEFT JOIN cities c ON av.city_id = c.city_id
                  LEFT JOIN states s ON c.state_id = s.state_id";
        return $this->db->query($query)->result_array();
    }

    function get_all_executives(){
        
        $desig_id = EXECUTIVE_DESIGNATION_ID;
        $query = "SELECT * FROM `employees` WHERE desig_id = '$desig_id'";
        return $this->db->query($query)->result_array();
    }
    function get_employees_with_desig($desig_id){

        return $this->db->get_where('employees', array('desig_id' => $desig_id,'is_active' => true))->result_array();
    }
    
    function get_all_groups(){
        
        
        $emp_query   = "SELECT elm.tl_id,elm.exctv_id,elm.manager_id FROM `emp_location_mapping` elm";
        
        $exctv_list_query  = $emp_query." WHERE elm.exctv_id != 0 GROUP BY elm.exctv_id";
        $tl_list_query    = $emp_query." WHERE elm.exctv_id = 0 AND tl_id != 0 GROUP BY elm.tl_id";
        //$manager_list_query    = $emp_query." WHERE elm.exctv_id = 0 AND elm.tl_id = 0 GROUP BY elm.manager_id";
        
        /* $exctv_list_query  = $emp_query." LEFT JOIN employees e ON elm.exctv_id = e.emp_id  WHERE elm.exctv_id != 0 AND e.is_active =true GROUP BY elm.exctv_id";
        $tl_list_query    = $emp_query." LEFT JOIN employees e ON elm.tl_id = e.emp_id  WHERE elm.exctv_id = 0  AND e.is_active =true GROUP BY elm.tl_id ";
        $manager_list_query    = $emp_query."  LEFT JOIN employees e ON elm.manager_id = e.emp_id 
                                 WHERE elm.exctv_id = 0 AND elm.tl_id = 0 AND e.is_active =true GROUP BY elm.manager_id"; */
  
        
        $exctv_list = $this->db->query($exctv_list_query)->result_array();
        $tl_list    = $this->db->query($tl_list_query)->result_array();
        //$manager_list    = $this->db->query($manager_list_query)->result_array();
        
        foreach($exctv_list as $key => $exctv){
                
            $exctv_id = $exctv['exctv_id'];
            $earea_query = "SELECT GROUP_CONCAT(res.area_name) as areas,GROUP_CONCAT(res.area_id) as area_ids , res.* FROM ( 
                    SELECT elp.*,ee.emp_name as exctv_name , et.emp_name as tl_name , 
                    em.emp_name as manager_name, a.area_name  FROM `emp_location_mapping` elp 
                    LEFT JOIN employees ee ON elp.exctv_id = ee.emp_id 
                    LEFT JOIN employees et ON elp.tl_id = et.emp_id 
                    LEFT JOIN employees em ON elp.manager_id = em.emp_id
                    LEFT JOIN areas a ON elp.area_id = a.area_id WHERE elp.exctv_id = '$exctv_id' 
                    
                    ORDER by a.area_name ) as res";
            
            $ex_areas = $this->db->query($earea_query)->row_array();
			
			$eoarea_query = "SELECT GROUP_CONCAT(res.area_name) as areas,GROUP_CONCAT(res.area_id) as area_ids , res.* FROM ( 
								SELECT eop.*,ee.emp_name as exctv_name ,a.area_name  FROM `emp_other_locations` eop 
								LEFT JOIN employees ee ON eop.emp_id = ee.emp_id 
								LEFT JOIN areas a ON eop.area_id = a.area_id 
								WHERE eop.emp_id = '$exctv_id' 
								ORDER by a.area_name ) as res";
            
            $ex_other_areas = $this->db->query($eoarea_query)->row_array();
            
            $exctv_list[$key]['areas'] = $ex_areas['areas'];
            $exctv_list[$key]['area_ids'] = $ex_areas['area_ids'];
            $exctv_list[$key]['exctv_name'] = $ex_areas['exctv_name'];
            $exctv_list[$key]['tl_name'] = $ex_areas['tl_name'];
            $exctv_list[$key]['manager_name'] = $ex_areas['manager_name'];
			
			$exctv_list[$key]['other_areas'] = $ex_other_areas['areas'];
            $exctv_list[$key]['other_area_ids'] = $ex_other_areas['area_ids'];
            
        }
        
        
        foreach($tl_list as $key => $tl){
                
            $tl_id = $tl['tl_id'];
            $tlarea_query = "SELECT GROUP_CONCAT(res.area_name) as areas,GROUP_CONCAT(res.area_id) as area_ids , res.* FROM ( 
                    SELECT elp.*,ee.emp_name as exctv_name , et.emp_name as tl_name , 
                    em.emp_name as manager_name, a.area_name  FROM `emp_location_mapping` elp 
                    LEFT JOIN employees ee ON elp.exctv_id = ee.emp_id 
                    LEFT JOIN employees et ON elp.tl_id = et.emp_id 
                    LEFT JOIN employees em ON elp.manager_id = em.emp_id
                    LEFT JOIN areas a ON elp.area_id = a.area_id WHERE elp.tl_id = '$tl_id' and elp.exctv_id = 0 ORDER by a.area_name ) as res";
            
            $tl_areas = $this->db->query($tlarea_query)->row_array();
			
			
			 $tlo_area_query = "SELECT GROUP_CONCAT(res.area_name) as areas,GROUP_CONCAT(res.area_id) as area_ids , res.* FROM ( 
                    SELECT eop.*,ee.emp_name as tl_name ,a.area_name  FROM `emp_other_locations` eop 
                    LEFT JOIN employees ee ON eop.emp_id = ee.emp_id 
                   
                    LEFT JOIN areas a ON eop.area_id = a.area_id 
					WHERE eop.emp_id = '$tl_id' ORDER by a.area_name ) as res";
            
            $tl_other_areas = $this->db->query($tlo_area_query)->row_array();
            
            $tl_list[$key]['areas']         = $tl_areas['areas'];
            $tl_list[$key]['area_ids']      = $tl_areas['area_ids'];
            $tl_list[$key]['exctv_name']    = $tl_areas['exctv_name'];
            $tl_list[$key]['tl_name']       = $tl_areas['tl_name'];
            $tl_list[$key]['manager_name']  = $tl_areas['manager_name'];
			
			$tl_list[$key]['other_areas']      = $tl_other_areas['areas'];
            $tl_list[$key]['other_area_ids']   = $tl_other_areas['area_ids'];
        }
        
        /* foreach($manager_list as $key => $manger){
            
            $manger_id = $manger['manager_id'];
            $marea_query = "SELECT GROUP_CONCAT(res.area_name) as areas,GROUP_CONCAT(res.area_id) as area_ids , res.* FROM ( 
                    SELECT elp.*,ee.emp_name as exctv_name , et.emp_name as tl_name , 
                    em.emp_name as manager_name, a.area_name  FROM `emp_location_mapping` elp 
                    LEFT JOIN employees ee ON elp.exctv_id = ee.emp_id 
                    LEFT JOIN employees et ON elp.tl_id = et.emp_id 
                    LEFT JOIN employees em ON elp.manager_id = em.emp_id
                    LEFT JOIN areas a ON elp.area_id = a.area_id WHERE elp.manager_id = '$manger_id' ORDER by a.area_name ) as res";
            
            $manager_areas = $this->db->query($marea_query)->row_array();
            
            $manager_list[$key]['areas']         = $manager_areas['areas'];
            $manager_list[$key]['area_ids']      = $manager_areas['area_ids'];
            $manager_list[$key]['exctv_name']    = $manager_areas['exctv_name'];
            $manager_list[$key]['tl_name']       = $manager_areas['tl_name'];
            $manager_list[$key]['manager_name']  = $manager_areas['manager_name'];
            
        } */

        

       /* $exctv_query = $query." WHERE res.exctv_id != 0 GROUP BY res.exctv_id";
        $tl_query    = $query." WHERE res.exctv_id = 0 GROUP BY res.tl_id";

        $exctv_group = $this->db->query($exctv_query)->result_array();
        $tl_group    = $this->db->query($tl_query)->result_array(); */

        
        //print_r( $tl_list);
          //return  array_merge($tl_list,$exctv_list,$manager_list);
		
         return  array_merge($tl_list,$exctv_list);

    }

    function get_user_highers($emp_id, $desig_id){

        $data = [];
        if($desig_id == 4){

            $this->db->group_by('tl_id');
            $this->db->limit(1);
            $res = $this->db->get_where('emp_location_mapping', array('tl_id' => $emp_id))->row_array();

            $data['exctv_id']      = 0;
            $data['tl_id']          = $emp_id;
             if(sizeof($res) >0){
                
                $data['manager_id']     = $res['manager_id'];
                
            }else{
                
                
                $data['manager_id']     = 0;
            }

        }else if($desig_id == 5){

            $this->db->group_by('exctv_id');
            $this->db->limit(1);
            $res = $this->db->get_where('emp_location_mapping', array('exctv_id' => $emp_id))->row_array();
 

            $data['exctv_id']      = $emp_id;
            if(sizeof($res) >0){
                $data['tl_id']          = $res['tl_id'];
				$data['manager_id']     = $res['manager_id'];
                
            }else{
                
                $data['tl_id']          = 0;
                $data['manager_id']     = 0;
            }
        }else if($desig_id == 3){

            $data['exctv_id']      = 0;
            $data['tl_id']          = 0;
            $data['manager_id']     = $emp_id;
        }

        return $data;
    }

    function get_area_det($area_id){

        $query = "SELECT a.*,s.state_id FROM `areas` a LEFT JOIN cities c ON a.city_id = c.city_id LEFT JOIN states s ON c.state_id = s.state_id WHERE area_id = ".$area_id;
        return $this->db->query($query)->row_array();
    }

    function get_areas_by_employee($emp_id,$desig_id){
        
        $cmn_where = " AND ll.created_by = '$emp_id'";
        $query = "SELECT  res.* FROM ( SELECT elp.*, a.area_name,c.city_name,s.state_name ,s.intrnl_trnprt_prsntg as discount,s.max_discount as max_discount,
                                       (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('opi','opq') AND ll.audit_status = 'aprvd' ".$cmn_where.") as cct_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('ope','ng','efv') ".$cmn_where." ) as ems_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('or','pr','ofv','od','dlrvd') ".$cmn_where." ) as orders_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('drpd','edrpd') ".$cmn_where.") as dropped_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('loss','eloss') ".$cmn_where." ) as loss_leads_count,
                                         (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('oclpt') ".$cmn_where.") as completed_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.assigned_to = '$emp_id' ) as assigned_leads_count
                                       FROM `emp_location_mapping` elp 
                                       LEFT JOIN areas a ON elp.area_id = a.area_id 
                                       LEFT JOIN cities c ON a.city_id =  c.city_id
                                       LEFT JOIN states s ON c.state_id = s.state_id) AS res";
        
        if($desig_id == EXECUTIVE_DESIGNATION_ID){

            $query .=" WHERE res.exctv_id != 0 AND res.exctv_id = '$emp_id'";

        }else if ($desig_id == TEAM_LEAD_DESIGNATION_ID){

            $query .=" WHERE res.tl_id = '$emp_id'";

        }else if($desig_id == MANAGER_DESIGNATION_ID){

            $query .=" WHERE  res.manager_id = '$emp_id'";

        }

        return $this->db->query($query)->result_array();
    }
    
    
    function get_other_areas_by_employee($emp_id,$desig_id){
        
        $cmn_where = " AND ll.created_by = '$emp_id'";
        $extve = EXECUTIVE_DESIGNATION_ID;
        $tl = TEAM_LEAD_DESIGNATION_ID;
        $manager = MANAGER_DESIGNATION_ID;
        $query = "SELECT  res.*,IFNULL(asgn.asgn_emp_id,'') AS asgn_emp_id,IF($desig_id = '$extve' ,'$emp_id',0) as exctv_id,
                  IF($desig_id = '$tl','$emp_id',0) as tl_id,
                  IF($desig_id = '$manager','$emp_id',0) as manger_id,
                  IFNULL(e.emp_name,'') as asgn_emp_name FROM ( SELECT elp.area_id,elp.emp_id, a.area_name,c.city_name,s.state_name ,s.intrnl_trnprt_prsntg as discount,s.max_discount as max_discount,
                                       (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('opi','opq') AND ll.audit_status = 'aprvd' ".$cmn_where.") as cct_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('ope','ng','efv') ".$cmn_where." ) as ems_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('or','pr','ofv','od','dlrvd') ".$cmn_where." ) as orders_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('drpd','edrpd') ".$cmn_where.") as dropped_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('loss','eloss') ".$cmn_where." ) as loss_leads_count,
                                         (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.lead_status IN('oclpt') ".$cmn_where.") as completed_leads_count,
                                        (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                            WHERE elp.area_id = ll.area_id AND ll.assigned_to = '$emp_id' ) as assigned_leads_count
                                       FROM `emp_other_locations` elp 
                                       LEFT JOIN areas a ON elp.area_id = a.area_id 
                                       LEFT JOIN cities c ON a.city_id =  c.city_id
                                       LEFT JOIN states s ON c.state_id = s.state_id) AS res 
                                       LEFT JOIN (SELECT area_id, IF ((exctv_id = NULL OR exctv_id = 0),`tl_id`,`exctv_id`)  as asgn_emp_id 
                                       FROM `emp_location_mapping`) AS asgn on res.area_id = asgn.area_id
                                       LEFT JOIN employees e on asgn.asgn_emp_id = e.emp_id
                                       WHERE res.emp_id = '$emp_id'";
        
       

        return $this->db->query($query)->result_array();
    }
    
    function get_cities_by_emoployee($emp_id){
        
        
        $cities = $this->db->query("SELECT ecm.city_id,c.city_name FROM `emp_city_mapping` ecm 
                                    LEFT JOIN cities c on c.city_id = ecm.city_id WHERE emp_id = '$emp_id'")->result_array();
        
        //print_r($cities);
        foreach($cities as $key => $city){
        
            $city_id = $city['city_id'];
            $cmn_where = " AND ll.created_by = '$emp_id'";
            
            $query = " SELECT res.*, asgn.asgn_emp_id, e.emp_name as asgn_emp_name,$emp_id as manager_id
                      FROM (SELECT a.*,c.city_name,s.state_name ,s.intrnl_trnprt_prsntg as discount,s.max_discount as max_discount,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('opi','opq') AND ll.audit_status = 'aprvd' ".$cmn_where.") as cct_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('ope','ng','efv') ".$cmn_where." ) as ems_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('or','pr','ofv','od','dlrvd') ".$cmn_where." ) as orders_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('drpd','edrpd') ".$cmn_where.") as dropped_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('loss','eloss') ".$cmn_where." ) as loss_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.lead_status IN('oclpt') ".$cmn_where." ) as completed_leads_count,
                            (SELECT COUNT(*) as lead_count FROM leads_list ll 
                                WHERE a.area_id = ll.area_id AND ll.assigned_to = '$emp_id') as assigned_leads_count
                        FROM areas a 
                        LEFT JOIN cities c ON a.city_id =  c.city_id
                        LEFT JOIN states s ON c.state_id = s.state_id
                        WHERE a.is_active = true 
                        AND a.city_id ='$city_id') AS res 
                            LEFT JOIN (SELECT area_id, IF ((exctv_id = NULL OR exctv_id = 0),`tl_id`,`exctv_id`)  as asgn_emp_id 
                            FROM `emp_location_mapping`) AS asgn on res.area_id = asgn.area_id
                            LEFT JOIN employees e on asgn.asgn_emp_id = e.emp_id";
                        
            $cities[$key]['areas'] = $this->db->query($query)->result_array();
                        
        }
        
      // print_r($cities);
       return $cities;
        
    }


    function add_assignment($params)
    {
        $this->db->insert('assignments',$params);
        return $this->db->insert_id();
    }

    function get_myassignments($emp_id,$emp_desig){

        $query = "SELECT asg.* ,ea.exctv_id,ea.tl_id,ea.manager_id, a.area_name,s.state_name,s.intrnl_trnprt_prsntg as discount,s.max_discount as max_discount
				 FROM assignments asg
				 
                 LEFT JOIN emp_location_mapping ea ON ea.area_id = asg.area_id
                 LEFT JOIN areas a ON a.area_id = asg.area_id
				 LEFT JOIN cities c ON a.city_id = c.city_id
				 LEFT JOIN states s ON c.state_id = s.state_id
                 WHERE asg.dest_prsn_id = '$emp_id'";

        /* if($emp_desig == MANAGER_DESIGNATION_ID){

            $query .=" WHERE manager_id = '$emp_id'"; 

        }
        if($emp_desig == TEAM_LEAD_DESIGNATION_ID){

            $query .=" WHERE tl_id = '$emp_id'"; 

        }
        if($emp_desig == EXECUTIVE_DESIGNATION_ID){

            $query .=" WHERE exctv_id = '$emp_id'"; 

        } */

        return $this->db->query($query)->result_array();

    }

    function get_assigned_assignments($assigned_by){

        //return $this->db->get_where('assignments', array('asgn_by' => $assigned_by))->result_array();
        
        $query = " SELECT asg.*,a.area_name FROM  assignments asg LEFT JOIN areas a ON a.area_id = asg.area_id WHERE asgn_by = '$assigned_by' ";
        
        return $this->db->query($query)->result_array();
    }
    
    function get_areas_by_emp(){
        
        $emp_id = $this->session->userdata('user_id');
        
        $query = " SELECT * FROM areas WHERE city_id IN (SELECT city_id FROM emp_city_mapping WHERE emp_id = '$emp_id') AND is_active = true";
        if($this->session->userdata('user_id') == ADMIN_DESIGNATION_ID ){
            
            $query = " SELECT * FROM areas WHERE  is_active = true";
        }
        return $this->db->query($query)->result_array();
    }
}
