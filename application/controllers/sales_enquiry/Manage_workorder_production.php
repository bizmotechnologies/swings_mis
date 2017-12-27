<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ERROR | E_PARSE);

class Manage_workorder_production extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        //start session		
      date_default_timezone_set('Asia/Kolkata');       
    }
    
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
    public function getMaterialrecord(){
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getMaterialrecord';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }
//----this fun is used to verify the alloted length and consume length-------------------------//
    public function verify_materiallength(){
        extract($_POST);
       //print_r($_POST);
        $val='';
        $count=1;
        for ($j = 0; $j < count($profile_id); $j++) {
        for ($p = 0; $p < count($_POST['usedlength_'.$count]); $p++) {
            if(($_POST['usedlength_'.$count][$p] != $_POST['consumedtube_'.$count][$p]) || ($_POST['material_name_'.$count][$p] != $_POST['Material_Change_'.$count][$p])){
            echo '<div class="w3-col l12 w3-small">';
            //print_r($profile_id);die();
                echo'<div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Profile Name:</label>
                <input type="hidden" name="wo_id" id="wo_id" value="'.$wo_id.'">
                <input type="hidden" name="profile_id[]" id="profile_id" value="'.$profile_id[$p].'">
                <input type="hidden" name="CustomerName" id="CustomerName" value="'.$CustomerName.'">
                <input type="text" class="form-control" name="ChangedprofileName[]" id="ChangedprofileName" value="'.$profile_name[$j].'" disabled>
                </div>
                
                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Material Name:</label>
                <input type="text" class="form-control" name="ChangedmaterialName[]" id="materialName" value="'.$_POST['material_name_'.$count][$p].'" disabled>
                </div>
                
                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Changed Material:</label>
                <input type="text" class="form-control" name="updatedMaterialName[]" id="updatedMaterialName" value="'.$_POST['Material_Change_'.$count][$p].'" disabled>
                </div>
                </div>  
                
                <div class="w3-col l12">
                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Material ID:</label>
                <input type="text" class="form-control" name="material_innerID[]" id="material_innerID" value="'.$_POST['material_ID_'.$count][$p].'" disabled>
                </div>
                
                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Material OD:</label>
                <input type="text" class="form-control" name="material_outerID[]" id="material_outerID" value="'.$_POST['material_OD_'.$count][$p].'" disabled>
                </div>                

                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Alloted Length:</label>
                <input type="text" class="form-control" name="Allotedmaterial_length[]" id="Allotedmaterial_length" value="'.$_POST['usedlength_'.$count][$p].'" disabled>
                </div>
                
                <div class="w3-col l3 w3-margin-top w3-padding-right">
                <label>Consume Length:</label>
                <input type="text" class="form-control" name="Consumedmaterial_length[]" id="Consumedmaterial_length" value="'.$_POST['consumedtube_'.$count][$p].'" disabled>
                </div>
                </div>

                <div class="w3-col l12">                
                <div class="w3-col l10 w3-margin-top w3-padding-right">
                <label>Reason For Change Length / Material:</label>
                <input type="text" class="form-control" id="reasonForchange" name="reasonForchange[]">
                </div>
                </div>';
                
            }else{
                
            }
        }
        $count++;
        }
    }
//----this fun is used to verify the alloted length and consume length-------------------------//    
//----this fun is used to get the all work order details from wo production-------------------------//

    public function get_Workorderfor_Product_details() {
        extract($_POST);
        $materials = Manage_workorder_production::getMaterialrecord();     //-------show all Raw materials
        
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/get_Workorderfor_Product_details?wo_id='.$Workorder_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
         //print_r($response);

        if ($response['status']==0) {
          echo $response['status_message'];  
  } else {
    foreach ($response['status_message'] as $key) {
      $date=date('d/m/Y',strtotime($key['dated'])); 
      echo'
       <form id="productionForm" name="productionForm" type="post">';
      if($key['query_status'] == 1){$hide = "w3-hide";}
      
      echo'<div id="" class="w3-col l12 w3-small">
        <a class="w3-button btn w3-red '.$hide.'" id="startTime_'.$key['wo_id'].'" onclick="update_start_time('.$key['wo_id'].');"';if($key['open'] == 'open'){ echo'disabled';} echo'>Start Time<i class="w3-margin-left fa fa-clock-o"></i></a>
        <a class="w3-button btn w3-black '.$hide.'" id="endTime_'.$key['wo_id'].'" onclick="update_end_time('.$key['wo_id'].');">End Time<i class="w3-margin-left fa fa-clock-o"></i></a>
        <hr>
      </div>';//----div for start time and end time----------------------------------------//
      }
      echo'<div class= "w3-margin-top w3-card-2">
      <div class="w3-col l12 w3-small">
      <table class="table table-bordered">
      <tbody>
      <tr>
      <th class="text-right">Customer Name:</th>
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
      <div class="w3-col l12 w3-small">
      <table class="table table-bordered table-responsive">
      <thead>
      <tr>
      <th class="text-center">Sr.</th>
      <th class="text-center">Profile</th>
      <th class="text-center">Material</th>
      <th class="text-center">Change Material</th>
      <th class="text-center">Material ID</th>
      <th class="text-center">Material OD</th>
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
      $productQuantity = json_decode($key['modified_quantity'],true);
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
        $profile_id = ($response['status_message']['profile_id']);
        //echo $profile_id;die();
        //------------------get profile name ends---------------------------
        echo '
        <tr id="divno_'.$count.'">
        <td class="text-center">
        <label>'.$count.'.</label>
        </td>
        <td class="text-center">
        <label>'.$profile_name.'</label>
        </td>';
        //-----this td is for to show original material        
        echo'<td class="text-center">';
        foreach ($row['material_associated'] as $material) {
        echo '<input class="form-control" type="text" name="material_Name_'.$count.'[]" id="Material_Name" readonly value="'.$material['material_id'].'">';
        }
        echo'<input type="hidden" name="profile_id[]" id="profile_id" value="'.$row['profile_id'][$count].'">                    
        </td>';
        //-----this td is for to show original material
        //-----this td is for to show changed material and chnage material datalist
        echo'<td>';
        foreach ($row['material_associated'] as $mat){
            echo'<input onclick="this.select();" autocomplete="off" list="MaterialChanged" value="'.$mat['material_id'].'" id="Material_Change" name="Material_Change_'.$count.'[]" class="form-control" type="text" placeholder="Material" ">';
            echo'<datalist id="MaterialChanged">';
                    foreach ($materials['status_message'] as $result) {
                        echo'<option data-value = "'.$result['material_id'].'" value = "'.$result['material_name'].'"></option>';
                    }
                    echo'</datalist>';
        }   
        echo'</td>';
        //-----this td is for to show changed material and chnage material datalist
        //---------td for show materila Inner Dimention
        echo'<td class="text-center">';
        $no = 0;            
        foreach ($row['material_associated'] as $material) {            
        echo'<input class="form-control" type="text" name="material_ID_'.$count.'[]" id="usedlength" readonly value="'.$material['material_ID'][$new][$no].'" </label>';
        $no++;
        }
        echo'</td>';
        //---------td for show materila Inner Dimention
        //---------td for show materila outer Dimention
        echo'<td class="text-center">';
        $no = 0;            
        foreach ($row['material_associated'] as $material) {            
        echo'<input class="form-control" type="text" name="material_OD_'.$count.'[]" id="usedlength" readonly value="'.$material['material_OD'][$new][$no].'" </label>';
        $no++;
        }
        echo'</td>';
        //---------td for show materila outer Dimention
        echo'<input type="hidden" name="profile_name[]" id="profile_name" value="'.$profile_name.'">';
        echo'<input type="hidden" name="wo_id" id="wo_id" value="'.$Workorder_id.'">';
        echo'<input type="hidden" name="CustomerName" id="CustomerName" value="'.$key['customer_name'].'">';
        foreach($row['material_associated'] as $material){
        echo'<input type="hidden" name="material_name_'.$count.'[]" id="material_name" value="'.$material['material_id'].'">';
        }
        echo'<td>';  //----this code for showing the tube for  the material associated
                    $no = 0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<input class="form-control" type="text" name="usedlength_'.$count.'[]" id="usedlength" readonly value="' . ($material['material_Length'][$new][$no]) . '" </label>';
                        $no++;
                    }  //----this code for showing the text box related the material associated
                    echo'</td>';
        echo'<td>';
                    $no=0;
                    foreach ($row['material_associated'] as $material) {
                        echo'<input type="text" class="form-control" id="consumedtube" name="consumedtube_'.$count.'[]" value="'.$material['material_Length'][$new][$no].'" >';
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
        <td class="text-center">';
        
        echo'<label>'.$productQuantity[$new].'</label>
        </td>        
        <td class="text-center">
        <label>'.number_format($row['product_price']/$row['product_quantity'], 2, '.', '').'</label>
        </td>
        </tr>';
        $new++;
        $count++;
      }
      //-----thhis jquery for verify the changed length of workorder
      echo '</tbody>
      </table>
      </div>
      <div class="w3-col l12 w3-small">
      <button type="submit" class="btn w3-right btn-sm w3-blue w3-margin">Verify</button>
      </div>
      </form>
      <form id="raiseQueryForm" name="raiseQueryForm" type="post">
      <div id="show_consume_tube_query"></div>
      <div id="checkqueryerror"></div>
      <div class="w3-col l12">
      <button type="submit" class="btn w3-right btn-sm w3-blue w3-margin"'; if($key['query_status'] == 1){echo'disabled';} if($key['open'] == 'open'){ echo'disabled';} echo'>Submit</button>
      </div>
      </form>';
      //-----thhis jquery for verify the changed length of workorder
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
                $("#show_consume_tube_query").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
</script>';
  //-----thhis jquery for verify the changed length of workorder
  //-----thhis jquery for submit the changed length of workorder
      echo' <script>
      $(function () {
    $("#raiseQueryForm").submit(function () {
        dataString = $("#raiseQueryForm").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: BASE_URL + "sales_enquiry/Manage_workorder_production/Submit_raiseQueryDetails",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#msg_header").text("Message");
                $("#msg_span").css({"color": "black"});
                $("#addMaterials_err").html(data);
                $("#myModalnew").modal("show");            }
        });
        return false;  
    });
});
</script>';
      //-----thhis jquery for submit the changed length of workorder-----//
      //----------this script is used to update the workorder is started here with time and date and closed status----------//
      
      echo'<script>
                    function update_start_time(wo_id){ 
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "sales_enquiry/Manage_workorder_production/update_start_time",
                            data: {
                                wo_id: wo_id
                            },
                            return: false, 
                            success: function (data)
                            {
                                $("#msg_header").text("Message");
                                $("#msg_span").css({"color": "black"});
                                $("#addMaterials_err").html(data);
                                $("#myModalnew").modal("show");
                                $("#startTime_"+wo_id).attr("disabled","disabled");
                                $("input[type=\'submit\']").attr("disabled","disabled");
                                
                            }
                        });
                    }
            </script>';
      //----------this script is used to update the workorder is started here with time and date and closed status----------//
      //----------this script is used to update the workorder is ended here with time and date and closed status----------//
      echo'<script>
                    function update_end_time(wo_id){ 
                    //alert(wo_id);
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "sales_enquiry/Manage_workorder_production/update_end_time",
                            data: {
                                wo_id: wo_id
                            },
                            return: false, 
                            success: function (data)
                            {
                                //alert(data);  
                                $("#msg_header").text("Message");
                                $("#msg_span").css({"color": "black"});
                                $("#addMaterials_err").html(data);
                                $("#myModalnew").modal("show");
                                $("#Demo1").load(location.href + " #Demo1>*", "");
                                $("#showProduction_workorder").load(location.href + " #showProduction_workorder>*", "");
                            }
                        });
                    }
            </script>';
            //----------this script is used to update the workorder is ended here with time and date and closed status----------//

            }
  }
        
    
