<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageEnquiry_model extends CI_Model {

    public function getBest_tube($material_id, $Material_ID, $Material_OD, $Material_LENGTH) {
        $criteriaForTube = ManageEnquiry_model::CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH);

        return ($criteriaForTube);
    }

    public function CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH) {

        $sql = "SELECT * from raw_materialstock WHERE material_id = '$material_id'";
        $result = $this->db->query($sql);
        $rawMaterial_ID = 0;
        $rawMaterial_OD = 0;
        $rawMaterial_Tolerance = 0;
        $rawMaterial_LENGTH = 0;
        $criteria = array();
        $response = array();
        
        foreach ($result->result_array() as $row) {
            $rawMaterial_ID = $row['raw_ID'];
            $rawMaterial_OD = $row['raw_OD'];
            $rawMaterial_LENGTH = $row['avail_length'];
            $rawMaterial_Tolerance = $row['tolerance'];
            $Conditionone = $Material_ID - $rawMaterial_ID;
            $Conditiontwo = $Material_OD + $rawMaterial_Tolerance;
            //echo $Conditionone;
            if ($Conditionone >= 0) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($rawMaterial_OD >= $Conditiontwo) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($Conditionone == $Material_ID) {
                $criteria[] = 1;
            } elseif ($Conditionone >= $rawMaterial_Tolerance) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }
            
            
            $length_avail=($Material_LENGTH + $rawMaterial_Tolerance);
                //echo $length_avail;
                if($rawMaterial_LENGTH >= $length_avail) {
                    $criteria[] = 1;
                }
                else{
                    $criteria[] = 0;
                }
            //print_r($criteria);
            if (in_array(0, $criteria)) {
                $response = array(
                    'status' => 0,
                    'value' => 'N/A'
                );
                unset($criteria);
            } else {
                $length_avail=($Material_LENGTH + $rawMaterial_Tolerance);
                //echo $length_avail;                
                    $response = array(
                        'status' => 1,
                        'value' => $rawMaterial_ID.'/'.$rawMaterial_OD
                    );  
                    unset($criteria);
                    break;
            }
            
            
        }
        return ($response);
    }

}

?>