<?php
class MaterialStock_Management extends CI_controller{

public function index(){

  $this->load->model('MaterialStockManagement_model');
  $response['All_Material'] = $this->MaterialStockManagement_model->GetMaterialDetails();// this fun shows that the select material values
  //print_r($response); die();
  $response['details'] = $this->MaterialStockManagement_model->Getreceived_Stock(); 
        //print_r($response);
  $this->load->view('materialstock_management', $response);

	}

public function Save_StockMaterial_Info(){ // this fun for add stock by vender to stocks
	extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
	$this->load->model('MaterialStockManagement_model');
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

}
public function Update_UpdatedStockMaterial_Info(){

    extract($_POST);
    $data = $_POST;
    $this->load->model('MaterialStockManagement_model');
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

}
public function DeleteStockDetails(){

  extract($_GET);
     // print_r($_GET);die();
  $data = $_GET;
  $this->load->model('MaterialStockManagement_model');  
  $records = $this->MaterialStockManagement_model->DeleteStockDetails($data);
    redirect('MaterialStock_Management');

}
public function ShowMaterialStock(){

	extract($_POST);
      //print_r($_POST);die();
    $data = $_POST;
    $this->load->model('MaterialStockManagement_model');
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

       }

}
?>