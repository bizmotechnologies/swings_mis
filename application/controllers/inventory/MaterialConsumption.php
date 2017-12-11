<?php
//error_reporting(E_ERROR | E_PARSE);
class MaterialConsumption extends CI_controller
{
    public function __construct(){
        parent::__construct();
        
        //start session     
        $user_id=$this->session->userdata('user_id');
        $user_name=$this->session->userdata('user_name');
        $privilege=$this->session->userdata('privilege');
        $branch_name=$this->session->userdata('branch_name');
        //check session variable set or not, otherwise logout
        if(($user_id=='') || ($user_name=='') || ($privilege=='') || ($branch_name=='')){
            redirect('role_login');
        }
        $this->load->model('inventory_model/materialConsume_model');
    }

	public function index()
	{		
        $data['all_consume']=MaterialConsumption::getConsumptionDetails();
        $data['all_material']=MaterialConsumption::getMaterialrecord();
       $this->load->view('includes/navigation.php');
       $this->load->view('inventory/stock/consumeForm',$data);
	}

    //----------------this fun is for get total info of materials---------------//
    public function getMaterialrecord() {

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getMaterialrecord';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response);
        return $response;
    }

    //---add consumed length
	public function addConsumption()
	{
		extract($_POST);
		$data = $_POST;

        //---------------if any of the role is not selected, then return this--------//
        if($material_name=='0'){
            echo '<div class="alert alert-danger">
            <strong>Choose appropriate material first !!!</strong> 
            </div>          
            ';  
            die();
        }

		$path = base_url();                                                   
        $url = $path.'api/ManageConsumption_api/addConsumption';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();

        if ($response['status'] == 0) {
            echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>' . $response['status_message'] . '</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
              location.reload();
             });
            }, 600);
            </script>';
        } else {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>' . $response['status_message'] . '</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            location.reload();
             });
            }, 600);
            </script>';
        }
	  
	}

    public function getConsumptionDetails()
    {        
        //Connection establishment to get data from REST API
        $path=base_url();
        $url = $path.'api/ManageConsumption_api/getConsumptionDetails';      
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        //print_r($response_json);die();
        //api processing ends

       return $response;
   
    }
}
?>