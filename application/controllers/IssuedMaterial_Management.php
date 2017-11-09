<?php
class IssuedMaterial_Management extends CI_controller{

public function index(){

  $this->load->model('IssuedMaterialManagement_model');
  $this->load->view('issuedmaterial_management');

}



?>