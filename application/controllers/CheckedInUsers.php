<?php
 
 
class CheckedInUsers extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CheckedInUsers_model');
        
         if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

    } 

    /*
     * Listing of products
     */
    function index()
    {
        $where = "";
        $Role = $this->session->userdata('Role');
        if($Role == 2 || $Role == 3){
            $where = " where c.CompID=".$this->session->userdata('company_id');
        }
        $data['users_list'] = $this->CheckedInUsers_model->get_all_checkins($where);
        
        $data['_view'] = 'checked_in_users/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new product
     */
    function add()
    {   
        $this->load->library('form_validation');

		//$this->form_validation->set_rules('product_name','Product Name','required|max_length[100]|min_length[3]');
		$this->form_validation->set_rules('kva_rating_code','Kva Rating ','required');
		$this->form_validation->set_rules('model_no','Model No','required');
		$this->form_validation->set_rules('engine_make_cod','Engine Make','required');
		$this->form_validation->set_rules('phase_code','Phase ','required');
		$this->form_validation->set_rules('panel_type_code','Panel Type ','required');
        
		//$this->form_validation->set_rules('team_price','Team Price','required');
		$this->form_validation->set_rules('list_price','List Price','required');
		$this->form_validation->set_rules('scope_content','Product Scope','required');
		$this->form_validation->set_rules('description','Description','required');
	
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'product_name'      => $this->input->post('kva_rating_code')."".$this->input->post('model_no'),
				'kva_rating_code'   => $this->input->post('kva_rating_code'),
				'model_no'          => $this->input->post('model_no'),
				'engine_make_cod'   => $this->input->post('engine_make_cod'),
				'phase_code'        => $this->input->post('phase_code'),
				'panel_type_code'   => $this->input->post('panel_type_code'),
                
                'list_price'        => $this->input->post('list_price'),
                'scope_content'     => $this->input->post('scope_content'),
                'description'     => $this->input->post('description')
            );
            
            $product_id = $this->Product_model->add_product($params);
             if($product_id != null && $product_id != 'undefined' && $product_id != '' ){

                $this->session->set_flashdata('success','Product added successfully');
                redirect('Product/index');
            }else{
                
                $this->session->set_flashdata('error','Something went wrong plese try again.');
                redirect('Product/index');
            }
            
        }
        else
        {            
            $data['_view'] = 'product/add';
            $data['kva_ratings']    = $this->Dropdown_model->get_all_list_by_name('kva_rating');
            $data['model_nos']      = $this->Dropdown_model->get_all_list_by_name('models');
            $data['engines']        = $this->Dropdown_model->get_all_list_by_name('engine');
            $data['phases']         = $this->Dropdown_model->get_all_list_by_name('phase');
            $data['panels']         = $this->Dropdown_model->get_all_list_by_name('panels');
            $data['trolleys']       = $this->Dropdown_model->get_all_list_by_name('trolleys');
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a product
     */
    function edit($product_id)
    {   
        // check if the product exists before trying to edit it
        $data['product'] = $this->Product_model->get_product($product_id);
        
        if(isset($data['product']['product_id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('kva_rating_code','Kva Rating Code','required');
			$this->form_validation->set_rules('model_no','Model No','required');
			$this->form_validation->set_rules('engine_make_cod','Engine Make Cod','required');
			$this->form_validation->set_rules('phase_code','Phase Code','required');
            $this->form_validation->set_rules('panel_type_code','Panel Type Code','required');
            
		    //$this->form_validation->set_rules('team_price','Team Price','required');
		    $this->form_validation->set_rules('list_price','List Price','required');
		    $this->form_validation->set_rules('scope_content','Product Scope','required');
		    $this->form_validation->set_rules('description','Description','required');
			
			if($this->form_validation->run())     
            {   
                $params = array(
					'product_name' => $this->input->post('product_name'),
					'kva_rating_code' => $this->input->post('kva_rating_code'),
					'model_no' => $this->input->post('model_no'),
					'engine_make_cod' => $this->input->post('engine_make_cod'),
					'phase_code' => $this->input->post('phase_code'),
					'panel_type_code' => $this->input->post('panel_type_code'),
					
                    'list_price'        => $this->input->post('list_price'),
                    'scope_content'     => $this->input->post('scope_content'),
                    'description'     => $this->input->post('description')
                );

                $res = $this->Product_model->update_product($product_id,$params);    
                
                if($res){

                    $this->session->set_flashdata('success','Product updated successfully');
                    redirect('Product/index');
                }else{
                    
                    $this->session->set_flashdata('error','Something went wrong plese try again.');
                    redirect('Product/index');
                }
                
            }
            else
            {
                $data['_view'] = 'product/edit';
                $data['kva_ratings']    = $this->Dropdown_model->get_all_list_by_name('kva_rating');
                $data['model_nos']      = $this->Dropdown_model->get_all_list_by_name('models');
                $data['engines']        = $this->Dropdown_model->get_all_list_by_name('engine');
                $data['phases']         = $this->Dropdown_model->get_all_list_by_name('phase');
                $data['panels']         = $this->Dropdown_model->get_all_list_by_name('panels');
                $data['trolleys']       = $this->Dropdown_model->get_all_list_by_name('trolleys');
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The product you are trying to edit does not exist.');
    } 

    /*
     * Deleting product
     */
    function remove($product_id)
    {
        $product = $this->Product_model->get_product($product_id);

        // check if the product exists before trying to delete it
        if(isset($product['product_id']))
        {
            $this->Product_model->delete_product($product_id);
            redirect('product/index');
        }
        else
            show_error('The product you are trying to delete does not exist.');
    }
    
}
