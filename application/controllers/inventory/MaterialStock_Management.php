<?php

error_reporting(E_ERROR | E_PARSE);

class MaterialStock_Management extends CI_controller {

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
    }


    public function index() {

        $response['All_Material'] = MaterialStock_Management::GetMaterialDetails(); // this fun shows that the select material values
        $response['vendors'] = MaterialStock_Management::GetVendorsDetails(); // this fun shows that the select material values
        $response['values'] = MaterialStock_Management::Get_Purchase_Stock(); // this fun shows that the select material values
        $response['details'] = MaterialStock_Management::GetRawMaterialInfoDetails(); // this fun shows that the select material values
        $response['product'] = MaterialStock_Management::GetProductsName();
        $response['Purchased'] = MaterialStock_Management::GetPurchaseProductsName();
        $response['Finished'] = MaterialStock_Management::GetFinishedInformationDetails();
        $response['materials'] = MaterialStock_Management::getMaterialrecord();     //-------show all materials
        $response['Fg_info']=MaterialStock_Management::GetFinishedGoodsDetails();
        $response['quotation']=MaterialStock_Management::GetQuotationIdFromquoation_master();    //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/stock/materialstock_management', $response);
    }
    public function GetFinishedGoodsDetails()
    {
         $path=base_url();
         $url = $path.'api/finished_good_api/GetFinishedGoodsDetails';   
         // $url = $path.'api/Wo_get_all_infoapi/sget_all_wo_id?wo_id='.$wo_id;    
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_HTTPGET, true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response_json = curl_exec($ch);
         curl_close($ch);
         $response=json_decode($response_json, true);
         return $response;
    }
    
     public function GetQuotationIdFromquoation_master() {

        $path = base_url();
        $url = $path . 'api/finished_good_api/GetQuotationIdFromquoation_master';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response);
        return $response;
    }

//----this fun is used to filter the materials 
    public function showmaterialCategory(){
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/MaterialStockManagement_api/showmaterialCategory?material_id='.$material_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        $response = json_encode($response['status_message'][0]);
        print_r($response);
    }
    public function FilterMaterialBy_Name(){
        extract($_POST);
        $material_id=$Material_idForMaterialFilter;
        if($Material_idForMaterialFilter=='undefined'){
            $material_id=0;
        }
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getMaterialrecord_filter?material_id='.$material_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);


        if($response['status']==1){

            echo '
            <table class="table table-striped table-responsive w3-small"> 
            <!-- table starts here -->
            <thead>
            <tr class="w3-black">
            <th class="text-center">SR. No</th>
            <th class="text-center">Material&nbsp;Name</th>  
            <th class="text-center">ID</th>              
            <th class="text-center">OD</th>              
            <th class="text-center">Available&nbsp;Length</th>              
            <th class="text-center">Tolerance</th>
            <th class="text-center">Price/Unit</th>
            <th class="text-center">Branch</th>
            <th class="text-center">Actions</th>  

            </tr>
            </thead>
            <tbody ><!-- table body starts here -->';
            $count = 1;
            if ($response['status'] == 1) {
                for ($i = 0; $i < count($response['status_message']); $i++) {
                    echo '<tr class="text-center">
                    <td class="text-center">' . $count . '.</td>
                    <td class="text-center"><input type="text" name="Updated_MaterialStock_Materialname" id="Updated_MaterialStock_Materialname_'.$response['status_message'][$i]['rawmaterial_id'].'" class="form-control" value="' . $response['status_message'][$i]['material_name'] . '"></td>
                    <td class="text-center">' . $response['status_message'][$i]['raw_ID'] . '</td>
                    <td class="text-center">' . $response['status_message'][$i]['raw_OD'] . '</td>
                    <td class="text-center"><input type="number" name="Updated_MaterialStock_Length" id="Updated_MaterialStock_Length_'.$response['status_message'][$i]['rawmaterial_id'].'" class="form-control" value="' . $response['status_message'][$i]['avail_length'] . '"></td>
                    <td class="text-center">' . $response['status_message'][$i]['tolerance'] . '</td>
                    <td class="text-center">' . $response['status_message'][$i]['material_price'] . ' <i class="fa fa-rupee"></i></td>
                    <td class="text-center">' . $response['status_message'][$i]['branch_name'] . '</td>
                    <td class="text-center"><a class="btn w3-text-blue w3-medium w3-padding-small" id="update_rawMaterial_'.$response['status_message'][$i]['rawmaterial_id'].'" onclick="update_rawMaterial('.$response['status_message'][$i]['rawmaterial_id'].')" title="Update Raw Material" style="padding:0"><i class="fa fa-edit"></i></a>
                    <a class="btn w3-text-red w3-medium w3-padding-small" title="Delete Raw Material" id="delete_rawMaterial_'.$response['status_message'][$i]['rawmaterial_id'].'" onclick="delete_rawMaterial('.$response['status_message'][$i]['rawmaterial_id'].')" style="padding:0"><i class="fa fa-close"></i>
                    </a> 
                    </td>
                    </tr>';
                    $count++;
                }
            } else {
                echo'<tr><td style="text-align: center;" colspan = "9">No Records Found...!</td></tr>';
            }

            echo '</tbody><!-- table body close here -->
            </table>   <!-- table closed here -->
            ';
        }
        else{
            echo '
            <div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>' . $response['status_message'] . '</strong> 
            </div>    
            ';
        }
    }

