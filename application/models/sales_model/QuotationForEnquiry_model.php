<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuotationForEnquiry_model extends CI_Model {

//------------this fun is for get all enquiries for quotation status-------------
    public function fetchEnquiry_For_Quotation() {
        $query = "SELECT * FROM enquiry_master WHERE current_status = '1'";

        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

//------------this fun is for get all enquiries for quotation status-------------
//------------this fun is for get all enquiries for sorting-------------
    public function GetEnquiriesForSorting() {
        $query = "SELECT * FROM enquiry_master";

        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Quotations Found for specified Filter !!!.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

//------------this fun is for get all enquiries for sorting-------------
//------------this fun is for get all enquiries sort by date, customer and sort-------------

    public function filter_quotation($From_date, $To_date, $customer_Id) {

        if ($customer_Id == '') {
            $query = "SELECT * FROM quotation_master WHERE dated BETWEEN '$From_date' AND '$To_date' AND current_status!='0' ";
        } else {
            $query = "SELECT * FROM quotation_master WHERE dated BETWEEN '$From_date' AND '$To_date' AND customer_id='$customer_Id' AND current_status!='0' ";
        }

        //echo $query;die();
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Quotations Found for specified Filter !!!');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

    //------------this fun is for get all enquiries sort by date, customer and sort-------------//
    //------------this fun is used to get enquiries by enquiry id--------------------------------//
    public function Show_Enquiry($enquiry_id) {
        $query = "SELECT * FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";

        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

    //------------this fun is used to get enquiries by enquiry id--------------------------------//
    //------------this fun is used to get enquiry product by enquiry id--------------------------------//
    public function getEnquiry_products($enquiry_id) {
        $query = "SELECT products_associated FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";

        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = 0;
        } else {
            $response = $result->result_array();
        }
        return $response;
    }

    //------------this fun is used to get enquiry product by enquiry id--------------------------------//
    //------------this fun is used to save quotation--------------------------------//
    public function save_quotation($data) {
        extract($data);

        $delivery_P = '';
        $enquiry_products = QuotationForEnquiry_model::getEnquiry_products($enquiry_id);

        $this->load->model('inventory_model/ManageCustomer_model');
        $customer_details = $this->ManageCustomer_model->getCustomerBy_ID($customer_id);

        if ($enquiry_products == 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'Quotation Raised Successfully');

            return $response;
            die();
        }

        //print_r($enquiry_products);die();
        switch ($delivery_period) {
            case '1':
            $delivery_P = 'day/days';
            break;

            case '2':
            $delivery_P = 'week/weeks';
            break;

            case '3':
            $delivery_P = 'month/months';
            break;

            case '4':
            $delivery_P = 'year/years';
            break;

            default:
                # code...
            break;
        }

        $delivery_within = $delivery_span . ' ' . $delivery_P;
        $insert_quotation = "INSERT INTO quotation_master(enquiry_id,customer_id,customer_name,product_associated,delivery_within,dated,time_at,current_status) VALUES ('$enquiry_id','$customer_id','" . $customer_details[0]['customer_name'] . "','" . $enquiry_products[0]['products_associated'] . "','$delivery_within',NOW(),NOW(),'1')";

        if ($this->db->query($insert_quotation)) {

            //--------------update enquiry from live enquiry to Quotation---------------------
            $update_enquiry = "UPDATE enquiry_master SET current_status = '0' WHERE enquiry_id = '$enquiry_id'";
            if ($this->db->query($update_enquiry)) {
                $response = array(
                    'status' => 1,
                    'status_message' => 'Quotation Raised Successfully');
            } else {
                $response = array(
                    'status' => 0,
                    'status_message' => 'Quotation Raised but Enquiry remained Live!!!');
            }
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Quotation Raising Failed');
        }

        return $response;
    }

    //------------this fun is used to save quotation--------------------------------//
    // -----------------------contact customer for quotation----------------------//
    //-------------------------------------------------------------//
    public function contact_admin() {
        // extract($data);
        // $this->load->model('admin_settings');
        // $all_mailsettings=$this->admin_settings->allMailSettings();
        // $admin_mail=$all_mailsettings[0]['mail_email'];
        // $admin_password=$all_mailsettings[0]['mail_password'];
        //$mail->SMTPDebug = 2;                               // Enable verbose debug output


        $emailFrom = 'samrat.munde@bizmo-tech.com';
        $nameFrom = 'Seal-Wings ';

        // Configure email library
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'seal-wings.com';
        $config['smtp_timeout'] = '7';
        $config['smtp_port'] = 465;
        $config['charset'] = 'iso-8859-1';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
//$config[‘validation’] = TRUE; // bool whether to validate email or not
        $config['smtp_user'] = 'test@seal-wings.com';
        $config['smtp_pass'] = 'sealwings@123';

// Load email library and passing configured values to email library
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

// Sender email address
        $this->email->from('test@seal-wings.com', 'username');
// Receiver email address
        $this->email->to('samratbizmotech@gmail.com');
// Subject of email
        $this->email->subject('Hii test mail');
// Message in email
        $this->email->message('Test mail content');



        //require 'mail/PHPMailerAutoload.php';
//         $mail = new PHPMailer;
// $mail->SMTPDebug = 2;                               // Enable verbose debug output
// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'seal-wings.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
//         $mail->Username = 'test@seal-wings.com';                 // SMTP username
//         $mail->Password = 'sealwings@123';                           // SMTP password
//         $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//         $mail->Port = 465;                                    // TCP port to connect to
//         $mail->setFrom('samratbizmotech@gmail.com', 'samrat');
//         $mail->addAddress($emailFrom, $nameFrom);     // Add a recipient
//         $mail->addReplyTo('samratbizmotech@gmail.com', 'samrat');
//         // $mail->addCC('cc@example.com');
//         // $mail->addBCC('bcc@example.com');
//         $mail->isHTML(true);                                  // Set email format to HTML
//         $mail->Subject = 'Response for your Enquiry';
//         $mail->Body    = 'There is a query from <b>'.$emailFrom.'</b><br>This is the body in plain text for non-HTML mail clients<br>';
//         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients<br>';
        // if(!$mail->send()) {
        if ($this->email->send()) {
            $response = array(
                'status' => 0,
                'status_message' => 'Message could not be sent. <br>Mailer Error: ' . $mail->ErrorInfo
            );
        } else {
            $response = array(
                'status' => 1,
                'status_message' => 'Message has been sent'
            );
        }
        //sql query to insert user row and create an account
        return $response;
    }

    //----------------------------contact customer END------------------------------//
    //------------this fun is used to get enquiry product by enquiry id--------------------------------//
    public function sendTo_PO($quotation_id) {
        $update_quotation = "UPDATE quotation_master SET current_status = '2' WHERE quotation_id = '$quotation_id'";
        if ($this->db->query($update_quotation)) {
            $response = array(
                'status' => 1,
                'status_message' => 'Quotation sent to PO Successfully');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Quotation sent to PO Failed!!!');
        }
        return $response;
    }

//------------this fun is used to get enquiry product by enquiry id--------------------------------//
//----------this fun is used to insert quotation for revised quotation-------------------------------------//
    public function getEnquiry_DetailsFor_MultipleQuotation($data) {
        extract($data);
        $productarr = '';
        $customer_id = '';
        $customer_name = '';
        $productinfoArr = '';
        $profile_id = '';
        $prod_price = '';
        $delivery_within = '';
        $delivery_period = '';

        switch ($revise_deliveryPeriod) {
            case '1':
            $delivery_period = 'day/days';
            break;

            case '2':
            $delivery_period = 'week/weeks';
            break;

            case '3':
            $delivery_period = 'month/months';
            break;

            case '4':
            $delivery_period = 'year/years';
            break;

            default:
                # code...
            break;
        }
        $Updated_price = json_decode($product_JSON, TRUE);

        $Product_details = QuotationForEnquiry_model::getquotationdetails($enquiry_id); //----fun for get quotation details
        $product_information = json_decode($Product_details, true);

        $query = "SELECT * FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $products = array(
                'status' => 0,
                'status_message' => 'Records not found....!');
        } else {
            $extra = array();
            foreach ($result->result_array() as $row) {
                $productinfoArr = $row['products_associated'];
                $customer_id = $row['customer_id'];
                $customer_name = $row['customer_name'];
            }
            foreach (json_decode($productinfoArr, TRUE) as $key) {//-----loop for compare value in below loop
                $extra = array(
                    'profile_id' => $key['profile_id'],
                    'product_price' => $key['product_price']
                );
                $count = 0;
                foreach ($product_information as &$prod) {//-----loop for update json price
                    if ($prod['profile_id'] == $key['profile_id']) {
                        $prod['product_price'] = $Updated_price[$count];
                    }
                    $count++;
                }
            }

            $productarr = json_encode($product_information);
        }
//print_r($productarr);die();
        $sqlupdate = "UPDATE quotation_master SET current_status = '0' WHERE enquiry_id = '$enquiry_id'"; //----update enquiry befor insert to status 0
        $resultupdate = $this->db->query($sqlupdate);

        if ($resultupdate) {
            $delivery_within = $revise_deliverySpan . ' ' . $delivery_period;
            $sqlinsert = "INSERT INTO quotation_master(enquiry_id,customer_id,customer_name,"
            . "product_associated,delivery_within,dated,time_at,current_status) "
                    . "VALUES ('$enquiry_id','$customer_id','$customer_name','$productarr','$delivery_within',NOW(),NOW(),'1')"; //----insert new quotation into quotation master

                    $resultinsert = $this->db->query($sqlinsert);
                    if ($resultinsert) {
                        $response = array(
                            'status' => 1,
                            'status_message' => 'Quotation Inserted Successfully..!');
                    } else {
                        $response = array(
                            'status' => 0,
                            'status_message' => 'Quotation did not get revised...!');
                    }
                } else {
                    $response = array(
                        'status' => 0,
                        'status_message' => 'Quotation did not get revised...!');
                }
                return $response;
            }

//----------this fun is used to insert quotation for revised quotation-------------------------------------//
//----------this fun is used to fetch enquiry details-------------------------------------//

            public function getquotationdetails($enquiry_id) {
                $sql = "SELECT * FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";

                $result = $this->db->query($sql);
                $Product_details = '';
                if ($result->num_rows() <= 0) {
                    $Product_details = array(
                        'status' => 0,
                        'status_message' => 'No Records Found.');
                } else {
                    foreach ($result->result_array() as $row) {
                        $Product_details = $row['products_associated'];
                    }
                }
                return $Product_details;
            }

//----------this fun is used to fetch enquiry details-------------------------------------//
//----this fun is used to sort quotation by status----------------------------//

            public function sort_byStatus($From_date, $To_date, $Sort_by, $customer_Id) {
                
                if ($From_date == '' && $To_date == '' && $customer_Id == '') {
                    $sqlsort = "SELECT * FROM quotation_master WHERE current_status ='$Sort_by'";
                }
                else if($From_date == '' && $To_date == ''){
                    $sqlsort = "SELECT * FROM quotation_master WHERE customer_id = '$customer_Id' AND current_status ='$Sort_by'";
                }
                else if($customer_Id == '' && $To_date == ''){
                    $sqlsort = "SELECT * FROM quotation_master WHERE customer_id = '$customer_Id' AND dated <= '$To_date' AND current_status ='$Sort_by'";
                }
                else if($From_date == '' && $customer_Id == ''){
                    $sqlsort = "SELECT * FROM quotation_master WHERE customer_id = '$customer_Id' AND dated >= '$From_date' AND current_status ='$Sort_by'";
                }
                 else {
                    if ($From_date == '') {
                        $sqlsort = "SELECT * FROM quotation_master WHERE customer_id = '$customer_Id' AND dated <= '$To_date' AND current_status ='$Sort_by'";
                    } else if ($To_date == '') {
                        $sqlsort = "SELECT * FROM quotation_master WHERE customer_id = '$customer_Id' AND dated >= '$From_date' AND current_status ='$Sort_by'";
                    } else if ($customer_Id == '') {
                        $sqlsort = "SELECT * FROM quotation_master WHERE dated BETWEEN '$From_date' AND '$To_date' AND current_status ='$Sort_by'";
                    } else {
                        $sqlsort = "SELECT * FROM quotation_master WHERE dated BETWEEN '$From_date' AND '$To_date' AND customer_id='$customer_Id' AND current_status ='$Sort_by' ";
                    }
                }
        //echo $sqlsort;die();
                $result = $this->db->query($sqlsort);

                if ($result->num_rows() <= 0) {
                    $response = array(
                        'status' => 0,
                        'status_message' => 'No Quotations Found for specified Filter !!!');
                } else {
                    $response = array(
                        'status' => 1,
                        'status_message' => $result->result_array());
                }
                return $response;
            }

//----this fun is used to sort quotation by status----------------------------//
//----this fun is used to sort enquiries ----------------------------//
    public function sort_Enquiries($From_date, $To_date, $customer_Id){
        if ($customer_Id == '') {
            $query = "SELECT * FROM enquiry_master WHERE date_on BETWEEN '$From_date' AND '$To_date'";
        } else {
            $query = "SELECT * FROM enquiry_master WHERE date_on BETWEEN '$From_date' AND '$To_date' AND customer_id='$customer_Id'";
        }
        //echo $query;die();
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Enquiries Found for specified Filter !!!');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }
//----this fun is used to sort enquiries ----------------------------//
    //----this fun is used to get customer details----------------------------//

            public function getcustomerDetails() {
        //extract($data);
                $query = "SELECT * FROM customer_details";
                $result = $this->db->query($query);

                if ($result->num_rows() <= 0) {
                    $response = array(
                        'status' => 0,
                        'status_message' => 'No Records Found.');
                } else {
                    $response = array(
                        'status' => 1,
                        'status_message' => $result->result_array());
                }
                return $response;
            }

    //----this fun is used to get customer details----------------------------//
        }
