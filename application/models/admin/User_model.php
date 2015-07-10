<?php

class User_model extends CI_Model {

    function Activate_Users_WithGroup() {
        $this->load->model('admin/mdl');
        $sql = 'select ID, fname as "Firstname", lname as "Lastname", active as "Active" from members order by ID';
        try {
            $result = $this->mdl->_custom_query($sql);
            if (!$result) {
                throw new exception();
            } else {
                return $result->result_array();
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }

    function Get_AllUsers() {
        $this->load->model('admin/mdl');
        $sql = 'Select members.ID, fname as "Firstname", lname as "Lastname", Username as "Loginname",email as "E-mail", usergroups.Name as "Group", members.active as "Active" from members, usergroups where members.GroupID = usergroups.ID order by members.ID';
        try {
            $result = $this->db->query($sql);
            if (!$result) {
                throw new exception();
            } else {
                return $result->result_array();
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }

    function Get_User_Where_With_Labels($id) {
        $sql = 'Select members.ID, fname as "Firstname", lname as "Lastname", Username as "Loginname",email as "E-mail", usergroups.Name as "Group", members.active from members, usergroups where members.ID = ' . $id . ' and members.GroupID = usergroups.ID order by members.ID';
        $this->load->model('admin/mdl');
        try {
            $result = $this->mdl->_custom_query($sql);
            if (!$result) {
                throw new exception();
            } else {
                return $result;
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }

    function Get_User_By_ID($id) {
        $this->load->model('admin/mdl');
//        try {
            $result = $this->mdl->get_where('members', $id);
            if (!$result) {
//                throw new exception();
                return false;
            } else {
                return $result;
            }
//        } catch (Exception $ex) {
////            $error = $this->db->error();
////            echo "Error Number: " . $error['code'];
////            echo "Error Message: " . $error['message']();
//        }
    }

    function Get_Custom($sql) {
        $this->load->model('admin/mdl');
        try {
            $result = $this->mdl->_custom_query($sql);
            if (!$result) {
                throw new exception();
            } else {
                return $result;
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }
    function Insert($data){
        $this->load->model('admin/mdl');
        try{
            $result = $this->mdl->_insert('members',$data);
            if(!$result){
                throw new exception('opps');
            }else{
                return $result;
            }
        
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();

        }
    }
    
    function Update($id, $data){
        $this->load->model('admin/mdl');
//        try{
            $result = $this->mdl->_update('members',$id, $data);
            if(!$result){
                
            }else{
                return $result;
            }
//        } catch (Exception $ex) {
// echo "Error Number: " . $this->db->_error_number() . "<br />";
//            echo "Error Message: " . $this->db->_error_message();
//        }
        
    }
    function Delete($id){
        $this->load->model('admin/mdl');
        $result = $this->mdl->get_where('members',$id);
        if($result){
            #record exists
            $this->mdl->_delete('members',$id);
        }
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

