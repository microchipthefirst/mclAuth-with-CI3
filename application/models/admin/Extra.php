<?php

class Extra extends CI_Model {

    function getTable($data, $optionbuttons,$class, $check, $response) {
        //builds a bootstrap-enabled table from 
        //$data - an array returned using result_array()
        //Optionbuttons is a key=>value array where the key is the text to print (in an <a> tag
        //and the value is the href content.
        //The table must have an ID field in the $data array.  This is used to populate the optionbuttons.
        //Examples are Edit, Delete etc.
        //Class is the class definition, if required, for bootstrap - provide an empty string for no class.
        $str = "<table id='myTable' class='table table-striped'>";
        $str .= "<tr>";
        foreach ($data[0] as $key=>$value)
        {
            $str .= "<td>$key</td>";
        }
        $str .= "</tr>";
        foreach($data as $d){
            $str .= "<tr>";
            foreach($d as $key=>$value){
                if ($key == 'ID') {
                        $id = $value;
                    }elseif($check){
                        if ($value == "1") {
                            $toggle = "Deactivate";
                        } else {
                            $toggle = "Activate";
                        }
//                        $response;
                    }
                $str .= "<td> $value</td>";
            }
            //trying to pass a bit of code as text
//            if ($value == "1") {
//                            $toggle = "Deactivate";
//                        } else {
//                            $toggle = "Activate";
//                        }
            //from admin_view/activate_group - it isn't working...
        foreach($optionbuttons as $key=>$value){
            $optionkey =  $key;
            if($response != ""){
                $optionvalue = $toggle;
            }else{
                $optionvalue = $value;
            }                        
            $str .= "<td><a href='$optionvalue$id' $class>$optionkey</a></td>";            
        }
            $str .= "</tr>";            
        }
       $str .= "</table>";
       return $str;
//        echo $response;
    }

    function htmlSelect($data, $size, $name, $width, $select) {
        //build a select clause from incoming data
        //$data contains an array returned from a table returned by Result_array()
        //Name is the Select tag's name to identify the data on the form's posting
        //Size is the number of rows to display - send an empty string for default
        //Width is the number of pixels wide the select should be - send an empty string for default
        //Select contains a key=>value array defining field name and value to define the selected row.
        if ($size == "") {
            $size = "empty";
        } else {
            $size = "size='$size'";
        }
        if ($width == "") {
            $width = "empty";
        } else {
            $width = " style='width: $width'";
        }
        foreach ($select as $key => $value) {
            $selectkey = $key;
            $selectvalue = $value;
        }
        $str = "<select class='form-control' name=$name $size $width>";
        foreach ($data as $d) {
            foreach ($d as $key => $value) {
                If ($key == $selectkey) {
                    if ($selectvalue == $value) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= "<option value=" . $d['ID'] . " $selected>" . $d['Name'] . " </option>";
                }
            }
        }
        $str .= "</select>";
        return $str;
    }

    function getParamSelect($data, $name, $size) {
        $str = "<select name=$name size=$size style='width: 90px'>";
        foreach ($data as $d) {
            $str .= "<option value=" . $d['ID'] . ">" . $d['Descr'] . "</option>";
        }
        $str .= "</select>";
        return $str;
    }

    function getParamSelectVAT($data, $name, $size) {
        $str = "<select name=$name size=$size style='width: 90px'>";
        foreach ($data as $d) {
            $str .= "<option value=" . $d['ID'] . ">" . $d['Descr'] . "</option>";
        }
        $str .= "</select>";
        return $str;
    }

}

function buildTable($result) {
//        print_r($result);
    $str = "<table id='myTable' class='table table-striped'>";
    $str .= "<tr>";
    foreach ($result as $key => $value) {
        $str .= "<td width=10>$key</td>";
    }
    $str .= "</tr><tr>";
    foreach ($result as $arr) {
        foreach ($arr as $key => $value) {
            $str .= "<td> $arr</td>";
        }
    }
    $str .= "</tr></table>";
    return $str;
}

?>