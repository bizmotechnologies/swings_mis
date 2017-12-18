<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ERROR | E_PARSE);

class Manage_workorder_production extends CI_Controller {

    public function index() {
        $data['wo_info'] = Manage_workorder_production::get_Workorderfor_Production();
        $this->load->view('includes/navigation.php');
        $this->load->view('sales/manage_workorder_production.php', $data);
    }
//----this fun is used to get the all wo id for from wo production-------------------------//
    public function get_Workorderfor_Production() {
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/get_Workorderfor_Production';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }
//----this fun is used to get the all wo id for from wo production-------------------------//
//----this fun is used to get the all work order details from wo production-------------------------//

    public function get_Workorderfor_Production_details() {
        extract($_POST);
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/get_Workorderfor_Production_details?wo_id='.$Workorder_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
 
        if ($response['status']==0) {
          echo $response['status_message'];  
  } else {
    foreach ($response['status_message'] as $key) {
      $date=date('d/m/Y',strtotime($key['dated'])); 
      echo '
      <div class= "w3-margin-top w3-card-2">
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
      </div>
      <table class="table table-bordered table-responsive">
      <thead>
      <tr>
      <th class="text-center">Sr.</th>
      <th class="text-center">Profile</th>
      <th class="text-center">Material</th>      
      <th class="text-center">ID</th>
      <th class="text-center">OD</th>
      <th class="text-center">Length</th>
      <th class="text-center">Used Tube</th>
      <th class="text-center">Consume Tube</th>      
      <th class="text-center">Qty</th>
      <th class="text-center">per Piece (<i class="fa fa-inr"></i>)</th>
      </tr>
      </thead>
      <tbody>';
      $count=1;
      foreach (json_decode($key['product_associated'],TRUE) as $row) {
                  
        //-----------------get profile name----------------------
        $path=base_url();
        $url = $path.'api/ManageProfile_api/profileDetails?profile_id='.$row['profile_id']; 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        $profile_name=($response['status_message'][0]['profile_name']);
        //echo $profile_name;
        //------------------get profile name ends---------------------------
        echo '
        <tr>
        <td class="text-center">
        <label>'.$count.'.</label>
        </td>
        <td class="text-center">
        <label>'.$profile_name.'</label>
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
        <td class="text-center">';
        $no = 0;
        foreach ($row['material_associated'] as $material) {
          echo($material['best_tube'][$no]);
          $no++;
        }  
        echo '</td>
        <td class="text-center">
        <input type="text" name="consume" id="consume">
        </td>
        <td class="text-center">
        <label>'.$row['product_quantity'].'</label>
        </td>        
        <td class="text-center">
        <label>'.number_format($row['product_price']/$row['product_quantity'], 2, '.', '').'</label>
        </td>
        </tr>';
        $count++;
      }
      echo '</tbody>
      </table>';     
    }
  }
        
    }
//----this fun is used to get the all work order details from wo production-------------------------//

}
