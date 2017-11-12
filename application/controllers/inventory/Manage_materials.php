<?php 
class Manage_materials extends CI_controller{
	
	public function index(){
		//$this->load->helper('url');
		$this->load->model('inventory_model/ManageMaterial_model');	
		$data['all_categories'] = $this->ManageMaterial_model->getcategory();
        $this->load->view('includes/navigation');
		$this->load->view('inventory/materials/manage_material', $data);
	}
//----this function is used to update material details-----
	public function Update(){
			extract($_POST);
			//print_r($_POST);die();
			$data = $_POST;
			$this->load->model('inventory_model/ManageMaterial_model');
			$new= $this->ManageMaterial_model->updateRecord( $data );
			redirect('inventory/materials/manage_material');
			
	}
	//--this function is used to update material details

public function add_material(){
    $this->load->view('includes/navigation');
	$this->load->view('inventory/materials/add_material');

}
		//--- this function is used to save material details------

	public function saveMaterial(){
			extract($_POST);
			$data = $_POST;
			//print_r($data);die();
			$this->load->model('inventory_model/ManageMaterial_model');
			$response = $this->ManageMaterial_model->saveMaterial( $data );

		if($response['status'] == 0){
	       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
   				window.location.reload();
            }, 1000);
            </script>';
        }
        else
        {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
				window.location.reload();
            }, 1000);
            </script>';
        }

		
	}
	//--- this function is used to save material details------

// ---- this function is used to delete material details-------

	public function Delete(){

			extract($_GET);
			//print_r($_POST);die();
			$data = $_GET;
			$this->load->model('inventory_model/ManageMaterial_model');
			$response= $this->ManageMaterial_model->deleteRecord( $data );
			if($response['status'] == 0){
	       echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
			window.location.reload();
            }, 1000);
            </script>';
        }
        else
        {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
            <strong>'.$response['status_message'].'</strong> 
            </div>
            <script>
            window.setTimeout(function() {
             $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
             });
				window.location.reload();
            }, 1000);
            </script>';
        }
        redirect('Manage_materials');

		
	}
// ---- this function is used to delete material details-------

	public function addCategory(){
	$this->load->model('inventory_model/ManageMaterial_model');	
	$response = $this->ManageMaterial_model->addcategory($_POST);
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
        }
        else
        {
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
//----------this function is used to show material wise details of material table ------
	public function Showmaterialtable(){
		//$data=($_POST);
		//print_r($data);

		$this->load->model('inventory_model/ManageMaterial_model');	
		$all_categories= $this->ManageMaterial_model->getcategory();

		$this->load->model('inventory_model/ManageMaterial_model');
		$response= $this->ManageMaterial_model->getrecord($_POST);
		//$this->load->view('home', $data);
		//print_r($data);
		echo'<table class="table table-bordered">
               <tr>
                 <th>Material&nbsp;id</th>
                 <th>Material&nbsp;name</th>
                 <th>Material&nbsp;ID</th>
                 <th>Material&nbsp;OD</th>
                 <th>Price&nbsp;(cost/mm)</th>
                 <th>Price in <i class="fa fa-rupee"></i>:</th>
                 <th>Actions</th>
               </tr>';
         if($response['status']==1){
		 for($i = 0; $i < count($response['status_message']); $i++) { 
             echo '<tr>
                 <td>'.$response['status_message'][$i]['material_id'].'</td>
                 <td>'.$response['status_message'][$i]['material_name'].'</td>
                 <td>'.$response['status_message'][$i]['material_innerdimention'].'</td>
                 <td>'.$response['status_message'][$i]['material_outerdimention'].'</td>
                 <td>'.$response['status_message'][$i]['pricepermm'].'</td>           
                  <td>'.$response['status_message'][$i]['conversion_rate'].'</td>
                 <td><a class="btn w3-medium" title="Updatematerial" data-toggle="modal" data-target="#updateMenu_'.$response['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
					<a class="btn w3-medium" title="Deletematerial" href="'.base_url().'inventory/Manage_materials/Delete?material_id='.$response['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-trash"></i></a>
					<!-- Modal -->
					<div id="updateMenu_'.$response['status_message'][$i]['material_id'].'" class="modal fade " role="dialog">
						<div class="modal-dialog ">
							<!-- Modal content-->
							<div class="modal-content col-lg-8 col-lg-offset-2">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title w3-xxlarge w3-text-red">Update</h4>
								</div>
								<div class="modal-body">
									<form method="POST" action="'.base_url().'inventory/Manage_materials/Update">
										<div class="w3-center">
										<input type="hidden" class="" id="new_material_id" name="new_material_id" value="'.$response['status_message'][$i]['material_id'].'">
										<input type="hidden" class="" id="new_material_category_id" name="new_material_category_id" value="'.$response['status_message'][$i]['material_id'].'">
										</div><br>
										<label>Material Name: </label>
										<input class="form-control" type="text" value="'.$response['status_message'][$i]['material_name'].'" id="updated_materialname" name="updated_materialname" required><br>

										<label>Material&nbsp;ID: </label>
										<input class="form-control" type="text" value="'.$response['status_message'][$i]['material_innerdimention'].'" id="updated_materialID" name="updated_materialID" required><br>

										<label>Material&nbsp;OD: </label>
										<input class="form-control" type="text" value="'.$response['status_message'][$i]['material_outerdimention'].'" id="updated_materialOD" name="updated_materialOD" required><br>
										<div class="w3-col l12">
                                        <div class="w3-col l4 w3-padding-right">
                                        <label>Price&nbsp;<span class="w3-tiny">(cost/mm)</span>:</label>
                                        <input type="number" name="updated_costpermm" id="updated_costpermm" value="'.$response['status_message'][$i]['pricepermm'].'"  class="form-control w3-margin-bottom" placeholder="Material Instock Quantity"  step="0.01" min="0" required/>
                                        </div>
                                        <div class="w3-col l4">
                                        <label class="w3-text-white">currency:</label>
                                           <select class="form-control getmaterialdetails" name="Select_UpdatedCurrency" id="Select_UpdatedCurrency"  required>
                                                          <option value="0">Currency </option>
                                                          <option value="dollar">Dollar</option>
                                                          <option value="euro">Euro</option>
                                                          <option value="pound">Pound</option>
                                                          <option value="rupees">Rupees</option>
                                            </select>
                                           </div>
                                        <div class="w3-col l4 w3-padding-left">
                                          <label>Price in <i class="fa fa-rupee"></i>:</label>
                                           <input type="number" name="UpdatedCurrency_amount" id="UpdatedCurrency_amount" class="form-control" placeholder="Currency Amount" step="0.01" required>
                                        </div>                                       
                                         </div><br>										
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
         	echo'<tr><td colspan="7" style="text-align: center;">'.$response['status_message'].'</td></tr>';
         } 
      echo '</table>';
	}
//----------this function is used to show material wise details of material table ------

}
 ?>