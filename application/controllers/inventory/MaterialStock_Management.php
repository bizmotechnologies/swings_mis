<?php
class MaterialStock_Management extends CI_controller{

public function index(){

  $response['All_Material'] =MaterialStock_Management::GetMaterialDetails();// this fun shows that the select material values
  $response['vendors'] =MaterialStock_Management::GetVendorsDetails();// this fun shows that the select material values
  $response['values'] =MaterialStock_Management::Get_Purchase_Stock();// this fun shows that the select material values
  $response['details'] =MaterialStock_Management::GetRawMaterialInfoDetails();// this fun shows that the select material values
  $response['product'] =MaterialStock_Management::GetProductsName();
  $response['Purchased']=MaterialStock_Management::GetPurchaseProductsName();
  $this->load->view('includes/navigation');
  $this->load->view('inventory/stock/materialstock_management', $response);

	}



public function Save_PurchasedProduct_Info(){

        extract($_POST);
        $data = $_POST;
        //print_r($data);
        $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/Save_PurchasedProduct_Info';    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        //print_r($response_json);die();

       if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
            }, 1000);
            </script>';
          }else{
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
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

public function GetPurchaseProductsName(){
  $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/GetPurchaseProductsName';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        return $response;
}

public function GetProductsName(){
  $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/GetProductsName';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        return $response;
}

/*--------------this fun for geting all material information -----------------------*/
  public function GetRawMaterialInfoDetails(){

      $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/GetRawMaterialInfoDetails';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        return $response;

  }/*--------------this fun for geting all material information -----------------------*/

/*--------------this fun for geting all material information -----------------------*/
  public function GetMaterialDetails(){

      $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/GetMaterialDetails';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        return $response;

  }/*--------------this fun for geting all material information -----------------------*/

/*--------------this fun for geting all Vendor information -----------------------*/

  public function GetVendorsDetails(){

    $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/GetVendorsDetails';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        return $response;
  }/*--------------this fun for geting all material information -----------------------*/

/*--------------this fun for geting all Purchased product information -----------------------*/

  public function Get_Purchase_Stock(){

    $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/Get_Purchase_Stock';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        return $response;
  }/*--------------this fun for geting all purchased product information -----------------------*/

  /*--------------this fun is for save raw material stock information -----------------------*/

public function Save_RawStockMaterial_Info(){

        extract($_POST);
        $data = $_POST;
        //print_r($data);
        $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/Save_RawStockMaterial_Info';    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

       if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
            }, 1000);
            </script>';
          }else{
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
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
  /*--------------this fun is for save raw material stock information -----------------------*/


  /*--------------this fun is for Delete raw material stock information -----------------------*/

public function DeleteRawMaterialStockDetails(){
  extract($_GET);
  $data = $_GET;
  $path=base_url();
            $url = $path.'api/MaterialStockManagement_api/DeleteRawMaterialStockDetails?rawmaterial_id='.$rawmaterial_id;        
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);

            redirect('inventory/MaterialStock_Management');      

}
  /*--------------this fun is for save raw material stock information -----------------------*/

public function Update_UpdatedRawStockMaterial_Info(){

  extract($_POST);
  $data = $_POST;
  //print_r($data); die();
    $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/Update_UpdatedRawStockMaterial_Info';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        //print_r($response_json);die();
        if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
            }, 1000);
            </script>';
          }else{
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
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

public function Save_StockMaterial_Info(){ // this fun for add stock by vender to stocks
	extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
	$this->load->model('inventory_model/MaterialStockManagement_model');
    $response = $this->MaterialStockManagement_model->Save_StockMaterial_Info($data);

    if($response['status'] == 0){
	echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
            location.reload();
            }, 1000);
            </script>';
          }else{
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
            location.reload();
            }, 1000);
            </script>';

          }

}/*save stock material info fun ends here*/

public function Update_UpdatedStockMaterial_Info(){  /* this update fun is used to update stock material*/

    extract($_POST);
    $data = $_POST;
    $this->load->model('inventory_model/MaterialStockManagement_model');
    $response = $this->MaterialStockManagement_model->Update_UpdatedStockMaterial_Info($data);
    //print_r($response);
    if($response['status'] == 0)
       {
                echo $response['status_message'];
       }
       else
       {
                echo trim($response['status_message']);
       }

}  /*this update fun is ends here*/

public function DeleteStockDetails(){   /*this is the fun for delete stock details*/

  extract($_GET);
     // print_r($_GET);die();
  $data = $_GET;
  $this->load->model('inventory_model/MaterialStockManagement_model');  
  $records = $this->MaterialStockManagement_model->DeleteStockDetails($data);
    redirect('inventory/MaterialStock_Management');

}/*this fun for delete stock details ends here*/

public function ShowMaterialStock(){   /* this show material stock fun is used to show all stocks quantity*/

	extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
    $this->load->model('inventory_model/MaterialStockManagement_model');
    $response = $this->MaterialStockManagement_model->showMaterial($data);
    //print_r($response);
    if($response['status'] == 0)
       {
      	        echo $response['status_message'];
       }
       else
       {
      	      	echo trim($response['status_message']);
       }

       }/*this show material fun ends here*/

}
?>