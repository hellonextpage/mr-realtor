<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 include_once('application/libraries/swiftmailer/swift_required.php');
 
class Companies extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Companies_model');
      
        
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }
    } 

    /*
     * Listing of employees
     */
    function index()
    {
        $where = "";
        $Role = $this->session->userdata('Role');
        if($Role == 2 || $Role == 3){
            $where = $this->session->userdata('company_id');
        }           
        $data['companies']   = $this->Companies_model->get_all_companies($where);
        $data['_view'] = 'companies/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new employee
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('CompName','Company Name','required|max_length[35]|min_length[2]|is_unique[company.CompName]');
		$this->form_validation->set_rules('MobileNo','Mobile No','required|max_length[15]|integer|min_length[10]');
		$this->form_validation->set_rules('EmailID','Email Id','required');
        $this->form_validation->set_rules('Address','Address','required');
        
        
		if($this->form_validation->run())     
        {   

            $photo_path = '';

            $this->load->library('encryption');
           $slug = url_title($this->input->post('CompName'), 'dash', true);


            $params = array(
				
				'CompName'        => $this->input->post('CompName'),
				'MobileNo'      => $this->input->post('MobileNo'),
				'Phone_no'      => $this->input->post('Phone_no'),
				'EmailID'     => $this->input->post('EmailID'),
				'Website'        => $this->input->post('Website'),
				'Address'       => $this->input->post('Address'),
                'AboutCompany'       => $this->input->post('AboutCompany'),
				'CreatedOn'     => date('Y-m-d h:i:s'),
                'slug' => $slug
            );


            $this->db->trans_start();
            
            $id = $this->Companies_model->add_companay($params);
            
            $key = substr($this->input->post('CompName'), 0, 4).$id;//bin2hex($id.$this->input->post('CompName').$this->encryption->create_key(3));
            $this->db->where('CompID',$id);
            $this->db->update('company',array('unique_code'=>$key));
            $this->db->trans_complete();
            if($this->db->trans_status() == true){
                
                redirect('Companies/index');

            }else{
                
                $this->session->set_flashdata('error','Something went wrong plese try again.');
                redirect('Companies/index');
            }
            
        }
        else
        {            
            $data['_view'] = 'companies/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a employee
     */
    function edit($CompID)
    {   
        // check if the employee exists before trying to edit it
        $data['company'] = $this->Companies_model->get_company($CompID);
        
        if(isset($data['company']['CompID']))
        {
            $this->load->library('form_validation');
            if($this->input->post('CompName')!=$data['company']['CompName']){
                $is_unique = '|is_unique[company.CompName]';
            }else{
                $is_unique = '';
            }
            $this->form_validation->set_rules('CompName','Company Name','required|max_length[35]|min_length[2]'.$is_unique);
            $this->form_validation->set_rules('MobileNo','Mobile No','required|max_length[15]|integer|min_length[10]');
            $this->form_validation->set_rules('EmailID','Email Id','required');
            $this->form_validation->set_rules('Address','Address','required');

			if($this->form_validation->run())     
            {   
	$slug = url_title($this->input->post('CompName'), 'dash', true);
					$params = array(
					
                        'CompName'        => $this->input->post('CompName'),
                        'MobileNo'      => $this->input->post('MobileNo'),
                        'Phone_no'      => $this->input->post('Phone_no'),
                        'EmailID'     => $this->input->post('EmailID'),
                        'Website'        => $this->input->post('Website'),
                        'Address'       => $this->input->post('Address'),
                        'AboutCompany'       => $this->input->post('AboutCompany'),
                        'slug' => $slug
                        
					);
				

                $this->db->trans_start();
                $res = $this->Companies_model->update_comapany($CompID,$params); 
                if($this->input->post('CompName')!=$data['company']['CompName']){
                $key = substr($this->input->post('CompName'), 0, 4).$CompID;//bin2hex($id.$this->input->post('CompName').$this->encryption->create_key(3));
            $this->db->where('CompID',$CompID);
            $this->db->update('company',array('unique_code'=>$key));
        }
                 
                $this->db->trans_complete();
                if($this->db->trans_status()){

                    $this->db->trans_commit();
                    $this->session->set_flashdata('success','Company updated successfully');
                    redirect('Companies/index');

                }else{

                    $this->db->trans_roll_back();
                    $this->session->set_flashdata('error','Something went wrong plese try again.');
                    redirect('Companies/index');
                }
                
            }
            else
            {
                $data['_view'] = 'companies/edit';
              
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The employee you are trying to edit does not exist.');
    } 

    /*
     * Deleting employee
     */
    function remove($emp_id)
    {
        $employee = $this->Employee_model->get_employee($emp_id);

        // check if the employee exists before trying to delete it
        if(isset($employee['emp_id']))
        {
            $this->Employee_model->delete_employee($emp_id);
            redirect('employee/index');
        }
        else
            show_error('The employee you are trying to delete does not exist.');
    }



    function deactivate($CompID){
        
         $data['company'] = $this->Companies_model->get_company($emp_id);
        
        if(isset($data['company']['CompID']))
        {
            
           $res = $this->db->query("UPDATE  company SET IsActive = false WHERE CompID = '$CompID'");
            
             if($res){
            
                $this->session->set_flashdata('success','Company Deactivated Successfully');
                
            }else{
                
                $this->session->set_flashdata('error','Something went wrong please try again.');
            }
            
            redirect('Companies/index');
        }else{
            show_error('The employee you are trying to edit does not exist.');
        }
    }
    
    function activate($CompID){
        
        $data['company'] = $this->Companies_model->get_company($emp_id);
        
        if(isset($data['company']['CompID']))
        {
            
           $res = $this->db->query("UPDATE  company SET IsActive = true WHERE CompID = '$CompID'");
            
             if($res){
            
                $this->session->set_flashdata('success','Company Deactivated Successfully');
                
            }else{
                
                $this->session->set_flashdata('error','Something went wrong please try again.');
            }
            
            redirect('Companies/index');
        }else{
            show_error('The employee you are trying to edit does not exist.');
        }
    }
	
	
}
