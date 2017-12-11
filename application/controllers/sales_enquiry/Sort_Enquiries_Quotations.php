<?php
error_reporting(E_ERROR | E_PARSE);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//S-wings Manage_quotations
class Sort_Enquiries_Quotations extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //start session		
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $privilege = $this->session->userdata('privilege');

        //check session variable set or not, otherwise logout
        if (($user_id == '') || ($user_name == '') || ($privilege == '')) {
            redirect('role_login');
        }
    }

    public function index() {
        
    }
    
    //------------this fun is used to get all customer details------------//

    public function sort_Enquiries(){
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Sort_Enquiry_Quotations_api/sort_Enquiries?Enquiry_From_date='.$Enquiry_From_date.'&Enquiry_To_date='.$Enquiry_To_date.'&customer_id='.$customer_idFilter;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);        die();
        $count=1; 
                  if($response['status']==0){
                    echo '<div class="alert alert-danger">
                    <strong>'.$response['status_message'].'</strong> 
                    </div>';
                  }
                  else
                  {
                    foreach ($response['status_message'] as $key) {
                      $date=date('d/m/y', strtotime($key['date_on']));
                      $customer_id=$key['customer_id'];
                      $customer_name=$key['customer_name'];

                      $current_stat='live';
                      $color='w3-green';
                      $hide='';

                      if($key['current_status']=='2'){
                        $current_stat='In PO';
                        $color='w3-red';
                        $hide='w3-hide';
                      }

                      echo                    
                      '<tr>
                      <td class="w3-center">'.$count.'.</td>
                      <td class="w3-center">#ENQ-0'.$key['enquiry_id'].'</td>
                      <td class="w3-center">'.ucwords($customer_name).'</td>
                      <td class="w3-center">'.$date.'</td>
                      <td class="w3-center"><span class="'.$color.'  w3-padding-small w3-round">'.$current_stat.'</span></td>
                      <td>
                      <div class="w3-col l12 w3-text-grey w3-center">
                      <a class="btn w3-medium" style="padding:0px;" data-toggle="modal" data-target="#viewQuote_modal_" title="View Quotation"><i class="fa fa-eye"></i></a>
                      </div>                      
                      </td>
                      </tr>';
                      $count++;
                    }
                  }
                  
        }
    //------------this fun is used to get all customer details------------//
    
    // --------------------- this fun is used to get filter quotation by customer and date ----------------------------------//	

    public function filter_quotation() {
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Sort_Enquiry_Quotations_api/filter_quotation?From_date='.$filter_fromDate.'&To_date='.$filter_toDate.'&customer_id='.$customer_idFilter;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
       // print_r($response_json);        die();
        
        echo'<div id="quotation_table" class="w3-col l12 w3-padding">
                <table class="table table-bordered table-responsive w3-small" ><!-- table starts here -->
                  <tr style="background-color:black; color:white;" >
                    <th class="w3-center">Sr. No</th>
                    <th class="w3-center">Quotation No.</th>              
                    <th class="w3-center">Enquiry No.</th>              
                    <th class="w3-center">Customer</th>              
                    <th class="w3-center">Raised on</th>              
                    <th class="w3-center">Delivery within</th>              
                    <th class="w3-center">Current Status</th> 
                    <th class="w3-center">#&nbsp;Actions</th>                                           
                  </tr>';
                  $count=1; 
                  if($response['status']==0){
                    echo '<div class="alert alert-danger">
                    <strong>'.$response['status_message'].'</strong> 
                    </div>';
                  }
                  else
                  {
                    foreach ($response['status_message'] as $key) {
                      $date=date('d/m/y', strtotime($key['dated']));
                      $delivery_values=explode(' ', $key['delivery_within']);
                      $customer_id=$key['customer_id'];
                      $customer_name=$key['customer_name'];
                      $quotation_id=$key['quotation_id'];

                      $current_stat='live';
                      $color='w3-green';
                      $hide='';

                      if($key['current_status']=='2'){
                        $current_stat='In PO';
                        $color='w3-red';
                        $hide='w3-hide';
                      }

                      echo                    
                      '<tr class="">
                      <td class="w3-center">'.$count.'.</td>
                      <td class="w3-center">#QUO-0'.$quotation_id.'</td>
                      <td class="w3-center">#ENQ-0'.$key['enquiry_id'].'</td>
                      <td class="w3-center">'.ucwords($customer_name).'</td>
                      <td class="w3-center">'.$date.'</td>
                      <td class="w3-center">'.$key['delivery_within'].'</td>
                      <td class="w3-center"><span class="'.$color.'  w3-padding-small w3-round">'.$current_stat.'</span></td>
                      <td>
                      <div class="w3-col l12 w3-text-grey">
                      <a class="btn w3-medium" style="padding:0px;" data-toggle="modal" data-target="#viewQuote_modal_'.$key['quotation_id'].'" title="View Quotation"><i class="fa fa-eye"></i></a>

                      <a class="btn w3-medium '.$hide.'" style="padding:0px;" onclick="send_ToPO('.$quotation_id.');" title="Send to PO"><i class="fa fa-sign-out"></i></a>

                      <a class="btn w3-medium" style="padding:0px;" onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.')" title="Send To Client"><i class="fa fa-envelope"></i></a>
                      </div>                      
                      </td>
                      </tr>
                      ';
                      //onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.');"---- code for mail sending
                      $count++;

                      echo '
                      <!-- Modal start  --> 
                      <div id="viewQuote_modal_'.$key['quotation_id'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content w3-col l12">
                      <div class="modal-header w3-blue">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span class="w3-text-white">Quotation No: #QUO-0'.$key['quotation_id'].'</span></h4>
                      </div>
                      <div class="modal-body">';
                      $products_associatedArr= json_decode($key['product_associated'],true);

                      $enquiry_no=$key['enquiry_id'];
                      $customer_id=$key['customer_id'];
                      $customer_name=$key['customer_name'];
                      $date=date('d M Y', strtotime($key['dated']));
                      $time=date('h:m A', strtotime($key['time_at']));

                      $product_arr=array();
      //print_r($products_associatedArr);die();

                      echo '
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="checkbox">
                      <label title="Toggle the switch to raise this quotation" class="">
                      <input name="revise_quoteBtn" data-onstyle="danger" data-size="mini" id="revise_quoteBtn_'.$key['quotation_id'].'" type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" value="1">
                      <b>Toggle to Revise Quotation</b>
                      </label>                           
                      </div>
                      </div>                      
                      <div class="w3-col l12 w3-small" id="view_quoteDiv_'.$key['quotation_id'].'">
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-left">
                      <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                      <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                      </div>
                      <div class="w3-right">
                      <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                      </div>
                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                      <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Products:</label>

                      <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                      foreach ($products_associatedArr as $value) { 
                        echo '
                        <li>'.strtoupper($value['product_name']).' -';

                        if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                        echo '
                        </li>
                        <ol>
                        <i>
                        <li>'.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                        if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                        echo '@ '.$value['product_price'].' <i class="fa fa-inr"></i> per NO</li>
                        </i>
                        </ol>
                        <br>
                        ';
                      } 
                      echo '</ol>              
                      </div>
                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Delivery within: '.$key['delivery_within'].'</label><br>

                      </div></div><br>';

                      echo '
                      <form id="revise_quoteForm_'.$key['quotation_id'].'">
                      <div class="w3-col l12 w3-small" id="revise_quoteDiv_'.$key['quotation_id'].'" style="display:none">
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-left">
                      <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                      <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                      </div>
                      <div class="w3-right">
                      <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                      </div>
                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                      <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Products:</label>

                      <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                      foreach ($products_associatedArr as $value) { 
                        echo '
                        <li>'.strtoupper($value['product_name']).' -';

                        if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                        echo '
                        </li>
                        <ol>
                        <i>
                        <li>
                        '.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                        if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                        echo '@ 
                        <div class="input-group w3-small" style="width:200px">
                        <input name="revise_productPrice[]" type="number" class="form-control" step="0.01" min="0" value="'.$value['product_price'].'">
                        <span class="input-group-addon"><i class="fa fa-inr"></i> per NO</span>
                        </div>                        
                        </li>
                        </i>
                        </ol>
                        <br>
                        ';
                      } 
                      echo '</ol>              
                      </div>
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-col l12">
                      <label class="w3-label w3-text-red">Delivery within:</label>
                      <input type="number" name="revise_deliverySpan" class="form-control w3-padding-right" style="width:80px" min="0" value="'.$delivery_values[0].'">
                      <select class="w3-input" style="width:120px" name="revise_deliveryPeriod">
                      <option '; if($delivery_values[1]=='day/days'){ echo 'selected'; } echo ' value="1">day/days</option>
                      <option '; if($delivery_values[1]=='week/weeks'){ echo 'selected'; } echo ' value="2">week/weeks</option>
                      <option '; if($delivery_values[1]=='month/months'){ echo 'selected'; } echo ' value="3">month/months</option>
                      <option '; if($delivery_values[1]=='year/years'){ echo 'selected'; } echo ' value="4">year/years</option>
                      </select>
                      </div> 
                      <button class="btn w3-button btn-block w3-red w3-margin-top w3-margin-bottom" type="submit" id="send_quote" name="send_quote">Revise Quotation For Enquiry #ENQ-0'.$enquiry_no.'</button>                     
                      <br>
                      </form>
                      </div><br>
                      </div>';
      //------------------------------products fetched end ----------------------------------//
                      echo '</div>
                      <br><br>

                      </div>
                      <!-- //Modal End  -->
                      <!-- script to toggle i.e.hide/show revise and new quotation div -->
                      <script>
                      $(function() {
                        $("#revise_quoteBtn_'.$key['quotation_id'].'").change(function() {
                          if ($("#revise_quoteBtn_'.$key['quotation_id'].'").is(":checked")) {
                            $("#revise_quoteDiv_'.$key['quotation_id'].'").show();
                            $("#view_quoteDiv_'.$key['quotation_id'].'").hide();
                          }
                          else{
                            $("#revise_quoteDiv_'.$key['quotation_id'].'").hide();
                            $("#view_quoteDiv_'.$key['quotation_id'].'").show();        
                          }
                        })
                      })
                      </script>
                      <!-- script ends -->

                      <!--     script to add revised quotation     -->
                      <script>
                      $(function(){
                        $("#revise_quoteForm_'.$key['quotation_id'].'").submit(function(){
                         dataString = $("#revise_quoteForm_'.$key['quotation_id'].'").serialize();

                         $.ajax({
                           type: "POST",
                           url: "'.base_url().'sales_enquiry/manage_quotations/getEnquiry_DetailsFor_MultipleQuotation",
                           data: dataString,
                           return: false,  //stop the actual form post !important!

                           success: function(data)
                           {
                             $.alert(data);                                     
                           }

                         });
                         return false;  //stop the actual form post !important!

                       });
                     });
                     </script>
                     <!-- script ends here -->
                     ';
                   }
                 }
               echo'</table>
             </div>'; 
    }

    // --------------------- this fun is used to get filter quotation by customer and date ----------------------------------//
    // --------------------- this fun is used to get filter quotations by status ----------------------------------//
    public function sort_byStatus() {
        extract($_POST);

        $path = base_url();
        $url = $path . 'api/Sort_Enquiry_Quotations_api/sort_byStatus?From_date='.$From_date.'&To_date='.$To_date.'&Sort_by='.$Sort_by.'&customer_id='.$customer_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        
        echo'<div id="quotation_table" class="w3-col l12 w3-padding">
                <table class="table table-bordered table-responsive w3-small" ><!-- table starts here -->
                  <tr style="background-color:black; color:white;" >
                    <th class="w3-center">Sr. No</th>
                    <th class="w3-center">Quotation No.</th>              
                    <th class="w3-center">Enquiry No.</th>              
                    <th class="w3-center">Customer</th>              
                    <th class="w3-center">Raised on</th>              
                    <th class="w3-center">Delivery within</th>              
                    <th class="w3-center">Current Status</th> 
                    <th class="w3-center">#&nbsp;Actions</th>                                           
                  </tr>';
                  $count=1; 
                  if($response['status']==0){
                    echo '<div class="alert alert-danger">
                    <strong>'.$response['status_message'].'</strong> 
                    </div>';
                  }
                  else
                  {
                    foreach ($response['status_message'] as $key) {
                      $date=date('d/m/y', strtotime($key['dated']));
                      $delivery_values=explode(' ', $key['delivery_within']);
                      $customer_id=$key['customer_id'];
                      $customer_name=$key['customer_name'];
                      $quotation_id=$key['quotation_id'];

                      $current_stat='live';
                      $color='w3-green';
                      $hide='';

                      if($key['current_status']=='2'){
                        $current_stat='In PO';
                        $color='w3-red';
                        $hide='w3-hide';
                      }

                      echo                    
                      '<tr class="">
                      <td class="w3-center">'.$count.'.</td>
                      <td class="w3-center">#QUO-0'.$quotation_id.'</td>
                      <td class="w3-center">#ENQ-0'.$key['enquiry_id'].'</td>
                      <td class="w3-center">'.ucwords($customer_name).'</td>
                      <td class="w3-center">'.$date.'</td>
                      <td class="w3-center">'.$key['delivery_within'].'</td>
                      <td class="w3-center"><span class="'.$color.'  w3-padding-small w3-round">'.$current_stat.'</span></td>
                      <td>
                      <div class="w3-col l12 w3-text-grey">
                      <a class="btn w3-medium" style="padding:0px;" data-toggle="modal" data-target="#viewQuote_modal_'.$key['quotation_id'].'" title="View Quotation"><i class="fa fa-eye"></i></a>

                      <a class="btn w3-medium '.$hide.'" style="padding:0px;" onclick="send_ToPO('.$quotation_id.');" title="Send to PO"><i class="fa fa-sign-out"></i></a>

                      <a class="btn w3-medium" style="padding:0px;" onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.')" title="Send To Client"><i class="fa fa-envelope"></i></a>
                      </div>                      
                      </td>
                      </tr>
                      ';
                      //onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.');"---- code for mail sending
                      $count++;

                      echo '
                      <!-- Modal start  --> 
                      <div id="viewQuote_modal_'.$key['quotation_id'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content w3-col l12">
                      <div class="modal-header w3-blue">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><span class="w3-text-white">Quotation No: #QUO-0'.$key['quotation_id'].'</span></h4>
                      </div>
                      <div class="modal-body">';
                      $products_associatedArr= json_decode($key['product_associated'],true);

                      $enquiry_no=$key['enquiry_id'];
                      $customer_id=$key['customer_id'];
                      $customer_name=$key['customer_name'];
                      $date=date('d M Y', strtotime($key['dated']));
                      $time=date('h:m A', strtotime($key['time_at']));

                      $product_arr=array();
      //print_r($products_associatedArr);die();

                      echo '
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="checkbox">
                      <label title="Toggle the switch to raise this quotation" class="">
                      <input name="revise_quoteBtn" data-onstyle="danger" data-size="mini" id="revise_quoteBtn_'.$key['quotation_id'].'" type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" value="1">
                      <b>Toggle to Revise Quotation</b>
                      </label>                           
                      </div>
                      </div>                      
                      <div class="w3-col l12 w3-small" id="view_quoteDiv_'.$key['quotation_id'].'">
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-left">
                      <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                      <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                      </div>
                      <div class="w3-right">
                      <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                      </div>
                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                      <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Products:</label>

                      <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                      foreach ($products_associatedArr as $value) { 
                        echo '
                        <li>'.strtoupper($value['product_name']).' -';

                        if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                        echo '
                        </li>
                        <ol>
                        <i>
                        <li>'.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                        if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                        echo '@ '.$value['product_price'].' <i class="fa fa-inr"></i> per NO</li>
                        </i>
                        </ol>
                        <br>
                        ';
                      } 
                      echo '</ol>              
                      </div>
                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Delivery within: '.$key['delivery_within'].'</label><br>

                      </div></div><br>';

                      echo '
                      <form id="revise_quoteForm_'.$key['quotation_id'].'">
                      <div class="w3-col l12 w3-small" id="revise_quoteDiv_'.$key['quotation_id'].'" style="display:none">
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-left">
                      <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                      <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                      </div>
                      <div class="w3-right">
                      <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                      </div>
                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                      <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                      </div>

                      <div class="w3-col l12 w3-margin-bottom">
                      <label class="w3-label w3-text-red">Products:</label>

                      <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                      foreach ($products_associatedArr as $value) { 
                        echo '
                        <li>'.strtoupper($value['product_name']).' -';

                        if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                        echo '
                        </li>
                        <ol>
                        <i>
                        <li>
                        '.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                        if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                        echo '@ 
                        <div class="input-group w3-small" style="width:200px">
                        <input name="revise_productPrice[]" type="number" class="form-control" step="0.01" min="0" value="'.$value['product_price'].'">
                        <span class="input-group-addon"><i class="fa fa-inr"></i> per NO</span>
                        </div>                        
                        </li>
                        </i>
                        </ol>
                        <br>
                        ';
                      } 
                      echo '</ol>              
                      </div>
                      <div class="w3-col l12 w3-margin-bottom">
                      <div class="w3-col l12">
                      <label class="w3-label w3-text-red">Delivery within:</label>
                      <input type="number" name="revise_deliverySpan" class="form-control w3-padding-right" style="width:80px" min="0" value="'.$delivery_values[0].'">
                      <select class="w3-input" style="width:120px" name="revise_deliveryPeriod">
                      <option '; if($delivery_values[1]=='day/days'){ echo 'selected'; } echo ' value="1">day/days</option>
                      <option '; if($delivery_values[1]=='week/weeks'){ echo 'selected'; } echo ' value="2">week/weeks</option>
                      <option '; if($delivery_values[1]=='month/months'){ echo 'selected'; } echo ' value="3">month/months</option>
                      <option '; if($delivery_values[1]=='year/years'){ echo 'selected'; } echo ' value="4">year/years</option>
                      </select>
                      </div> 
                      <button class="btn w3-button btn-block w3-red w3-margin-top w3-margin-bottom" type="submit" id="send_quote" name="send_quote">Revise Quotation For Enquiry #ENQ-0'.$enquiry_no.'</button>                     
                      <br>
                      </form>
                      </div><br>
                      </div>';
      //------------------------------products fetched end ----------------------------------//
                      echo '</div>
                      <br><br>

                      </div>
                      <!-- //Modal End  -->
                      <!-- script to toggle i.e.hide/show revise and new quotation div -->
                      <script>
                      $(function() {
                        $("#revise_quoteBtn_'.$key['quotation_id'].'").change(function() {
                          if ($("#revise_quoteBtn_'.$key['quotation_id'].'").is(":checked")) {
                            $("#revise_quoteDiv_'.$key['quotation_id'].'").show();
                            $("#view_quoteDiv_'.$key['quotation_id'].'").hide();
                          }
                          else{
                            $("#revise_quoteDiv_'.$key['quotation_id'].'").hide();
                            $("#view_quoteDiv_'.$key['quotation_id'].'").show();        
                          }
                        })
                      })
                      </script>
                      <!-- script ends -->

                      <!--     script to add revised quotation     -->
                      <script>
                      $(function(){
                        $("#revise_quoteForm_'.$key['quotation_id'].'").submit(function(){
                         dataString = $("#revise_quoteForm_'.$key['quotation_id'].'").serialize();

                         $.ajax({
                           type: "POST",
                           url: "'.base_url().'sales_enquiry/manage_quotations/getEnquiry_DetailsFor_MultipleQuotation",
                           data: dataString,
                           return: false,  //stop the actual form post !important!

                           success: function(data)
                           {
                             $.alert(data);                                     
                           }

                         });
                         return false;  //stop the actual form post !important!

                       });
                     });
                     </script>
                     <!-- script ends here -->
                     ';
                   }
                 }
               echo'</table>
             </div>';
        
    }

    // --------------------- this fun is used to get filter quotations by status ----------------------------------//
}
