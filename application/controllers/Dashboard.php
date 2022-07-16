<?php
 
 
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {

        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}
