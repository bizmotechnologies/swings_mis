<?php
class Vendor_Management extends CI_controller{

public function index(){
 
 $this->load->model('VendorManagement_model');
 $response['details'] = $this->VendorManagement_model->GetAllVendorDetails();
 $this->load->view('vendor_management', $response);

}

public function save_VendorDetails(){  /*this fun for saving all vendor details*/

	extract($_POST);
	$data = $_POST;
    //print_r($data); die();
	$this->load->model('VendorManagement_model');
	$response = $this->VendorManagement_model->save_VendorDetails( $data ); 

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
}/* this save vndor details fun ends here*/

public function Update_VendorDetails(){  /*this fun is used to update vendor details*/

	extract($_POST);
	$data = $_POST;
	//print_r($data); die();
      $this->load->model('VendorManagement_model');
      $response = $this->VendorManagement_model->Update_VendorDetails( $data );
      //print_r($response['status_message']);die();
       if($response['status'] == 0)
       {
      	        echo $response['status_message'];
       }
       else
       {
      	      	echo $response['status_message'];
       }

}/*fun update vendor details ends here*/

public function DeleteVendorDetails(){/*fun for delete vendor info*/

		extract($_GET);
        $data = $_GET;
        $this->load->model('VendorManagement_model');  
        $response = $this->VendorManagement_model->DeleteVendorDetails($data);
        redirect('Vendor_Management');      
	  }/*fun ends here*/

}
?>