<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);

class Regrettable_report_controller extends CI_Controller {

    public function index() {
        $this->load->database();
        $this->load->model('Report/Enquiry_report_model');
        $this->load->model('inventory_model/ManageCustomer_model');
        $data['all_customer'] = Regrettable_report_controller::getcustomerDetails();
        $this->load->view('includes/navigation.php');
        $this->load->view('Report/regrettable_view.php', $data);
    }

    public function getCustomerDetails() {

        $path = base_url();
        $url = $path . 'api/ManageCustomer_api/getCustomerDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function get_regrettable_data() {
        extract($_POST);
        $customer_id = '14';
        $path = base_url();
        $url = $path . 'api/Regrettable_report_api/get_regrettable_data?From_date=' . $filter_fromDate . '&To_date=' . $filter_toDate . '&cust_id=' . $customer_idFilter;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        $key = '';
        $row = '';
        $material = '';
        $count = 1;
        if ($response['status'] == 0) {
            echo '<div class="alert alert-danger">
               <strong>' . $response['status_message'] . '</strong> 
               </div>';
        } else {
            foreach ($response['status_message'] as $key) {
                $enquiry_id = $key['enquiry_id'];
                $customer_name = $key['customer_name'];
                $branch_name = $key['branch_name'];

                $row = json_decode($key['products_associated'], true);
                foreach ($row as $value) {
                    $product_name = $value['product_name'];
                    
                    foreach ($value['material_associated'] as $data) {
                        if ($data['regret_material'] == 1) {

                            // $material_id=$data['material_id'];
                        }
                        echo '<tr class="">
               <td class="w3-center">'.$count.'</td>
               <td class="w3-center">'.$enquiry_id.'</td>
               <td class="w3-center">'.$customer_name.'</td>
               <td class="w3-center">'.$branch_name.'</td>
               <td class="w3-center">'.$product_name.'</td>
               <td class="w3-center">'.$material_id.'</td>
                  
            </tr>';
                        $count++;
                    }
                }
            }
        }
        //print_r($material_id);die();
    }

    public function sort_byBranch() {
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Regrettable_report_api/sort_byBranch?From_date=' . $From_date . '&To_date=' . $To_date . '&Sort_by_branch=' . $Sort_by_branch . '&cust_id=' . $cust_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        // print_r($response_json);

        $key = '';
        $row = '';
        $material = '';
        $count = 1;
        if ($response['status'] == 0) {
            echo '<div class="alert alert-danger">
               <strong>' . $response['status_message'] . '</strong> 
               </div>';
        } else {
            foreach ($response['status_message'] as $key) {
                $enquiry_id = $key['enquiry_id'];
                $customer_name = $key['customer_name'];
                $branch_name = $key['branch_name'];

                $row = json_decode($key['products_associated'], true);
                foreach ($row as $value) {
                    $product_name = $value['product_name'];
                    //$materials = $value['material_associated'];
                    foreach ($value['material_associated'] as $data) {
                        $material_id = $data[material_id];

                        '<tr class="">
             <td class="w3-center">' . $count . '</td>
            <td class="w3-center">' . $enquiry_id . '</td>
             <td class="w3-center">' . $customer_name . '</td>
            <td class="w3-center">' . $branch_name . '</td>
              <td class="w3-center">' . $product_name . '</td>
                <td class="w3-center">' . $material_id . '</td>
                  
            </tr>';
                        $count++;
                    }
                }
            }
        }
    }

}
