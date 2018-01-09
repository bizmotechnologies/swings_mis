<?php 

class Finished_good_model extends CI_Model {

public function GetFinishedGoodsDetails() {

        $query = "SELECT * FROM finished_goods";
        //echo $query();die();
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    } 

    public function ShowFinishedGoods($data) {
        extract($data);

        $sql = "INSERT INTO finished_goods (material_name,id,od,length,
            price,discount_percentage,margin_percentage,cost_price,quotation,
            vendor_name,quantity) 
        values ('$Fmaterial','$Id','$Od','$Lenght','$Price','$Discount',
            '$Margin','$CostPrice','$Select_Quotation','$Select_Vendor',
            '$Quantity',)";
        //echo $sql; die();
        $result = $this->db->query($sql);

        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Enquiry Details Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Enquiry Not Inserted Successfully...!');
        }
   
        return $response;
    } 

    public function GetQuotationIdFromquoation_master() {

        $query = "SELECT * FROM quotation_master";
        //echo $query();die();
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'no records found');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }    
}
?>