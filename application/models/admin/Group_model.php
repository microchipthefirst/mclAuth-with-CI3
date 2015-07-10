<?php

class Group_model extends CI_Model {

    function Get_Groups() {
        $this->load->model('admin/mdl');
        try {
            $result = $this->mdl->get_table('usergroups');
            if (!$result) {
                throw new Exception();
            } else {
                return $result;
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }

    function Get_ActiveGroups() {
        $this->load->model('admin/mdl');
        try {
            $result = $this->db->select('ID,Name')
                    ->where('Active', '1')
                    ->get('usergroups');
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

    function Get_Group_By_ID($id) {
        $this->load->model('admin/mdl');
        try {
            $result = $this->mdl->get_where('usergroups', $id);
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

    function Insert($data) {
        $this->load->model('admin/mdl');
        try {
            $result = $this->mdl->_insert('usergroups', $data);
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

    function Update($id, $data) {
        $this->load->model('admin/mdl');
        try{
            $result = $this->mdl->_update('usergroups', $id, $data);
            if(!$result){
                throw new exception();
            }else{
                return $result;
            }
        } catch (Exception $ex) {
            $error = $this->db->error();
            echo "Error Number: " . $error['code'];
            echo "Error Message: " . $error['message']();
        }
    }

    function Delete($id) {
        $this->load->model('admin/mdl');
        $result = $this->mdl->get_where("usergroups",$id);
        if($result){
            $this->mdl->_delete('usergroups',$id);
        }
    }

//    Method chaining
//    $query = $this->db->select('title')
//                ->where('id', $id)
//                ->limit(10, 20)
//                ->get('mytable');
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

