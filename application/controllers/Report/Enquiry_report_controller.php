
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);

class Enquiry_report_controller extends CI_Controller {

    public function index() {
        $this->load->database();
        $this->load->model('Report/Enquiry_report_model');
        $data['wo_info'] = $this->Enquiry_report_model->get_all_data($From_date, $To_date, $cust_id);
        $this->load->model('inventory_model/ManageCustomer_model');
        $data['all_customer'] = Enquiry_report_controller::getcustomerDetails();
        $this->load->view('includes/navigation.php');
        $this->load->view('Report/enquiry_To_woreports.php', $data);
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

    public function get_all_data() {
        extract($_POST);

        $path = base_url();
        $url = $path . 'api/Enquiry_To_woReports_api/Enquiry_report_api?From_date=' . $filter_fromDate . '&To_date=' . $filter_toDate . '&cust_id=' . $customer_idFilter;
        //echo $url;die();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        $count = 1;
        if ($response['status'] == 0) {
            echo '<div class="alert alert-danger">
               <strong>' . $response['status_message'] . '</strong> 
               </div>';
        } else {

            foreach ($response['status_message'] as $value) {
                $dateEnq = $value['date_on'];
                //print_r($dateEnq);die();
                $datewo = $value['dated'];
                //print_r($datewo);die();
                $date1Timestamp = strtotime($datewo);
                $date2Timestamp = strtotime($dateEnq);
                $difference = $date1Timestamp - $date2Timestamp;
                $diff = floor($difference / (60 * 60 * 24));
                $date_difference = $diff;
                $enquiry_id = $value['enquiry_id'];
                //print_r($enquiry_id);die();
                $quotation_id = $value['quotation_id'];
                $branch_name = $value['branch_name'];
                $customer_name = $value['customer_name'];
                $enquiry_raised_date = $value['date_on'];
                $workorder_raised_date = $value['dated'];
                $daystaken = $date_difference;

                echo
                '<tr class="">
             <td class="w3-center">' . $count . '</td>
            <td class="w3-center">' . $enquiry_id . '</td>
             <td class="w3-center">' . $quotation_id . '</td>
            <td class="w3-center">' . $branch_name . '</td>
            <td class="w3-center">' . $customer_name . '</td>
              <td class="w3-center">' . $enquiry_raised_date . '</td>
                <td class="w3-center">' . $workorder_raised_date . '</td>
                  <td class="w3-center">' . $daystaken . '</td>
            </tr>';
                $count++;
            }
        }
    }

    public function sort_byBranch() {
        extract($_POST);
        //print_r($_POST);die();
        $path = base_url();
        $url = $path . 'api/Enquiry_To_woReports_api/sort_byBranch?From_date=' . $From_date . '&To_date=' . $To_date . '&Sort_by_branch=' . $Sort_by_branch . '&cust_id=' . $cust_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        // print_r($response_json);
        $count = 1;
        if ($response['status'] == 0) {
            echo '<div class="alert alert-danger">
               <strong>' . $response['status_message'] . '</strong> 
               </div>';
        } else {
            foreach ($response['status_message'] as $value) {
                $dateEnq = $value['date_on'];
                //print_r($dateEnq);die();
                $datewo = $value['dated'];
                //print_r($datewo);die();
                $date1Timestamp = strtotime($datewo);
                $date2Timestamp = strtotime($dateEnq);
                $difference = $date1Timestamp - $date2Timestamp;
                $diff = floor($difference / (60 * 60 * 24));
                $date_difference = $diff;
                $enquiry_id = $value['$enquiry_id'];
                $quotation_id = $value['$quotation_id'];
                $branch_name = $value['branch_name'];
                $customer_name = $value['customer_name'];
                $enquiry_raised_date = $value['date_on'];
                $workorder_raised_date = $value['dated'];
                $daystaken = $date_difference;

                echo
                '<tr class="">
             <td class="w3-center">' . $count . '.</td>
            <td class="w3-center">' . $enquiry_id . '.</td>
             <td class="w3-center">' . $quotation_id . '.</td>
            <td class="w3-center">' . $branch_name . '</td>
            <td class="w3-center">' . $customer_name . '</td>
              <td class="w3-center">' . $enquiry_raised_date . '</td>
                <td class="w3-center">' . $workorder_raised_date . '</td>
                  <td class="w3-center">' . $daystaken . '</td>
            </tr>';
                $count++;
            }
        }
    }

}