//this fun is used to get all prices from price list---------------------------------------    
    public function GetPriceFromPriceList() {
        extract($_POST);
        $data = $_POST;

        $path = base_url();
        $url = $path . 'api/MaterialStockManagement_api/GetPriceFromPriceList';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        echo $response;
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

//----------------this fun is for get total info of materials---------------//

    public function Save_PurchasedProduct_Info() {
        extract($_POST);
        $data = $_POST;
        
        $path = base_url();
        $url = $path . 'api/MaterialStockManagement_api/Save_PurchasedProduct_Info';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

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
          }, 1000);
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
      }, 1000);
      </script>';
  }
}
public function UpdateMaterialCategory(){
    extract($_POST);
    $data = $_POST;
        //print_r($data);die();
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/UpdateMaterialCategory';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    if ($response['status'] == 0) {
        echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
        <strong>' . $response['status_message'] . '</strong> 
        </div>
        <script>
        window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
          });
      }, 1000);
      </script>';
  } else {
    echo'<div class="alert alert-success w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    <script>
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  }, 1000);
  </script>';
}
}

//-----------------------------api to fetch excel to db-------------//
public function EXCELDB() {

    $data = '';
    print_r($data); die();

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/excelTodb';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    print_r($response_json);die();
}
    //------------------------------------------------------------------//

public function Delete() {
    extract($_POST);

    $path = base_url();
    $url = $path . 'api/ManageMaterial_api/deleteRecord?material_id=' . $Select_NewMaterials_Id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
}

public function GetPurchaseProductsName() {
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetPurchaseProductsName';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    return $response;
}

public function GetFinishedInformationDetails() {
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetFinishedInformationDetails';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    return $response;
}

public function GetProductsName() {
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetProductsName';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    return $response;
}

/* --------------this fun for geting all material information ----------------------- */

public function GetRawMaterialInfoDetails() {

    $branch_name=$this->session->userdata('branch_name');

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetRawMaterialInfoDetails?branch_name='.$branch_name;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    return $response;
    
}

/* --------------this fun for geting all material information ----------------------- */

/* --------------this fun for geting all material information ----------------------- */

public function GetMaterialDetails() {
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetMaterialDetails';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    return $response;
}

/* --------------this fun for geting all material information ----------------------- */

/* --------------this fun for geting all Vendor information ----------------------- */

public function GetVendorsDetails() {

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/GetVendorsDetails';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    return $response;
}

/* --------------this fun for geting all material information ----------------------- */

/* --------------this fun for geting all Purchased product information ----------------------- */

