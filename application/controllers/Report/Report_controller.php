<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);

class Report_controller extends CI_Controller
  {
    public function index()
 	 {
 	 		   $this->load->database();
    	   	   $this->load->model('Report/report_model');
    	   	   $data['wo_info']=$this->report_model->get_all_info();
         $this->load->model('inventory_model/ManageCustomer_model');
         $data['all_customer'] = Report_controller::getcustomerDetails();
 	 		   $this->load->view('includes/navigation.php');
		       $this->load->view('Report/report_view.php',$data);
   	}

    public function getCustomerDetails() {

        $path = base_url();
        $url = $path . 'api/ManageCustomer_api/getCustomerDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

   	 public function get_all_info() 
    {
         $path=base_url();
         $url = $path.'api/Report_api/get_all_info';   
        $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_HTTPGET, true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response_json = curl_exec($ch);
         curl_close($ch);
         $response=json_decode($response_json, true);
         print_r($response_json);
    }

    public function show_ProfitReport()
    {
          extract($_POST);
          //print_r($_POST);
          $path=base_url();
          $url = $path.'api/Report_api/show_ProfitReport'; 
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_HTTPGET, true);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response_json = curl_exec($ch);
          curl_close($ch);
          $response=json_decode($response_json, true);
          print_r($response_json);
    }
        public function sort_Profitreport()
        {
            extract($_POST);
            
           // print_r($_POST);die();
            $path = base_url();
            $url = $path.'api/Report_api/sort_Profitreport?From_date='.$filter_fromDate.'&To_date='.$filter_toDate.'&cust_id='.$customer_idFilter;
            //echo $url;die();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            //print_r($response_json);die();
               
                 $count=1; 
               if($response['status']==0){
               echo '<div class="alert alert-danger">
               <strong>'.$response['status_message'].'</strong> 
               </div>';
             }else
             {
              foreach ($response['status_message'] as $value) {
               $wo_id=$value['wo_id'];
               //print_r($wo_id);
               $customer_name=$value['customer_name'];
                $branch_name=$value['branch_name'];
                $vendor_name=$value['vendor_name'];
                $material_name=$value['material_name'];
                $profit=$value['profit'];
               // $boughtout_profit=$value['profit'];

              

              echo                    
            '<tr class="">
             <td class="w3-center">'.$count.'.</td>
            <td class="w3-center">'.$wo_id.'.</td>
             <td class="w3-center">'.$customer_name.'.</td>
            <td class="w3-center">'.$branch_name.'</td>
            <td class="w3-center">'.$vendor_name.'</td>
            <td class="w3-center">'.$material_name.'</td>
            <td class="w3-center">'.$profit.'</td>
            
            </tr>';
             $count++;
           }
             }
         }

        public function sort_byBranch() 
        {
            extract($_POST);
            //print_r($_POST);die();
            $path = base_url();
            $url = $path . 'api/Report_api/sort_byBranch?From_date='.$From_date.'&To_date='.$To_date.'&Sort_by_branch='.$Sort_by_branch.'&cust_id='.$cust_id;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            print_r($response_json);
              $count=1; 
               if($response['status']==0){
               echo '<div class="alert alert-danger">
               <strong>'.$response['status_message'].'</strong> 
               </div>';
             }else
             {
              foreach ($response['status_message'] as $value) {
               $wo_id=$value['wo_id'];
               //print_r($wo_id);
               $customer_name=$value['customer_name'];
                $branch_name=$value['branch_name'];
                $vendor_name=$value['vendor_name'];
                $material_name=$value['material_name'];
                $profit=$value['profit'];
               // $boughtout_profit=$value['profit'];

              

              echo                    
            '<tr class="">
             <td class="w3-center">'.$count.'.</td>
            <td class="w3-center">'.$wo_id.'.</td>
             <td class="w3-center">'.$customer_name.'.</td>
            <td class="w3-center">'.$branch_name.'</td>
            <td class="w3-center">'.$vendor_name.'</td>
            <td class="w3-center">'.$material_name.'</td>
            <td class="w3-center">'.$profit.'</td>
            
            </tr>';
             $count++;
           }
             }
      }
}