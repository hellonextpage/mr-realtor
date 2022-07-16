<?php
 
 
class CompanyVentures extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CompanyVentures_model');
        $this->load->model('Api_model');
        /*  if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        } */

    } 

    /*
     * Listing of products
     */
    function index()
    {
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }
        $where = "";
        $Role = $this->session->userdata('Role');
        if($Role == 2 || $Role == 3){
            $where = " where v.CompID=".$this->session->userdata('company_id');
        }
        $data['all_ventures'] = $this->CompanyVentures_model->get_all_ventures($where);

        $data['_view'] = 'ventures/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new product
     */
    function add()
    {
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }   
        $this->load->library('form_validation');

		//$this->form_validation->set_rules('product_name','Product Name','required|max_length[100]|min_length[3]');
		$this->form_validation->set_rules('CompID','Company','required');
		$this->form_validation->set_rules('VentureName','Venture Name','required|is_unique[ventureslist.VentureName]');
		$this->form_validation->set_rules('ZoneID','City/Zone','required');
		$this->form_validation->set_rules('AboutVenture','About Venture ','required');
		$this->form_validation->set_rules('Latitude','Latitude ','required');
        $this->form_validation->set_rules('VentureSequence','VentureSequence ','required|is_unique[ventureslist.VentureSequence]');
        
		//$this->form_validation->set_rules('team_price','Team Price','required');
		$this->form_validation->set_rules('Longitude','Longitude','required');
	   $this->form_validation->set_rules('photo_path', 'Image', 'required');

	
		
		if($this->form_validation->run())     
        {   

            $photo_path = '';

            if($_FILES['photo_path']['name'] != ''){

                $uploads_dir  = 'uploads/ventures/';

                $tmp_name = $_FILES["photo_path"]["tmp_name"];
                $name = time().$_FILES["photo_path"]["name"];
                $target = $uploads_dir.$name;
        
                if (move_uploaded_file($tmp_name, $target)) {
                    $photo_path = $target;
                }
            }

            if($_FILES['brochure']['name'] != ''){

                $uploads_dir  = 'uploads/ventures/';

                $tmp_name = $_FILES["brochure"]["tmp_name"];
                $brochure = time().$_FILES["brochure"]["name"];
                $target = $uploads_dir.$brochure;
        
                if (move_uploaded_file($tmp_name, $target)) {
                    //$brochure = $target;
                }
            }

            

            $slug = url_title($this->input->post('VentureName'), 'dash', true);
            $params = array(
				'CompID'            => $this->input->post('CompID'),
				'VentureName'       => $this->input->post('VentureName'),
				'ZoneID'            => $this->input->post('ZoneID'),
				'AboutVenture'      => $this->input->post('AboutVenture'),
                'highlights'      => $this->input->post('highlights'),
                'statement_area'      => $this->input->post('statement_area'),
				'Latitude'          => $this->input->post('Latitude'),
                'Longitude'         => $this->input->post('Longitude'),
                'VentureStatus'     => $this->input->post('VentureStatus'),
                'CreatedOn'        => date('Y-m-d h:i:s'),
                'VentureLogo'       => $photo_path,
                'location'       => $this->input->post('venture_location'),
                'brochure'       => $brochure,
                'venture_slug'     => $slug,
                'VentureSequence'     => $this->input->post('VentureSequence'),
            );
            
            $VentureID = $this->CompanyVentures_model->add_venture($params);

            if($VentureID != null && $VentureID != 'undefined' && $VentureID != '' ){

                $this->session->set_flashdata('success','Venture added successfully');
                redirect('CompanyVentures/index');

            }else{
                
                $this->session->set_flashdata('error','Something went wrong plese try again.');
                redirect('CompanyVentures/index');
            }
        }
        else
        {            
            $data['_view']         = 'ventures/add';
            $Role = $this->session->userdata('Role');
            
            $this->db->select('*');
            $this->db->from('company');
            if($Role == 2 || $Role == 3){
                $this->db->where('CompID',$this->session->userdata('company_id'));
            } 
            $companies = $this->db->get()->result_array();
            $data['companies']    = $companies;
            $data['zones']         = $this->db->get('zones')->result_array();
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a product
     */
    function edit($VentureID)
    {
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }   
        // check if the product exists before trying to edit it
        $data['venture'] = $this->CompanyVentures_model->get_venture($VentureID);

        if(isset($data['venture']['VentureID']))
        {
          if($this->input->post('VentureSequence')!=$data['venture']['VentureSequence']){
            $is_unique = '|is_unique[ventureslist.VentureSequence]';
          }else{
            $is_unique = '';
          }

            $this->load->library('form_validation');
            //$this->form_validation->set_rules('product_name','Product Name','required|max_length[100]|min_length[3]');
            $this->form_validation->set_rules('CompID','Company','required');
            $this->form_validation->set_rules('VentureName','Venture Name','required');
            $this->form_validation->set_rules('ZoneID','City/Zone','required');
            $this->form_validation->set_rules('AboutVenture','About Venture ','required');
            $this->form_validation->set_rules('Latitude','Latitude ','required');
            $this->form_validation->set_rules('VentureSequence','VentureSequence ','required'.$is_unique);
            $this->form_validation->set_rules('Longitude','Longitude','required');
			
			if($this->form_validation->run())     
            {   

                $photo_path = '';
                $brochure = '';
                $location = '';
                if($_FILES['photo_path']['name'] != ''){
    
                    $uploads_dir  = 'uploads/ventures/';
    
                    $tmp_name = $_FILES["photo_path"]["tmp_name"];
                    $name = time().$_FILES["photo_path"]["name"];
                    $target = $uploads_dir.$name;
            
                    if (move_uploaded_file($tmp_name, $target)) {
                        $photo_path = $target;
                    }
                }
                if($_FILES['brochure']['name'] != ''){

                    $uploads_dir  = 'uploads/ventures/';
                    $tmp_name = $_FILES["brochure"]["tmp_name"];
                    $brochure = time().$_FILES["brochure"]["name"];
                    $target = $uploads_dir.$brochure;
            
                    if (move_uploaded_file($tmp_name, $target)) {
                        //$brochure = $target;
                    }
                }


                
                $slug = url_title($this->input->post('VentureName'), 'dash', true);
                $params = array(
                    'CompID'            => $this->input->post('CompID'),
                    'VentureName'       => $this->input->post('VentureName'),
                    'ZoneID'            => $this->input->post('ZoneID'),
                    'AboutVenture'      => $this->input->post('AboutVenture'),
                    'Latitude'          => $this->input->post('Latitude'),
                    'Longitude'         => $this->input->post('Longitude'),                        
                    'highlights'      => $this->input->post('highlights'),
                    'statement_area'      => $this->input->post('statement_area'),
                    'VentureStatus'     => $this->input->post('VentureStatus'),
                    'venture_slug'      => $slug,
                    'VentureSequence'     => $this->input->post('VentureSequence'),
                    'location'       => $this->input->post('venture_location'),
                );
                if($photo_path!=""){
                    $params['VentureLogo'] = $photo_path;
                }
                if($brochure!=""){
                    $params['brochure'] = $brochure;
                }
                

                $res = $this->CompanyVentures_model->update_venture($VentureID,$params);    
                
                if($res){

                    $this->session->set_flashdata('success','Venture updated successfully');
                    redirect('CompanyVentures/index');
                }else{
                    
                    $this->session->set_flashdata('error','Something went wrong plese try again.');
                    redirect('CompanyVentures/index');
                }
                
            }
            else
            {
                $data['_view'] = 'ventures/edit';
                $Role = $this->session->userdata('Role');
                
                $this->db->select('*');
                $this->db->from('company');
                if($Role == 2 || $Role == 3){
                $this->db->where('CompID',$this->session->userdata('company_id'));
            } 
                $companies = $this->db->get()->result_array();
                $data['companies']    = $companies;
                $data['zones']         = $this->db->get('zones')->result_array();
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The venture you are trying to edit does not exist.');
    } 

    function venturePlots($VentureID){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }
        
        $data['venture']        = $this->CompanyVentures_model->get_venture($VentureID);
        $data['venture_plots']  = $this->CompanyVentures_model->get_venture_plots($VentureID);

        $data['_view'] = 'ventures/venture_plots';
        $this->load->view('layouts/main',$data);
    }


   function add_plots($VentureID){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

        $data['VentureID']  = $VentureID;
        $data['plot_types'] = $this->db->get('plot_type')->result_array();
        $data['facings'] = $this->db->get('facings')->result_array();
        $data['_view'] = 'ventures/add_plot';
        $this->load->view('layouts/main',$data);

   }

   function savePlot($VentureID){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }


    $this->load->library('form_validation');

    $this->form_validation->set_rules('PlotNo','Plot No','required');
    $this->form_validation->set_rules('Coordinates','Coordinates','required');
    $this->form_validation->set_rules('Facing','Facing','required');
    $this->form_validation->set_rules('ptype_id','Plot Type','required');
    $this->form_validation->set_rules('Plotsize','Plot Size','required');
    $this->form_validation->set_rules('Measurements','Measurements ','required');
    
    if($this->form_validation->run())     
    {   
        $params = array(

            'VentureID'         => $this->input->post('VentureID'),
            'PlotNo'            => $this->input->post('PlotNo'),
            'Coordinates'       => $this->input->post('Coordinates'),
            'IsAvailable'       => $this->input->post('IsAvailable'),
            'ptype_id'          => $this->input->post('ptype_id'),
            'Facing'            => $this->input->post('Facing'),
            'Plotsize'          => $this->input->post('Plotsize'),
            'EstPrice'          => $this->input->post('EstPrice'),
            'Measurements'      => $this->input->post('Measurements'),
            'LastModifiedBy'    => $this->session->userdata('user_id'),
            'AddedBy'           => $this->session->userdata('user_id'),
            'AddedOn'           => date('Y-m-d H:i:s')
        );
        
        $PlotID = $this->CompanyVentures_model->add_venture_plot($params);

        if($PlotID != null && $PlotID != 'undefined' && $PlotID != '' ){

            $this->session->set_flashdata('success','Plot added successfully');
            redirect('CompanyVentures/venturePlots/'.$this->input->post('VentureID'));
        }else{
            
            $this->session->set_flashdata('error','Something went wrong plese try again.');
            redirect('CompanyVentures/venturePlots/'.$this->input->post('VentureID'));
        }
    }
    else
    {            
        $data['_view']         = 'ventures/add_plot';
        $data['VentureID']  = $VentureID;
        $data['plot_types'] = $this->db->get('plot_type')->result_array();
        
        
        $this->load->view('layouts/main',$data);
    }

   }

  
   /*
     * Editing a product
     */
    function updatePlot($PlotID)
    {
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }   
        // check if the product exists before trying to edit it
        $data['venture_plot'] = $this->CompanyVentures_model->get_venture_plot($PlotID);
        
        if(isset($data['venture_plot']['PlotID']))
        {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('PlotNo','Plot No','required');
            $this->form_validation->set_rules('Coordinates','Coordinates','required');
          /*   $this->form_validation->set_rules('Facing','Facing','required'); */
            $this->form_validation->set_rules('ptype_id','Plot Type','required');
           /*  $this->form_validation->set_rules('Plotsize','Plot Size','required');
            $this->form_validation->set_rules('Measurements','Measurements ','required'); */
			
			if($this->form_validation->run())     
            {   
                $params = array(

                    'VentureID'         => $this->input->post('VentureID'),
                    'PlotNo'            => $this->input->post('PlotNo'),
                    'Coordinates'       => $this->input->post('Coordinates'),
                    'IsAvailable'       => $this->input->post('IsAvailable'),
                    'ptype_id'          => $this->input->post('ptype_id'),
                    'Facing'            => $this->input->post('Facing'),
                    'Plotsize'          => $this->input->post('Plotsize'),
                    'EstPrice'          => $this->input->post('EstPrice'),
                    'Measurements'      => $this->input->post('Measurements'),
                    'LastModifiedBy'    => $this->session->userdata('user_id'),
                );

                $res = $this->CompanyVentures_model->update_venture_plot($PlotID,$params);    
                
                if($res){
                    $this->session->set_flashdata('success','Plot updated successfully');
                    redirect('CompanyVentures/venturePlots/'.$this->input->post('VentureID'));
                }else{                    
                    $this->session->set_flashdata('error','Something went wrong plese try again.');
                    redirect('CompanyVentures/venturePlots/'.$this->input->post('VentureID'));
                }
            }
            else
            {
                $data['_view'] = 'ventures/edit_plot';
                $data['plot_types'] = $this->db->get('plot_type')->result_array();
                $data['facings'] = $this->db->get('facings')->result_array();
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The venture you are trying to edit does not exist.');
    } 

    function ventureGallery($VentureID){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

        $data['_view'] = 'ventures/gallery';
        $data['VentureID'] = $VentureID;
        $data['venture_images'] = $this->db->get_where('venture_images',array('VentureID' => $VentureID))->result_array();
        $this->load->view('layouts/main',$data);
    }

    function saveVentureImage(){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

        $VentureID = $this->input->post('VentureID');
      
   
        $files = $_FILES['venture_images'];
      
        if(sizeof($files) > 0){

            for($i= 0;$i< sizeof($files) ; $i++){

                $photo_path = '';
               
                if($_FILES['venture_images']['name'][$i] != ''){

                    $uploads_dir  = './uploads/ventures_images/';

                    $tmp_name = $_FILES["venture_images"]["tmp_name"][$i];
                    $name = time().$_FILES["venture_images"]["name"][$i];
                    $target = $uploads_dir.$name;
            
                    if (move_uploaded_file($tmp_name, $target)) {
                        $photo_path = $target;
                    
                        $this->db->insert('venture_images', array('VentureID'=>$VentureID,'Image_path'=>$photo_path));
                    }
                }
            }
            echo "success";
            $this->session->set_flashdata('success','Images uploaded successfully');
            //redirect('CompanyVentures/ventureGallery/'.$this->input->post('VentureID'));
        }else{
            echo "error";
            $this->session->set_flashdata('error','Something went wrong please try again.');
            //redirect('CompanyVentures/ventureGallery/'.$this->input->post('VentureID'));
        }

    }

    function saveVentureImages(){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

        $VentureID = $this->input->post('VentureID');
      
   
        $files = $_FILES['venture_images'];
      
        if(sizeof($files) > 0){

            for($i= 0;$i< sizeof($files) ; $i++){

                $photo_path = '';
               
                if($_FILES['venture_images']['name'][$i] != ''){

                    $uploads_dir  = './uploads/ventures_images/';

                    $tmp_name = $_FILES["venture_images"]["tmp_name"][$i];
                    $name = time().$_FILES["venture_images"]["name"][$i];
                    $target = $uploads_dir.$name;
            
                    if (move_uploaded_file($tmp_name, $target)) {
                        $photo_path = $target;
                    
                        $this->db->insert('venture_images', array('VentureID'=>$VentureID,'Image_path'=>$photo_path));
                    }
                }
            }
            $this->session->set_flashdata('success','Images uploaded successfully');
            redirect('CompanyVentures/ventureGallery/'.$this->input->post('VentureID'));
        }else{
            $this->session->set_flashdata('error','Something went wrong please try again.');
            redirect('CompanyVentures/ventureGallery/'.$this->input->post('VentureID'));
        }

    }
    
    function delete_image(){
        if($this->session->userdata('isLoggedIn') == null || $this->session->userdata('isLoggedIn') != 'yes' ){
            redirect('Login');
        }

        $vimage_id = $this->input->post('vimage_id');
        $res = $this->db->delete('venture_images',array('vimage_id' => $vimage_id));
        if($res){

            $this->session->set_flashdata('success','Image deleted successfully');
           echo true;

        }else{
            
            $this->session->set_flashdata('error','Something went wrong plese try again.');
            echo false;
        }
    }

    function venturePlotsBulkUpload(){
     

        $filename = $_FILES["UploadData"]["name"];
        $VentureID  = $this->input->post('VentureID');
        $_FILES["UploadData"]["size"];
        $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));
        
        //we check,file must be have csv extention

            try{
        
                if ($_FILES["UploadData"]["error"] > 0) {
                    
                    $msg = "Return Code: " . $_FILES["UploadData"]["error"] . "<br />";
                    $this->session->set_flashdata('error',$msg);

                }else{

                            //if file already exists
                        $storagename = "uploaded_file".time().".csv";
                        if (file_exists("uploads/" . $storagename)) {
                            $msg=  $_FILES["UploadData"]["name"] . " already exists. ";
                        }
                        else {
                                //Store file in directory "upload" with the name of "uploaded_file.txt"
                            $storagename = "uploaded_file".time().".csv";
                            move_uploaded_file($_FILES["UploadData"]["tmp_name"], "uploads/" . $storagename);
                        
                        }
                    try{
                        
                            
                            $file = fopen( "uploads/" . $storagename , "r" );

                        
                            $this->db->trans_start();
                            
                                $i = 0;
                            
                            $error_list_array = [];
                            $this->db->trans_start();
                            while (($plot_data = fgetcsv($file, 10000, ",")) != FALSE )
                            {
                               
                                if($plot_data[0] != ''){
                               
                                     if(sizeof($plot_data) < 8  ){
                                            
                                        
                                         $this->session->set_flashdata('error','Upload Failed Please Provide Valid Content');
                                         //redirect('leads_list/index');

                                     }else{

                                        $params = array(
                                                        'VentureID'	    => $VentureID,
                                                        'PlotNo'	    => $plot_data[0],
                                                        'Coordinates'	=> $plot_data[1],
                                                        'IsAvailable'	=> $plot_data[2],
                                                        'ptype_id'	    => $plot_data[3],
                                                        'Facing'	    => $plot_data[4],
                                                        'Plotsize'	    => $plot_data[5],
                                                        'EstPrice'	    => $plot_data[6],
                                                        'Measurements'	=> $plot_data[7],
                                        );
                                        $this->db->insert('venture_plots',$params);
                                     }
                            }

                            $this->db->trans_complete();

                            if($this->db->trans_status() == true){

                                $this->db->trans_commit();
                                $this->session->set_flashdata('success','Plots Uploaded Succesfully');

                            }else{

                                $this->db->trans_rollback();
                                $this->session->set_flashdata('error','Something Went Wrong Pleas Try Again.');
                            }
                        }
                    }catch(Exception $e){

                        $this->session->set_flashdata('error',$e->getMessage());
                    }
            }
        }
        catch(Exception $e){

            $this->session->set_flashdata('error',$e->getMessage());
        }
        
        redirect('CompanyVentures/ventureGallery/'.$this->input->post('VentureID'));
    }
        

    public function venturePlotsBulkUploadJson(){

            // Read JSON file 10252AMnelloreparks
            $Mplots_latlng  = file_get_contents(base_url().'json/123932AMplots.json');
            $Mplots_det     = file_get_contents(base_url().'json/Getplots.json');
            $parks          = file_get_contents(base_url().'json/10252AMnelloreparks.json');
            $roads          = file_get_contents(base_url().'json/30200AMnelloroads.json');

            //Decode JSON
            $Mplots_latlng = json_decode($Mplots_latlng,true);
            $Mplots_det     = json_decode($Mplots_det,true);
            $parks          = json_decode($parks,true);
            $roads          = json_decode($roads,true);

            //Print data
            foreach($Mplots_latlng['features'] as $list){

              
                $plotno = $list['properties']['name'];
               
                if(strlen($plotno) == 1)
                    $plotno = "00".$plotno;
                if(strlen($plotno) == 2)
                    $plotno = "0".$plotno;

                $filter = array_filter($Mplots_det, function($v, $k) use ($plotno) {
                        return  'NELLORE-'.$plotno == $v['No_'];
                    }, ARRAY_FILTER_USE_BOTH);
                $filter = array_values($filter);
                
                if(sizeof($filter) > 0){

                    $params = array(
                        'VentureID'	    => 1,
                        'PlotNo'	    => $plotno,
                        'Coordinates'	=> json_encode($list['geometry']['coordinates']),
                        'IsAvailable'	=> 'A',
                        'ptype_id'	    => 2,
                        'Facing'	    => $filter[0]['Facing'],
                        'Plotsize'	    => $filter[0]['Saleable Area'],
                        'EstPrice'	    => '1999',
                        'Measurements'	=> 'E-'.$filter[0]['Size-East'].' W-'.$filter[0]['Size-West'].' N-'.$filter[0]['Size-North'].' S-'.$filter[0]['Size-South'],                    
                    );
                  
                    $this->db->insert('venture_plots',$params);

                }
               
            }
          
            foreach($parks['features'] as $list){

                $params = array(
                    'VentureID'	    => 1,
                    'PlotNo'	    => '0',
                    'Coordinates'	=> json_encode($list['geometry']['coordinates']),
                    'IsAvailable'	=> 'NA',
                    'ptype_id'	    => 3,
                    'Facing'	    => '',
                    'Plotsize'	    => '',
                    'EstPrice'	    => '',
                    'Measurements'	=> '',
                );
              
                $this->db->insert('venture_plots',$params);
            
               
            }

            foreach($roads['features'] as $list){

                $params = array(
                    'VentureID'	    => 1,
                    'PlotNo'	    => '0',
                    'Coordinates'	=> json_encode($list['geometry']['coordinates']),
                    'IsAvailable'	=> 'NA',
                    'ptype_id'	    => 4,
                    'Facing'	    => '',
                    'Plotsize'	    => '',
                    'EstPrice'	    => '',
                    'Measurements'	=> '',
                );
              
                $this->db->insert('venture_plots',$params);
            
            }

            echo 'completed';
    }

    public function get_road_layers(){

        $road_features = [];
        foreach($all_roads as $value){
            
            $temp = (object)[];
            $temp->type = "Feature";
            $temp->properties = (object)array('name'=>'','description' => 'Parks');
            $temp->geometry = (object)array('type' => 'Polygon','coordinates'=>$value['Coordinates']);
            array_push($road_features,$temp);
        }

        $mroads = (object)array('type'=>'FeatureCollection','crs'=>$crs,'features'=>$road_features);
        
        echo json_encode($road_features);

    }
    public function getPlot_details($VentureID,$CompID){

        $response = [];
       /*  $CompID = $this->input->post('CompID');
        $VentureID = $this->input->post('VentureID'); */
        $all_plots = $this->db->get_where('venture_plots',array('VentureID' => $VentureID,'ptype_id' => 2))->result_array();
        $all_parks = $this->db->get_where('venture_plots',array('VentureID' => $VentureID,'ptype_id' => 3))->result_array();
        $all_roads = $this->db->get_where('venture_plots',array('VentureID' => $VentureID,'ptype_id' => 4))->result_array();
        $plot_features = [];
        $plot_det = [];
        $park_features = [];
        $road_features = [];
        foreach($all_plots as $value){
            
            $temp = (object)[];
            $temp->type = "Feature";
            $temp->properties = (object)array('name'=>$value['PlotNo']);
            $temp->geometry = (object)array('type' => 'Polygon','coordinates'=> json_decode($value['Coordinates']));
            array_push($plot_features,$temp);

            $det = (object)array(

                "No_"=> $value['PlotNo'],
                "Status"=> $value['IsAvailable'],
                "Facing"=> $value['Facing'],
                "Customer Name"=> "",
                "Saleable Area"=> $value['Plotsize'],
                "Measurements"=> $value['Measurements'],
                "Size-East"=> 60.00000000000000000000,
                "Size-West"=> 60.00000000000000000000,
                "Size-North"=> 40.00000000000000000000,
                "Size-South"=> 40.00000000000000000000
            );
            array_push($plot_det,$det);
        }

        $crs = (object)array("type"=>"name", "properties"=>(object) array( "name"=> "urn:ogc:def:crs:OGC:1.3:CRS84"));
        $mplots = (object)array('type'=>'FeatureCollection','crs'=>$crs,'features'=>$plot_features);
        /* $response['getPlots'] =  $plot_det; */

        $fp = fopen('mplots_1.json', 'w');
        fwrite($fp, json_encode($mplots));
        fclose($fp);
        
        foreach($all_parks as $value){
            
            $temp = (object)[];
            $temp->type = "Feature";
            $temp->properties = (object)array('name'=>'','description' => 'Parks');
            $temp->geometry = (object)array('type' => 'Polygon','coordinates'=> json_decode($value['Coordinates']));
            array_push($park_features,$temp);
        }

        $mparks = (object)array('type'=>'FeatureCollection','crs'=>$crs,'features'=>$park_features);

        $fp = fopen('mparks_1.json', 'w');
        fwrite($fp, json_encode($mparks));
        fclose($fp);
        foreach($all_roads as $value){
            
            $temp = (object)[];
            $temp->type = "Feature";
            $temp->properties = (object)array('name'=>'','description' => 'Parks');
            $temp->geometry = (object)array('type' => 'Polygon','coordinates'=> json_decode($value['Coordinates']));
            array_push($road_features,$temp);
        }

        $mroads = (object)array('type'=>'FeatureCollection','features'=>$road_features);
        
        $fp = fopen('mroads_1.json', 'w');
        fwrite($fp, json_encode($mroads));
        fclose($fp);
        $response[] = (object)array(
            "CONFIG_ID" =>  75,
            "PROJECT_ID" => null,
            "CONFIG_OPENCOLOR" => "#FFFBD6",
            "CONFIG_MARTGAGECOLOR" => "#d8cf7b",
            "CONFIG_BOOKEDCOLOR" => "#C89400",
            "CONFIG_REGISTEREDCOLOR" => "#C89400",
            "CONFIG_BACKGROUNDIMAGE" => base_url().'mplots_1.json',
            "CONFIG_STATUS" => 1,
            "CONFIG_ROADJSON" => base_url().'mroads_1.json',
            "CONFIG_CREATEDBY" => 2,
            "CONFIG_CREATEDDATE" => "2017-05-30T04:43:41.84",
            "CONFIG_UPDATEDDATE" => "2017-05-30T04:43:41.84",
            "CONFIG_UPDATEDBY" => 1,
            "CONFIG_GEOjSON" => null,
            "config_longitude" => 0.000000000,
            "config_latitude" => 0.000000000,
            "CONFIG_ROTATION" => "0",
            "CONFIG_PROJECT_COMPANYID" => null,
            "config_zoom" => 20.0,
            "config_minzoom" => 15.0,
            "config_maxzoom" => 24.0,
            "config_minlong" => "79.973614376",
            "config_minlat" => "14.599926533",
            "config_maxlong" => "79.982039571",
            "config_maxlat" => "14.608011897",
            "config_gardenjs" => base_url().'mparks_1.json',
            "config_colorstatus"=> "",
            "project_code" => "209520",
            "PROJECT_LAYERJSON" => "",
            "zoom_14to16" => "",
            "zoom_16to18" => "",
            "zoom_18to20" => "",
            "zoom_20to22" => "",
            "map_bgimage" => "http://localhost/layout1/images/40700AMBG FOR WEB-1.jpg",
            "popup_click" => "1",
            "configproject_status" => 1,
            "config_textscale" => ".8"
        );
        
        echo json_encode($response);
    }

    function Getplots($VentureID,$CompID){

        $response = [];
        $all_plots = $this->db->get_where('venture_plots',array('VentureID' => $VentureID,'ptype_id' => 2))->result_array();
       
        $plot_features = [];
        $plot_det     = [];
        foreach($all_plots as $value){
            
            $det = (object)array(

                "No_"=> $value['PlotNo'],
                "Status"=> $value['IsAvailable'],
                "Facing"=> $value['Facing'],
                "Customer Name"=> "",
                "Saleable Area"=> $value['Plotsize'],
                "Measurements"=> $value['Measurements'],
                "Size-East"=> 60.00000000000000000000,
                "Size-West"=> 60.00000000000000000000,
                "Size-North"=> 40.00000000000000000000,
                "Size-South"=> 40.00000000000000000000
            );
            array_push($plot_det,$det);
        }

        $crs = (object)array("type"=>"name", "properties"=>(object) array( "name"=> "urn:ogc:def:crs:OGC:1.3:CRS84"));
        $response = (object)array('type'=>'FeatureCollection','crs'=>$crs,'features'=>$plot_det);
        echo json_encode($plot_det);

    }

    function projectgardenimages(){
        echo json_encode([]);
    }
    

    function showVentureOld(){
        if(isset($_GET['c']) && isset($_GET['v'])){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($_GET['c']);
            $this->load->view('venture_layout/newlist',$data);
        }elseif(isset($_GET['c']) && isset($_GET['s'])){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($_GET['c'],$_GET['s']);
            $this->load->view('venture_layout/list',$data);
        }elseif(isset($_GET['c'])){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($_GET['c']);
            $this->load->view('venture_layout/list',$data);
        }
    }

    function showVenture($company='',$status=''){
        if($company!="" && $status!=""){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($company,$status);
            $data['company_id'] =   $this->CompanyVentures_model->get_company($company); 
            $data['status']       = $status;
            if(count($data['ventures'])>0){
                $this->load->view('venture_layout/newlist',$data);
            }else{
                $this->load->view('venture_layout/noventures',$data);
            } 
        }else{
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($company,$status);
            $data['company_id'] =   $this->CompanyVentures_model->get_company($company);
            $data['status']       = $status;
            if(count($data['ventures'])>0){
                $this->load->view('venture_layout/newlist',$data);
            }else{                
                $this->load->view('venture_layout/noventures',$data);
            } 
        }
    }

    function showVentures($company='',$venture='',$status=''){
        if($company!="" && $status!="" && $venture!=""){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($company,$status);
            $data['company_id'] =   $this->CompanyVentures_model->get_company($company);
            $data['venture_id'] =   $this->CompanyVentures_model->get_venture_id($venture);
            $data['status']       = $status;
            if(count($data['ventures'])>0){
                $this->load->view('venture_layout/newlist',$data);
            }else{
                $this->load->view('venture_layout/noventures',$data);
            }           
            
        }elseif($company!="" && $venture!=""){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($company,$status);
            $data['company_id'] =   $this->CompanyVentures_model->get_company($company); 
            $data['venture_id'] =   $this->CompanyVentures_model->get_venture_id($venture);
            $data['status']       = $status;
            if(count($data['ventures'])>0){
                $this->load->view('venture_layout/newlist',$data);
            }else{
                $this->load->view('venture_layout/noventures',$data);
            } 
        }elseif($company!=""){
            $data['ventures'] = $this->Api_model->get_all_ventures_by_company($company,$status);
            $data['company_id'] =   $this->CompanyVentures_model->get_company($company);
            $data['status']       = $status;
            if(count($data['ventures'])>0){
                $this->load->view('venture_layout/newlist',$data);
            }else{
                
                $this->load->view('venture_layout/noventures',$data);
            } 
        }
    }
}
