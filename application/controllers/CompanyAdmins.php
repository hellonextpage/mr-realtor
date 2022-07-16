<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 include_once('application/libraries/swiftmailer/swift_required.php');
 
class CompanyAdmins extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Companies_admin_model');
        $this->load->model('Companies_model');
        $this->load->model('CompanyVentures_model');
        
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
                $where = $Role;
            }
           
        $data['company_admins'] = $this->Companies_admin_model->get_all_company_admins($where);

        $data['_view'] = 'company_admins/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new employee
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('Name','Name','required|max_length[35]|min_length[2]');
        if($this->session->userdata('Role')!=1){
            $this->form_validation->set_rules('CompID','Company','required');
        }
		
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

		$this->form_validation->set_rules('MobileNo','Mobile Number','required|max_length[15]|integer|min_length[10]');
        $this->form_validation->set_rules('EmailID','Email Id','required|valid_email|max_length[100]|is_unique[compadmins.EmailID]');

		if($this->form_validation->run())     
        {   

            if($this->session->userdata('Role') == 1){
                $role = 2;
            }else{
                $role = 3;
            }
            $params = array(
				
				'CompID'        => $this->input->post('CompID'),
				'Name'          => $this->input->post('Name'),
				'EmailID'       => $this->input->post('EmailID'),
				'MobileNo'      => $this->input->post('MobileNo'),
			/* 	'created_by'    => $this->session->userdata('user_id'), */
                'Password'=>$this->input->post('password'),
				'CreatedOn'     => date('Y-m-d h:i:s'),
                'Role'  => $role
				
            );


            $this->db->trans_start();
            
            $CompAdminID = $this->Companies_admin_model->add_cadmin($params);
        
            //$pass_cade = $this->generate_password();
            //$this->db->where('CompAdminID',$CompAdminID);
            //$this->db->update('compadmins', array( 'password' => $pass_cade));
            
            foreach($this->input->post('Ventures') as $v){
                $venturedata = array(
                    'user_id'=>$CompAdminID,
                    'comp_id'=>$this->input->post('CompID'),
                    'venture_id'=>$v
                );
                $this->db->insert('venture_mapping',$venturedata);
            }
            
            $this->db->trans_complete();
            if($this->db->trans_status() == true){
                
                		$emailTmplt = "<html><head>
				</head>
				<body>
				<h3>Mr Realtor</h3>
				<table style='padding:10px;width:100%;border:1px solid #ccc;'>
				<tr style='padding:30px;'><th>Employee Email </th><td>" . $EmailID . "</td></tr>
				<tr style='padding:30px;'><th>Password </th><td>" . $pass_cade . "</td></tr>
				
				
				</table>
				</body>
				</html>";
				$subject = "Welcome Mail From - Mr.Realtor";
				//$transport =  Swift_SmtpTransport::newInstance('smtp.zoho.com',465,'ssl')
			
				  //      ->setUsername('solutions@v2vpestcontrol.com')
				    //    ->setPassword('Solutions@123');

                $transport = Swift_MailTransport::newInstance();
				// Create the message
				$message = Swift_Message::newInstance();
				$message->setTo(array(
					$this->input->post('EmailID') => "Mr.Realtor"
					

				));
				$message->setSubject($subject);
				$message->setBody($emailTmplt,'text/html');
				$message->setFrom("admin@mrrealtor.com", "Mr.Realtor");

				// Send the email
				$mailer = Swift_Mailer::newInstance($transport);
				$mailer->send($message);	 


                $this->session->set_flashdata('success','Company ademin added successfully');
                redirect('CompanyAdmins/index');
            }else{
                
                $this->session->set_flashdata('error','Something went wrong plese try again.');
                redirect('CompanyAdmins/index');
            }
            
        }
        else
        { 
            $where = "";
            $Vwhere = "";
            $Role = $this->session->userdata('Role');
            if($Role == 2 || $Role == 3){
                $where = $this->session->userdata('company_id');
                $Vwhere = " where v.CompID=".$this->session->userdata('company_id');
            }           
            $data['companies']   = $this->Companies_model->get_all_companies($where);
            $data['all_ventures'] = $this->CompanyVentures_model->get_all_ventures($Vwhere);
            $data['_view'] = 'company_admins/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a employee
     */
    function edit($CompAdminID)
    {   


        $data['company_admin'] = $this->Companies_admin_model->get_company_admin($CompAdminID);
 
        if($data['company_admin']['EmailID'])
        {
            $this->load->library('form_validation');
            if($this->input->post('EmailID')!=$data['company_admin']['EmailID']){
                $is_unique = '|is_unique[compadmins.EmailID]';
            }else{
                $is_unique = '';
            }
            $this->form_validation->set_rules('Name','Name','required|max_length[35]|min_length[2]');
            if($this->session->userdata('Role')!=1){
                $this->form_validation->set_rules('CompID','Company','required');
            }
            $this->form_validation->set_rules('MobileNo','Mobile Number','required|max_length[15]|integer|min_length[10]');
            $this->form_validation->set_rules('EmailID','Email Id','required|valid_email|max_length[100]'.$is_unique);

            if($this->form_validation->run())     
            {   

					
                $params = array(
				
                    'CompID'        => $this->input->post('CompID'),
                    'Name'          => $this->input->post('Name'),
                    'EmailID'       => $this->input->post('EmailID'),
                    'MobileNo'      => $this->input->post('MobileNo'),
                    'CreatedOn'     => date('Y-m-d h:i:s'),
                    'Password'=>$this->input->post('password'),
                    
                );
	
                $this->db->trans_start();
                $res = $this->Companies_admin_model->update_company_admin($CompAdminID,$params); 
                 $this->db->where('user_id',$CompAdminID);
                 $this->db->delete('venture_mapping');
                foreach($this->input->post('Ventures') as $v){
                    $venturedata = array(
                        'user_id'=>$CompAdminID,
                        'comp_id'=>$this->input->post('CompID'),
                        'venture_id'=>$v
                    );
                    $this->db->insert('venture_mapping',$venturedata);
                }
                $this->db->trans_complete();
                if($this->db->trans_status()){

                    $this->db->trans_commit();
                    $this->session->set_flashdata('success','Company admin updated successfully');
                    redirect('CompanyAdmins/index');

                }else{

                    $this->db->trans_roll_back();
                    $this->session->set_flashdata('error','Something went wrong plese try again.');
                    redirect('CompanyAdmins/index');
                }
                
            }
            else
            {
                $data['_view'] = 'company_admins/edit';
                 $where = "";
                 $Vwhere = "";
            $Role = $this->session->userdata('Role');
            if($Role == 2 || $Role == 3){
                $where = $this->session->userdata('company_id');
                $Vwhere = " where v.CompID=".$this->session->userdata('company_id');
            }

            $selected_ventures = $this->db->query('select venture_id from venture_mapping where user_id='.$CompAdminID)->result_array();

            $data['companies']   = $this->Companies_model->get_all_companies($where);
            $data['all_ventures'] = $this->CompanyVentures_model->get_all_ventures($Vwhere);
            $data['selected_ventures']   = $selected_ventures;
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company admin you are trying to edit does not exist.');
    } 

    /*
     * Deleting employee
     */
    function remove($emp_id)
    {
        $data['cadmin'] = $this->Companies_admin_model->get_company_admin($CompAdminID);

        // check if the employee exists before trying to delete it
        if(isset($data['emp_id']))
        {
            $this->Employee_model->delete_employee($emp_id);
            redirect('employee/index');
        }
        else
            show_error('The employee you are trying to delete does not exist.');
    }


    
    function deactivate($CompAdminID){
        
         $data['cadmin'] = $this->Companies_admin_model->get_company_admin($CompAdminID);
        
        if(isset($data['cadmin']['CompAdminID']))
        {
            
           $res = $this->db->query("UPDATE  compadmins SET IsActive = false WHERE CompAdminID = '$CompAdminID'");
            
             if($res){
            
                $this->session->set_flashdata('success','Company Admin Deactivated Successfully');
                
            }else{
                
                $this->session->set_flashdata('error','Something went wrong please try again.');
            }
            
            redirect('CompanyAdmins/index');
        }else{
            show_error('The company admin you are trying to edit does not exist.');
        }
    }
    
    function activate($CompAdminID){
        
        $data['cadmin'] = $this->Companies_admin_model->get_company_admin($CompAdminID);
        
        if(isset($data['cadmin']['CompAdminID']))
        {
            
           $res = $this->db->query("UPDATE  compadmins SET IsActive = true WHERE CompAdminID = '$CompAdminID'");
            
             if($res){
            
                $this->session->set_flashdata('success','Company Admin Deactivated Successfully');
                
            }else{
                
                $this->session->set_flashdata('error','Something went wrong please try again.');
            }
            
            redirect('CompanyAdmins/index');
        }else{
            show_error('The company admin you are trying to edit does not exist.');
        }
    }
	
}
