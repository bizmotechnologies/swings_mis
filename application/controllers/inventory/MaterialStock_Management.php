<?php
class MaterialStock_Management extends CI_controller{
  public function __construct(){
    parent::__construct();  
    //start session   
    $user_id=$this->session->userdata('user_id');
    $user_name=$this->session->userdata('user_name');
    $privilege=$this->session->userdata('privilege');
    
    //check session variable set or not, otherwise logout
    if(($user_id=='') || ($user_name=='') || ($privilege=='')){
      redirect('role_login');
    }   
  }
  public function index(){

  $response['All_Material'] =MaterialStock_Management::GetMaterialDetails();// this fun shows that the select material values
  $response['vendors'] =MaterialStock_Management::GetVendorsDetails();// this fun shows that the select material values
  $response['values'] =MaterialStock_Management::Get_Purchase_Stock();// this fun shows that the select material values
  $response['details'] =MaterialStock_Management::GetRawMaterialInfoDetails();// this fun shows that the select material values
  $response['product'] =MaterialStock_Management::GetProductsName();
  $response['Purchased']=MaterialStock_Management::GetPurchaseProductsName();
  $response['Finished']=MaterialStock_Management::GetFinishedInformationDetails();
  $this->load->view('includes/navigation');
  $this->load->view('inventory/stock/materialstock_management', $response);

}



public function Save_PurchasedProduct_Info(){

  extract($_POST);
  $data = $_POST;
        //print_r($data);
<<<<<<< HEAD
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
=======
        $path=base_url();
        $url = $path.'api/MaterialStockManagement_api/Save_PurchasedProduct_Info';    
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
              location.reload();
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
            location.reload();
             });
            }, 1000);
            </script>';

          }
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96

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

public function GetFinishedInformationDetails(){
  $path=base_url();
  $url = $path.'api/MaterialStockManagement_api/GetFinishedInformationDetails';        
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
<<<<<<< HEAD
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
=======
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
                          location.reload();
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
                          location.reload(); 
             });
            }, 1000);
            </script>';

          }
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96
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

public function Update_Finishedproducts_Info(){

  extract($_POST);
  $data = $_POST;
  //print_r($data); die();
  $path=base_url();
  $url = $path.'api/MaterialStockManagement_api/Update_Finishedproducts_Info';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
        //print_r($response_json);die();
<<<<<<< HEAD
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
=======
        if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            location.reload();
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
            location.reload();          
             });
            }, 1000);
            </script>';

          }
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96

}

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
<<<<<<< HEAD
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
=======
        if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            location.reload();              
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
            location.reload();              
             });
            }, 1000);
            </script>';

          }
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96

}


public function Update_purchasedproducts_Info(){

 extract($_POST);
 $data = $_POST;
      // print_r($data); die();
 $path=base_url();
 $url = $path.'api/MaterialStockManagement_api/Update_purchasedproducts_Info';
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $response_json = curl_exec($ch);
 curl_close($ch);
 $response=json_decode($response_json, true);
        //print_r($response_json);die();
<<<<<<< HEAD
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
=======
        if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            location.reload();              
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
            location.reload();              
             });
            }, 1000);
            </script>';

          }
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96

}

public function DeleteFinishedProductDetails(){
  extract($_GET);
  $data = $_GET;
  $path=base_url();
  $url = $path.'api/MaterialStockManagement_api/DeleteFinishedProductDetails?finished_product_id='.$finished_product_id;        
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);

  redirect('inventory/MaterialStock_Management');
}

public function DeletePurchasedStockDetails(){
  extract($_GET);
  $data = $_GET;
  $path=base_url();
  $url = $path.'api/MaterialStockManagement_api/DeletePurchasedStockDetails?purchased_product_id='.$purchased_product_id;        
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);

  redirect('inventory/MaterialStock_Management');
}


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

public function Save_FinishedProduct_Info(){

  extract($_POST);
  $data = $_POST;
        //print_r($data);
  $path=base_url();
  $url = $path.'api/MaterialStockManagement_api/Save_FinishedProduct_Info';    
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
        //print_r($response_json);
<<<<<<< HEAD
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
=======
        if($response['status'] == 0){
       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            location.reload();              
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
            location.reload();              
             });
            }, 1000);
            </script>';
>>>>>>> 41fe651ad200f00afae060f1a747e575806e4d96
}
}

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