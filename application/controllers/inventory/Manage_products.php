<?php
class Manage_products extends CI_controller{

public function index(){

	$this->load->model('ManageProduct_model');	
	$data['all_categories'] = $this->ManageProduct_model->getProductcategory();	


  $data['products'] = $this->ManageProduct_model->getProductsId(); 
  $this->load->view('manage_products', $data);

	}

public function showMaterial(){

    extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
    $this->load->model('ManageProduct_model');
    $price = $this->ManageProduct_model->showMaterial($data);
print_r($price);

}

public function add_products(){

	$this->load->model('ManageProduct_model');
  $data['all_materials'] = $this->ManageProduct_model->getMaterialId(); 
	$data['all_categories'] = $this->ManageProduct_model->getProductcategory();
	$this->load->view('add_products', $data);

}
public function Show_Material_Product_Association(){

    extract($_POST);
    $data = $_POST;
    $this->load->model('ManageProduct_model');  
    $response = $this->ManageProduct_model->Show_Material_Product_Association($data);

    $count=1;
      if($response['status']==0){
     for($i = 0; $i < count($response['status_message']); $i++) { 
           echo '<tr class="text-center">
                 <td class="text-center">'.$count.'</td>
                 <td class="text-center">'.$response['status_message'][$i]['material_name'].'</td>
                 <td class="text-center"><a class="btn w3-red w3-medium w3-padding-small" title="DeleteProduct" href="'.base_url().'Manage_products/DeleteMaterialProductAssoc?product_material_assoc_id='.$response['status_message'][$i]['product_material_assoc_id'].'" style="padding:0"><i class="fa fa-close"></i>Delete</a></td>
                 </tr>';
                  $count++;
               }
              }
             else
            {
             echo'<tr><td style="text-align: center;">No Records Found...!</td></tr>';
            }


}
public function Save_Material_product_assoc(){
      extract($_POST);
      //print_r($_POST);die();
      $data = $_POST;
      $this->load->model('ManageProduct_model');
      $response = $this->ManageProduct_model->Save_Material_product_assoc( $data );
      $count=1;
      if($response['status']==0){
     for($i = 0; $i < count($response['status_message']); $i++) { 
           echo '<tr class="text-center">
                 <td class="text-center">'.$count.'</td>
                 <td class="text-center">'.$response['status_message'][$i]['material_name'].'</td>
                 <td class="text-center"><a class="btn w3-red w3-medium w3-padding-small" title="DeleteProduct" href="'.base_url().'Manage_products/DeleteMaterialProductAssoc?product_material_assoc_id='.$response['status_message'][$i]['product_material_assoc_id'].'" style="padding:0"><i class="fa fa-close">&nbsp;</i> Delete</a></td>
                 </tr>';
                  $count++;
               }
              }
             else
            {
             echo'<tr><td style="text-align: center;">No Records Found...!</td></tr>';
            }
}

public function DeleteMaterialProductAssoc(){
  extract($_GET);
  $data = $_GET;
  $this->load->model('ManageProduct_model');  
  $response = $this->ManageProduct_model->DeleteMaterialProductAssoc($data);
  redirect('Manage_products');

}
public function save_Products(){
  
	$data = $this->input->post();
	$this->load->model('ManageProduct_model');
	$response = $this->ManageProduct_model->save_Products($data);
  //print_r($response); die();
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
}


public function DeleteProduct(){
	$this->load->model('ManageProduct_model');	
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
}

public function DeleteRecord(){
	extract($_GET);
			//print_r($_POST);die();
	$data = $_GET;
	$this->load->model('ManageProduct_model');	
	$records = $this->ManageProduct_model->DeleteRecord($data);
}
public function addProductCategory(){

	$this->load->model('ManageProduct_model');	
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
public function ShowProductsTable(){

	$this->load->model('ManageProduct_model');	
	$all_categories = $this->ManageProduct_model->getProductcategory();

	$this->load->model('ManageProduct_model');	
	$data = $this->ManageProduct_model->getProduct_Records($_POST);

	echo'<table class="table table-bordered">
               <tr>
                 <th>Product&nbsp;id</th>
                 <th>Product&nbsp;name</th>
                 <th>Product&nbsp;category&nbsp;id</th>
                 <th>ID</th>
                 <th>OD</th>
                 <th>Thickness</th>
                 <th>Price</th>
                 <th>Actions</th>
               </tr>';
               //print_r($data);
         if($data['status']==0){
		 for($i = 0; $i < count($data['status_message']); $i++) { 
             echo '<tr>
                 <td>'.$data['status_message'][$i]['product_id'].'</td>
                 <td>'.$data['status_message'][$i]['product_name'].'</td>
                 <td>'.$data['status_message'][$i]['product_category_id'].'</td>
                 <td>'.$data['status_message'][$i]['ID'].'</td>
                 <td>'.$data['status_message'][$i]['OD'].'</td>
                 <td>'.$data['status_message'][$i]['thickness'].'</td>
                 <td>'.$data['status_message'][$i]['price'].'</td>
                 <td><a class="btn w3-medium" title="UpdateProduct" data-toggle="modal" data-target="#updateMenu_'.$data['status_message'][$i]['product_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
					<a class="btn w3-medium" title="DeleteProduct" href="'.base_url().'Manage_products/DeleteRecord?Product_id='.$data['status_message'][$i]['product_id'].'" style="padding:0"><i class="fa fa-trash"></i></a>
					<!-- Modal -->
					<div id="updateMenu_'.$data['status_message'][$i]['product_id'].'" class="modal fade " role="dialog">
						<div class="modal-dialog ">
							<!-- Modal content-->
							<div class="modal-content modal-md">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title w3-xxlarge w3-text-red">Update</h4>
								</div>
								<div class="modal-body">
									<form method="POST" action="'.base_url().'Manage_products/UpdateRecord">
										<div class="w3-center">
										<input type="hidden" class="" id="new_Product_id" name="new_Product_id" value="'.$data['status_message'][$i]['product_id'].'">
										<input type="hidden" class="" id="new_Product_category_id" name="new_Product_category_id" value="'.$data['status_message'][$i]['product_category_id'].'">
										</div><br>
										
										<label>Product Name: </label>
										<input class="form-control" type="text" value="'.$data['status_message'][$i]['product_name'].'" id="updated_ProductName" name="updated_ProductName"><br>

										<label>Select Category: </label>										 
										 <select class="form-control w3-margin-bottom" name="update_Product_category_id" id="update_Product_category_id">';
        								 foreach ($all_categories as $result ) 
        								 {
        								 	$selected="";
        								 	if($result->product_category_id==$data['status_message'][$i]['product_category_id'])
        								 		{$selected='selected';}
        								 echo'<option value='.$result->product_category_id.' '.$selected.'> '.$result->product_category_name.'</option>';
      								     }
      								 	echo'</select>

      								 	<label>Measurements: </label><br>
      								 	<div class="w3-col l12 w3-margin-bottom">
      								 		<div class="w3-col l3">
      								 			<input type="number" name="UpdatedInner_dimention" id="UpdatedInner_dimention" value="'.$data['status_message'][$i]['ID'].'" class="form-control " step="0.01" min="0" placeholder="ID" required>
      								 		</div>
      								 		<div class="w3-col l1 w3-padding">
													<b>X</b>
      								 		</div>
      								 		<div class="w3-col l3">
 			       								<input type="number" name="UpdatedOuter_dimention" id="UpdatedOuter_dimention" class="form-control " value="'.$data['status_message'][$i]['OD'].'" step="0.01" min="0" placeholder="OD" required>
      								 		</div>
      								 		<div class="w3-col l1 w3-padding">
      								 				<b>X</b>
      								 		</div>
      								 		<div class="w3-col l3">
		        								<input type="number" name="Updatedinput_Thickness" id="Updatedinput_Thickness" class="form-control " value="'.$data['status_message'][$i]['thickness'].'" placeholder="Thickness" step="0.01" min="0" required><br>
      								 		</div>
      								 	</div>      								 	

										<label>Price:</label>
										<input type="number" name="updated_Price" id="updated_Price" value="'.$data['status_message'][$i]['price'].'"  class="form-control w3-margin-bottom" placeholder="Material Length And Thickness" style="margin:0px; width: 120px;" step="0.01" min="0" required/>
										
										<button class="btn w3-red" type="submit" name="updateRecord" id="updateRecord">Update Menu</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!--modal end--> 
					</td>
              </tr>'; 
         	}   
         } 
         else
         {
         	echo'<tr><td colspan="7" style="text-align: center;">No Records Found...!</td></tr>';
         } 
      echo '</table>';
	}


public function UpdateRecord(){

			extract($_POST);
			//print_r($_POST);die();
			$data = $_POST;
			$this->load->model('ManageProduct_model');
		  $response = $this->ManageProduct_model->UpdateProductRecord( $data );
			if ($response['status'] == 0) {
       redirect('Manage_products');
      } else {
       redirect('Manage_products');
      }
}




}
?>