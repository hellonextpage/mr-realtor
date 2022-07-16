<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');
 include_once('application/libraries/swiftmailer/swift_required.php');  
class Realtor_Api extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model');
     
    } 

    function login_post(){
        $missing_params = "";
        $response = [];
        $postdata = json_decode(file_get_contents("php://input"),true);    
        if(isset($postdata['EmailID']) && $postdata['EmailID'] != ''){
            $EmailID  = $postdata['EmailID'];
        }else{
            $missing_params .= " EmailID , ";
        }
        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){
            $CompID  = $postdata['CompID'];
        }else{
            $missing_params .= " CompID , ";
        }
        if(isset($postdata['Passsword']) && $postdata['Passsword'] != ''){
            $Passsword  = $postdata['Passsword'];
        }else{
            $missing_params .= " Passsword , ";
        }
        if($missing_params != ''){
            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];
        }else{
            $admin_user = $this->Api_model->check_user($CompID,$Passsword,$EmailID);
          //     echo $this->db->last_query();
            if(sizeof($admin_user) > 0){
                $response['status'] = 1;
                $response['resp_mesage'] = 'Logged in successfully';
                $response['data'] = $admin_user;
            }else{
                $response['status'] = 0;
                $response['resp_mesage'] = 'Invalid Email/Password';
                $response['data'] = $admin_user;
            }
        }
        //$this->response($response);
        echo json_encode($response);
    }

    function checkInUser(){

        
        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
      //$postdata = $_POST;
        /* $file = fopen('login.txt','w');
        fwrite($file, json_encode($postdata));
        fclose($file); */
        if(isset($postdata['Name']) && $postdata['Name'] != ''){

            $Name  = $postdata['Name'];
        }else{

            $missing_params .= " Name , ";
        }

        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){

            $CompID  = $postdata['CompID'];
        }else{

            $missing_params .= " Keyword , ";
        }

        if(isset($postdata['MobileNo']) && $postdata['MobileNo'] != ''){

            $MobileNo  = $postdata['MobileNo'];
        }else{

            $missing_params .= " MobileNo , ";
        }

        if(isset($postdata['IsAgentOrCust']) && $postdata['IsAgentOrCust'] != ''){

            $IsAgentOrCust  = $postdata['IsAgentOrCust'];
        }else{

            $missing_params .= " IsAgentOrCust , ";
        }


        if($missing_params != ''){
            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];
        }else{
            $res = $this->Api_model->checkin_user($CompID,$MobileNo,$Name,$IsAgentOrCust);       
            $response['status'] = 1;
            $response['resp_mesage'] = 'Checked in successfully';
            $response['data'] = [];

        }
        //$this->response($response);
        echo json_encode($response);
    }

    function getVentures(){

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
       //$postdata = $_POST;
      
        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){

            $CompID  = $postdata['CompID'];
        }else{

            $missing_params .= " CompID , ";
        }

        if($missing_params == ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{
            //$keyword = $this->input->post('keyword');        
           // $ventures = $this->Api_model->get_all_ventures_by_company($keyword); 
            $ventures = $this->Api_model->get_all_ventures_by_company($CompID);

            $response['status'] = 1;
            $response['resp_mesage'] = 'Ventures Fetched Successfully';
            $response['data'] = $ventures;
        }

        echo json_encode($response);
    }


    function changePlotAvailability(){


        
        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
        //$postdata = $_POST;
      
        if(isset($postdata['VentureID']) && $postdata['VentureID'] != ''){

            $VentureID  = $postdata['VentureID'];
        }else{

            $missing_params .= " VentureID , ";
        }

        if(isset($postdata['PlotNo']) && $postdata['PlotNo'] != ''){

            $PlotNo  = $postdata['PlotNo'];
        }else{

            $missing_params .= " PlotNo , ";
        }

        if(isset($postdata['Status']) && $postdata['Status'] != ''){

            $Status  = $postdata['Status'];
        }else{

            $missing_params .= " Status , ";
        }


        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{

            $plot_det = $this->db->get_where('venture_plots',array('VentureID' => $VentureID,'PlotNo' => $PlotNo))->result_array();
            if(sizeof($plot_det) > 0){

                $res = $this->Api_model->change_plot_availability($VentureID,$PlotNo,$Status);
                if($res){
    
                    $response['status']      = 1;
                    $response['resp_mesage'] = 'Plot Status Updated Successfully';
                    $response['data']        = [];

                }else{
    
                    $response['status'] = 0;
                    $response['resp_mesage'] = 'Something went wrong please try again';
                    $response['data'] = [];
                }

            }else{
                
                $response['status'] = 0;
                $response['resp_mesage'] = 'No plot found for given details';
                $response['data'] = [];
            }
        }
        echo json_encode($response);
    }

    function changePassword(){

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
       //$postdata = $_POST;
      
        if(isset($postdata['CompAdminID']) && $postdata['CompAdminID'] != ''){

            $CompAdminID  = $postdata['CompAdminID'];
        }else{

            $missing_params .= " CompAdminID , ";
        }
        if(isset($postdata['newPassword']) && $postdata['newPassword'] != ''){

            $newPassword  = $postdata['newPassword'];
        }else{

            $missing_params .= " newPassword , ";
        }

        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{

            $res = $this->Api_model->change_company_admin_password($CompAdminID,$newPassword);

            if($res){
    
                $response['status'] = 1;
                $response['resp_mesage'] = 'Password Updated Successfully';
                $response['data'] = [];

            }else{

                $response['status'] = 0;
                $response['resp_mesage'] = 'Something went wrong please try again';
                $response['data'] = [];
            }
        }

        echo json_encode($response);
    }

    function getVentureDetails(){

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
       //$postdata = $_POST;
      
        if(isset($postdata['VentureID']) && $postdata['VentureID'] != ''){

            $VentureID  = $postdata['VentureID'];
        }else{

            $missing_params .= " VentureID , ";
        }
        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{

            $venture_det = $this->db->get_where('ventureslist',array('VentureID' => $VentureID))->result_array();
            if(sizeof($venture_det) > 0){
                
                $data = [];
                $data['venture_det'] = $this->Api_model->get_venture($VentureID);
                $data['venture_plots'] = $this->Api_model->get_venture_plots($VentureID);
                $data['venture_images'] = $this->Api_model->get_venture_images($VentureID);
                
                $response['status'] = 1;
                $response['resp_mesage'] = 'Plot Status Updated Successfully';
                $response['data'] = $data;      
                             
            }else{
                
                $response['status'] = 0;
                $response['resp_mesage'] = 'No plot found for given details';
                $response['data'] = [];
            }
        }

        echo json_encode($response);
    }

    public function getVenturePlots(){

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
        if(isset($postdata['VentureID']) && $postdata['VentureID'] != ''){

            $VentureID  = $postdata['VentureID'];
        }else{

            $missing_params .= " VentureID , ";
        }
        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{


            $venture_det = $this->db->get_where('ventureslist',array('VentureID' => $VentureID))->result_array();
            if(sizeof($venture_det) > 0){
                
                $data = [];
                $data['venture_det'] = $this->Api_model->get_venture($VentureID);
                $data['venture_images'] = $this->Api_model->get_venture_images($VentureID);
                
                    $response['status'] = 1;
                    $response['resp_mesage'] = 'Plot Status Updated Successfully';
                    $response['data'] = $data;
               

            }else{
                
                $response['status'] = 0;
                $response['resp_mesage'] = 'No plot found for given details';
                $response['data'] = [];
            }
        }

        echo json_encode($response);
    }

    public function saveEnquiry(){  

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){

            $CompID  = $postdata['CompID'];

        }else{

            $missing_params .= " CompID , ";
        }
        if(isset($postdata['PlotsInterested']) && $postdata['PlotsInterested'] != ''){

            $PlotsInterested  = $postdata['PlotsInterested'];

        }else{

            $missing_params .= " PlotsInterested , ";
        }
        if(isset($postdata['MinInvestAmt']) && $postdata['MinInvestAmt'] != ''){

            $MinInvestAmt  = $postdata['MinInvestAmt'];
        }else{

            $missing_params .= " MinInvestAmt , ";
        }
        if(isset($postdata['MaxInvestAmt']) && $postdata['MaxInvestAmt'] != ''){

            $MaxInvestAmt  = $postdata['MaxInvestAmt'];
        }else{

            $missing_params .= " MaxInvestAmt , ";
        }
        
        if(isset($postdata['PreferredLocation']) && $postdata['PreferredLocation'] != ''){

            $PreferredLocation  = $postdata['PreferredLocation'];
        }else{

            $missing_params .= " PreferredLocation , ";
        }

        if(isset($postdata['MobileNo']) && $postdata['MobileNo'] != ''){

            $MobileNo  = $postdata['MobileNo'];
        }else{

            $missing_params .= " MobileNo , ";
        }

        if(isset($postdata['EmailID']) && $postdata['EmailID'] != ''){

            $EmailID  = $postdata['EmailID'];
        }else{

            $missing_params .= " EmailID , ";
        }
        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{


            $params = array('CompID'            => $CompID,
                            'PlotsInterested'   => $PlotsInterested,
                            'MinInvestAmt'      => $MinInvestAmt,
                            'MaxInvestAmt'      => $MaxInvestAmt,
                            'PreferredLocation' => $PreferredLocation,
                            'MobileNo'          => $MobileNo,
                            'EmailID'           => $EmailID,
                            'CreatedOn'         => date('Y-m-d h:i:s'),
          );

            $res = $this->Api_model->save_enquiry($params);
            if(sizeof($res) > 0){
                
             
                    $response['status'] = 1;
                    $response['resp_mesage'] = 'Enqury Saved Successfully';
                    $response['data'] = [];
               

            }else{
                
                $response['status'] = 0;
                $response['resp_mesage'] = 'Something went wrong';
                $response['data'] = [];
            }
        }

        echo json_encode($response);


    }

    function forgotPassword(){

        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
        //$postdata = $_POST;
        if(isset($postdata['EmailID']) && $postdata['EmailID'] != ''){

            $EmailID  = $postdata['EmailID'];
        }else{

            $missing_params .= " EmailID , ";
        }

        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){

            $CompID  = $postdata['CompID'];
        }else{

            $missing_params .= " CompID , ";
        }
        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{

            $get_user = $this->db->get_where('compadmins',array('EmailID' => $EmailID,'CompID' => $CompID))->row_array();

            if(sizeof($get_user)){

                $otp = $this->generate_otp();
            $emailTmplt = "<html><head>
                    </head>
                    <body>
                    <h3>Here is the OTP For Password Change</h3>
                    <p>OTP : ".$otp."</p>
                    </body>
                    </html>";
                $subject = "OTP From Mr.Realtor";
                
                 $transport =  Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                
                            ->setUsername('niranjanpusuluri@gmail.com')
                            ->setPassword('odhglvbvehkevwkf');
 
                $message = Swift_Message::newInstance();
                $message->setTo(array(
                    
                    'sathishkumar.gorinta@gmail.com' => "Mr.Realtor", 
                     $EmailID  => "Mr.Realtor"
                ));
                $message->setSubject($subject);
                $message->setBody($emailTmplt,'text/html');
             
                
                $message->setFrom("admin@mrrealtor", "Mr.Realtor");

                // Send the email
                $mailer = Swift_Mailer::newInstance($transport);
                $mail_satatus = $mailer->send($message);	
							
                if($mail_satatus == 0 || $mail_satatus == false ){

                    $this->db->trans_rollback();
                    $response['status'] = 0;
                    $response['resp_mesage'] = 'Something went wrong please try again';
                    $response['opt'] = '';
                    
                }else{

                    $response['status'] = 1;
                    $response['resp_mesage'] = 'OTP sent to mails Successfully';
                    $response['opt'] = $otp;
                }

            }else{

                    $response['status'] = 0;
                    $response['resp_mesage'] = 'No User Exist With Given EmailID';
                    $response['opt'] = '';
            }
            
        }

        echo json_encode($response);

    }

    function updatePassword(){


        $missing_params = "";
        $response = [];
        
        $postdata = json_decode(file_get_contents("php://input"),true);
        //$postdata = $_POST;
        if(isset($postdata['CompID']) && $postdata['CompID'] != ''){

            $CompID  = $postdata['CompID'];
        }else{

            $missing_params .= " CompID , ";
        }

        if(isset($postdata['EmailID']) && $postdata['EmailID'] != ''){

            $EmailID  = $postdata['EmailID'];
        }else{

            $missing_params .= " EmailID , ";
        }
        if(isset($postdata['NewPassword']) && $postdata['NewPassword'] != ''){

            $NewPassword  = $postdata['NewPassword'];
        }else{

            $missing_params .= " NewPassword , ";
        }
        if($missing_params != ''){

            $response['status'] = 0;
            $response['resp_mesage'] = 'Missing/ Empty the following params'.$missing_params;
            $response['data'] = [];

        }else{

            $get_user = $this->db->get_where('compadmins',array('EmailID' => $EmailID,'CompID' => $CompID))->row_array();

            if(sizeof($get_user)){
                

                $this->db->where(array('EmailID' => $EmailID,'CompID' => $CompID));
                $res =$this->db->update('compadmins',array('Password' => $NewPassword));
                if(!$res){

                    $this->db->trans_rollback();
                    $response['status'] = 0;
                    $response['resp_mesage'] = 'Something went wrong please try again';
                    $response['data'] = '';
                    
                }else{

                    $response['status'] = 1;
                    $response['resp_mesage'] = 'Password Updated Successfully';
                    $response['data'] = $get_user;
                }

            }else{

                    $response['status'] = 0;
                    $response['resp_mesage'] = 'No User Exist With Given EmailID';
                    $response['opt'] = '';
            }            
        }
        echo json_encode($response);
    }

    function generate_otp(){
        $pass_cade = mt_rand(100000, 999999);
        return $pass_cade;
    }
    function checkCompany(){
        $keyword = $this->input->post('keyword');        
        $ventures = $this->Api_model->get_all_ventures_by_company($keyword);        
        if(count($ventures)>0){
            $data['status'] = true;
            $data['ventures']  = $ventures;
            $data['message']  = '';            
        }else{           
            $data['status'] = false;
            $data['ventures']  = [];
            $data['message']  = 'No company founded for the entered keyword.';
        }
        echo json_encode($data);
    }
}