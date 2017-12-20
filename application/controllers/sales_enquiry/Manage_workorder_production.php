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
//----this fun is used to verify the alloted length and consume length-------------------------//
    public function verify_materiallength(){
        extract($_POST);
        print_r($_POST);
        $val='';
        $count=1;
        for ($j = 0; $j < count($profile_id); $j++) {
        for ($p = 0; $p < count($_POST['usedlength_'.$count]); $p++) {
            //print_r($_POST['usedlength_'.$count]);
            //print_r($_POST['consumedtube_'.$count]);
            if($_POST['usedlength_'.$count][$p] == $_POST['consumedtube_'.$count][$p]){
                //echo 'No change in consumed tube';
            }else{
                echo '<div class="w3-col l12">
                <div class="w3-col l6"><label>Profile Name</label>
                <input type="hidden" name="wo_id" id="wo_id" value="'.$wo_id.'">
                <input type="text" name="ChangedprofileName[]" id="ChangedprofileName" value="'.$profile_name[$j].'">
                </div>
                <div><label>Material Name</label>
                <input type="text" name="ChangedmaterialName[]" id="materialName" value="'.$_POST['material_name_'.$count][$p].'">
                </div>
                <div><label>alloted Length</label>
                <input type="text" name="Allotedmaterial_length[]" id="Allotedmaterial_length" value="'.$_POST['usedlength_'.$count][$p].'">
                </div>
                <div><label>Consume Length</label>
                <input type="text" name="Consumedmaterial_length[]" id="Consumedmaterial_length" value="'.$_POST['consumedtube_'.$count][$p].'">
                </div>
                <div><label>Reason For Change Length</label>
                <textarea class="form-control" rows="3" id="comment"></textarea>
                </div>
                </div>';
            }
        }
        $count++;
        }
    }
//----this fun is used to verify the alloted length and consume length-------------------------//    
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
       <form id="productionForm" name="productionForm" type="post">   
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
        <td class="text-center">';
                    foreach ($row['material_associated'] as $material) {
                        echo' <label>';
                        echo($material['material_id']);
                        echo '</label>';
                    }
                    echo'<input type="hidden" name="profile_id[]" id="profile_id" value="'.$row['profile_id'].'">
                    
        </td>';
        echo'<input type="hidden" name="profile_name[]" id="profile_name" value="'.$profile_name.'">';
        echo'<input type="hidden" name="wo_id" id="wo_id" value="'.$Workorder_id.'">';
        foreach($row['material_associated'] as $material){
        echo'<input type="hidden" name="material_name_'.$count.'[]" id="material_name" value="'.$material['material_id'].'">';
        }
        echo'<td>';  //----this code for showing the tube for  the material associated
                    $no = 0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<input class="form-control" type="text" name="usedlength_'.$count.'[]" id="usedlength" value="' . ($material['material_Length'][$new][$no]) . '" </label>';
                        $no++;
                    }  //----this code for showing the text box related the material associated
                    echo'</td>';
        echo'<td>';
                    $no=0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<input type="text" class="form-control" id="consumedtube" name="consumedtube_'.$count.'[]" value="'.$material['material_Length'][$new][$no].'" onkeyup="getconsumetube('.$count.');">';
                        $no++;
                    }  //----this code for showing the text box related the material associated
        echo'</td>
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
      </table>
      <div class="w3-col l12">
      <button type="submit" class="btn w3-right btn-sm w3-blue w3-margin">Verify</button>
      </div>
      </form>
      <form>
      <div id="show_consume_tube_query"></div>
      <div class="w3-col l12">
      <button type="submit" class="btn w3-right btn-sm w3-blue w3-margin">Submit</button>
      </div>
      </form>';
      echo'
          <script>
      $(function () {
    $("#productionForm").submit(function () {
        dataString = $("#productionForm").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: BASE_URL + "sales_enquiry/Manage_workorder_production/verify_materiallength",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                //alert(data);
                $("#show_consume_tube_query").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
</script>';
            }
  }
        
    }
//----this fun is used to get the all work order details from wo production-------------------------//

}