//----this fun is used to get the all work order details from wo production-------------------------//
    public function Submit_raiseQueryDetails() {
        extract($_POST);
        //print_r($reasonForchange);die();
        $query =array(); 
                                    //---json for add reason for change in wo query
        for($i=0; $i< count($ChangedprofileName); $i++){
           $quotationSpecialistArr = array(
               'wo_id' => $wo_id,
               'ChangedprofileName' => $ChangedprofileName[$i],
               'ChangedmaterialName' => $ChangedmaterialName[$i],
               'UpdatedMaterialName' => $updatedMaterialName[$i],
               'material_ID' => $material_innerID[$i],
               'material_OD' => $material_outerID[$i],
               'Allotedmaterial_length' => $Allotedmaterial_length[$i],
               'Consumedmaterial_length' => $Consumedmaterial_length[$i],
               'reasonForchange' => $reasonForchange[$i]
           );
           $query[] = $quotationSpecialistArr;//---json for add reason for change in wo query
        }
                                                             
        $branch_name=$this->session->userdata('branch_name');//---this is for taking branch name from the session 
        $data['branch_name']=$branch_name;                   //---this is for taking branch name from session 
        
        $data['QueryForQuotationSpecialist']=json_encode($query);
                       //---storing quotation specilist query in json format
        $data['wo_id'] = $wo_id;
        $data['CustomerName'] = $CustomerName;
        
        //---api for save production raised query----------//
        
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/Submit_raiseQueryDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 0) {
            echo $response['status_message'];
        } else {
            echo $response['status_message']; 
        }
    }
