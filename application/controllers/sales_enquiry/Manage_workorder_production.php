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
          
      <div id="" class="w3-col l12">
        <a class="w3-button w3-red" href="#">Start Time<i class="w3-margin-left fa fa-clock-o"></i></a>
        <a class="w3-button w3-black" href="#">End Time<i class="w3-margin-left fa fa-clock-o"></i></a>
        <hr>
      </div>
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
      <th class="text-center">Alloted Length</th>
      <th class="text-center">Consume Length</th>      
      <th class="text-center">ID</th>
      <th class="text-center">OD</th>
      <th class="text-center">Length</th>      
      <th class="text-center">Qty</th>
      <th class="text-center">per Piece (<i class="fa fa-inr"></i>)</th>
      </tr>
      </thead>
      <tbody>';
      $count=1;
      $new = 0;
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
        <tr id="divno_'.$count.'">
        <td class="text-center">
        <label>'.$count.'.</label>
        </td>
        <td class="text-center">
        <label>'.$profile_name.'</label>
        </td>
        <td class="text-center">
        <table>';
                    foreach ($row['material_associated'] as $material) {
                        echo' <tr><td><label>';
                        echo($material['material_id']);
                        echo '</label><td></tr>';
                    }
                    echo'</table>
        <input type="hidden" name="profile_id" id="profile_id" value="'.$row['profile_id'].'">
        </td>
        <td>
        <table id="lengthtable">';
                    //----this code for showing the tube for  the material associated
                    $no = 0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<tr><td>';
                        echo'<input type="text" name="usedlength[]" id="usedlength" value="' . ($material['material_Length'][$new][$no]) . '" </label>';
                        echo'</td></tr>';
                        $no++;
                    }  //----this code for showing the text box related the material associated
                    echo'</table>
        </td>
        <td>
        <table id="mytable">'; //----this code for showing the text box related the material associated
                    $no=0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<tr><td>';                       
                        echo'<input type="text" id="consumedtube" name="consumedtube[]" value="'.$material['material_Length'][$new][$no].'" onkeyup="getconsumetube('.$count.');">';
                        echo'</td></tr>';
                        $no++;
                    }  //----this code for showing the text box related the material associated
                    echo'</table>
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
