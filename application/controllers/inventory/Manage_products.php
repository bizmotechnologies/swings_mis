<?php
class Manage_products extends CI_controller{

  public function index(){

   $this->load->model('inventory_model/ManageProduct_model');	
  $data['productdata']=Manage_products::getProduct_Records();     //-------show all materials
  $this->load->view('includes/navigation');
  $data['products'] = $this->ManageProduct_model->getProductsId(); /*fun for get products info*/
  $this->load->view('inventory/products/manage_products', $data);

}

public function getProduct_Records(){

  $path=base_url();
  $url = $path.'api/ManageProducts_api/getProduct_Records';        
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
  return $response;


}

public function showmaterialInfo(){/* this fun is used to get materila info*/

  extract($_POST);
  $path=base_url();
  $url = $path.'api/ManageProducts_api/showmaterialInfo?SelectNew_Material_id_1='.$SelectNew_Material_id_1;    
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
  print_r($response);

}/*show material info fun ends here*/

public function add_products(){/* fun for add products*/

	$this->load->model('inventory_model/ManageProduct_model');
  $data['all_materials'] = $this->ManageProduct_model->getMaterialId(); 
  $this->load->view('includes/navigation');
  $this->load->view('inventory/products/add_products', $data);

}/*funn for addproducts ends here*/

public function Save_Material_product_assoc(){/*this fun for save materila product association*/
  extract($_POST);
      //print_r($_POST);die();
  $data = $_POST;
  $this->load->model('inventory_model/ManageProduct_model');
  $response = $this->ManageProduct_model->Save_Material_product_assoc( $data );
  $count=1;
  if($response['status']==0){
   for($i = 0; $i < count($response['status_message']); $i++) { 
     echo '<tr class="text-center">
     <td class="text-center">'.$count.'</td>
     <td class="text-center">'.$response['status_message'][$i]['material_name'].'</td>
     <td class="text-center"><a class="btn w3-red w3-medium w3-padding-small" title="DeleteProduct" href="'.base_url().'inventory/Manage_products/DeleteMaterialProductAssoc?product_material_assoc_id='.$response['status_message'][$i]['product_material_assoc_id'].'" style="padding:0"><i class="fa fa-close">&nbsp;</i> Delete</a></td>
     </tr>';
     $count++;
   }
 }
 else
 {
   echo'<tr><td style="text-align: center;">No Records Found...!</td></tr>';
 }
}/*--------------funn ends here--------------------------------*/


public function DeleteMaterialProductAssoc(){/* dekete material assocition to product*/
  extract($_GET);
  $data = $_GET;
  $this->load->model('inventory_model/ManageProduct_model');  
  $response = $this->ManageProduct_model->DeleteMaterialProductAssoc($data);
  redirect('inventory/Manage_products');

}/*fun ends here*/
public function save_Products(){/* this fun for add products*/
  extract($_POST);
  $data = $_POST;

  $test=array();
  $calc_arr=array();
  $val=array();
  foreach ($ID_val as $key) {
      $calc_arr[]=$key;  //---------create array of roles to store in feature table
    }

    foreach ($OD_val as $key) {
      $test[]=$key;  //---------create array of roles to store in feature table
    }

    foreach ($SelectNew_Material_id as $key) {
      $val[]=$key;  //---------create array of roles to store in feature table
    }
    $data=array(
      'Input_productName' => $Input_productName, 
      'Inner_dimention' => $Inner_dimention, 
      'Outer_dimention' => $Outer_dimention,
      'input_Thickness' => $input_Thickness,
      'ID_val' => json_encode($calc_arr), 
      'OD_val' => json_encode($test),
      'SelectNew_Material_id' => json_encode($val) 
      //-------json format as ['role-1','role-2',...]
      );
    $path=base_url();
    $url = $path.'api/ManageProducts_api/save_Products';  
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
}/*fun ends here*/


public function DeleteProduct(){/* this fun for delete product*/
	$this->load->model('inventory_model/ManageProduct_model');	
	$records = $this->ManageProduct_model->DeleteProduct($_POST);
	echo'<div class="alert alert-danger w3-margin">
  <strong>'.$records['status_message'].'</strong> 
  </div>
  <script>
  window.setTimeout(function() {
   $(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
  });
location.reload();
}, 1000);
</script>';        
}/*delete product ends here*/

public function DeleteRecord(){ /*this fun for delete product reortds*/
	extract($_GET);
  $data = $_GET;
  //print_r($data);
  $path=base_url();
  $url = $path.'api/ManageProducts_api/DeleteRecord?Product_id='.$Product_id;        
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
            //print_r($response_json);
  redirect('inventory/Manage_products');

}
/*fun ends here*/


public function UpdateRecord(){   /* this fun for update product records*/

  extract($_POST);
  $data = $_POST;

  $path=base_url();
  $url = $path.'api/ManageProducts_api/updateRecord';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);

  $this->load->model('inventory_model/ManageProduct_model');
  $response = $this->ManageProduct_model->UpdateProductRecord( $data );
  if ($response['status'] == 0) {
   redirect('inventory/Manage_products');
 } else {
   redirect('inventory/Manage_products');
 }
}/*ends product records */




}
?>