//----this fun is used to update the start time of the work order production 
    public function update_start_time() {
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/update_start_time?wo_id='.$wo_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 0) {
            echo $response['status_message'];
        } else {
            echo $response['status_message']; 
        }
    }

//----this fun is used to update the start time of the work order production 
//----this fun is used to update the END time of the work order production 

    public function update_end_time() {
        extract($_POST);
       // print_r($_GET);die();
        $path = base_url();
        $url = $path . 'api/Manage_Workorder_Production_api/update_end_time?wo_id='.$wo_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);die();
        if ($response['status'] == 0) {
            echo $response['status_message'];
        } else {
            echo $response['status_message']; 
        }
    }

    //----this fun is used to update the END time of the work order production
    
    public function cron_job()
  {
    $path = base_url();
    $url = $path . 'api/Manage_Workorder_Production_api/get_Workorderfor_Production';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    foreach ($response['status_message'] as $key) {
      $path = base_url();
      $url = $path .'api/Manage_Workorder_Production_api/get_Workorderfor_Production_details?wo_id='.$key['wo_id'];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPGET, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response_json_forDate = curl_exec($ch);
      curl_close($ch);
      $response_forDate = json_decode($response_json_forDate, true);
      foreach ($response_forDate['status_message'] as $value) {
       $scheduler_status= $value['scheduler_status'];
        $current_date=date('Y-m-d');
        $previous_date=$value['dated'];
        $date1Timestamp = strtotime($current_date);
        $date2Timestamp = strtotime($previous_date);
        $difference = $date1Timestamp - $date2Timestamp;
        $diff= floor($difference / (60 * 60 * 24));
        $date_difference=$diff;
        if( $date1Timestamp== $date2Timestamp){
            echo "scheduler_status".$scheduler_status=0;
        }
        elseif($date_difference==1){
          echo '<th width="4%" scope="col" style="color: green;">'.$date_difference.'</th>';
           echo "scheduler_status".$scheduler_status=1;
        }
        elseif($date_difference==2){
                 echo '<th width="4%" scope="col" style="color: Orange;">'.$date_difference.'</th>';
                 echo "scheduler_status".$scheduler_status=2;
        }
        elseif ($date_difference==3){
              echo '<th width="4%" scope="col" style="color: red;">'.$date_difference.'</th>';
              echo "scheduler_status".$scheduler_status=3;
        }
        elseif($date_difference>=4){
          echo "locked";
          echo "scheduler_status".$scheduler_status=4;
        }       
      }
    $path = base_url();
    $url = $path .'api/Manage_Workorder_Production_api/cron_job?wo_id='.$key['wo_id'].'&scheduler_status='.$scheduler_status;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    }
  }
//----this fun is used to verify the alloted length and consume length-------------------------//    

}
