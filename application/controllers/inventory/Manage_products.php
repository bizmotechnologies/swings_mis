<?php
class Manage_products extends CI_controller{

public function index(){

	$this->load->model('inventory_model/ManageProduct_model');	
	$data['all_categories'] = $this->ManageProduct_model->getProductcategory();	
  $data['productdata'] = $this->ManageProduct_model->getProduct_Records();
  $this->load->view('includes/navigation');
  $data['products'] = $this->ManageProduct_model->getProductsId(); /*fun for get products info*/
  $this->load->view('inventory/products/manage_products', $data);

	}

public function showmaterialInfo(){/* this fun is used to get materila info*/

    extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
    $this->load->model('inventory_model/ManageProduct_model');
    $price = $this->ManageProduct_model->showmaterialInfo($data);
    print_r($price);die();

}/*show material info fun ends here*/
 
public function add_products(){/* fun for add products*/

	$this->load->model('inventory_model/ManageProduct_model');
  $data['all_materials'] = $this->ManageProduct_model->getMaterialId(); 
	$data['all_categories'] = $this->ManageProduct_model->getProductcategory();
	$this->load->view('inventory/products/add_products', $data);

}/*funn for addproducts ends here*/
public function Show_Material_Product_Association(){/* fun for show materials product associatoion */

    extract($_POST);
    $data = $_POST;
    $this->load->model('inventory_model/ManageProduct_model');  
    $response = $this->ManageProduct_model->Show_Material_Product_Association($data);

    $count=1;
      if($response['status']==0){
     for($i = 0; $i < count($response['status_message']); $i++) { 
           echo '<tr class="text-center">
                 <td class="text-center">'.$count.'</td>
                 <td class="text-center">'.$response['status_message'][$i]['material_name'].'</td>
                 <td class="text-center"><a class="btn w3-red w3-medium w3-padding-small" title="DeleteProduct" href="'.base_url().'inventory/Manage_products/DeleteMaterialProductAssoc?product_material_assoc_id='.$response['status_message'][$i]['product_material_assoc_id'].'" style="padding:0"><i class="fa fa-close"></i>Delete</a></td>
                 </tr>';
                  $count++;
               }
              }
             else
            {
             echo'<tr><td style="text-align: center;">No Records Found...!</td></tr>';
            }


}/*fun ends here*/
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
}/*funn ends here*/


public function DeleteMaterialProductAssoc(){/* dekete material assocition to product*/
  extract($_GET);
  $data = $_GET;
  $this->load->model('inventory_model/ManageProduct_model');  
  $response = $this->ManageProduct_model->DeleteMaterialProductAssoc($data);
  redirect('inventory/Manage_products');

}/*fun ends here*/
public function save_Products(){/* this fun for add products*/
  
	$data = $this->input->post();
	$this->load->model('inventory_model/ManageProduct_model');
	$response = $this->ManageProduct_model->save_Products($data);

 // print_r($response); die();
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
	$this->load->model('inventory_model/ManageProduct_model');	
	$records = $this->ManageProduct_model->DeleteRecord($data);
}
/*fun ends here*/
public function addProductCategory(){/*this fun for add product category*/

	$this->load->model('inventory_model/ManageProduct_model');	
	$response = $this->ManageProduct_model->addProductCategory($_POST);
  if($response['status'] == 0){
	echo'<div class="alert alert-danger w3-margin">
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
  echo'<div class="alert alert-success w3-margin">
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
}
/*addd product caegory ends here*/


public function UpdateRecord(){   /* this fun for update product records*/

			extract($_POST);
			//print_r($_POST);die();
			$data = $_POST;
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