public function Get_Purchase_Stock() {

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Get_Purchase_Stock';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    return $response;
}

/* --------------this fun for geting all purchased product information ----------------------- */

/* --------------this fun is for save raw material stock information ----------------------- */

public function Save_RawStockMaterial_Info() {

    extract($_POST);
    $data = $_POST;
    $branch_name=$this->session->userdata('branch_name');
    $data['branch_name']=$branch_name;        
    $price = $Input_RawMaterialPrice;

    if (isset($checkPrice)) {
        $price = $Input_RawMaterialPriceFrom_Pricelist;
    }

    $data['price'] = $price;
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Save_RawStockMaterial_Info';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
        //print_r($response_json);die();
    if ($response['status'] == 0) {
        echo'<div class="alert w3-red w3-margin" style="text-align: center;">
        <strong>' . $response['status_message'] . '</strong> 
        </div>
        <script>
        window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 

          });
      }, 1000);
      </script>';
  } else {
    echo'<div class="alert w3-green w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    <script>
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
  }, 1000);
  </script>';
}
}

/* --------------this fun is for save raw material stock information ----------------------- */


/* --------------this fun is for Delete raw material stock information ----------------------- */

public function DeleteRawMaterialStockDetails() {
    extract($_GET);
    $data = $_GET;

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/DeleteRawMaterialStockDetails?rawmaterial_id=' . $rawmaterial_id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
}

/* --------------this fun is for save raw material stock information ----------------------- */

public function Update_Finishedproducts_Info() {

    extract($_POST);
    $data = $_POST;
        //print_r($data); die();
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Update_Finishedproducts_Info';
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
      }, 1000);
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
  }, 1000);
  </script>';
}
}

public function Update_UpdatedStockMaterial_Info() {

    extract($_POST);
    $data = $_POST;

    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Update_UpdatedRawStockMaterial_Info';
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
        ';
    } else {
        echo'<div class="alert alert-success w3-margin" style="text-align: center;">
        <strong>' . $response['status_message'] . '</strong> 
        </div>
        ';
    }
}

public function Update_purchasedproducts_Info() {

    extract($_POST);
    $data = $_POST;
        // print_r($data); die();
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Update_purchasedproducts_Info';
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
      }, 1000);
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
  }, 1000);
  </script>';
}
}

public function DeleteFinishedProductDetails() {
    extract($_GET);
    $data = $_GET;
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/DeleteFinishedProductDetails?finished_product_id=' . $finished_product_id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    redirect('inventory/MaterialStock_Management');
}

public function DeletePurchasedStockDetails() {
    extract($_GET);
    $data = $_GET;
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/DeletePurchasedStockDetails?purchased_product_id=' . $purchased_product_id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);

    redirect('inventory/MaterialStock_Management');
}


public function Save_FinishedProduct_Info() {

    extract($_POST);
    $data = $_POST;
        //print_r($data);
    $path = base_url();
    $url = $path . 'api/MaterialStockManagement_api/Save_FinishedProduct_Info';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
        //print_r($response_json);
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
      }, 1000);
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
  }, 1000);
  </script>';
}
}

public function DeleteStockDetails() { /* this is the fun for delete stock details */

    extract($_GET);
        // print_r($_GET);die();
    $data = $_GET;
    $this->load->model('inventory_model/MaterialStockManagement_model');
    $records = $this->MaterialStockManagement_model->DeleteStockDetails($data);
    redirect('inventory/MaterialStock_Management');
}

/* this fun for delete stock details ends here */

public function ShowMaterialStock() { /* this show material stock fun is used to show all stocks quantity */

    extract($_POST);
        //print_r($_POST);die();
    $data = $_POST;
    $this->load->model('inventory_model/MaterialStockManagement_model');
    $response = $this->MaterialStockManagement_model->showMaterial($data);
        //print_r($response);
    if ($response['status'] == 0) {
        echo $response['status_message'];
    } else {
        echo trim($response['status_message']);
    }
}

/* this show material fun ends here */
}

?>