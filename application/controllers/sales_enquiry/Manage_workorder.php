<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_workorder extends CI_Controller
  {
    public function index()
 	 {
    	   $this->load->database();
    	   $this->load->model('sales_model/manage_workorder_model');
    	   $data['wo_info']=$this->manage_workorder_model->get_all_woinfo();
    	   $this->load->view('includes/navigation.php');
		     $this->load->view('sales/manage_workorder.php',$data);
   	} 
	
    public function get_all_woinfo() 
    {
         $path=base_url();
         $url = $path.'api/Wo_get_all_infoapi/get_all_woinfo';   
         // $url = $path.'api/Wo_get_all_infoapi/get_all_wo_id?wo_id='.$wo_id;	   
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_HTTPGET, true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response_json = curl_exec($ch);
         curl_close($ch);
         $response=json_decode($response_json, true);
         return $response;
    }


    public function show_WO_id_info()
    {
          extract($_POST);
          //print_r($_POST);
          $path=base_url();
          $url = $path.'api/Wo_get_all_infoapi/show_WO_id_info?wo_id='.$wo_id; 
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_HTTPGET, true);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response_json = curl_exec($ch);
          curl_close($ch);
          $response=json_decode($response_json, true);
          //print_r($response);die();
          //print_r($response['status_message']);

          if ($response['status']==0) {
            
          } else {

            foreach ($response['status_message'] as $key) {
             //$customer_name=$response['status_message']['customer_name'];
              $date=date('d/m/Y',strtotime($key['dated'])); 
            echo '
            <div class= "w3-margin-top w3-card-2 w3-padding">
              <div class="w3-col l12">
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="text-right">Customer ID:</th>
                    <td>'.$key['customer_name'].'</th>
                    <th class="text-right">Date:</td>
                    <td>'.$date.'</td>
                    <th class="text-right">Work Order No:</th>
                    <td>#WO-0'.$key['wo_id'].'</td>
                  </tr>
                </tbody>
              </table>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Sr.</th>
                    <th class="text-center">Profile</th>
                    <th class="text-center">Material</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">OD</th>
                    <th class="text-center">Length</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">per Price</th>
                    <th class="text-center">Upload Drawings</th>
                  </tr>
                </thead>
                <tbody>';
                $count=1;
                foreach (json_decode($key['product_associated'],TRUE) as $row) {
                  //print_r($row);
                  echo '
                  <tr>
                    <td class="text-center">
                      <label>'.$count.'.</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['profile_id'].'</label>
                    </td>
                    <td class="text-center">
                      <label>';
                      foreach ($row['material_associated'] as $material) {
                        echo($material['material_id']).'+';
                      }  
                      echo '</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['Prod_ID'][0].'</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['Prod_OD'][0].'</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['Prod_length'][0].'</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['product_quantity'].'</label>
                    </td>
                    <td class="text-center">
                      <label>'.$row['product_price'].'</label>
                    </td>
                    <td class="text-center">
                      <input type="file" name="drawing_1" class="w3-border w3-input" style="">
                    </td>
                  </tr>';
                  $count++;
                }
               echo '</tbody>
              </table>
            </div> 
          </div>

            ';
          }
          }
          

  }
    
}
?>