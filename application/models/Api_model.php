<?php
 
 
class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function check_user($CompID,$Passsword,$EmailID){

        return $this->db->get_where('compadmins',array('CompID' => $CompID,'Password' => $Passsword,'EmailID' => $EmailID))->row_array();
    }

    
    function get_all_ventures_by_company($CompID,$status='')
    {
        
        $statusquery = "";
        if($status!=""){
            $statusquery = "and v.VentureStatus='$status'";
        }
        $query = "SELECT v.*,DATE_FORMAT(v.CreatedOn,'%d-%m-%Y') as CreatedDate,c.AboutCompany,c.slug,c.CompName,z.ZoneName ,
                 (SELECT count(*) FROM `venture_plots` WHERE  v.VentureID = VentureID) as Total_plots ,
                 (SELECT count(*) FROM `venture_plots` WHERE `IsAvailable` = 'A' and v.VentureID = VentureID) as Available_plots ,
                 (SELECT count(*) FROM `venture_plots` WHERE (`IsAvailable` = 'NA' OR `IsAvailable` = 'P'  ) and v.VentureID = VentureID) as Registered_plots 
                  FROM ventureslist  v
                  LEFT JOIN company c ON v.CompID = c.CompID
                  LEFT JOIN zones z on z.ZoneID = v.ZoneID
                  WHERE c.slug = '$CompID' or c.unique_code='$CompID' ".$statusquery."  order by v.VentureSequence";
        
        return $this->db->query($query)->result_array();
    }

    function change_plot_availability($VentureID,$PlotNo,$Status){


        $this->db->where(array('VentureID' => $VentureID,'PlotNo' =>$PlotNo));
        return $this->db->update('venture_plots',array('IsAvailable' => $Status));
    }

    function change_company_admin_password($CompAdminID,$newPassword){

            $this->db->where('CompAdminID',$CompAdminID);
            return $this->db->update('compadmins',array('Password' => $newPassword));
    }

    function get_venture($VentureID){

        $query = "SELECT v.*,c.CompName,z.ZoneName FROM ventureslist v
                  LEFT JOIN company c ON v.CompID = c.CompID
                  LEFT JOIN zones z on z.ZoneID = v.ZoneID 
                  WHERE v.VentureID = '$VentureID' ";
        
        return $this->db->query($query)->row_array();
    }
    function get_venture_plots($VentureID){

        $query = "SELECT v.*,f.facingName,pt.ptype_name FROM venture_plots v
                    LEFT JOIN plot_type pt ON pt.ptype_id = v.ptype_id
                    LEFT JOIN facings f ON f.facingID = v.Facing
                    WHERE v.VentureID = '$VentureID' 
                    AND v.ptype_id = 2 ";        
        return $this->db->query($query)->result_array();
    }

    function get_venture_images($VentureID){
        return $this->db->get_where('venture_images',array('VentureID' => $VentureID))->result_array();
    }

    function checkin_user($CompID,$MobileNo,$Name,$IsAgentOrCust){

        $check_exist = $this->db->get_where('check_in_users',array('MobileNo' => $MobileNo,
                                                                   'CompID' => $CompID))->row_array();
        if(sizeof($check_exist) > 0){
            $this->db->where('checkInId',$check_exist['checkInId']);
            return $this->db->update('check_in_users',array('LastCheckedInOn' => date('Y-m-d h:i:s')));
        }else{
            return $this->db->insert('check_in_users',array('LastCheckedInOn'  => date('Y-m-d h:i:s'),
                                                            'CompID'           => $CompID,
                                                            'MobileNo'         => $MobileNo,
                                                            'Name'             => $Name,
                                                            'IsAgentOrCust'    => $IsAgentOrCust));
        }
    }

    function save_enquiry($params){
        return $this->db->insert('plot_enqueries',$params);
    }

}