<?php

class VendorManagement_model extends CI_Model{

  public function save_VendorDetails($data){/*fun for save vendor deatails*/
   extract($data);

   $sql = "INSERT INTO vendor_details (vendor_name, vendor_email, vendor_shopname, vendor_shopaddress,
    vendor_country, vendor_state, vendor_city, contact_no_one, contact_no_two, vendorbank_name,
    vendorbank_address, vendor_accno, vendor_ifsc_no, vendor_micr_no, vendor_pan_no, submitted_date)
    VALUES ('$Input_VendorName','$Input_VendorEmail','$Input_VendorShopName','$Input_VendorShopAddress',
   '$Select_VendorCountry','$Select_VendorState','$Input_VendorCity','$Input_VendorContactNo_one',
   '$Input_VendorContactNo_two','$Input_VendorsBank_name','$Input_VendorBank_Address',
   '$Input_VendorBank_AccNo','$Input_VendorBank_IFSC_Code','$Input_VendorBank_MICR_Code','$Input_VendorPAN_No',now())";

$resultnew =$this->db->query($sql);

if($resultnew){  
 $response=array(
   'status' => 1,
   'status_message' =>'Records Inserted Successfully..!');
}
else{
  $response=array(
    'status' => 0,
    'status_message' => 'Records Not Inserted Successfully...!');
}

return $response;

}/*fun ends here*/

public function GetAllVendorDetails(){  /*this function is used to show all info of vendors in table*/

  $query = "SELECT * FROM vendor_details WHERE visible = '1'";

  $result =$this->db->query($query);

  if($result->num_rows()<=0){  
   $response=array(
     'status' => 1,
     'status_message' =>'No Records Found.'	);
 }
 else{
  $response=array(
    'status' => 0,
    'status_message' => $result->result_array());
}
return $response;

} /*this function is used to show all info of vendors in table*/

public function Update_VendorDetails($data){/*this fun is for update vendor detaisl*/
	extract($data);

  $sql = "UPDATE vendor_details SET vendor_name = '$Updated_VendorName',
  vendor_email = '$Updated_VendorEmail',vendor_shopname = '$Updated_VendorShopName',
  vendor_shopaddress = '$Updated_VendorShopAddress',vendor_country = '$SelectVendorUpdated_Country',
  vendor_state = '$SelectUpdatedVendor_State',vendor_city = '$UpdateVendor_City',
  contact_no_one = '$Updated_VendorContactNo_one' ,contact_no_two = '$Updated_VendorContactNo_two' ,
  vendorbank_name = '$Updated_VendorBank_name' , vendorbank_address = '$Updated_VendorBank_Address' ,
  vendor_accno = '$Updated_VendorBank_AccNo' ,vendor_ifsc_no = '$UpdatedVendor_Bank_IFSC_Code',
  vendor_micr_no='$UpdatedVendor_Bank_MICR_Code', vendor_pan_no='$VendorUpdated_PAN_No' WHERE vendor_id ='$new_Vendor_id'";

  $resultUpadateCustomerDetails =$this->db->query($sql);

  if($resultUpadateCustomerDetails){  
    $response=array(
      'status' => 1,
      'status_message' =>'Records Updated Successfully..!');
  }
  else{
    $response=array(
      'status' => 0,
      'status_message' => 'Records Not Updated Successfully...!');
  }
  return $response;

}/*vendor update details ends here*/

public function DeleteVendorDetails($data){ /*this fun for delete vendor details */

  extract($data);
    //print_r($data);die();
  $sqldelete = "UPDATE vendor_details SET visible = '0' WHERE vendor_id = '$Vendor_id'";

  $resultdelete =$this->db->query($sqldelete);

  if($resultdelete){  
    $response=array(
      'status' => 1,
      'status_message' =>'Records Deleted Successfully..!');
  }
  else{
    $response=array(
      'status' => 0,
      'status_message' => 'Records Not Deleted Successfully...!');
  }
  return $response;
}
/*delete fun ends here*/



}
?>