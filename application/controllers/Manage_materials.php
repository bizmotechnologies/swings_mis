<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_materials extends CI_controller{
	
	public function index(){
		//$this->load->helper('url');
		$this->load->model('ManageMaterial_model');	
		$data['all_categories'] = $this->ManageMaterial_model->getcategory();
		
		$this->load->view('includes/navigation.php');
		$this->load->view('admin/manage_material', $data);
	}
	public function add_material(){
		$this->load->model('ManageMaterial_model');	
		$data['all_categories'] = $this->ManageMaterial_model->getcategory();
		$this->load->view('add_material',$data);
	}
	public function Update(){
			extract($_POST);
			//print_r($_POST);die();
			$data = $_POST;
			$this->load->model('ManageMaterial_model');
			$new= $this->ManageMaterial_model->updateRecord( $data );
			redirect('manage_material');
			
	}
	public function saveMaterial(){
		$this->form_validation->set_rules('inputmaterial_name', 'Material Name', 'required');
		$this->form_validation->set_rules('input_ingredients', 'Material Ingredients', 'required');
		$this->form_validation->set_rules('input_material_category_id', 'Material Category', 'required');
		$this->form_validation->set_rules('input_length_thickness', 'Material Length', 'required');
		$this->form_validation->set_rules('input_instock_quantity', 'Material Instock Quantity', 'required');
		$this->form_validation->set_rules('input_priceFor_material', 'Material Price', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if($this->form_validation->run() )
		{
			$data = $this->input->post();
			$this->load->model('ManageMaterial_model');
			$response = $this->ManageMaterial_model->saverecord( $data );

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
	}

	public function Delete(){

			extract($_GET);
			//print_r($_POST);die();
			$data = $_GET;
			$this->load->model('ManageMaterial_model');
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
        redirect('manage_material');

		
	}

	public function addCategory(){
	$this->load->model('ManageMaterial_model');	
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

	public function Showmaterialtable(){
		//$data=($_POST);
		//print_r($data);

		$this->load->model('ManageMaterial_model');	
		$all_categories= $this->ManageMaterial_model->getcategory();

		$this->load->model('ManageMaterial_model');
		$response= $this->ManageMaterial_model->getrecord($_POST);
		//$this->load->view('home', $data);
		//print_r($data);
		echo'<table class="table table-bordered">
               <tr>
                 <th>Material&nbsp;id</th>
                 <th>Material&nbsp;name</th>
                 <th>Material&nbsp;category&nbsp;id</th>
                 <th>Ingrediants</th>
                 <th>Lenth/thickness</th>
                 <th>Instock&nbsp;quantity</th>
                 <th>Price</th>
                 <th>Actions</th>
               </tr>';
         if($response['status']==1){
		 for($i = 0; $i < count($response['status_message']); $i++) { 
             echo '<tr>
                 <td>'.$response['status_message'][$i]['material_id'].'</td>
                 <td>'.$response['status_message'][$i]['material_name'].'</td>
                 <td>'.$response['status_message'][$i]['material_category_id'].'</td>
                 <td>'.$response['status_message'][$i]['ingredients'].'</td>
                 <td>'.$response['status_message'][$i]['length_thickness'].'</td>
                 <td>'.$response['status_message'][$i]['instock_quantity'].'</td>
                  <td>'.$response['status_message'][$i]['material_price'].'</td>
                 <td><a class="btn w3-medium" title="Updatematerial" data-toggle="modal" data-target="#updateMenu_'.$response['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
					<a class="btn w3-medium" title="Deletematerial" href="'.base_url().'Home/Delete?material_id='.$response['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-trash"></i></a>
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
									<form method="POST" action="'.base_url().'Home/Update">
										<div class="w3-center">
										<input type="hidden" class="" id="new_material_id" name="new_material_id" value="'.$response['status_message'][$i]['material_id'].'">
										<input type="hidden" class="" id="new_material_category_id" name="new_material_category_id" value="'.$response['status_message'][$i]['material_category_id'].'">
										</div><br>
										<label>Material Name: </label>
										<input class="form-control" type="text" value="'.$response['status_message'][$i]['material_name'].'" id="updated_materialname" name="updated_materialname"><br>

										<label>Ingrediants: </label>
										<input class="form-control" type="text" value="'.$response['status_message'][$i]['ingredients'].'" id="updated_ingredients" name="updated_ingredients"><br>
										<label>Select Category: </label>										 
										 <select class="form-control" name="update_category_id" id="update_category_id">';
        								 foreach ($all_categories as $result ) 
        								 {
        								 	$selected="";
        								 	if($result->material_category_id==$response['status_message'][$i]['material_category_id'])
        								 		{$selected='selected';}
        								 echo'<option value='.$result->material_category_id.' '.$selected.'> '.$result->material_category_name.'</option>';
      								     }
      								 	echo'</select>
										<label>Length:</label>
										<input type="number" name="updated_materiallength" id="updated_materiallength" value="'.$response['status_message'][$i]['length_thickness'].'"  class="form-control w3-margin-bottom" placeholder="Material Length And Thickness" style="margin:0px; width: 120px;" step="0.01" min="0" required/>
										<label>Instock&nbsp;Quantity:</label>
										<input type="number" name="updated_instockquantity" id="updated_instockquantity" value="'.$response['status_message'][$i]['instock_quantity'].'"  class="form-control w3-margin-bottom" placeholder="Material Instock Quantity" style="margin:0px; width: 120px;" step="0.01" min="0" required/>
										<label>Price:</label>
										<input type="number" name="updated_materialPrice" id="updated_materialPrice" value="'.$response['status_message'][$i]['material_price'].'"  class="form-control w3-margin-bottom" placeholder="Material Instock Quantity" style="margin:0px; width: 120px;" step="0.01" min="0" required/>
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

}
 ?>