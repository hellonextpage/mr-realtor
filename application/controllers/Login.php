<?php
 
 
class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    } 

    function index(){


        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            $data['_view'] = 'login';
            $this->load->view('layouts/main_before_login',$data);
        }else{

            redirect('CompanyVentures/index');
        }

        
    }

    function checkLogin(){

            $this->db->where(array('EmailId'   => $this->input->post('email'),
                                   'Passsword'   => $this->input->post('password')));
            $res = $this->db->get('admins')->row_array();
            if(sizeof($res) > 0){

                $this->session->set_userdata('isLoggedIn','yes');
                $this->session->set_userdata('user_id',$res['admin_id']);
               
                $this->session->set_userdata('EmailId',$res['EmailId']);
           
                $this->session->set_flashdata('success','LoggedIn successfully');
                redirect('CompanyVentures/index');

            }else{
                
                $this->session->set_flashdata('error','Email / Password incorrect .');
                redirect('Login');
            }
      
    }


    function checkCompanyLogin(){

            $this->db->where(array('EmailId'   => $this->input->post('email'),
                                   'Password'   => $this->input->post('password')));
            $res = $this->db->get('compadmins')->row_array();
            if(sizeof($res) > 0){

                $this->session->set_userdata('isLoggedIn','yes');
                $this->session->set_userdata('user_id',$res['CompAdminID']);

                $this->session->set_userdata('EmailId',$res['EmailID']);
                $this->session->set_userdata('Role',$res['Role']);
                $this->session->set_userdata('company_id',$res['CompID']);
           
                $this->session->set_flashdata('success','LoggedIn successfully');
                
                redirect('CompanyVentures/index');

            }else{
                
                $this->session->set_flashdata('error','Email / Password incorrect .');
                redirect('Login');
            }
      
    }

    function logOut(){

        $this->session->sess_destroy();
        redirect('Login');

    }
}